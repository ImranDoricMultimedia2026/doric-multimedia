<?php
require __DIR__ . '/admin/includes/db.php';
require __DIR__ . '/admin/includes/blog_helpers.php';

$requestPath = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH);
if (($requestPath === '/blog' || preg_match('#^/blog/[^/]+$#', (string) $requestPath) === 1) && empty($_GET['slug'])) {
    $pathParts = explode('/', trim((string) $requestPath, '/'));
    if (isset($pathParts[1])) {
        $_GET['slug'] = $pathParts[1];
    }
}

$pdo = getDbConnection();
$slug = trim((string) ($_GET['slug'] ?? ''));

/* ---------- helpers ---------- */
/** plain text nikaal kar word boundary par kaato (mb-safe) */
$snip = static function ($html, int $len): string {
    $text = trim(preg_replace('/\s+/u', ' ', strip_tags((string) $html)));
    if ($text === '' || mb_strlen($text) <= $len) {
        return $text;
    }
    $cut = mb_substr($text, 0, $len);
    $space = mb_strrpos($cut, ' ');
    if ($space !== false && $space > $len * 0.55) {
        $cut = mb_substr($cut, 0, $space);
    }
    return rtrim($cut, " ,.;:-") . '…';
};
$esc = static function ($value): string {
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
};
$initials = static function ($name): string {
    $parts = preg_split('/\s+/u', trim((string) $name), -1, PREG_SPLIT_NO_EMPTY) ?: [];
    if (empty($parts)) {
        return 'D';
    }
    // Use only the first initial for the avatar (single-letter avatar)
    return mb_strtoupper(mb_substr($parts[0], 0, 1));
};

if ($slug !== '') {
    $stmt = $pdo->prepare('SELECT b.*, c.name AS category_name, a.name AS author_name FROM blogs b LEFT JOIN categories c ON c.id = b.category_id LEFT JOIN admins a ON a.id = b.author_id WHERE b.slug = :slug AND b.status = :status LIMIT 1');
    $stmt->execute([':slug' => $slug, ':status' => 'published']);
    $blog = $stmt->fetch();

    if (!$blog) {
        http_response_code(404);
        $pageTitle = 'Blog Not Found';
        $pageDescription = 'The requested Doric Multimedia blog post could not be found.';
        $canonical = 'https://' . ($_SERVER['HTTP_HOST'] ?? 'localhost') . '/blog';
        $ogImage = 'https://' . ($_SERVER['HTTP_HOST'] ?? 'localhost') . '/images/no-image2.png';
    } else {
        $pageTitle = $blog['seo_title'] ?: $blog['title'];
        $pageDescription = $blog['seo_description'] ?: ($blog['excerpt'] ?: $snip($blog['content'], 160));
        $canonical = !empty($blog['canonical_url']) ? $blog['canonical_url'] : generateBlogCanonicalUrl($blog['slug']);
        $ogImage = !empty($blog['featured_image'])
            ? 'https://' . ($_SERVER['HTTP_HOST'] ?? 'localhost') . '/uploads/blogs/' . rawurlencode($blog['featured_image'])
            : 'https://' . ($_SERVER['HTTP_HOST'] ?? 'localhost') . '/images/no-image2.png';

        // Select updated_at explicitly (avoid using published_at/created_at)
        // Include author name so related cards can display author correctly
        $relatedStmt = $pdo->prepare('SELECT b.id, b.title, b.slug, b.excerpt, b.featured_image, b.updated_at AS updated_at, c.name AS category_name, a2.name AS author_name FROM blogs b LEFT JOIN categories c ON c.id = b.category_id LEFT JOIN admins a2 ON a2.id = b.author_id WHERE b.status = :status AND b.id != :id AND b.category_id = :category_id ORDER BY b.updated_at DESC LIMIT 3');
        $relatedStmt->execute([':status' => 'published', ':id' => (int) $blog['id'], ':category_id' => (int) $blog['category_id']]);
        $relatedPosts = $relatedStmt->fetchAll();

        if (count($relatedPosts) < 3) {
            $fallbackStmt = $pdo->prepare('SELECT b.id, b.title, b.slug, b.excerpt, b.featured_image, b.updated_at AS updated_at, c.name AS category_name, a2.name AS author_name FROM blogs b LEFT JOIN categories c ON c.id = b.category_id LEFT JOIN admins a2 ON a2.id = b.author_id WHERE b.status = :status AND b.id != :id ORDER BY b.updated_at DESC LIMIT 6');
            $fallbackStmt->execute([':status' => 'published', ':id' => (int) $blog['id']]);
            $fallbackPosts = $fallbackStmt->fetchAll();

            /* duplicate na aaye — jo ids already related me hain unhe skip karo */
            $seenIds = [(int) $blog['id']];
            foreach ($relatedPosts as $relatedRow) {
                $seenIds[] = (int) $relatedRow['id'];
            }
            foreach ($fallbackPosts as $fallbackRow) {
                if (count($relatedPosts) >= 3) {
                    break;
                }
                if (!in_array((int) $fallbackRow['id'], $seenIds, true)) {
                    $relatedPosts[] = $fallbackRow;
                    $seenIds[] = (int) $fallbackRow['id'];
                }
            }
        }

        $contentHtml = sanitizeBlogHtml($blog['content']);

        /* reading time — str_word_count non-Latin par fail hota hai, isliye manual */
        $plainContent = trim(preg_replace('/\s+/u', ' ', strip_tags((string) $blog['content'])));
        $wordCount = $plainContent === '' ? 0 : count(preg_split('/\s+/u', $plainContent));
        $readingTime = max(1, (int) ceil($wordCount / 200));
    }
} else {
    $stmt = $pdo->prepare('SELECT b.*, c.name AS category_name, a.name AS author_name FROM blogs b LEFT JOIN categories c ON c.id = b.category_id LEFT JOIN admins a ON a.id = b.author_id WHERE b.status = :status ORDER BY b.published_at DESC, b.id DESC');
    $stmt->execute([':status' => 'published']);
    $posts = $stmt->fetchAll();
    $pageTitle = 'Blog';
    $pageDescription = 'Explore the latest business, accounting, GST, and growth insights from Doric Multimedia.';
    $canonical = 'https://' . ($_SERVER['HTTP_HOST'] ?? 'localhost') . '/blog';
}

$isSingle = ($slug !== '' && !empty($blog));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="/">
    <title><?php echo $esc($pageTitle ?? 'Doric Multimedia Blog'); ?></title>
    <meta name="description" content="<?php echo $esc($pageDescription ?? 'Doric Multimedia blog insights.'); ?>">
    <meta name="keywords" content="<?php echo $esc($blog['seo_keywords'] ?? 'Doric Multimedia blog, business insights, accounting, GST, Tally'); ?>">
    <link rel="canonical" href="<?php echo $esc($canonical ?? 'https://' . ($_SERVER['HTTP_HOST'] ?? 'localhost') . '/blog'); ?>">

    <meta property="og:type" content="<?php echo $isSingle ? 'article' : 'website'; ?>">
    <meta property="og:title" content="<?php echo $esc($pageTitle ?? 'Doric Multimedia Blog'); ?>">
    <meta property="og:description" content="<?php echo $esc($pageDescription ?? 'Doric Multimedia blog insights.'); ?>">
    <meta property="og:image" content="<?php echo $esc($ogImage ?? 'https://' . ($_SERVER['HTTP_HOST'] ?? 'localhost') . '/images/no-image2.png'); ?>">
    <meta property="og:image:alt" content="<?php echo $esc($pageTitle ?? 'Doric Multimedia Blog'); ?>">
    <meta property="og:url" content="<?php echo $esc($canonical ?? 'https://' . ($_SERVER['HTTP_HOST'] ?? 'localhost') . '/blog'); ?>">
    <meta property="og:site_name" content="Doric Multimedia">
    <?php if ($isSingle): ?>
        <meta property="article:published_time" content="<?php echo $esc(date('c', strtotime((string) ($blog['published_at'] ?: $blog['created_at'])))); ?>">
        <?php if (!empty($blog['updated_at'])): ?>
            <meta property="article:modified_time" content="<?php echo $esc(date('c', strtotime((string) $blog['updated_at']))); ?>">
        <?php endif; ?>
        <meta property="article:section" content="<?php echo $esc($blog['category_name'] ?: 'Blog'); ?>">
    <?php endif; ?>

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo $esc($pageTitle ?? 'Doric Multimedia Blog'); ?>">
    <meta name="twitter:description" content="<?php echo $esc($pageDescription ?? 'Doric Multimedia blog insights.'); ?>">
    <meta name="twitter:image" content="<?php echo $esc($ogImage ?? 'https://' . ($_SERVER['HTTP_HOST'] ?? 'localhost') . '/images/no-image2.png'); ?>">

    <link rel="stylesheet" href="/blog.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Fraunces:opsz,wght@9..144,500;9..144,600;9..144,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
    /* ======================================================================
       DORIC BLOG — brand #9d3626
       .dbg = listing/shared, .dpost = single post (naya editorial layout)
       ====================================================================== */
    :root{
        --brand:#9d3626;
        --brand-dark:#7a2a1e;
        --brand-light:#b54a3a;
        --brand-tint:rgba(157,54,38,.07);
        --brand-tint-2:rgba(157,54,38,.15);
        --brand-grad:linear-gradient(135deg,#b8412d 0%,#9d3626 45%,#6f2418 100%);

        --ink:#0f172a;
        --ink-2:#475569;
        --ink-3:#8b97a8;
        --paper:#ffffff;
        --paper-2:#f8fafc;
        --paper-3:#f1f4f8;
        --line:rgba(15,23,42,.08);
        --line-2:rgba(15,23,42,.14);

        --sh-sm:0 2px 8px rgba(15,23,42,.06);
        --sh-md:0 12px 40px -14px rgba(15,23,42,.18);
        --sh-lg:0 28px 70px -28px rgba(15,23,42,.3);

        --r-sm:12px; --r-md:16px; --r-lg:22px; --r-pill:999px;
        --t:.3s cubic-bezier(.4,0,.2,1);

        --serif:'Fraunces',Georgia,'Times New Roman',serif;
        --sans:'Inter',-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,sans-serif;
    }
    .dbg *,.dbg *::before,.dbg *::after,
    .dpost *,.dpost *::before,.dpost *::after{box-sizing:border-box;}
    .dbg,.dpost{font-family:var(--sans);color:var(--ink);-webkit-font-smoothing:antialiased;}

    /* ==================================================================
       READING PROGRESS
       ================================================================== */
    .dpost-progress{
        position:fixed;top:0;left:0;right:0;height:3px;z-index:1000;
        background:transparent;pointer-events:none;
    }
    .dpost-progress__bar{
        height:100%;width:0;background:var(--brand-grad);
        box-shadow:0 0 12px rgba(157,54,38,.6);transition:width .1s linear;
    }

    /* ==================================================================
       SINGLE POST — HERO (title/meta sirf EK baar)
       ================================================================== */
    .dpost{background:var(--paper);}
    .dpost__head{
        position:relative;overflow:hidden;
        background:
            radial-gradient(900px 380px at 15% -20%,rgba(157,54,38,.10),transparent 62%),
            radial-gradient(700px 320px at 95% 0%,rgba(15,23,42,.05),transparent 58%),
            linear-gradient(180deg,var(--paper-2),var(--paper));
        border-bottom:1px solid var(--line);
        padding:34px 0 40px;
    }
    .dpost__inner{max-width:1160px;margin:0 auto;padding:0 24px;}
    .dpost__narrow{max-width:760px;}

    /* breadcrumb */
    .dpost-crumb{
        display:flex;align-items:center;gap:9px;flex-wrap:wrap;
        font-size:.79rem;color:var(--ink-3);margin-bottom:22px;
    }
    .dpost-crumb a{color:var(--ink-2);text-decoration:none;font-weight:500;transition:var(--t);}
    .dpost-crumb a:hover{color:var(--brand);}
    .dpost-crumb i.sep{font-size:.55rem;opacity:.5;}
    .dpost-crumb .now{
        color:var(--ink-3);max-width:340px;
        overflow:hidden;text-overflow:ellipsis;white-space:nowrap;
    }

    /* category pill */
    .dpost-cat{
        display:inline-flex;align-items:center;gap:7px;
        padding:6px 15px;border-radius:var(--r-pill);
        background:var(--brand-tint);color:var(--brand);
        border:1px solid var(--brand-tint-2);
        font-size:.73rem;font-weight:700;letter-spacing:.07em;text-transform:uppercase;
        text-decoration:none;transition:var(--t);
    }
    .dpost-cat:hover{background:var(--brand);color:#fff;border-color:var(--brand);}
    .dpost-cat i{font-size:.66rem;}

    /* title — serif display */
    .dpost-title{
        font-family:var(--serif);
        font-size:clamp(1.85rem,4.4vw,3.15rem);
        font-weight:600;line-height:1.1;letter-spacing:-.025em;
        color:var(--ink);margin:18px 0 0;max-width:20ch;
    }
    .dpost-deck{
        margin:16px 0 0;max-width:62ch;
        font-size:clamp(1rem,1.5vw,1.16rem);line-height:1.65;
        color:var(--ink-2);font-weight:400;
    }

    /* byline */
    .dpost-by{
        display:flex;align-items:center;gap:14px;flex-wrap:wrap;
        margin-top:26px;padding-top:22px;border-top:1px solid var(--line);
    }
    .dpost-by__av{
        width:46px;height:46px;flex:0 0 46px;border-radius:50%;
        display:grid;place-items:center;
        background:var(--brand-grad);color:#fff;
        font-size:.88rem;font-weight:700;letter-spacing:.02em;
        box-shadow:0 8px 18px -8px rgba(157,54,38,.7);
    }
    .dpost-by__who{line-height:1.4;}
    .dpost-by__who strong{display:block;font-size:.92rem;font-weight:650;color:var(--ink);letter-spacing:-.01em;}
    .dpost-by__who span{
        display:flex;align-items:center;gap:9px;flex-wrap:wrap;
        font-size:.81rem;color:var(--ink-3);margin-top:3px;
    }
    .dpost-by__who span i{font-size:.72rem;opacity:.8;}
    .dpost-by__who .sep{width:4px;height:4px;border-radius:50%;background:var(--ink-3);opacity:.5;}
    .dpost-by__time{
        display:inline-flex;align-items:center;gap:6px;
        padding:3px 11px;border-radius:var(--r-pill);
        background:var(--paper-3);border:1px solid var(--line);
        font-size:.76rem;font-weight:600;color:var(--ink-2);
    }

    /* ==================================================================
       COVER
       ================================================================== */
    .dpost-cover{
        max-width:1160px;margin:-1px auto 0;padding:34px 24px 0;
    }
    .dpost-cover__frame{
        position:relative;border-radius:var(--r-lg);overflow:hidden;
        box-shadow:var(--sh-md);background:var(--paper-3);
        aspect-ratio:16/8;
    }
    .dpost-cover__frame img{
        width:100%;height:100%;object-fit:cover;display:block;
    }
    .dpost-cover__frame::after{
        content:'';position:absolute;inset:0;pointer-events:none;
        background:linear-gradient(180deg,transparent 60%,rgba(15,23,42,.14));
    }

    /* ==================================================================
       BODY LAYOUT — article + sticky sidebar
       ================================================================== */
    .dpost-main{
        max-width:1160px;margin:0 auto;padding:44px 24px 80px;
        display:grid;grid-template-columns:minmax(0,1fr) 268px;gap:56px;align-items:start;
    }

    /* ---- prose ---- */
    .dpost-body{
        max-width:none;font-size:1.075rem;line-height:1.78;color:#1c2637;
        overflow-wrap:break-word;
    }
    .dpost-body > *:first-child{margin-top:0;}
    .dpost-body p{margin:0 0 1.35em;}
    /* pehle paragraph thoda bada — editorial feel */
    .dpost-body > p:first-of-type{font-size:1.15rem;line-height:1.72;color:#16202f;}

    .dpost-body h2{
        font-family:var(--serif);
        font-size:clamp(1.4rem,2.4vw,1.85rem);font-weight:600;
        line-height:1.22;letter-spacing:-.02em;color:var(--ink);
        margin:2.4em 0 .7em;padding-top:.3em;position:relative;scroll-margin-top:90px;
    }
    .dpost-body h2::before{
        content:'';position:absolute;top:0;left:0;
        width:42px;height:3px;border-radius:3px;background:var(--brand-grad);
    }
    .dpost-body h3{
        font-size:clamp(1.13rem,1.7vw,1.32rem);font-weight:700;
        line-height:1.35;letter-spacing:-.015em;color:var(--ink);
        margin:2em 0 .6em;scroll-margin-top:90px;
    }
    .dpost-body h4{font-size:1.05rem;font-weight:700;margin:1.7em 0 .5em;color:var(--ink);}

    .dpost-body a{
        color:var(--brand);font-weight:500;text-decoration:none;
        border-bottom:1px solid var(--brand-tint-2);transition:var(--t);
    }
    .dpost-body a:hover{border-bottom-color:var(--brand);background:var(--brand-tint);}

    .dpost-body strong,.dpost-body b{font-weight:700;color:var(--ink);}
    .dpost-body em{font-style:italic;}

    .dpost-body ul,.dpost-body ol{margin:0 0 1.35em;padding-left:1.35em;}
    .dpost-body li{margin-bottom:.55em;padding-left:.2em;}
    .dpost-body ul li::marker{color:var(--brand);}
    .dpost-body ol li::marker{color:var(--brand);font-weight:700;}
    .dpost-body li > ul,.dpost-body li > ol{margin:.55em 0 0;}

    .dpost-body blockquote{
        margin:1.9em 0;padding:22px 26px;
        background:linear-gradient(180deg,var(--brand-tint),rgba(157,54,38,.03));
        border-left:4px solid var(--brand);border-radius:0 var(--r-md) var(--r-md) 0;
        font-family:var(--serif);font-size:1.14rem;line-height:1.6;
        color:#2a3446;font-style:normal;
    }
    .dpost-body blockquote p:last-child{margin-bottom:0;}
    .dpost-body blockquote cite{
        display:block;margin-top:12px;font-family:var(--sans);
        font-size:.83rem;font-style:normal;font-weight:600;color:var(--brand);
    }

    .dpost-body img{
        max-width:100%;height:auto;display:block;
        border-radius:var(--r-md);margin:1.9em auto;box-shadow:var(--sh-sm);
    }
    .dpost-body figure{margin:1.9em 0;}
    .dpost-body figure img{margin:0;}
    .dpost-body figcaption{
        margin-top:11px;text-align:center;
        font-size:.83rem;color:var(--ink-3);line-height:1.5;
    }

    .dpost-body hr{
        border:0;height:1px;background:var(--line-2);margin:2.6em 0;
    }

    /* tables — mobile par scroll ho jaye */
    .dpost-body table{
        width:100%;border-collapse:collapse;margin:1.9em 0;
        font-size:.94rem;border:1px solid var(--line);border-radius:var(--r-sm);
        overflow:hidden;display:table;
    }
    .dpost-body thead th{
        background:var(--paper-3);text-align:left;padding:12px 15px;
        font-size:.78rem;font-weight:700;letter-spacing:.05em;text-transform:uppercase;
        color:var(--ink-2);border-bottom:1px solid var(--line-2);
    }
    .dpost-body tbody td{padding:12px 15px;border-bottom:1px solid var(--line);vertical-align:top;}
    .dpost-body tbody tr:last-child td{border-bottom:0;}
    .dpost-body tbody tr:nth-child(even){background:var(--paper-2);}
    .dpost-tablescroll{overflow-x:auto;margin:1.9em 0;-webkit-overflow-scrolling:touch;}
    .dpost-tablescroll table{margin:0;}

    .dpost-body code{
        font-family:ui-monospace,SFMono-Regular,Menlo,Consolas,monospace;
        font-size:.88em;padding:2px 7px;border-radius:6px;
        background:var(--paper-3);color:var(--brand-dark);border:1px solid var(--line);
    }
    .dpost-body pre{
        margin:1.9em 0;padding:18px 20px;border-radius:var(--r-md);
        background:#0f172a;color:#e2e8f0;overflow-x:auto;
        font-size:.88rem;line-height:1.6;
    }
    .dpost-body pre code{background:none;border:0;padding:0;color:inherit;}

    /* ---- share row (article ke neeche) ---- */
    .dpost-share{
        display:flex;align-items:center;gap:10px;flex-wrap:wrap;
        margin:44px 0 0;padding:22px 0;
        border-top:1px solid var(--line);border-bottom:1px solid var(--line);
    }
    .dpost-share__label{
        display:flex;align-items:center;gap:8px;margin-right:6px;
        font-size:.82rem;font-weight:700;color:var(--ink-2);
        letter-spacing:.02em;
    }
    .dpost-share__label i{color:var(--brand);}
    .dpost-sh{
        display:inline-flex;align-items:center;justify-content:center;
        width:42px;height:42px;border-radius:50%;
        background:var(--paper-2);border:1px solid var(--line);
        color:var(--ink-2);font-size:.95rem;text-decoration:none;
        cursor:pointer;transition:var(--t);
    }
    .dpost-sh:hover{transform:translateY(-3px);color:#fff;border-color:transparent;box-shadow:var(--sh-sm);}
    .dpost-sh--fb:hover{background:#1877f2;}
    .dpost-sh--wa:hover{background:#25d366;}
    .dpost-sh--li:hover{background:#0a66c2;}
    .dpost-sh--x:hover{background:#0f172a;}
    .dpost-sh--mail:hover{background:var(--brand);}
    .dpost-sh--copy:hover{background:var(--brand);}
    .dpost-sh.is-done{background:#16a34a;color:#fff;border-color:transparent;}

    /* ---- sidebar ---- */
    .dpost-side{position:sticky;top:24px;display:flex;flex-direction:column;gap:18px;}
    .dpost-box{
        background:var(--paper);border:1px solid var(--line);
        border-radius:var(--r-md);box-shadow:var(--sh-sm);overflow:hidden;
    }
    .dpost-box__t{
        display:flex;align-items:center;gap:9px;
        padding:14px 17px;border-bottom:1px solid var(--line);
        background:var(--paper-2);
        font-size:.73rem;font-weight:700;letter-spacing:.09em;text-transform:uppercase;color:var(--ink-3);
    }
    .dpost-box__t i{color:var(--brand);font-size:.78rem;}
    .dpost-box__b{padding:13px 17px 16px;}

    /* TOC */
    .dpost-toc{display:flex;flex-direction:column;gap:1px;max-height:52vh;overflow-y:auto;}
    .dpost-toc::-webkit-scrollbar{width:5px;}
    .dpost-toc::-webkit-scrollbar-thumb{background:var(--line-2);border-radius:99px;}
    .dpost-toc a{
        display:block;padding:7px 11px;border-radius:8px;
        font-size:.845rem;line-height:1.45;color:var(--ink-2);
        text-decoration:none;border-left:2px solid transparent;transition:var(--t);
    }
    .dpost-toc a:hover{background:var(--brand-tint);color:var(--brand);}
    .dpost-toc a.is-sub{padding-left:22px;font-size:.8rem;color:var(--ink-3);}
    .dpost-toc a.is-active{
        background:var(--brand-tint);color:var(--brand);
        font-weight:600;border-left-color:var(--brand);
    }

    /* vertical share (desktop) */
    .dpost-vshare{display:flex;gap:8px;flex-wrap:wrap;}
    .dpost-vshare .dpost-sh{width:38px;height:38px;font-size:.85rem;}

    /* newsletter / CTA box */
    .dpost-cta{
        border-radius:var(--r-md);overflow:hidden;color:#fff;
        background:var(--brand-grad);padding:20px 19px;
        box-shadow:0 16px 34px -18px rgba(157,54,38,.9);
    }
    .dpost-cta h4{
        margin:0 0 7px;font-family:var(--serif);
        font-size:1.08rem;font-weight:600;letter-spacing:-.015em;line-height:1.25;
    }
    .dpost-cta p{margin:0 0 15px;font-size:.84rem;line-height:1.55;opacity:.92;}
    .dpost-cta a{
        display:inline-flex;align-items:center;gap:8px;
        padding:10px 17px;border-radius:var(--r-pill);
        background:#fff;color:var(--brand);
        font-size:.82rem;font-weight:700;text-decoration:none;transition:var(--t);
    }
    .dpost-cta a:hover{transform:translateY(-2px);box-shadow:0 10px 20px -8px rgba(0,0,0,.35);}

    /* ==================================================================
       RELATED
       ================================================================== */
    .dpost-rel{
        background:var(--paper-2);border-top:1px solid var(--line);
        padding:56px 0 70px;
    }
    .dpost-rel__head{
        display:flex;align-items:flex-end;justify-content:space-between;
        gap:18px;flex-wrap:wrap;margin-bottom:28px;
    }
    .dpost-rel__head h2{
        margin:0;font-family:var(--serif);
        font-size:clamp(1.4rem,2.6vw,1.95rem);font-weight:600;
        letter-spacing:-.02em;color:var(--ink);
    }
    .dpost-rel__head p{margin:7px 0 0;font-size:.9rem;color:var(--ink-3);}
    .dpost-rel__grid{
        display:grid;grid-template-columns:repeat(auto-fill,minmax(290px,1fr));gap:24px;
    }

    /* card (related + listing dono use karte hain) */
    .dcard{
        display:flex;flex-direction:column;
        background:var(--paper);border:1px solid var(--line);
        border-radius:var(--r-lg);overflow:hidden;
        box-shadow:var(--sh-sm);transition:var(--t);text-decoration:none;
    }
    .dcard:hover{transform:translateY(-6px);box-shadow:var(--sh-md);border-color:var(--line-2);}
    .dcard__img{position:relative;aspect-ratio:16/9;overflow:hidden;background:var(--paper-3);}
    .dcard__img img{width:100%;height:100%;object-fit:cover;display:block;transition:transform .55s ease;}
    .dcard:hover .dcard__img img{transform:scale(1.055);}
    .dcard__cat{
        position:absolute;top:13px;left:13px;
        padding:4px 12px;border-radius:var(--r-pill);
        background:rgba(15,23,42,.72);
        -webkit-backdrop-filter:blur(8px);backdrop-filter:blur(8px);
        color:#fff;font-size:.66rem;font-weight:700;
        letter-spacing:.07em;text-transform:uppercase;
    }
    .dcard__b{padding:19px 21px 21px;flex:1;display:flex;flex-direction:column;}
    .dcard__date{
        display:flex;align-items:center;gap:7px;
        font-size:.76rem;color:var(--ink-3);margin-bottom:10px;
    }
    .dcard__date i{font-size:.7rem;}
    .dcard__t{
        margin:0 0 9px;font-size:1.075rem;font-weight:700;
        line-height:1.36;letter-spacing:-.015em;color:var(--ink);transition:var(--t);
    }
    .dcard:hover .dcard__t{color:var(--brand);}
    .dcard__x{
        margin:0 0 17px;flex:1;
        font-size:.9rem;line-height:1.62;color:var(--ink-2);
    }
    .dcard__f{
        display:flex;align-items:center;justify-content:space-between;gap:12px;
        padding-top:15px;border-top:1px solid var(--line);
    }
    .dcard__who{
        display:flex;align-items:center;gap:8px;
        font-size:.81rem;font-weight:500;color:var(--ink-2);min-width:0;
    }
    .dcard__who .av{
        width:24px;height:24px;flex:0 0 24px;border-radius:50%;
        display:grid;place-items:center;
        background:var(--brand-grad);color:#fff;font-size:.6rem;font-weight:700;
    }
    .dcard__who span{overflow:hidden;text-overflow:ellipsis;white-space:nowrap;}
    .dcard__go{
        display:inline-flex;align-items:center;gap:7px;flex:0 0 auto;
        font-size:.82rem;font-weight:700;color:var(--brand);letter-spacing:-.01em;
    }
    .dcard__go i{font-size:.72rem;transition:transform var(--t);}
    .dcard:hover .dcard__go i{transform:translateX(4px);}

    /* ==================================================================
       LISTING PAGE
       ================================================================== */
    .dbg-shell{max-width:1240px;margin:0 auto;padding:0 24px 84px;}
    .dbg-head{text-align:center;padding:64px 0 44px;position:relative;}
    .dbg-head__pill{
        display:inline-flex;align-items:center;gap:8px;
        padding:6px 17px;border-radius:var(--r-pill);
        background:var(--brand-tint);color:var(--brand);border:1px solid var(--brand-tint-2);
        font-size:.74rem;font-weight:700;letter-spacing:.09em;text-transform:uppercase;
    }
    .dbg-head h1{
        margin:18px 0 0;font-family:var(--serif);
        font-size:clamp(2rem,5vw,3.3rem);font-weight:600;
        line-height:1.08;letter-spacing:-.03em;color:var(--ink);
    }
    .dbg-head p{
        margin:15px auto 0;max-width:56ch;
        font-size:clamp(.98rem,1.4vw,1.1rem);line-height:1.65;color:var(--ink-2);
    }
    .dbg-head__rule{
        width:74px;height:3px;margin:26px auto 0;
        border-radius:3px;background:var(--brand-grad);
    }
    .dbg-grid{
        display:grid;grid-template-columns:repeat(auto-fill,minmax(330px,1fr));gap:28px;
    }
    .dbg-grid .dcard{animation:dbgUp .55s cubic-bezier(.2,.7,.2,1) both;}

    /* ==================================================================
       EMPTY / 404
       ================================================================== */
    .dbg-empty{padding:90px 24px;text-align:center;}
    .dbg-empty__card{
        max-width:480px;margin:0 auto;padding:52px 40px;
        background:var(--paper);border:1px solid var(--line);
        border-radius:var(--r-lg);box-shadow:var(--sh-md);
    }
    .dbg-empty__art{
        width:80px;height:80px;margin:0 auto 22px;border-radius:26px;
        display:grid;place-items:center;font-size:1.95rem;
        background:var(--brand-tint);color:var(--brand);border:1px solid var(--brand-tint-2);
    }
    .dbg-empty__card h2{
        margin:0 0 10px;font-family:var(--serif);
        font-size:1.55rem;font-weight:600;letter-spacing:-.02em;color:var(--ink);
    }
    .dbg-empty__card p{margin:0 0 26px;font-size:.95rem;line-height:1.65;color:var(--ink-2);}
    .dbtn{
        display:inline-flex;align-items:center;gap:9px;
        padding:12px 24px;border-radius:var(--r-pill);
        background:var(--brand-grad);color:#fff;
        font-size:.87rem;font-weight:650;text-decoration:none;
        border:0;cursor:pointer;transition:var(--t);
        box-shadow:0 12px 26px -12px rgba(157,54,38,.85);
    }
    .dbtn:hover{transform:translateY(-2px);color:#fff;box-shadow:0 18px 34px -12px rgba(157,54,38,.9);}
    .dbtn--ghost{
        background:var(--paper);color:var(--ink-2);
        border:1px solid var(--line);box-shadow:var(--sh-sm);
    }
    .dbtn--ghost:hover{color:var(--brand);border-color:var(--brand-tint-2);background:var(--brand-tint);}

    /* back to blog */
    .dpost-back{margin:0 0 26px;}
    .dpost-back a{
        display:inline-flex;align-items:center;gap:9px;
        font-size:.86rem;font-weight:600;color:var(--ink-2);text-decoration:none;transition:var(--t);
    }
    .dpost-back a:hover{color:var(--brand);gap:12px;}

    /* to-top */
    .dpost-top{
        position:fixed;bottom:26px;right:26px;z-index:960;
        width:46px;height:46px;border-radius:50%;
        display:grid;place-items:center;cursor:pointer;
        background:var(--brand-grad);color:#fff;border:0;
        box-shadow:0 14px 30px -12px rgba(157,54,38,.9);
        opacity:0;visibility:hidden;transform:translateY(12px);transition:var(--t);
    }
    .dpost-top.is-on{opacity:1;visibility:visible;transform:none;}
    .dpost-top:hover{transform:translateY(-3px);}

    @keyframes dbgUp{from{opacity:0;transform:translateY(22px);}to{opacity:1;transform:none;}}
    @media (prefers-reduced-motion:reduce){
        .dbg *,.dpost *{animation:none !important;transition:none !important;}
    }

    /* ==================================================================
       RESPONSIVE
       ================================================================== */
    @media (max-width:1080px){
        .dpost-main{grid-template-columns:minmax(0,1fr);gap:0;}
        .dpost-side{
            position:static;flex-direction:row;flex-wrap:wrap;
            margin-top:40px;
        }
        .dpost-side > *{flex:1 1 260px;}
        .dpost-toc{max-height:none;}
    }
    @media (max-width:768px){
        .dpost__head{padding:24px 0 30px;}
        .dpost__inner,.dpost-cover,.dpost-main{padding-left:18px;padding-right:18px;}
        .dpost-crumb{margin-bottom:16px;font-size:.75rem;}
        .dpost-crumb .now{display:none;}
        .dpost-title{max-width:none;}
        .dpost-cover{padding-top:24px;}
        .dpost-cover__frame{aspect-ratio:16/10;border-radius:var(--r-md);}
        .dpost-main{padding-top:32px;padding-bottom:56px;}
        .dpost-body{font-size:1.02rem;line-height:1.75;}
        .dpost-body > p:first-of-type{font-size:1.07rem;}
        .dpost-body blockquote{padding:18px 20px;font-size:1.06rem;}
        .dpost-body table{font-size:.86rem;}
        .dpost-body thead th,.dpost-body tbody td{padding:10px 12px;}
        .dpost-share{gap:8px;margin-top:34px;}
        .dpost-sh{width:39px;height:39px;font-size:.88rem;}
        .dpost-share__label{width:100%;margin-bottom:4px;}
        .dpost-rel{padding:44px 0 56px;}
        .dpost-rel__grid{grid-template-columns:1fr;gap:20px;}
        .dbg-shell{padding:0 18px 60px;}
        .dbg-head{padding:44px 0 34px;}
        .dbg-grid{grid-template-columns:1fr;gap:20px;}
        .dpost-top{bottom:18px;right:18px;width:42px;height:42px;}
    }
    @media (max-width:480px){
        .dpost-by{gap:11px;}
        .dpost-by__av{width:40px;height:40px;flex:0 0 40px;font-size:.8rem;}
        .dpost-cover__frame{aspect-ratio:4/3;}
        .dbg-empty{padding:56px 18px;}
        .dbg-empty__card{padding:38px 24px;}
        .dcard__b{padding:17px 18px 19px;}
    }
    @media print{
        .dpost-progress,.dpost-side,.dpost-share,.dpost-rel,.dpost-top,.dpost-crumb{display:none !important;}
        .dpost-main{grid-template-columns:1fr;padding:0;}
    }
    </style>
</head>
<body>
<?php include __DIR__ . '/navbar.php'; ?>
<?php include __DIR__ . '/modal.php'; ?>

<?php if ($slug !== ''): ?>
    <?php if (!empty($blog)): ?>

        <div class="dpost-progress" aria-hidden="true"><div class="dpost-progress__bar" id="dpostBar"></div></div>

        <article class="dpost" itemscope itemtype="https://schema.org/BlogPosting">

            <!-- ============ HERO — title/meta sirf yahan ek baar ============ -->
            <header class="dpost__head">
                <div class="dpost__inner">
                    <nav class="dpost-crumb" aria-label="Breadcrumb">
                        <a href="/index.php"><i class="fas fa-house"></i></a>
                        <i class="fas fa-chevron-right sep"></i>
                        <a href="/blog.php">Blog</a>
                        <i class="fas fa-chevron-right sep"></i>
                        <span class="now"><?php echo $esc($blog['title']); ?></span>
                    </nav>

                    <div class="dpost__narrow">
                        <span class="dpost-cat">
                            <i class="fas fa-tag"></i>
                            <?php echo $esc($blog['category_name'] ?: 'Blog'); ?>
                        </span>

                        <h1 class="dpost-title" itemprop="headline"><?php echo $esc($blog['title']); ?></h1>

                        <?php if (!empty($blog['excerpt'])): ?>
                            <p class="dpost-deck" itemprop="description"><?php echo $esc($blog['excerpt']); ?></p>
                        <?php endif; ?>

                        <div class="dpost-by">
                            <span class="dpost-by__av"><?php echo $esc($initials($blog['author_name'] ?: 'Doric Admin')); ?></span>
                            <div class="dpost-by__who">
                                <strong><?php echo $esc($blog['author_name'] ?: 'Doric Admin'); ?></strong>
                                <span>
                                    <?php $formattedUpdated = formatUpdatedAtForDisplay($blog['updated_at'] ?? null); ?>
                                    <?php if (!empty($formattedUpdated)): ?>
                                        <time datetime="<?php echo $esc(date('c', strtotime((string)$blog['updated_at']))); ?>">
                                            <i class="far fa-calendar"></i>
                                            <?php echo $esc($formattedUpdated); ?>
                                        </time>
                                        <span class="sep"></span>
                                    <?php endif; ?>
                                    <span class="dpost-by__time">
                                        <i class="far fa-clock"></i> <?php echo (int) $readingTime; ?> min read
                                    </span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- ============ COVER ============ -->
            <div class="dpost-cover">
                <div class="dpost-cover__frame">
                    <img src="<?php echo $esc(!empty($blog['featured_image']) ? blogImageUrl($blog['featured_image']) : '/images/no-image2.png'); ?>"
                         alt="<?php echo $esc($blog['title']); ?>" itemprop="image">
                </div>
            </div>

            <!-- ============ BODY + SIDEBAR ============ -->
            <div class="dpost-main">

                <div>
                    <div class="dpost-back">
                        <a href="/blog.php"><i class="fas fa-arrow-left"></i> Back to all posts</a>
                    </div>

                    <div class="dpost-body" id="dpostBody" itemprop="articleBody">
                        <?php echo $contentHtml; ?>
                    </div>

                    <!-- share -->
                    <div class="dpost-share">
                        <span class="dpost-share__label"><i class="fas fa-share-nodes"></i> Share this article</span>
                        <a class="dpost-sh dpost-sh--fb" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode($canonical); ?>" target="_blank" rel="noopener noreferrer" aria-label="Share on Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a class="dpost-sh dpost-sh--wa" href="https://wa.me/?text=<?php echo urlencode($blog['title'] . ' ' . $canonical); ?>" target="_blank" rel="noopener noreferrer" aria-label="Share on WhatsApp"><i class="fab fa-whatsapp"></i></a>
                        <a class="dpost-sh dpost-sh--li" href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode($canonical); ?>" target="_blank" rel="noopener noreferrer" aria-label="Share on LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                        <a class="dpost-sh dpost-sh--x" href="https://twitter.com/intent/tweet?text=<?php echo urlencode($blog['title']); ?>&url=<?php echo urlencode($canonical); ?>" target="_blank" rel="noopener noreferrer" aria-label="Share on X"><i class="fab fa-x-twitter"></i></a>
                        <a class="dpost-sh dpost-sh--mail" href="mailto:?subject=<?php echo urlencode($blog['title']); ?>&body=<?php echo urlencode('Check out this post: ' . $canonical); ?>" aria-label="Share via Email"><i class="fas fa-envelope"></i></a>
                        <button type="button" class="dpost-sh dpost-sh--copy" id="dpostCopy"
                                data-url="<?php echo $esc($canonical); ?>" aria-label="Copy link" title="Copy link">
                            <i class="fas fa-link"></i>
                        </button>
                    </div>
                </div>

                <!-- sidebar -->
                <aside class="dpost-side">
                    <div class="dpost-box" id="dpostTocBox" hidden>
                        <div class="dpost-box__t"><i class="fas fa-list-ul"></i> In this article</div>
                        <div class="dpost-box__b">
                            <nav class="dpost-toc" id="dpostToc" aria-label="Table of contents"></nav>
                        </div>
                    </div>

                    <div class="dpost-box">
                        <div class="dpost-box__t"><i class="fas fa-share-nodes"></i> Share</div>
                        <div class="dpost-box__b">
                            <div class="dpost-vshare">
                                <a class="dpost-sh dpost-sh--wa" href="https://wa.me/?text=<?php echo urlencode($blog['title'] . ' ' . $canonical); ?>" target="_blank" rel="noopener noreferrer" aria-label="Share on WhatsApp"><i class="fab fa-whatsapp"></i></a>
                                <a class="dpost-sh dpost-sh--li" href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode($canonical); ?>" target="_blank" rel="noopener noreferrer" aria-label="Share on LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                                <a class="dpost-sh dpost-sh--fb" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode($canonical); ?>" target="_blank" rel="noopener noreferrer" aria-label="Share on Facebook"><i class="fab fa-facebook-f"></i></a>
                                <a class="dpost-sh dpost-sh--x" href="https://twitter.com/intent/tweet?text=<?php echo urlencode($blog['title']); ?>&url=<?php echo urlencode($canonical); ?>" target="_blank" rel="noopener noreferrer" aria-label="Share on X"><i class="fab fa-x-twitter"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="dpost-cta">
                        <h4>Business advice chahiye?</h4>
                        <p>Accounting, GST aur Tally ke liye Doric Multimedia ki team se baat karo.</p>
                        <a href="/contact.php">Get in touch <i class="fas fa-arrow-right" style="font-size:.72rem;"></i></a>
                    </div>
                </aside>
            </div>

            <!-- ============ RELATED ============ -->
            <?php if (!empty($relatedPosts)): ?>
                <section class="dpost-rel">
                    <div class="dpost__inner">
                        <div class="dpost-rel__head">
                            <div>
                                <h2>Related reading</h2>
                                <p>IExplore more articles and insights from Doric Multimedia.</p>
                            </div>
                            <a href="/blog.php" class="dbtn dbtn--ghost">All posts <i class="fas fa-arrow-right" style="font-size:.72rem;"></i></a>
                        </div>

                        <div class="dpost-rel__grid">
                            <?php foreach ($relatedPosts as $related): ?>
                                <a class="dcard" href="/blog/<?php echo $esc($related['slug']); ?>">
                                    <div class="dcard__img">
                                        <img src="<?php echo $esc(blogImageUrl($related['featured_image'] ?? null)); ?>"
                                             alt="<?php echo $esc($related['title']); ?>" loading="lazy">
                                        <span class="dcard__cat"><?php echo $esc($related['category_name'] ?: 'General'); ?></span>
                                    </div>
                                    <div class="dcard__b">
                                        <div class="dcard__date">
                                            <i class="far fa-calendar"></i>
                                                        <?php echo $esc(formatUpdatedAtForDisplay($related['updated_at'] ?? null)); ?>
                                        </div>
                                        <h3 class="dcard__t"><?php echo $esc($related['title']); ?></h3>
                                        <p class="dcard__x"><?php echo $esc($snip($related['excerpt'], 110) ?: 'Read the full article to learn more.'); ?></p>
                                        <div class="dcard__f">
                                            <span class="dcard__who">
                                                            <span class="av"><?php echo $esc($initials($related['author_name'] ?? $blog['author_name'] ?? 'Doric Admin')); ?></span>
                                                            <span><?php echo $esc($related['author_name'] ?? $blog['author_name'] ?? 'Doric Admin'); ?></span>
                                            </span>
                                            <span class="dcard__go">Read more <i class="fas fa-arrow-right"></i></span>
                                        </div>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </section>
            <?php endif; ?>
        </article>

        <button type="button" class="dpost-top" id="dpostTop" aria-label="Back to top"><i class="fas fa-arrow-up"></i></button>

        <!-- JSON-LD Schema -->
        <script type="application/ld+json">
        <?php
            $jsonLd = [
                '@context' => 'https://schema.org',
                '@type' => 'BlogPosting',
                'headline' => $blog['title'],
                'description' => $pageDescription,
                'image' => [blogImageUrl($blog['featured_image'] ?? null)],
                'datePublished' => $blog['published_at'] ?? $blog['created_at'],
                'dateModified' => $blog['updated_at'] ?? $blog['created_at'],
                'wordCount' => $wordCount,
                'author' => [
                    '@type' => 'Person',
                    'name' => $blog['author_name'] ?: 'Doric Admin'
                ],
                'publisher' => [
                    '@type' => 'Organization',
                    'name' => 'Doric Multimedia',
                    'logo' => [
                        '@type' => 'ImageObject',
                        'url' => 'https://' . ($_SERVER['HTTP_HOST'] ?? 'localhost') . '/images/dmpl_logo.png'
                    ]
                ],
                'mainEntityOfPage' => [
                    '@type' => 'WebPage',
                    '@id' => $canonical
                ]
            ];
            echo json_encode($jsonLd, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        ?>
        </script>

        <script>
        (function () {
            'use strict';
            var body = document.getElementById('dpostBody');
            var bar  = document.getElementById('dpostBar');
            var toTop = document.getElementById('dpostTop');

            /* ---------- wide tables ko scrollable wrapper do ---------- */
            if (body) {
                Array.prototype.forEach.call(body.querySelectorAll('table'), function (table) {
                    if (table.parentNode.classList.contains('dpost-tablescroll')) { return; }
                    var wrap = document.createElement('div');
                    wrap.className = 'dpost-tablescroll';
                    table.parentNode.insertBefore(wrap, table);
                    wrap.appendChild(table);
                });

                /* content ke andar ke external links naye tab me */
                Array.prototype.forEach.call(body.querySelectorAll('a[href^="http"]'), function (link) {
                    if (link.hostname !== window.location.hostname) {
                        link.target = '_blank';
                        link.rel = 'noopener noreferrer';
                    }
                });
            }

            /* ---------- TOC ---------- */
            var tocBox = document.getElementById('dpostTocBox');
            var toc = document.getElementById('dpostToc');
            var headings = [];

            if (body && toc) {
                headings = Array.prototype.slice.call(body.querySelectorAll('h2, h3'));

                if (headings.length >= 2) {
                    var used = {};
                    headings.forEach(function (heading, i) {
                        if (!heading.id) {
                            var base = (heading.textContent || 'section')
                                .toLowerCase()
                                .replace(/[^a-z0-9\u0900-\u097F\s-]/g, '')
                                .trim()
                                .replace(/\s+/g, '-')
                                .slice(0, 50) || ('section-' + i);
                            if (used[base]) { base = base + '-' + (++used[base]); } else { used[base] = 1; }
                            heading.id = base;
                        }
                        var a = document.createElement('a');
                        a.href = '#' + heading.id;
                        a.textContent = heading.textContent;
                        if (heading.tagName === 'H3') { a.className = 'is-sub'; }
                        toc.appendChild(a);
                    });
                    tocBox.hidden = false;
                } else {
                    headings = [];
                }
            }

            var tocLinks = toc ? Array.prototype.slice.call(toc.querySelectorAll('a')) : [];

            /* ---------- scroll: progress + active heading + to-top ---------- */
            var raf = null;
            function onScroll() {
                if (raf) { return; }
                raf = window.requestAnimationFrame(function () {
                    raf = null;

                    if (body && bar) {
                        var start = body.offsetTop;
                        var total = body.offsetHeight - window.innerHeight + 120;
                        var done = window.pageYOffset - start;
                        var pct = total > 0 ? (done / total) * 100 : 0;
                        bar.style.width = Math.max(0, Math.min(100, pct)) + '%';
                    }

                    if (toTop) { toTop.classList.toggle('is-on', window.pageYOffset > 600); }

                    if (headings.length) {
                        var current = 0;
                        for (var i = 0; i < headings.length; i++) {
                            if (headings[i].getBoundingClientRect().top <= 120) { current = i; }
                        }
                        tocLinks.forEach(function (link, i) {
                            link.classList.toggle('is-active', i === current);
                        });
                    }
                });
            }
            window.addEventListener('scroll', onScroll, { passive: true });
            window.addEventListener('resize', onScroll);
            onScroll();

            if (toTop) {
                toTop.addEventListener('click', function () {
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                });
            }

            /* ---------- smooth scroll TOC ---------- */
            tocLinks.forEach(function (link) {
                link.addEventListener('click', function (ev) {
                    var target = document.getElementById(link.getAttribute('href').slice(1));
                    if (!target) { return; }
                    ev.preventDefault();
                    window.scrollTo({ top: target.getBoundingClientRect().top + window.pageYOffset - 90, behavior: 'smooth' });
                });
            });

            /* ---------- copy link ---------- */
            var copyBtn = document.getElementById('dpostCopy');
            if (copyBtn) {
                copyBtn.addEventListener('click', function () {
                    var url = copyBtn.getAttribute('data-url') || window.location.href;
                    var done = function () {
                        copyBtn.classList.add('is-done');
                        copyBtn.innerHTML = '<i class="fas fa-check"></i>';
                        setTimeout(function () {
                            copyBtn.classList.remove('is-done');
                            copyBtn.innerHTML = '<i class="fas fa-link"></i>';
                        }, 1800);
                    };
                    if (navigator.clipboard && navigator.clipboard.writeText) {
                        navigator.clipboard.writeText(url).then(done, function () {});
                    } else {
                        var tmp = document.createElement('textarea');
                        tmp.value = url;
                        document.body.appendChild(tmp);
                        tmp.select();
                        try { document.execCommand('copy'); done(); } catch (err) {}
                        document.body.removeChild(tmp);
                    }
                });
            }
        }());
        </script>

    <?php else: ?>
        <!-- ============ 404 ============ -->
        <div class="dbg dbg-empty">
            <div class="dbg-empty__card">
                <div class="dbg-empty__art"><i class="fas fa-magnifying-glass"></i></div>
                <h2>Page not found</h2>
                <p>Jo blog post aap dhoondh rahe hain wo available nahi hai ya move ho gayi hai.</p>
                <a class="dbtn" href="/blog.php"><i class="fas fa-arrow-left"></i> Back to Blog</a>
            </div>
        </div>
    <?php endif; ?>

<?php else: ?>
    <!-- ============ LISTING ============ -->
    <div class="dbg dbg-shell">
        <div class="dbg-head">
            <span class="dbg-head__pill"><i class="fas fa-pen-nib"></i> Insights</span>
            <h1>Doric Multimedia Blog</h1>
            <p>Expert insights on business, accounting, GST, and growth strategies for modern enterprises.</p>
            <div class="dbg-head__rule"></div>
        </div>

        <?php if (!empty($posts)): ?>
            <div class="dbg-grid">
                <?php foreach ($posts as $index => $post): ?>
                    <a class="dcard" href="/blog/<?php echo $esc($post['slug']); ?>"
                       style="animation-delay:<?php echo number_format(min(0.05 + ($index * 0.05), 0.5), 2, '.', ''); ?>s;">
                        <div class="dcard__img">
                            <img src="<?php echo $esc(blogImageUrl($post['featured_image'] ?? null)); ?>"
                                 alt="<?php echo $esc($post['title']); ?>" loading="lazy">
                            <span class="dcard__cat"><?php echo $esc($post['category_name'] ?: 'General'); ?></span>
                        </div>
                        <div class="dcard__b">
                                        <div class="dcard__date">
                                            <i class="far fa-calendar"></i>
                                            <?php echo $esc(formatUpdatedAtForDisplay($post['updated_at'] ?? null)); ?>
                                        </div>
                            <h3 class="dcard__t"><?php echo $esc($post['title']); ?></h3>
                            <p class="dcard__x"><?php echo $esc($snip($post['excerpt'] ?: $post['content'], 125)); ?></p>
                            <div class="dcard__f">
                                <span class="dcard__who">
                                    <span class="av"><?php echo $esc($initials($post['author_name'] ?: 'Doric Admin')); ?></span>
                                    <span><?php echo $esc($post['author_name'] ?: 'Doric Admin'); ?></span>
                                </span>
                                <span class="dcard__go">Read more <i class="fas fa-arrow-right"></i></span>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="dbg-empty">
                <div class="dbg-empty__card">
                    <div class="dbg-empty__art"><i class="fas fa-feather-pointed"></i></div>
                    <h2>No published posts yet</h2>
                    <p>Fresh insights and expert content will appear here soon. Stay tuned.</p>
                    <a class="dbtn" href="/index.php"><i class="fas fa-house"></i> Back to Home</a>
                </div>
            </div>
        <?php endif; ?>
    </div>
<?php endif; ?>

<?php require __DIR__ . '/footer.php'; ?>
</body>
</html>
