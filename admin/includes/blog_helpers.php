<?php

/**
 * Doric Multimedia Blog Helpers
 * Premium utility functions for blog management
 * 
 * @package DoricMultimedia
 * @version 2.0
 */

/**
 * Normalize a string into a URL-friendly slug
 * 
 * @param string $value The string to normalize
 * @return string URL-friendly slug
 */
function normalizeBlogSlug(string $value): string
{
    $normalized = strtolower(trim($value));
    $normalized = preg_replace('/[^a-z0-9]+/i', '-', $normalized);
    $normalized = trim((string) $normalized, '-');
    
    // Prevent empty slugs
    if (empty($normalized)) {
        $normalized = 'post-' . uniqid();
    }
    
    return $normalized;
}

/**
 * Generate a secure, unique slug from title
 * 
 * @param string $title The blog post title
 * @param PDO $pdo Database connection for uniqueness check
 * @param int|null $excludeId Post ID to exclude from uniqueness check
 * @return string Unique slug
 */
function generateUniqueSlug(string $title, PDO $pdo, ?int $excludeId = null): string
{
    $baseSlug = normalizeBlogSlug($title);
    $slug = $baseSlug;
    $counter = 1;
    
    while (true) {
        $stmt = $pdo->prepare('SELECT COUNT(*) FROM blogs WHERE slug = :slug' . ($excludeId ? ' AND id != :id' : ''));
        $params = [':slug' => $slug];
        if ($excludeId) {
            $params[':id'] = $excludeId;
        }
        $stmt->execute($params);
        
        if ((int) $stmt->fetchColumn() === 0) {
            break;
        }
        
        $slug = $baseSlug . '-' . $counter;
        $counter++;
    }
    
    return $slug;
}

/**
 * Get the full URL for a blog image with caching support
 * 
 * @param string|null $imagePath The image path or URL
 * @param bool $secure Force HTTPS
 * @return string Full image URL
 */
function blogImageUrl(?string $imagePath, bool $secure = true): string
{
    if (empty($imagePath)) {
        return '/images/no-image2.png';
    }

    // If it's already a full URL
    if (preg_match('/^https?:\/\//i', $imagePath) === 1) {
        return $secure ? preg_replace('/^http:/', 'https:', $imagePath) : $imagePath;
    }

    // Remove leading slashes for consistency
    $cleanPath = ltrim($imagePath, '/');
    
    // Add cache busting for better performance
    $cacheBuster = '';
    if (is_file(__DIR__ . '/../../uploads/blogs/' . $cleanPath)) {
        $cacheBuster = '?v=' . filemtime(__DIR__ . '/../../uploads/blogs/' . $cleanPath);
    }
    
    return '/uploads/blogs/' . rawurlencode($cleanPath) . $cacheBuster;
}

/**
 * Sanitize HTML content for safe display with premium formatting
 * 
 * @param string $content Raw HTML content
 * @param bool $allowImages Allow image tags
 * @param bool $allowLinks Allow link tags
 * @return string Sanitized HTML
 */
function sanitizeBlogHtml(string $content, bool $allowImages = true, bool $allowLinks = true): string
{
    // Define allowed tags with premium formatting support
    $allowedTags = '<p><br><strong><b><em><i><u><ul><ol><li>';
    $allowedTags .= '<h2><h3><h4><h5><h6>';
    $allowedTags .= '<blockquote><cite>';
    $allowedTags .= '<span><div><code><pre><hr>';
    $allowedTags .= '<table><thead><tbody><tr><th><td>';
    $allowedTags .= '<mark><del><ins><small><sub><sup>';
    
    if ($allowImages) {
        $allowedTags .= '<img><figure><figcaption>';
    }
    
    if ($allowLinks) {
        $allowedTags .= '<a>';
    }

    // Remove dangerous elements with content
    $dangerousElements = ['script', 'style', 'iframe', 'object', 'embed', 'form', 'input', 'button', 'svg', 'math', 'meta', 'link', 'base'];
    $pattern = '/<\s*(' . implode('|', $dangerousElements) . ')[^>]*>.*?<\s*\/\s*\1\s*>/is';
    $cleaned = preg_replace($pattern, '', $content);
    
    // Strip disallowed tags
    $sanitized = strip_tags($cleaned, $allowedTags);

    // Remove inline event handlers
    $sanitized = preg_replace('/\s+on[a-zA-Z]+\s*=\s*(?:"[^"]*"|\'[^\']*\'|[^">\s]+)/i', '', $sanitized);

    // Remove javascript: protocol from attributes
    $sanitized = preg_replace('/\s+(?:href|src|action|formaction)\s*=\s*(["\'])javascript:[^"\']*\1/i', '', $sanitized);

    // Normalize links with security attributes
    if ($allowLinks) {
        $sanitized = preg_replace_callback(
            '/<a\s+([^>]*?)href\s*=\s*(["\'])(.*?)\2([^>]*)>/i',
            function($matches) {
                $href = htmlspecialchars($matches[3], ENT_QUOTES, 'UTF-8');
                $attrs = trim($matches[1] . ' ' . ($matches[4] ?? ''));
                
                // Add security attributes
                $attrs = preg_replace('/\s+target\s*=\s*(["\'])[^"\']*\1/i', '', $attrs);
                $attrs = preg_replace('/\s+rel\s*=\s*(["\'])[^"\']*\1/i', '', $attrs);
                
                // Check if internal link
                $isInternal = strpos($href, $_SERVER['HTTP_HOST'] ?? '') !== false || strpos($href, '/') === 0;
                
                $target = $isInternal ? '' : ' target="_blank"';
                $rel = $isInternal ? '' : ' rel="noopener noreferrer"';
                
                return '<a href="' . $href . '"' . $target . $rel . ' ' . $attrs . '>';
            },
            $sanitized
        );
    }

    // Normalize images with lazy loading and proper attributes
    if ($allowImages) {
        $sanitized = preg_replace_callback(
            '/<img\s+([^>]*?)src\s*=\s*(["\'])(.*?)\2([^>]*)>/i',
            function($matches) {
                $src = htmlspecialchars($matches[3], ENT_QUOTES, 'UTF-8');
                $attrs = trim($matches[1] . ' ' . ($matches[4] ?? ''));
                
                // Extract existing alt text
                $alt = '';
                if (preg_match('/alt\s*=\s*(["\'])(.*?)\1/i', $attrs, $altMatch)) {
                    $alt = $altMatch[2];
                }
                
                // Remove existing loading and decoding attributes
                $attrs = preg_replace('/\s+(?:loading|decoding)\s*=\s*(["\'])[^"\']*\1/i', '', $attrs);
                
                return '<img src="' . $src . '" alt="' . htmlspecialchars($alt ?: 'Blog image', ENT_QUOTES, 'UTF-8') . '" loading="lazy" decoding="async" ' . $attrs . '>';
            },
            $sanitized
        );
    }

    // Add responsive table wrapper for better mobile display
    $sanitized = preg_replace('/<table([^>]*)>/i', '<div class="table-responsive"><table$1>', $sanitized);
    $sanitized = str_replace('</table>', '</table></div>', $sanitized);

    return $sanitized;
}

/**
 * Generate a canonical URL for a blog post
 * 
 * @param string $slug The blog slug
 * @param bool $secure Force HTTPS
 * @return string Full canonical URL
 */
function generateBlogCanonicalUrl(string $slug, bool $secure = true): string
{
    $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
    $protocol = $secure ? 'https' : 'http';
    
    // Remove any trailing slashes and ensure clean URL
    $base = $protocol . '://' . $host;
    return rtrim($base, '/') . '/blog/' . rawurlencode($slug);
}

/**
 * Ensure the blog upload directory exists with proper permissions
 * 
 * @param bool $createWebConfig Create web.config for security
 * @return string Directory path
 * @throws RuntimeException If directory cannot be created
 */
function ensureBlogUploadDirectory(bool $createWebConfig = true): string
{
    $dir = __DIR__ . '/../../uploads/blogs';
    
    if (!is_dir($dir)) {
        if (!mkdir($dir, 0775, true)) {
            throw new RuntimeException('Failed to create upload directory: ' . $dir);
        }
    }
    
    // Create .htaccess for Apache to prevent direct access
    $htaccessPath = $dir . '/.htaccess';
    if ($createWebConfig && !is_file($htaccessPath)) {
        $htaccessContent = "# Prevent direct access to uploaded files\n";
        $htaccessContent .= "<FilesMatch \"\.(jpg|jpeg|png|gif|webp)$\">\n";
        $htaccessContent .= "    Order Deny,Allow\n";
        $htaccessContent .= "    Deny from all\n";
        $htaccessContent .= "</FilesMatch>\n";
        file_put_contents($htaccessPath, $htaccessContent);
    }
    
    return $dir;
}

/**
 * Store a featured image with advanced validation and optimization
 * 
 * @param array $file The uploaded file from $_FILES
 * @param array $options Additional options (maxWidth, maxHeight, quality)
 * @return string|null Filename if successful, null otherwise
 * @throws RuntimeException On validation or storage failure
 */
function storeFeaturedImage(array $file, array $options = []): ?string
{
    // Validate upload
    if (!isset($file['tmp_name']) || !is_uploaded_file($file['tmp_name']) || $file['error'] !== UPLOAD_ERR_OK) {
        throw new RuntimeException('Invalid file upload. Please try again.');
    }

    // Define allowed mime types with extensions
    $allowedTypes = [
        'image/jpeg' => ['ext' => 'jpg', 'quality' => 85],
        'image/png' => ['ext' => 'png', 'quality' => 9],
        'image/webp' => ['ext' => 'webp', 'quality' => 80],
        'image/gif' => ['ext' => 'gif', 'quality' => null],
    ];
    
    // Get mime type
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);

    if (!array_key_exists($mime, $allowedTypes)) {
        throw new RuntimeException('Invalid image type. Please upload JPG, PNG, WEBP, or GIF.');
    }

    // Validate file size (max 5MB for premium)
    $maxSize = $options['maxSize'] ?? 5 * 1024 * 1024;
    if ($file['size'] > $maxSize) {
        throw new RuntimeException('Featured image must be under ' . ($maxSize / 1024 / 1024) . 'MB.');
    }

    // Generate secure filename
    $extension = $allowedTypes[$mime]['ext'];
    $filename = 'blog-' . bin2hex(random_bytes(16)) . '.' . $extension;
    
    // Get target directory
    $targetDir = ensureBlogUploadDirectory();
    $targetPath = $targetDir . DIRECTORY_SEPARATOR . $filename;

    // Process image with GD if available
    if (function_exists('imagecreatefromstring')) {
        $imageData = file_get_contents($file['tmp_name']);
        $image = imagecreatefromstring($imageData);
        
        if ($image !== false) {
            // Get image dimensions
            $width = imagesx($image);
            $height = imagesy($image);
            
            // Resize if needed (max 1200px width for performance)
            $maxWidth = $options['maxWidth'] ?? 1200;
            $maxHeight = $options['maxHeight'] ?? 800;
            
            if ($width > $maxWidth || $height > $maxHeight) {
                // Calculate new dimensions maintaining aspect ratio
                $ratio = min($maxWidth / $width, $maxHeight / $height);
                $newWidth = (int) ($width * $ratio);
                $newHeight = (int) ($height * $ratio);
                
                $resizedImage = imagecreatetruecolor($newWidth, $newHeight);
                
                // Preserve transparency for PNG
                if ($mime === 'image/png') {
                    imagealphablending($resizedImage, false);
                    imagesavealpha($resizedImage, true);
                    $transparent = imagecolorallocatealpha($resizedImage, 255, 255, 255, 127);
                    imagefilledrectangle($resizedImage, 0, 0, $newWidth, $newHeight, $transparent);
                }
                
                imagecopyresampled($resizedImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
                imagedestroy($image);
                $image = $resizedImage;
            }
            
            // Save image with appropriate quality
            $saved = false;
            switch ($mime) {
                case 'image/jpeg':
                    $saved = imagejpeg($image, $targetPath, $allowedTypes[$mime]['quality']);
                    break;
                case 'image/png':
                    $saved = imagepng($image, $targetPath, $allowedTypes[$mime]['quality']);
                    break;
                case 'image/webp':
                    $saved = imagewebp($image, $targetPath, $allowedTypes[$mime]['quality']);
                    break;
                default:
                    $saved = false;
            }
            
            imagedestroy($image);
            
            if (!$saved) {
                throw new RuntimeException('Failed to process and save the image.');
            }
            
            return $filename;
        }
    }

    // Fallback: Just move the file if GD is not available
    if (!move_uploaded_file($file['tmp_name'], $targetPath)) {
        throw new RuntimeException('Failed to store the uploaded image.');
    }

    return $filename;
}

/**
 * Remove a featured image file from the filesystem
 * 
 * @param string|null $imageName The image filename
 * @param bool $silent Don't throw errors if file doesn't exist
 * @return bool True if removed or didn't exist, false on error
 */
function removeFeaturedImageFile(?string $imageName, bool $silent = true): bool
{
    if (empty($imageName)) {
        return true;
    }

    // Sanitize filename to prevent directory traversal
    $safeName = basename($imageName);
    if ($safeName !== $imageName) {
        // Potential directory traversal attempt
        return false;
    }
    
    $path = __DIR__ . '/../../uploads/blogs/' . $safeName;
    
    if (!is_file($path)) {
        return true;
    }
    
    if (!unlink($path)) {
        if (!$silent) {
            throw new RuntimeException('Failed to remove image file: ' . $imageName);
        }
        return false;
    }
    
    return true;
}

/**
 * Get the reading time for a blog post
 * 
 * @param string $content The blog content
 * @param int $wordsPerMinute Average reading speed
 * @return array{minutes: int, formatted: string, seconds: int}
 */
function getReadingTime(string $content, int $wordsPerMinute = 200): array
{
    // Strip HTML tags and count words
    $text = strip_tags($content);
    $wordCount = str_word_count($text);
    
    $minutes = max(1, (int) ceil($wordCount / $wordsPerMinute));
    $seconds = (int) ceil(($wordCount / $wordsPerMinute) * 60);
    
    return [
        'minutes' => $minutes,
        'seconds' => $seconds,
        'formatted' => $minutes . ' min' . ($minutes > 1 ? 's' : '') . ' read',
        'wordCount' => $wordCount
    ];
}

/**
 * Generate social sharing URLs
 * 
 * @param string $url The URL to share
 * @param string $title The title of the content
 * @param string|null $image Optional image URL for sharing
 * @return array<string, string> Social media share URLs
 */
function getSocialShareUrls(string $url, string $title, ?string $image = null): array
{
    $encodedUrl = rawurlencode($url);
    $encodedTitle = rawurlencode($title);
    
    return [
        'facebook' => "https://www.facebook.com/sharer/sharer.php?u={$encodedUrl}&t={$encodedTitle}",
        'twitter' => "https://twitter.com/intent/tweet?text={$encodedTitle}&url={$encodedUrl}",
        'linkedin' => "https://www.linkedin.com/sharing/share-offsite/?url={$encodedUrl}",
        'whatsapp' => "https://wa.me/?text={$encodedTitle}%20{$encodedUrl}",
        'email' => "mailto:?subject={$encodedTitle}&body=Check%20out%20this%20post%3A%20{$encodedUrl}",
        'pinterest' => $image ? "https://pinterest.com/pin/create/button/?url={$encodedUrl}&media={$image}&description={$encodedTitle}" : '',
        'telegram' => "https://t.me/share/url?url={$encodedUrl}&text={$encodedTitle}",
    ];
}

/**
 * Generate structured data (JSON-LD) for SEO
 * 
 * @param array $blog Blog post data
 * @param string $canonicalUrl Canonical URL
 * @return array JSON-LD structured data
 */
function generateBlogStructuredData(array $blog, string $canonicalUrl): array
{
    $image = blogImageUrl($blog['featured_image'] ?? null);
    $readingTime = getReadingTime($blog['content'] ?? '');
    
    return [
        '@context' => 'https://schema.org',
        '@type' => 'BlogPosting',
        'headline' => $blog['title'],
        'description' => $blog['excerpt'] ?? substr(strip_tags($blog['content'] ?? ''), 0, 160),
        'image' => $image,
        'datePublished' => $blog['published_at'] ?? $blog['created_at'] ?? date('Y-m-d H:i:s'),
        'dateModified' => $blog['updated_at'] ?? $blog['created_at'] ?? date('Y-m-d H:i:s'),
        'author' => [
            '@type' => 'Person',
            'name' => $blog['author_name'] ?? 'Doric Multimedia',
            'url' => $canonicalUrl,
        ],
        'publisher' => [
            '@type' => 'Organization',
            'name' => 'Doric Multimedia',
            'logo' => [
                '@type' => 'ImageObject',
                'url' => 'https://' . ($_SERVER['HTTP_HOST'] ?? 'localhost') . '/images/dmpl_logo.png'
            ],
            'url' => 'https://' . ($_SERVER['HTTP_HOST'] ?? 'localhost'),
        ],
        'mainEntityOfPage' => [
            '@type' => 'WebPage',
            '@id' => $canonicalUrl
        ],
        'wordCount' => str_word_count(strip_tags($blog['content'] ?? '')),
        'timeRequired' => 'PT' . ($readingTime['seconds'] ?? 60) . 'S',
        'inLanguage' => 'en-US',
        'isAccessibleForFree' => true,
        'copyrightHolder' => [
            '@type' => 'Organization',
            'name' => 'Doric Multimedia'
        ],
        'copyrightYear' => date('Y'),
    ];
}

/**
 * Extract and format meta data for social sharing
 * 
 * @param array $blog Blog post data
 * @return array<string, string> Meta data
 */
function getBlogMetaData(array $blog): array
{
    $title = $blog['seo_title'] ?? $blog['title'];
    $description = $blog['seo_description'] ?? 
                  ($blog['excerpt'] ?? substr(strip_tags($blog['content'] ?? ''), 0, 160));
    $image = blogImageUrl($blog['featured_image'] ?? null);
    $url = generateBlogCanonicalUrl($blog['slug']);
    
    return [
        'title' => htmlspecialchars($title, ENT_QUOTES, 'UTF-8'),
        'description' => htmlspecialchars($description, ENT_QUOTES, 'UTF-8'),
        'image' => htmlspecialchars($image, ENT_QUOTES, 'UTF-8'),
        'url' => htmlspecialchars($url, ENT_QUOTES, 'UTF-8'),
        'keywords' => htmlspecialchars($blog['seo_keywords'] ?? 'Doric Multimedia blog', ENT_QUOTES, 'UTF-8'),
        'type' => 'article',
    ];
}

/**
 * Truncate text with elegant ellipsis
 * 
 * @param string $text The text to truncate
 * @param int $length Maximum length
 * @param string $ellipsis Ellipsis character
 * @return string Truncated text
 */
function truncateText(string $text, int $length = 100, string $ellipsis = '...'): string
{
    if (strlen($text) <= $length) {
        return $text;
    }
    
    $truncated = substr($text, 0, $length);
    
    // Cut at word boundary
    $lastSpace = strrpos($truncated, ' ');
    if ($lastSpace !== false) {
        $truncated = substr($truncated, 0, $lastSpace);
    }
    
    return $truncated . $ellipsis;
}

/**
 * Generate a human-readable date with relative time
 * 
 * @param string $date The date string
 * @param bool $showRelative Show relative time (e.g., "2 days ago")
 * @return string Formatted date
 */
function formatBlogDate(string $date, bool $showRelative = true): string
{
    $timestamp = strtotime($date);
    if (!$timestamp) {
        return $date;
    }
    
    if (!$showRelative) {
        return date('M j, Y', $timestamp);
    }
    
    $diff = time() - $timestamp;
    $diffMinutes = (int) floor($diff / 60);
    $diffHours = (int) floor($diff / 3600);
    $diffDays = (int) floor($diff / 86400);
    $diffWeeks = (int) floor($diff / 604800);
    $diffMonths = (int) floor($diff / 2592000);
    $diffYears = (int) floor($diff / 31536000);
    
    if ($diffMinutes < 1) {
        return 'Just now';
    } elseif ($diffMinutes < 60) {
        return $diffMinutes . ' min' . ($diffMinutes > 1 ? 's' : '') . ' ago';
    } elseif ($diffHours < 24) {
        return $diffHours . ' hour' . ($diffHours > 1 ? 's' : '') . ' ago';
    } elseif ($diffDays < 7) {
        return $diffDays . ' day' . ($diffDays > 1 ? 's' : '') . ' ago';
    } elseif ($diffWeeks < 4) {
        return $diffWeeks . ' week' . ($diffWeeks > 1 ? 's' : '') . ' ago';
    } elseif ($diffMonths < 12) {
        return $diffMonths . ' month' . ($diffMonths > 1 ? 's' : '') . ' ago';
    } else {
        return $diffYears . ' year' . ($diffYears > 1 ? 's' : '') . ' ago';
    }
}

/**
 * Get related posts with smart fallback
 * 
 * @param PDO $pdo Database connection
 * @param array $blog Current blog post
 * @param int $limit Number of related posts
 * @return array Related posts
 */
function getRelatedBlogs(PDO $pdo, array $blog, int $limit = 3): array
{
    $related = [];
    
    // First try: Same category
    if (!empty($blog['category_id'])) {
        $stmt = $pdo->prepare(
            'SELECT b.id, b.title, b.slug, b.excerpt, b.featured_image, b.published_at, c.name AS category_name 
             FROM blogs b 
             LEFT JOIN categories c ON c.id = b.category_id 
             WHERE b.status = :status AND b.id != :id AND b.category_id = :category_id 
             ORDER BY b.published_at DESC 
             LIMIT :limit'
        );
        $stmt->execute([
            ':status' => 'published',
            ':id' => (int) $blog['id'],
            ':category_id' => (int) $blog['category_id'],
            ':limit' => $limit
        ]);
        $related = $stmt->fetchAll();
    }
    
    // Fallback: Any published posts
    if (count($related) < $limit) {
        $remaining = $limit - count($related);
        $stmt = $pdo->prepare(
            'SELECT b.id, b.title, b.slug, b.excerpt, b.featured_image, b.published_at, c.name AS category_name 
             FROM blogs b 
             LEFT JOIN categories c ON c.id = b.category_id 
             WHERE b.status = :status AND b.id != :id 
             ORDER BY b.published_at DESC 
             LIMIT :limit'
        );
        $stmt->execute([
            ':status' => 'published',
            ':id' => (int) $blog['id'],
            ':limit' => $remaining
        ]);
        $fallback = $stmt->fetchAll();
        $related = array_slice(array_merge($related, $fallback), 0, $limit);
    }
    
    return $related;
}

/**
 * Format a DB timestamp for display in IST (Asia/Kolkata).
 * Assumes the DB timestamp is in UTC (Y-m-d H:i:s) and converts it once to IST.
 * Returns formatted string like "13 Aug 2026 · 1:23 PM" or empty string on failure.
 *
 * @param string|null $dbTimestamp
 * @return string
 */
function formatUpdatedAtForDisplay(?string $dbTimestamp): string
{
    if (empty($dbTimestamp)) {
        return '';
    }
    try {
        // Use the application's timezone (set via includes/db.php) and treat the
        // DB timestamp as a local time string for strtotime — this matches the
        // admin/detail rendering which uses `strtotime()` + `date()`.
        $ts = strtotime((string) $dbTimestamp);
        if ($ts === false) {
            return '';
        }
        return date('j M Y · g:i A', $ts);
    } catch (Exception $e) {
        return '';
    }
}