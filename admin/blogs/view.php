<?php
require __DIR__ . '/../includes/auth.php';
require __DIR__ . '/../includes/db.php';
require __DIR__ . '/../includes/blog_helpers.php';

startSecureSession();
requireAdminAuth();

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
if ($id <= 0) {
    $_SESSION['flash_message'] = 'Invalid blog selected.';
    $_SESSION['flash_type'] = 'danger';
    header('Location: /admin/blogs/index.php');
    exit;
}

$pdo = getDbConnection();
$stmt = $pdo->prepare('SELECT b.*, c.name AS category_name, a.name AS author_name FROM blogs b LEFT JOIN categories c ON c.id = b.category_id LEFT JOIN admins a ON a.id = b.author_id WHERE b.id = :id LIMIT 1');
$stmt->execute([':id' => $id]);
$blog = $stmt->fetch();

if (!$blog) {
    $_SESSION['flash_message'] = 'Blog not found.';
    $_SESSION['flash_type'] = 'danger';
    header('Location: /admin/blogs/index.php');
    exit;
}

$pageTitle = $blog['title'];
require __DIR__ . '/../includes/header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($blog['title'], ENT_QUOTES, 'UTF-8'); ?> - Blog Preview</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --brand-primary: #9d3626;
            --brand-dark: #7a2a1e;
            --brand-light: #b54a3a;
            --brand-subtle: rgba(157, 54, 38, 0.08);
            --brand-gradient: linear-gradient(135deg, #9d3626, #7a2a1e);
            --bg-primary: #f1f5f9;
            --bg-card: #ffffff;
            --text-primary: #0f172a;
            --text-secondary: #475569;
            --text-muted: #94a3b8;
            --border-light: rgba(15, 23, 42, 0.06);
            --shadow-sm: 0 1px 3px rgba(15, 23, 42, 0.06);
            --shadow-md: 0 4px 20px rgba(15, 23, 42, 0.08);
            --shadow-lg: 0 12px 40px rgba(15, 23, 42, 0.12);
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 16px;
            --radius-xl: 20px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * { box-sizing: border-box; }

        body {
            background: var(--bg-primary);
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            color: var(--text-primary);
            margin: 0;
            padding: 0;
        }

        /* ===== DASHBOARD CONTENT ===== */
        .dashboard-content {
            max-width: 1100px;
            margin: 0 auto;
            padding: 28px 32px 60px;
        }

        /* ===== PAGE HEADER ===== */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            flex-wrap: wrap;
            gap: 12px;
        }
        .page-header .left h1 {
            font-size: 24px;
            font-weight: 800;
            margin: 0;
            letter-spacing: -0.02em;
            color: var(--text-primary);
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .page-header .left h1 i {
            color: var(--brand-primary);
        }
        .page-header .left .subtitle {
            color: var(--text-secondary);
            font-size: 0.85rem;
            margin: 2px 0 0;
        }

        .btn-secondary {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 18px;
            border-radius: 50px;
            font-weight: 500;
            font-size: 0.85rem;
            color: var(--text-secondary);
            background: var(--bg-card);
            border: 1px solid var(--border-light);
            text-decoration: none;
            transition: var(--transition);
            cursor: pointer;
        }
        .btn-secondary:hover {
            border-color: var(--brand-primary);
            color: var(--brand-primary);
            background: var(--brand-subtle);
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: var(--brand-gradient);
            color: #fff;
            padding: 10px 22px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.85rem;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: var(--transition);
            box-shadow: 0 4px 16px rgba(157, 54, 38, 0.3);
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 28px rgba(157, 54, 38, 0.4);
            color: #fff;
        }

        /* ===== PREVIEW CARD ===== */
        .preview-card {
            background: var(--bg-card);
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-light);
            overflow: hidden;
            transition: var(--transition);
        }
        .preview-card:hover {
            box-shadow: var(--shadow-md);
        }

        .preview-card .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px 28px;
            border-bottom: 1px solid var(--border-light);
            flex-wrap: wrap;
            gap: 10px;
        }
        .preview-card .card-header h3 {
            font-size: 0.95rem;
            font-weight: 700;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--text-primary);
        }
        .preview-card .card-header h3 i {
            color: var(--brand-primary);
        }
        .preview-card .card-header .actions {
            display: flex;
            gap: 8px;
            align-items: center;
            flex-wrap: wrap;
        }
        .preview-card .card-header .actions .btn-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: 1px solid var(--border-light);
            background: var(--bg-card);
            color: var(--text-secondary);
            text-decoration: none;
            transition: var(--transition);
            cursor: pointer;
        }
        .preview-card .card-header .actions .btn-icon:hover {
            border-color: var(--brand-primary);
            color: var(--brand-primary);
            background: var(--brand-subtle);
        }

        /* ===== PREVIEW CONTENT ===== */
        .preview-body {
            padding: 28px 32px 40px;
        }

        /* Featured Image */
        .featured-image-wrap {
            margin-bottom: 24px;
            border-radius: var(--radius-md);
            overflow: hidden;
            border: 1px solid var(--border-light);
            background: var(--bg-primary);
            position: relative;
        }
        .featured-image-wrap img {
            width: 100%;
            max-height: 420px;
            object-fit: cover;
            display: block;
            transition: var(--transition);
        }
        .featured-image-wrap:hover img {
            transform: scale(1.01);
        }
        .featured-image-wrap .image-badge {
            position: absolute;
            bottom: 12px;
            right: 12px;
            background: rgba(15, 23, 42, 0.7);
            backdrop-filter: blur(8px);
            color: #fff;
            padding: 4px 14px;
            border-radius: 50px;
            font-size: 0.7rem;
            font-weight: 500;
        }

        /* Meta Info */
        .meta-row {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 16px;
            align-items: center;
        }
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 14px;
            border-radius: 50px;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }
        .status-badge.published {
            background: #dcfce7;
            color: #16a34a;
        }
        .status-badge.published::before {
            content: '';
            width: 6px;
            height: 6px;
            background: #22c55e;
            border-radius: 50%;
        }
        .status-badge.draft {
            background: #fef3c7;
            color: #d97706;
        }
        .status-badge.draft::before {
            content: '';
            width: 6px;
            height: 6px;
            background: #f59e0b;
            border-radius: 50%;
        }

        .meta-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 14px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 500;
            background: var(--bg-primary);
            color: var(--text-secondary);
        }
        .meta-pill i {
            font-size: 0.7rem;
            color: var(--brand-primary);
        }

        /* Title */
        .preview-title {
            font-size: clamp(1.8rem, 3.2vw, 2.8rem);
            font-weight: 800;
            margin: 0 0 12px;
            letter-spacing: -0.02em;
            color: var(--text-primary);
            line-height: 1.1;
        }

        /* Date Info */
        .date-info {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            margin-bottom: 20px;
            padding-bottom: 16px;
            border-bottom: 1px solid var(--border-light);
        }
        .date-info .item {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.85rem;
            color: var(--text-secondary);
        }
        .date-info .item i {
            color: var(--text-muted);
            font-size: 0.8rem;
        }
        .date-info .item strong {
            color: var(--text-primary);
        }

        /* Excerpt */
        .excerpt-box {
            padding: 16px 20px;
            background: var(--bg-primary);
            border-radius: var(--radius-md);
            border-left: 4px solid var(--brand-primary);
            margin-bottom: 24px;
            font-size: 1rem;
            color: var(--text-secondary);
            line-height: 1.6;
        }
        .excerpt-box i {
            color: var(--brand-primary);
            margin-right: 8px;
        }

        /* Content */
        .content-body {
            font-size: 1.02rem;
            line-height: 1.8;
            color: var(--text-primary);
        }
        .content-body p {
            margin-bottom: 1.2rem;
        }
        .content-body h2 {
            font-size: 1.6rem;
            font-weight: 700;
            margin: 1.8rem 0 0.8rem;
            color: var(--text-primary);
        }
        .content-body h3 {
            font-size: 1.25rem;
            font-weight: 700;
            margin: 1.4rem 0 0.6rem;
            color: var(--text-primary);
        }
        .content-body ul, 
        .content-body ol {
            margin: 0 0 1.2rem 1.5rem;
        }
        .content-body li {
            margin-bottom: 4px;
        }
        .content-body blockquote {
            border-left: 4px solid var(--brand-primary);
            padding: 12px 20px;
            margin: 1.2rem 0;
            background: var(--bg-primary);
            border-radius: 0 var(--radius-sm) var(--radius-sm) 0;
            font-style: italic;
            color: var(--text-secondary);
        }
        .content-body img {
            max-width: 100%;
            border-radius: var(--radius-sm);
            margin: 1.2rem 0;
        }
        .content-body pre {
            background: #0f172a;
            color: #e2e8f0;
            padding: 16px 20px;
            border-radius: var(--radius-sm);
            overflow-x: auto;
            font-size: 0.9rem;
            margin: 1.2rem 0;
        }
        .content-body code {
            background: var(--bg-primary);
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 0.9rem;
            color: var(--brand-primary);
        }

        /* ===== SEO METADATA ===== */
        .seo-metadata {
            margin-top: 32px;
            padding-top: 24px;
            border-top: 1px solid var(--border-light);
        }
        .seo-metadata .seo-title {
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 12px;
            color: var(--text-secondary);
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .seo-metadata .seo-title i {
            color: var(--brand-primary);
        }
        .seo-metadata .seo-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }
        .seo-metadata .seo-item {
            padding: 10px 14px;
            background: var(--bg-primary);
            border-radius: var(--radius-sm);
            border: 1px solid var(--border-light);
        }
        .seo-metadata .seo-item .label {
            font-size: 0.65rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--text-muted);
            display: block;
            margin-bottom: 4px;
        }
        .seo-metadata .seo-item .value {
            font-size: 0.9rem;
            color: var(--text-primary);
            word-break: break-all;
        }
        .seo-metadata .seo-item .value.empty {
            color: var(--text-muted);
            font-style: italic;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 992px) {
            .dashboard-content { padding: 20px 20px 40px; }
            .preview-body { padding: 20px 24px 32px; }
            .seo-metadata .seo-grid { grid-template-columns: 1fr; }
        }

        @media (max-width: 768px) {
            .dashboard-content { padding: 16px 12px 32px; }
            .page-header { flex-direction: column; align-items: flex-start; }
            .page-header .left h1 { font-size: 20px; }
            .preview-card .card-header { padding: 12px 16px; flex-direction: column; align-items: flex-start; }
            .preview-card .card-header .actions { width: 100%; }
            .preview-card .card-header .actions .btn-primary { flex: 1; justify-content: center; }
            .preview-body { padding: 16px 16px 24px; }
            .featured-image-wrap img { max-height: 240px; }
            .preview-title { font-size: 1.5rem; }
            .date-info { flex-direction: column; gap: 6px; }
            .meta-row { gap: 6px; }
            .excerpt-box { font-size: 0.9rem; padding: 12px 16px; }
            .content-body { font-size: 0.95rem; }
        }

        @media (max-width: 480px) {
            .dashboard-content { padding: 12px 8px 24px; }
            .preview-body { padding: 12px 12px 20px; }
            .featured-image-wrap img { max-height: 180px; }
            .preview-title { font-size: 1.3rem; }
            .meta-pill { font-size: 0.65rem; padding: 2px 10px; }
            .status-badge { font-size: 0.6rem; padding: 2px 10px; }
        }

        /* ===== ANIMATIONS ===== */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .preview-card {
            animation: fadeInUp 0.5s ease forwards;
        }

        /* ===== SCROLLBAR ===== */
        .content-body::-webkit-scrollbar {
            width: 6px;
        }
        .content-body::-webkit-scrollbar-track {
            background: var(--bg-primary);
        }
        .content-body::-webkit-scrollbar-thumb {
            background: var(--brand-primary);
            border-radius: 3px;
        }
    </style>
</head>
<body>

<main class="dashboard-content">
    <!-- ===== PAGE HEADER ===== -->
    <div class="page-header">
        <div class="left">
            <h1>
                <i class="fas fa-eye"></i> Blog Preview
            </h1>
            <p class="subtitle">
                <i class="fas fa-circle" style="font-size: 0.3rem; vertical-align: middle; color: var(--brand-primary);"></i>
                <?php echo htmlspecialchars($blog['status'] === 'published' ? 'This post is live on the website' : 'This post is currently in draft mode', ENT_QUOTES, 'UTF-8'); ?>
            </p>
        </div>
    </div>

    <!-- ===== PREVIEW CARD ===== -->
    <div class="preview-card">
        <!-- Card Header -->
        <div class="card-header">
            <h3>
                <i class="fas fa-file-alt"></i>
                <?php echo htmlspecialchars($blog['title'], ENT_QUOTES, 'UTF-8'); ?>
            </h3>
            <div class="actions">
                <a href="/blog/<?php echo htmlspecialchars($blog['slug'], ENT_QUOTES, 'UTF-8'); ?>" 
                   target="_blank" 
                   class="btn-icon" 
                   title="View on website">
                    <i class="fas fa-external-link-alt"></i>
                </a>
                <a href="/admin/blogs/edit.php?id=<?php echo (int) $blog['id']; ?>" 
                   class="btn-icon" 
                   title="Edit post">
                    <i class="fas fa-pen"></i>
                </a>
                <a href="/admin/blogs/index.php" class="btn-primary">
                    <i class="fas fa-arrow-left"></i> Back to Posts
                </a>
            </div>
        </div>

        <!-- Preview Body -->
        <div class="preview-body">
            <!-- Featured Image -->
            <?php if (!empty($blog['featured_image'])): ?>
                <div class="featured-image-wrap">
                    <img src="<?php echo htmlspecialchars(blogImageUrl($blog['featured_image']), ENT_QUOTES, 'UTF-8'); ?>" 
                         alt="<?php echo htmlspecialchars($blog['title'], ENT_QUOTES, 'UTF-8'); ?>">
                    <span class="image-badge">
                        <i class="fas fa-image"></i> Featured
                    </span>
                </div>
            <?php endif; ?>

            <!-- Meta Row -->
            <div class="meta-row">
                <span class="status-badge <?php echo strtolower((string) $blog['status']) === 'published' ? 'published' : 'draft'; ?>">
                    <?php echo ucfirst(htmlspecialchars((string) $blog['status'], ENT_QUOTES, 'UTF-8')); ?>
                </span>
                <span class="meta-pill">
                    <i class="fas fa-tag"></i>
                    <?php echo htmlspecialchars($blog['category_name'] ?: 'Uncategorized', ENT_QUOTES, 'UTF-8'); ?>
                </span>
                <span class="meta-pill">
                    <i class="fas fa-user"></i>
                    <?php echo htmlspecialchars($blog['author_name'] ?: 'Unknown Author', ENT_QUOTES, 'UTF-8'); ?>
                </span>
                <?php if (!empty($blog['views'])): ?>
                    <span class="meta-pill">
                        <i class="fas fa-eye"></i>
                        <?php echo number_format((int) $blog['views']); ?> views
                    </span>
                <?php endif; ?>
            </div>

            <!-- Title -->
            <h1 class="preview-title"><?php echo htmlspecialchars($blog['title'], ENT_QUOTES, 'UTF-8'); ?></h1>

            <!-- Date Info -->
            <div class="date-info">
                <span class="item">
                    <i class="far fa-calendar-alt"></i>
                    Published: <strong><?php echo htmlspecialchars($blog['published_at'] ? date('M j, Y', strtotime((string) $blog['published_at'])) : 'Not published', ENT_QUOTES, 'UTF-8'); ?></strong>
                </span>
                <span class="item">
                    <i class="far fa-clock"></i>
                    Updated: <strong><?php echo htmlspecialchars(date('M j, Y', strtotime((string) $blog['updated_at'])), ENT_QUOTES, 'UTF-8'); ?></strong>
                </span>
                <?php if (!empty($blog['excerpt'])): ?>
                    <span class="item">
                        <i class="fas fa-align-left"></i>
                        <?php echo strlen(strip_tags($blog['excerpt'])); ?> characters
                    </span>
                <?php endif; ?>
            </div>

            <!-- Excerpt -->
            <?php if (!empty($blog['excerpt'])): ?>
                <div class="excerpt-box">
                    <i class="fas fa-quote-left"></i>
                    <?php echo htmlspecialchars($blog['excerpt'], ENT_QUOTES, 'UTF-8'); ?>
                </div>
            <?php endif; ?>

            <!-- Content -->
            <div class="content-body">
                <?php echo $blog['content']; ?>
            </div>

            <!-- SEO Metadata -->
            <?php if (!empty($blog['seo_title']) || !empty($blog['seo_description']) || !empty($blog['seo_keywords']) || !empty($blog['canonical_url'])): ?>
                <div class="seo-metadata">
                    <div class="seo-title">
                        <i class="fas fa-search"></i>
                        SEO Metadata
                    </div>
                    <div class="seo-grid">
                        <?php if (!empty($blog['seo_title'])): ?>
                            <div class="seo-item">
                                <span class="label">SEO Title</span>
                                <span class="value"><?php echo htmlspecialchars($blog['seo_title'], ENT_QUOTES, 'UTF-8'); ?></span>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($blog['seo_description'])): ?>
                            <div class="seo-item">
                                <span class="label">SEO Description</span>
                                <span class="value"><?php echo htmlspecialchars($blog['seo_description'], ENT_QUOTES, 'UTF-8'); ?></span>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($blog['seo_keywords'])): ?>
                            <div class="seo-item">
                                <span class="label">SEO Keywords</span>
                                <span class="value"><?php echo htmlspecialchars($blog['seo_keywords'], ENT_QUOTES, 'UTF-8'); ?></span>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($blog['canonical_url'])): ?>
                            <div class="seo-item">
                                <span class="label">Canonical URL</span>
                                <span class="value"><?php echo htmlspecialchars($blog['canonical_url'], ENT_QUOTES, 'UTF-8'); ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php require __DIR__ . '/../includes/footer.php'; ?>
</body>
</html>