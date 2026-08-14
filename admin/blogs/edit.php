<?php
require __DIR__ . '/../includes/auth.php';
require __DIR__ . '/../includes/db.php';
require __DIR__ . '/../includes/blog_helpers.php';

startSecureSession();
requireAdminAuth();

$pageTitle = 'Edit Post';
$errors = [];
$categoryOptions = [];

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
if ($id <= 0 && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? (int) $_POST['id'] : 0;
}

$pdo = getDbConnection();

if ($id <= 0) {
    $_SESSION['flash_message'] = 'Invalid blog selected.';
    $_SESSION['flash_type'] = 'danger';
    header('Location: /admin/blogs/index.php');
    exit;
}

$stmt = $pdo->prepare('SELECT * FROM blogs WHERE id = :id LIMIT 1');
$stmt->execute([':id' => $id]);
$blog = $stmt->fetch();

if (!$blog) {
    $_SESSION['flash_message'] = 'Blog not found.';
    $_SESSION['flash_type'] = 'danger';
    header('Location: /admin/blogs/index.php');
    exit;
}

$form = [
    'title' => $blog['title'],
    'slug' => $blog['slug'],
    'excerpt' => $blog['excerpt'] ?? '',
    'content' => $blog['content'],
    'category' => (string) ($blog['category_id'] ?? ''),
    'status' => $blog['status'],
    'seo_title' => $blog['seo_title'] ?? '',
    'seo_description' => $blog['seo_description'] ?? '',
    'seo_keywords' => $blog['seo_keywords'] ?? '',
    'canonical_url' => $blog['canonical_url'] ?? '',
    'featured_image' => $blog['featured_image'] ?? null,
];

$categoryRows = $pdo->query('SELECT id, name, slug FROM categories ORDER BY name ASC')->fetchAll();
$categoryOptions = $categoryRows;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $form['title'] = trim((string) ($_POST['title'] ?? $blog['title']));
    $form['slug'] = normalizeBlogSlug((string) ($_POST['slug'] ?? $blog['slug']));
    $form['excerpt'] = trim((string) ($_POST['excerpt'] ?? ''));
    $form['content'] = trim((string) ($_POST['content'] ?? ''));
    $form['category'] = trim((string) ($_POST['category'] ?? ''));
    $form['status'] = trim((string) ($_POST['status'] ?? $blog['status']));
    $form['seo_title'] = trim((string) ($_POST['seo_title'] ?? ''));
    $form['seo_description'] = trim((string) ($_POST['seo_description'] ?? ''));
    $form['seo_keywords'] = trim((string) ($_POST['seo_keywords'] ?? ''));
    $form['canonical_url'] = trim((string) ($_POST['canonical_url'] ?? ''));

    if (!verifyCsrfToken($_POST['csrf_token'] ?? null)) {
        $errors[] = 'Security validation failed.';
    }

    if ($form['title'] === '') {
        $errors[] = 'Title is required.';
    }
    if ($form['slug'] === '') {
        $errors[] = 'Slug is required.';
    }
    if ($form['content'] === '') {
        $errors[] = 'Content is required.';
    }
    if ($form['category'] === '' || !ctype_digit((string) $form['category'])) {
        $errors[] = 'Please select a valid category.';
    }
    if (!in_array($form['status'], ['draft', 'published'], true)) {
        $errors[] = 'Status is invalid.';
    }

    if (empty($errors)) {
        $categoryCheck = $pdo->prepare('SELECT id FROM categories WHERE id = :id LIMIT 1');
        $categoryCheck->execute([':id' => (int) $form['category']]);
        if (!$categoryCheck->fetch()) {
            $errors[] = 'The selected category does not exist.';
        }

        $slugCheck = $pdo->prepare('SELECT id FROM blogs WHERE slug = :slug AND id != :id LIMIT 1');
        $slugCheck->execute([':slug' => $form['slug'], ':id' => $id]);
        if ($slugCheck->fetch()) {
            $errors[] = 'That blog slug already exists. Please choose another slug.';
        }
    }

    $newImage = $blog['featured_image'] ?? null;
    if (!empty($_FILES['featured_image']['name'])) {
        try {
            $uploaded = storeFeaturedImage($_FILES['featured_image']);
            if ($uploaded !== null) {
                $newImage = $uploaded;
            }
        } catch (RuntimeException $e) {
            $errors[] = $e->getMessage();
        }
    }

    if (empty($errors)) {
        try {
            $newStatus = $form['status'];
            $publishedAt = $blog['published_at'] ?? null;
            if ($newStatus === 'published' && ($blog['status'] !== 'published' || $publishedAt === null)) {
                $publishedAt = date('Y-m-d H:i:s');
            }
            if ($newStatus === 'draft') {
                $publishedAt = null;
            }

            $stmt = $pdo->prepare('UPDATE blogs SET title = :title, slug = :slug, excerpt = :excerpt, content = :content, featured_image = :featured_image, category_id = :category_id, status = :status, seo_title = :seo_title, seo_description = :seo_description, seo_keywords = :seo_keywords, canonical_url = :canonical_url, published_at = :published_at, updated_at = :updated_at WHERE id = :id');
            $stmt->execute([
                ':title' => $form['title'],
                ':slug' => $form['slug'],
                ':excerpt' => $form['excerpt'] !== '' ? $form['excerpt'] : null,
                ':content' => $form['content'],
                ':featured_image' => $newImage,
                ':category_id' => (int) $form['category'],
                ':status' => $newStatus,
                ':seo_title' => $form['seo_title'] !== '' ? $form['seo_title'] : null,
                ':seo_description' => $form['seo_description'] !== '' ? $form['seo_description'] : null,
                ':seo_keywords' => $form['seo_keywords'] !== '' ? $form['seo_keywords'] : null,
                ':canonical_url' => $form['canonical_url'] !== '' ? $form['canonical_url'] : null,
                ':published_at' => $publishedAt,
                ':updated_at' => date('Y-m-d H:i:s'),
                ':id' => $id,
            ]);

            if (!empty($_FILES['featured_image']['name']) && $newImage !== $blog['featured_image'] && !empty($blog['featured_image'])) {
                removeFeaturedImageFile($blog['featured_image']);
            }

            $_SESSION['flash_message'] = 'Blog updated successfully!';
            $_SESSION['flash_type'] = 'success';
            header('Location: /admin/blogs/index.php');
            exit;
        } catch (Throwable $e) {
            error_log('Blog update failed: ' . $e->getMessage());
            $errors[] = 'Unable to update the blog.';
        }
    }
}

$csrfToken = generateCsrfToken();

/* ---- view helpers ---- */
$esc = static function (?string $value): string {
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
};
$fmtDate = static function (?string $value): string {
    if (empty($value)) {
        return '—';
    }
    $ts = strtotime($value);
    return $ts ? date('d M Y, g:i A', $ts) : '—';
};

$currentCategoryName = '';
foreach ($categoryOptions as $categoryRow) {
    if ((string) $categoryRow['id'] === (string) $form['category']) {
        $currentCategoryName = (string) $categoryRow['name'];
        break;
    }
}

require __DIR__ . '/../includes/header.php';
?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
/* ==========================================================================
   DORIC ADMIN — EDIT POST (premium editor UI)
   Note: ye CSS create.php ke saath 100% same hai. Chaho to isse
   /admin/assets/css/admin-form.css me nikaal kar dono pages me link kar do.
   ========================================================================== */
.dcp{
    --brand:#9d3626;
    --brand-dark:#7a2a1e;
    --brand-light:#c2543f;
    --brand-ink:#611f16;
    --brand-tint:rgba(157,54,38,.07);
    --brand-tint-2:rgba(157,54,38,.14);
    --brand-grad:linear-gradient(135deg,#b8412d 0%,#9d3626 45%,#6f2418 100%);

    --bg:#f6f7f9;
    --bg-veil:radial-gradient(1200px 500px at 12% -10%,rgba(157,54,38,.10),transparent 60%),
              radial-gradient(900px 420px at 100% 0%,rgba(15,23,42,.07),transparent 55%);
    --surface:#ffffff;
    --surface-2:#fbfbfc;
    --surface-3:#f1f3f7;

    --ink:#10161f;
    --ink-2:#495468;
    --ink-3:#8b97a8;

    --line:rgba(16,22,31,.09);
    --line-strong:rgba(16,22,31,.16);

    --ok:#16a34a;
    --warn:#d97706;
    --danger:#dc2626;

    --sh-xs:0 1px 2px rgba(16,22,31,.05);
    --sh-sm:0 2px 8px rgba(16,22,31,.06),0 1px 2px rgba(16,22,31,.04);
    --sh-md:0 12px 32px -12px rgba(16,22,31,.18),0 2px 6px rgba(16,22,31,.05);
    --sh-lg:0 28px 60px -24px rgba(16,22,31,.28);
    --ring:0 0 0 4px var(--brand-tint-2);

    --r-xs:8px; --r-sm:12px; --r-md:16px; --r-lg:22px; --r-pill:999px;
    --t:220ms cubic-bezier(.4,0,.2,1);

    font-family:'Inter',-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,sans-serif;
    color:var(--ink);
    -webkit-font-smoothing:antialiased;
}
.dcp[data-theme="dark"]{
    --bg:#0b0e14;
    --bg-veil:radial-gradient(1100px 480px at 10% -12%,rgba(194,84,63,.20),transparent 62%),
              radial-gradient(900px 420px at 100% 0%,rgba(90,120,190,.12),transparent 58%);
    --surface:#141922;
    --surface-2:#171d27;
    --surface-3:#1e2531;
    --ink:#eef2f8;
    --ink-2:#a7b2c4;
    --ink-3:#6f7d92;
    --line:rgba(255,255,255,.09);
    --line-strong:rgba(255,255,255,.18);
    --brand-tint:rgba(194,84,63,.14);
    --brand-tint-2:rgba(194,84,63,.24);
    --sh-sm:0 2px 10px rgba(0,0,0,.35);
    --sh-md:0 14px 34px -14px rgba(0,0,0,.65);
    --sh-lg:0 30px 70px -28px rgba(0,0,0,.8);
}

.dcp *,.dcp *::before,.dcp *::after{box-sizing:border-box;}
body:has(.dcp){background:var(--bg,#f6f7f9);margin:0;}

.dcp{
    background:var(--bg);
    background-image:var(--bg-veil);
    background-repeat:no-repeat;
    min-height:100vh;
    padding:26px 28px 132px;
}
.dcp__wrap{max-width:1240px;margin:0 auto;}

/* ---------- Top bar ---------- */
.dcp-top{
    display:flex;align-items:center;justify-content:space-between;
    gap:18px;flex-wrap:wrap;margin-bottom:22px;
}
.dcp-crumb{
    display:flex;align-items:center;gap:8px;flex-wrap:wrap;
    font-size:.74rem;font-weight:600;letter-spacing:.04em;text-transform:uppercase;
    color:var(--ink-3);margin-bottom:10px;
}
.dcp-crumb a{color:var(--ink-3);text-decoration:none;transition:var(--t);}
.dcp-crumb a:hover{color:var(--brand);}
.dcp-crumb i{font-size:.55rem;opacity:.6;}
.dcp-title{
    margin:0;font-size:clamp(1.5rem,2.4vw,2rem);font-weight:800;
    letter-spacing:-.035em;line-height:1.1;display:flex;align-items:center;gap:12px;
}
.dcp-title .glyph{
    width:42px;height:42px;flex:0 0 42px;border-radius:14px;
    display:grid;place-items:center;color:#fff;font-size:.95rem;
    background:var(--brand-grad);
    box-shadow:0 10px 22px -10px rgba(157,54,38,.75),inset 0 1px 0 rgba(255,255,255,.28);
}
.dcp-sub{
    margin:8px 0 0;color:var(--ink-2);font-size:.86rem;line-height:1.5;
    display:flex;align-items:center;gap:8px;flex-wrap:wrap;
}
.dcp-sub .sep{opacity:.4;}
.dcp-top__right{display:flex;align-items:center;gap:10px;flex-wrap:wrap;}

/* ---------- Buttons ---------- */
.dcp-btn{
    display:inline-flex;align-items:center;justify-content:center;gap:8px;
    height:42px;padding:0 20px;border-radius:var(--r-pill);
    font-family:inherit;font-size:.85rem;font-weight:600;letter-spacing:-.01em;
    border:1px solid transparent;cursor:pointer;text-decoration:none;
    transition:var(--t);white-space:nowrap;
}
.dcp-btn:focus-visible{outline:none;box-shadow:var(--ring);}
.dcp-btn--ghost{background:var(--surface);color:var(--ink-2);border-color:var(--line);box-shadow:var(--sh-xs);}
.dcp-btn--ghost:hover{color:var(--brand);border-color:var(--brand-tint-2);background:var(--brand-tint);transform:translateY(-1px);}
.dcp-btn--quiet{background:transparent;color:var(--ink-3);border-color:var(--line);}
.dcp-btn--quiet:hover{color:var(--ink);background:var(--surface-3);}
.dcp-btn--primary{
    background:var(--brand-grad);color:#fff;
    box-shadow:0 12px 26px -12px rgba(157,54,38,.85),inset 0 1px 0 rgba(255,255,255,.22);
}
.dcp-btn--primary:hover{transform:translateY(-2px);color:#fff;box-shadow:0 18px 34px -12px rgba(157,54,38,.9),inset 0 1px 0 rgba(255,255,255,.28);}
.dcp-btn--primary:active{transform:translateY(0);}
.dcp-btn--icon{width:42px;padding:0;flex:0 0 42px;}

/* ---------- Layout ---------- */
.dcp-grid{display:grid;grid-template-columns:minmax(0,1fr) 356px;gap:22px;align-items:start;}
.dcp-col{display:flex;flex-direction:column;gap:18px;min-width:0;}
.dcp-col--side{position:sticky;top:20px;}

/* ---------- Card ---------- */
.dcp-card{
    background:var(--surface);border:1px solid var(--line);
    border-radius:var(--r-lg);box-shadow:var(--sh-md);
    overflow:hidden;position:relative;
    animation:dcpIn .5s cubic-bezier(.2,.7,.2,1) both;
}
.dcp-card--accent::before{
    content:'';position:absolute;inset:0 0 auto;height:3px;background:var(--brand-grad);opacity:.9;
}
.dcp-card__head{
    display:flex;align-items:center;justify-content:space-between;gap:12px;
    padding:16px 22px;border-bottom:1px solid var(--line);
    background:linear-gradient(180deg,var(--surface-2),var(--surface));
}
.dcp-card__head h3{
    margin:0;font-size:.9rem;font-weight:700;letter-spacing:-.01em;
    display:flex;align-items:center;gap:10px;
}
.dcp-card__head h3 i{color:var(--brand);font-size:.85rem;}
.dcp-card__body{padding:22px;display:flex;flex-direction:column;gap:18px;}
.dcp-card__body--tight{padding:18px;gap:14px;}

.dcp-chip{
    display:inline-flex;align-items:center;gap:6px;
    padding:4px 11px;border-radius:var(--r-pill);
    font-size:.68rem;font-weight:600;letter-spacing:.03em;text-transform:uppercase;
    background:var(--surface-3);color:var(--ink-3);border:1px solid var(--line);
}
.dcp-chip .dot{width:6px;height:6px;border-radius:50%;background:currentColor;}
.dcp-chip--draft{color:var(--warn);background:rgba(217,119,6,.10);border-color:rgba(217,119,6,.22);}
.dcp-chip--live{color:var(--ok);background:rgba(22,163,74,.10);border-color:rgba(22,163,74,.22);}
.dcp-chip--live .dot{box-shadow:0 0 0 0 rgba(22,163,74,.55);animation:dcpPulse 1.9s infinite;}
.dcp-chip--edit{color:var(--brand);background:var(--brand-tint);border-color:var(--brand-tint-2);}

/* ---------- Fields ---------- */
.dcp-field{display:flex;flex-direction:column;gap:7px;min-width:0;}
.dcp-field__top{display:flex;align-items:baseline;justify-content:space-between;gap:10px;}
.dcp-label{
    font-size:.76rem;font-weight:650;color:var(--ink);letter-spacing:.005em;
    display:flex;align-items:center;gap:6px;
}
.dcp-label .req{color:var(--danger);font-weight:700;}
.dcp-hint{font-size:.7rem;color:var(--ink-3);font-weight:500;}
.dcp-help{font-size:.72rem;color:var(--ink-3);display:flex;align-items:center;gap:6px;line-height:1.45;}
.dcp-help i{font-size:.68rem;opacity:.8;}

.dcp-input,.dcp-select,.dcp-textarea{
    width:100%;font-family:inherit;font-size:.9rem;color:var(--ink);
    background:var(--surface-2);border:1px solid var(--line);
    border-radius:var(--r-sm);padding:11px 14px;
    transition:border-color var(--t),box-shadow var(--t),background var(--t);
    outline:none;
}
.dcp-input::placeholder,.dcp-textarea::placeholder{color:var(--ink-3);}
.dcp-input:hover,.dcp-select:hover,.dcp-textarea:hover{border-color:var(--line-strong);}
.dcp-input:focus,.dcp-select:focus,.dcp-textarea:focus{
    background:var(--surface);border-color:var(--brand-light);box-shadow:var(--ring);
}
.dcp-input--lg{font-size:1.12rem;font-weight:650;letter-spacing:-.02em;padding:14px 16px;}
.dcp-textarea{resize:vertical;line-height:1.6;min-height:96px;}
.dcp-textarea--code{
    font-family:'JetBrains Mono',ui-monospace,Menlo,Consolas,monospace;
    font-size:.83rem;line-height:1.7;min-height:340px;
    background:var(--surface-2);
}
.dcp-select{
    appearance:none;padding-right:38px;cursor:pointer;
    background-image:url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%238b97a8' stroke-width='2.4' stroke-linecap='round'><path d='M6 9l6 6 6-6'/></svg>");
    background-repeat:no-repeat;background-position:right 13px center;background-size:16px;
}

.dcp-group{
    display:flex;align-items:stretch;
    background:var(--surface-2);border:1px solid var(--line);border-radius:var(--r-sm);
    transition:border-color var(--t),box-shadow var(--t),background var(--t);overflow:hidden;
}
.dcp-group:hover{border-color:var(--line-strong);}
.dcp-group:focus-within{background:var(--surface);border-color:var(--brand-light);box-shadow:var(--ring);}
.dcp-group__addon{
    display:flex;align-items:center;padding:0 12px;flex:0 0 auto;
    font-size:.82rem;color:var(--ink-3);font-weight:600;
    background:var(--surface-3);border-right:1px solid var(--line);white-space:nowrap;
}
.dcp-group .dcp-input{border:0;background:transparent;box-shadow:none;border-radius:0;min-width:0;}
.dcp-group .dcp-input:focus{box-shadow:none;}
.dcp-group__btn{
    flex:0 0 auto;border:0;border-left:1px solid var(--line);background:transparent;
    color:var(--ink-3);width:42px;cursor:pointer;transition:var(--t);font-size:.8rem;
}
.dcp-group__btn:hover{color:var(--brand);background:var(--brand-tint);}
.dcp-group__btn.is-on{color:var(--brand);background:var(--brand-tint);}

.dcp-meter{display:flex;align-items:center;gap:10px;font-size:.7rem;color:var(--ink-3);}
.dcp-meter__bar{flex:1;height:4px;border-radius:99px;background:var(--surface-3);overflow:hidden;}
.dcp-meter__fill{height:100%;width:0;border-radius:99px;background:var(--brand-grad);transition:width .25s ease,background .25s ease;}
.dcp-meter.is-warn .dcp-meter__fill{background:linear-gradient(90deg,#f59e0b,#d97706);}
.dcp-meter.is-full .dcp-meter__fill{background:linear-gradient(90deg,#ef4444,#dc2626);}
.dcp-meter__num{font-variant-numeric:tabular-nums;font-weight:600;}

.dcp-toolbar{
    display:flex;align-items:center;gap:6px;flex-wrap:wrap;
    padding:8px;border:1px solid var(--line);border-bottom:0;
    border-radius:var(--r-sm) var(--r-sm) 0 0;background:var(--surface-3);
}
.dcp-tool{
    width:32px;height:32px;border-radius:9px;border:1px solid transparent;
    background:transparent;color:var(--ink-2);cursor:pointer;font-size:.78rem;transition:var(--t);
}
.dcp-tool:hover{background:var(--surface);color:var(--brand);border-color:var(--line);}
.dcp-toolbar__spacer{flex:1;}
.dcp-toolbar__stat{font-size:.7rem;color:var(--ink-3);font-variant-numeric:tabular-nums;padding-right:6px;}
.dcp-editor .dcp-textarea--code{border-radius:0 0 var(--r-sm) var(--r-sm);}
.dcp-editor.is-full{position:fixed;inset:16px;z-index:1200;background:var(--surface);padding:16px;border-radius:var(--r-lg);box-shadow:var(--sh-lg);display:flex;flex-direction:column;}
.dcp-editor.is-full .dcp-textarea--code{flex:1;min-height:0;}

/* ---------- Segmented status ---------- */
.dcp-seg{
    display:grid;grid-template-columns:1fr 1fr;gap:4px;padding:4px;
    background:var(--surface-3);border:1px solid var(--line);border-radius:var(--r-sm);
}
.dcp-seg input{position:absolute;opacity:0;pointer-events:none;}
.dcp-seg label{
    display:flex;align-items:center;justify-content:center;gap:8px;
    padding:9px 8px;border-radius:9px;cursor:pointer;
    font-size:.82rem;font-weight:600;color:var(--ink-2);transition:var(--t);
    border:1px solid transparent;
}
.dcp-seg label:hover{color:var(--ink);}
.dcp-seg input:checked + label{
    background:var(--surface);color:var(--brand);border-color:var(--line);box-shadow:var(--sh-xs);
}
.dcp-seg input:focus-visible + label{box-shadow:var(--ring);}

/* ---------- Current image + dropzone ---------- */
.dcp-hero{
    position:relative;border-radius:var(--r-md);overflow:hidden;
    border:1px solid var(--line);background:var(--surface-3);
}
.dcp-hero img{display:block;width:100%;height:168px;object-fit:cover;}
.dcp-hero__tag{
    position:absolute;top:10px;left:10px;
    padding:4px 10px;border-radius:var(--r-pill);
    font-size:.65rem;font-weight:700;letter-spacing:.04em;text-transform:uppercase;
    background:rgba(10,14,20,.62);color:#fff;
    -webkit-backdrop-filter:blur(8px);backdrop-filter:blur(8px);
}
.dcp-drop{
    position:relative;border:1.5px dashed var(--line-strong);border-radius:var(--r-md);
    background:var(--surface-2);padding:22px 18px;text-align:center;cursor:pointer;
    transition:var(--t);
}
.dcp-drop:hover,.dcp-drop.is-over{border-color:var(--brand);background:var(--brand-tint);}
.dcp-drop input[type="file"]{position:absolute;inset:0;opacity:0;cursor:pointer;}
.dcp-drop__icon{
    width:42px;height:42px;margin:0 auto 10px;border-radius:13px;display:grid;place-items:center;
    background:var(--surface);border:1px solid var(--line);color:var(--brand);font-size:.95rem;box-shadow:var(--sh-xs);
}
.dcp-drop__title{font-size:.84rem;font-weight:650;}
.dcp-drop__title b{color:var(--brand);}
.dcp-drop__meta{font-size:.7rem;color:var(--ink-3);margin-top:4px;}
.dcp-preview{display:none;gap:12px;align-items:center;padding:10px;border:1px solid var(--line);border-radius:var(--r-md);background:var(--surface-2);}
.dcp-preview.is-on{display:flex;}
.dcp-preview img{width:74px;height:56px;object-fit:cover;border-radius:10px;flex:0 0 auto;background:var(--surface-3);}
.dcp-preview__meta{min-width:0;flex:1;}
.dcp-preview__name{font-size:.79rem;font-weight:600;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
.dcp-preview__size{font-size:.7rem;color:var(--ink-3);margin-top:2px;}
.dcp-preview__x{
    flex:0 0 auto;width:30px;height:30px;border-radius:9px;border:1px solid var(--line);
    background:var(--surface);color:var(--ink-3);cursor:pointer;transition:var(--t);
}
.dcp-preview__x:hover{color:var(--danger);border-color:rgba(220,38,38,.35);background:rgba(220,38,38,.08);}

/* ---------- Collapsible ---------- */
.dcp-acc__head{
    width:100%;display:flex;align-items:center;gap:12px;
    padding:16px 22px;background:linear-gradient(180deg,var(--surface-2),var(--surface));
    border:0;border-bottom:1px solid var(--line);cursor:pointer;text-align:left;
    font-family:inherit;color:var(--ink);transition:var(--t);
}
.dcp-acc__head:hover{background:var(--surface-3);}
.dcp-acc__head i.lead{color:var(--brand);font-size:.85rem;}
.dcp-acc__head .t{font-size:.9rem;font-weight:700;letter-spacing:-.01em;}
.dcp-acc__head .caret{margin-left:auto;color:var(--ink-3);transition:transform var(--t);font-size:.75rem;}
.dcp-acc.is-open .dcp-acc__head .caret{transform:rotate(180deg);}
.dcp-acc__body{display:none;}
.dcp-acc.is-open .dcp-acc__body{display:block;animation:dcpFade .3s ease both;}

/* SERP preview */
.dcp-serp{padding:16px;border:1px solid var(--line);border-radius:var(--r-md);background:var(--surface-2);}
.dcp-serp__url{font-size:.75rem;color:var(--ink-3);display:flex;align-items:center;gap:6px;}
.dcp-serp__title{color:#1a56db;font-size:1.02rem;font-weight:500;margin:5px 0 3px;line-height:1.35;}
.dcp[data-theme="dark"] .dcp-serp__title{color:#8ab4f8;}
.dcp-serp__desc{font-size:.8rem;color:var(--ink-2);line-height:1.5;}

/* keyword tags */
.dcp-tags{display:flex;flex-wrap:wrap;gap:6px;}
.dcp-tag{
    display:inline-flex;align-items:center;gap:5px;padding:3px 10px;border-radius:var(--r-pill);
    background:var(--brand-tint);color:var(--brand);border:1px solid var(--brand-tint-2);
    font-size:.7rem;font-weight:600;
}
.dcp[data-theme="dark"] .dcp-tag{color:var(--brand-light);}

/* ---------- Meta list ---------- */
.dcp-meta{list-style:none;margin:0;padding:0;display:flex;flex-direction:column;}
.dcp-meta li{
    display:flex;align-items:center;justify-content:space-between;gap:12px;
    padding:9px 0;border-bottom:1px dashed var(--line);font-size:.79rem;
}
.dcp-meta li:last-child{border-bottom:0;}
.dcp-meta .k{color:var(--ink-3);display:flex;align-items:center;gap:8px;}
.dcp-meta .k i{width:13px;text-align:center;font-size:.72rem;opacity:.8;}
.dcp-meta .v{color:var(--ink);font-weight:600;text-align:right;font-variant-numeric:tabular-nums;}

/* ---------- Checklist ---------- */
.dcp-check{list-style:none;margin:0;padding:0;display:flex;flex-direction:column;gap:9px;}
.dcp-check li{display:flex;align-items:center;gap:10px;font-size:.8rem;color:var(--ink-2);transition:var(--t);}
.dcp-check li .box{
    width:19px;height:19px;flex:0 0 19px;border-radius:6px;display:grid;place-items:center;
    border:1.5px solid var(--line-strong);color:transparent;font-size:.6rem;transition:var(--t);
}
.dcp-check li.is-done{color:var(--ink);}
.dcp-check li.is-done .box{background:var(--ok);border-color:var(--ok);color:#fff;}

/* ---------- Alerts ---------- */
.dcp-alert{
    display:flex;gap:12px;padding:15px 18px;border-radius:var(--r-md);
    border:1px solid rgba(220,38,38,.28);background:rgba(220,38,38,.07);
    color:#7f1d1d;font-size:.85rem;
}
.dcp[data-theme="dark"] .dcp-alert{color:#fecaca;}
.dcp-alert__icon{
    width:30px;height:30px;flex:0 0 30px;border-radius:9px;display:grid;place-items:center;
    background:var(--danger);color:#fff;font-size:.8rem;
}
.dcp-alert strong{display:block;margin-bottom:5px;font-size:.86rem;}
.dcp-alert ul{margin:0;padding-left:18px;display:flex;flex-direction:column;gap:3px;}

/* ---------- Sticky action bar ---------- */
.dcp-bar{
    position:fixed;left:0;right:0;bottom:0;z-index:900;
    padding:12px 28px calc(12px + env(safe-area-inset-bottom));
    background:color-mix(in srgb,var(--surface) 82%,transparent);
    -webkit-backdrop-filter:blur(16px) saturate(160%);backdrop-filter:blur(16px) saturate(160%);
    border-top:1px solid var(--line);box-shadow:0 -10px 30px -18px rgba(16,22,31,.35);
}
.dcp-bar__in{max-width:1240px;margin:0 auto;display:flex;align-items:center;gap:12px;flex-wrap:wrap;}
.dcp-bar__note{font-size:.76rem;color:var(--ink-3);display:flex;align-items:center;gap:8px;margin-right:auto;}
.dcp-bar__note i{color:var(--brand);}
.dcp-bar__note.is-dirty{color:var(--warn);font-weight:600;}
.dcp-bar__note.is-dirty i{color:var(--warn);}

/* ---------- Animations ---------- */
@keyframes dcpIn{from{opacity:0;transform:translateY(14px);}to{opacity:1;transform:none;}}
@keyframes dcpFade{from{opacity:0;transform:translateY(-6px);}to{opacity:1;transform:none;}}
@keyframes dcpPulse{0%{box-shadow:0 0 0 0 rgba(22,163,74,.5);}70%{box-shadow:0 0 0 7px rgba(22,163,74,0);}100%{box-shadow:0 0 0 0 rgba(22,163,74,0);}}
.dcp-card:nth-child(2){animation-delay:.06s;}
.dcp-card:nth-child(3){animation-delay:.12s;}
.dcp-card:nth-child(4){animation-delay:.18s;}
@media (prefers-reduced-motion:reduce){
    .dcp *,.dcp *::before{animation:none !important;transition:none !important;}
}

/* ---------- Responsive ---------- */
@media (max-width:1080px){
    .dcp-grid{grid-template-columns:1fr;}
    .dcp-col--side{position:static;}
}
@media (max-width:768px){
    .dcp{padding:18px 14px 140px;}
    .dcp-card__body{padding:18px;}
    .dcp-card__head,.dcp-acc__head{padding:14px 18px;}
    .dcp-top__right{width:100%;}
    .dcp-top__right .dcp-btn{flex:1;}
    .dcp-textarea--code{min-height:260px;}
    .dcp-bar{padding:10px 14px calc(10px + env(safe-area-inset-bottom));}
    .dcp-bar__note{display:none;}
    .dcp-bar__in .dcp-btn{flex:1;}
    .dcp-editor.is-full{inset:8px;}
}
@media (max-width:480px){
    .dcp-title{font-size:1.3rem;}
    .dcp-bar__in{flex-direction:column-reverse;}
    .dcp-bar__in .dcp-btn{width:100%;}
    .dcp-group{flex-wrap:wrap;}
    .dcp-group__addon{width:100%;border-right:0;border-bottom:1px solid var(--line);}
}
</style>

<div class="dcp" id="dcp" data-theme="light">
<div class="dcp__wrap">

    <!-- ============ TOP BAR ============ -->
    <header class="dcp-top">
        <div>
            <nav class="dcp-crumb">
                <a href="/admin/index.php">Dashboard</a>
                <i class="fas fa-chevron-right"></i>
                <a href="/admin/blogs/index.php">Posts</a>
                <i class="fas fa-chevron-right"></i>
                <span>Edit</span>
            </nav>
            <h1 class="dcp-title">
                <span class="glyph"><i class="fas fa-pen-to-square"></i></span>
                Edit Post
            </h1>
            <p class="dcp-sub">
                <span class="dcp-chip dcp-chip--edit"><i class="fas fa-hashtag"></i> ID <?php echo (int) $id; ?></span>
                <span class="sep">·</span>
                <span>Last updated <?php echo $esc($fmtDate($blog['updated_at'] ?? null)); ?></span>
            </p>
        </div>
        <div class="dcp-top__right">
            <button type="button" class="dcp-btn dcp-btn--ghost dcp-btn--icon" id="dcpTheme" title="Toggle theme" aria-label="Toggle theme">
                <i class="fas fa-moon"></i>
            </button>
            <?php if ($blog['status'] === 'published'): ?>
                <a href="/blog/<?php echo $esc($blog['slug']); ?>" target="_blank" rel="noopener" class="dcp-btn dcp-btn--ghost">
                    <i class="fas fa-arrow-up-right-from-square"></i> View Live
                </a>
            <?php endif; ?>
            <a href="/admin/blogs/index.php" class="dcp-btn dcp-btn--ghost">
                <i class="fas fa-arrow-left"></i> Back to Posts
            </a>
        </div>
    </header>

    <?php if (!empty($errors)): ?>
        <div class="dcp-card" style="margin-bottom:18px;border-color:rgba(220,38,38,.3);">
            <div class="dcp-alert" role="alert">
                <span class="dcp-alert__icon"><i class="fas fa-triangle-exclamation"></i></span>
                <div>
                    <strong>We couldn't save your changes</strong>
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li><?php echo $esc($error); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <form id="dcpForm" method="post" action="/admin/blogs/edit.php?id=<?php echo (int) $id; ?>" enctype="multipart/form-data" novalidate>
        <input type="hidden" name="csrf_token" value="<?php echo $esc($csrfToken); ?>">
        <input type="hidden" name="id" value="<?php echo (int) $id; ?>">

        <div class="dcp-grid">

            <!-- ============ MAIN COLUMN ============ -->
            <div class="dcp-col">

                <!-- Content card -->
                <section class="dcp-card dcp-card--accent">
                    <div class="dcp-card__head">
                        <h3><i class="fas fa-pen-nib"></i> Post Content</h3>
                        <span class="dcp-chip <?php echo $form['status'] === 'published' ? 'dcp-chip--live' : 'dcp-chip--draft'; ?>" id="dcpStatusChip">
                            <span class="dot"></span><span id="dcpStatusText"><?php echo $form['status'] === 'published' ? 'Published' : 'Draft'; ?></span>
                        </span>
                    </div>

                    <div class="dcp-card__body">
                        <!-- Title -->
                        <div class="dcp-field">
                            <div class="dcp-field__top">
                                <label class="dcp-label" for="title">Title <span class="req">*</span></label>
                                <span class="dcp-hint"><span id="titleCount"><?php echo mb_strlen((string) $form['title']); ?></span>/100</span>
                            </div>
                            <input type="text" id="title" name="title" class="dcp-input dcp-input--lg"
                                   value="<?php echo $esc($form['title']); ?>"
                                   placeholder="An engaging headline your readers can't skip"
                                   maxlength="100" autocomplete="off" required>
                        </div>

                        <!-- Slug -->
                        <div class="dcp-field">
                            <label class="dcp-label" for="slug">Permalink <span class="req">*</span></label>
                            <div class="dcp-group">
                                <span class="dcp-group__addon">/blog/</span>
                                <input type="text" id="slug" name="slug" class="dcp-input"
                                       value="<?php echo $esc($form['slug']); ?>"
                                       placeholder="example-post-title" autocomplete="off" spellcheck="false" required>
                                <button type="button" class="dcp-group__btn" id="slugSync" title="Regenerate slug from title" aria-label="Regenerate slug from title">
                                    <i class="fas fa-rotate"></i>
                                </button>
                                <button type="button" class="dcp-group__btn" id="slugCopy" title="Copy permalink" aria-label="Copy permalink">
                                    <i class="fas fa-copy"></i>
                                </button>
                            </div>
                            <p class="dcp-help"><i class="fas fa-triangle-exclamation"></i> Slug badalne se purane links tootenge — SEO ke liye soch kar badlein.</p>
                        </div>

                        <!-- Excerpt -->
                        <div class="dcp-field">
                            <div class="dcp-field__top">
                                <label class="dcp-label" for="excerpt">Short Description</label>
                                <span class="dcp-hint">Shown in listings &amp; search results</span>
                            </div>
                            <textarea id="excerpt" name="excerpt" class="dcp-textarea" maxlength="160"
                                      placeholder="One or two sentences that make someone want to read on..."><?php echo $esc($form['excerpt']); ?></textarea>
                            <div class="dcp-meter" id="excerptMeter">
                                <span class="dcp-meter__bar"><span class="dcp-meter__fill" id="excerptFill"></span></span>
                                <span><span class="dcp-meter__num" id="excerptCount"><?php echo mb_strlen((string) $form['excerpt']); ?></span> / 160</span>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="dcp-field">
                            <div class="dcp-field__top">
                                <label class="dcp-label" for="content">Full Content <span class="req">*</span></label>
                                <span class="dcp-hint">HTML supported</span>
                            </div>
                            <div class="dcp-editor" id="dcpEditor">
                                <div class="dcp-toolbar">
                                    <button type="button" class="dcp-tool" data-wrap="<strong>|</strong>" title="Bold"><i class="fas fa-bold"></i></button>
                                    <button type="button" class="dcp-tool" data-wrap="<em>|</em>" title="Italic"><i class="fas fa-italic"></i></button>
                                    <button type="button" class="dcp-tool" data-wrap="<h2>|</h2>" title="Heading"><i class="fas fa-heading"></i></button>
                                    <button type="button" class="dcp-tool" data-wrap="<a href=&quot;&quot;>|</a>" title="Link"><i class="fas fa-link"></i></button>
                                    <button type="button" class="dcp-tool" data-wrap="<ul>&#10;  <li>|</li>&#10;</ul>" title="List"><i class="fas fa-list-ul"></i></button>
                                    <button type="button" class="dcp-tool" data-wrap="<blockquote>|</blockquote>" title="Quote"><i class="fas fa-quote-left"></i></button>
                                    <button type="button" class="dcp-tool" data-wrap="<code>|</code>" title="Code"><i class="fas fa-code"></i></button>
                                    <span class="dcp-toolbar__spacer"></span>
                                    <span class="dcp-toolbar__stat" id="contentStat">0 words · 0 min read</span>
                                    <button type="button" class="dcp-tool" id="dcpFull" title="Toggle full screen"><i class="fas fa-expand"></i></button>
                                </div>
                                <textarea id="content" name="content" class="dcp-textarea dcp-textarea--code" spellcheck="false"
                                          placeholder="<p>Start writing your post…</p>" required><?php echo $esc($form['content']); ?></textarea>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- SEO card -->
                <section class="dcp-card dcp-acc is-open" id="dcpSeo">
                    <button type="button" class="dcp-acc__head" data-acc>
                        <i class="fas fa-magnifying-glass-chart lead"></i>
                        <span class="t">Search Engine Optimisation</span>
                        <span class="dcp-chip">Optional</span>
                        <i class="fas fa-chevron-down caret"></i>
                    </button>
                    <div class="dcp-acc__body">
                        <div class="dcp-card__body">
                            <div class="dcp-serp">
                                <div class="dcp-serp__url"><i class="fas fa-globe"></i> yoursite.com › blog › <span id="serpSlug"><?php echo $esc($form['slug']); ?></span></div>
                                <div class="dcp-serp__title" id="serpTitle">Your SEO title will appear here</div>
                                <div class="dcp-serp__desc" id="serpDesc">Add a meta description to control the snippet Google shows for this post.</div>
                            </div>

                            <div class="dcp-field">
                                <div class="dcp-field__top">
                                    <label class="dcp-label" for="seo_title">SEO Title</label>
                                    <span class="dcp-hint"><span id="seoTitleCount">0</span>/60 ideal</span>
                                </div>
                                <input type="text" id="seo_title" name="seo_title" class="dcp-input"
                                       value="<?php echo $esc($form['seo_title']); ?>"
                                       placeholder="Defaults to the post title if left empty">
                            </div>

                            <div class="dcp-field">
                                <div class="dcp-field__top">
                                    <label class="dcp-label" for="seo_description">SEO Description</label>
                                    <span class="dcp-hint"><span id="seoDescCount">0</span>/160 ideal</span>
                                </div>
                                <input type="text" id="seo_description" name="seo_description" class="dcp-input"
                                       value="<?php echo $esc($form['seo_description']); ?>"
                                       placeholder="A compelling one-line summary for search results">
                            </div>

                            <div class="dcp-field">
                                <label class="dcp-label" for="seo_keywords">SEO Keywords</label>
                                <input type="text" id="seo_keywords" name="seo_keywords" class="dcp-input"
                                       value="<?php echo $esc($form['seo_keywords']); ?>"
                                       placeholder="tally erp, gst filing, business automation">
                                <div class="dcp-tags" id="keywordTags"></div>
                            </div>

                            <div class="dcp-field">
                                <label class="dcp-label" for="canonical_url">Canonical URL</label>
                                <div class="dcp-group">
                                    <span class="dcp-group__addon"><i class="fas fa-link"></i></span>
                                    <input type="text" id="canonical_url" name="canonical_url" class="dcp-input"
                                           value="<?php echo $esc($form['canonical_url']); ?>"
                                           placeholder="https://yoursite.com/blog/original-post" spellcheck="false">
                                </div>
                                <p class="dcp-help"><i class="fas fa-circle-info"></i> Only needed when this content exists elsewhere.</p>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <!-- ============ SIDEBAR ============ -->
            <aside class="dcp-col dcp-col--side">

                <!-- Publish -->
                <section class="dcp-card">
                    <div class="dcp-card__head">
                        <h3><i class="fas fa-sliders"></i> Publishing</h3>
                        <span class="dcp-hint" id="dcpClock"></span>
                    </div>
                    <div class="dcp-card__body dcp-card__body--tight">
                        <div class="dcp-field">
                            <label class="dcp-label">Visibility</label>
                            <div class="dcp-seg">
                                <input type="radio" name="status" id="statusDraft" value="draft" <?php echo $form['status'] !== 'published' ? 'checked' : ''; ?>>
                                <label for="statusDraft"><i class="fas fa-pen-to-square"></i> Draft</label>
                                <input type="radio" name="status" id="statusPublished" value="published" <?php echo $form['status'] === 'published' ? 'checked' : ''; ?>>
                                <label for="statusPublished"><i class="fas fa-rocket"></i> Published</label>
                            </div>
                            <p class="dcp-help" id="statusHelp"><i class="fas fa-circle-info"></i> &nbsp;</p>
                        </div>

                        <div class="dcp-field">
                            <label class="dcp-label" for="category">Category <span class="req">*</span></label>
                            <select id="category" name="category" class="dcp-select" required>
                                <option value="">Select a category…</option>
                                <?php foreach ($categoryOptions as $category): ?>
                                    <option value="<?php echo (int) $category['id']; ?>"
                                        <?php echo (string) $form['category'] === (string) $category['id'] ? 'selected' : ''; ?>>
                                        <?php echo $esc($category['name']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </section>

                <!-- Featured image -->
                <section class="dcp-card">
                    <div class="dcp-card__head">
                        <h3><i class="fas fa-image"></i> Featured Image</h3>
                    </div>
                    <div class="dcp-card__body dcp-card__body--tight">
                        <?php if (!empty($form['featured_image'])): ?>
                            <div class="dcp-hero">
                                <span class="dcp-hero__tag">Current</span>
                                <img src="<?php echo $esc(blogImageUrl($form['featured_image'])); ?>" alt="Current featured image">
                            </div>
                        <?php endif; ?>

                        <div class="dcp-drop" id="dcpDrop">
                            <div class="dcp-drop__icon"><i class="fas fa-cloud-arrow-up"></i></div>
                            <div class="dcp-drop__title">
                                <?php echo !empty($form['featured_image']) ? 'Replace image — drop or <b>browse</b>' : 'Drop an image or <b>browse</b>'; ?>
                            </div>
                            <div class="dcp-drop__meta">JPG, PNG or WEBP · up to 2 MB</div>
                            <input type="file" id="featured_image" name="featured_image"
                                   accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp">
                        </div>

                        <div class="dcp-preview" id="dcpPreview">
                            <img id="dcpPreviewImg" src="" alt="New featured image preview">
                            <div class="dcp-preview__meta">
                                <div class="dcp-preview__name" id="dcpFileName"></div>
                                <div class="dcp-preview__size" id="dcpFileSize"></div>
                            </div>
                            <button type="button" class="dcp-preview__x" id="dcpFileClear" title="Cancel replacement" aria-label="Cancel replacement">
                                <i class="fas fa-xmark"></i>
                            </button>
                        </div>
                        <?php if (!empty($form['featured_image'])): ?>
                            <p class="dcp-help"><i class="fas fa-circle-info"></i> Nayi image upload karne par purani file delete ho jayegi.</p>
                        <?php endif; ?>
                    </div>
                </section>

                <!-- Post details -->
                <section class="dcp-card">
                    <div class="dcp-card__head">
                        <h3><i class="fas fa-circle-info"></i> Post Details</h3>
                    </div>
                    <div class="dcp-card__body dcp-card__body--tight">
                        <ul class="dcp-meta">
                            <li>
                                <span class="k"><i class="fas fa-hashtag"></i> Post ID</span>
                                <span class="v"><?php echo (int) $id; ?></span>
                            </li>
                            <li>
                                <span class="k"><i class="fas fa-folder"></i> Category</span>
                                <span class="v"><?php echo $currentCategoryName !== '' ? $esc($currentCategoryName) : '—'; ?></span>
                            </li>
                            <li>
                                <span class="k"><i class="fas fa-calendar-plus"></i> Created</span>
                                <span class="v"><?php echo $esc($fmtDate($blog['created_at'] ?? null)); ?></span>
                            </li>
                            <li>
                                <span class="k"><i class="fas fa-clock-rotate-left"></i> Updated</span>
                                <span class="v"><?php echo $esc($fmtDate($blog['updated_at'] ?? null)); ?></span>
                            </li>
                            <li>
                                <span class="k"><i class="fas fa-rocket"></i> Published</span>
                                <span class="v"><?php echo $esc($fmtDate($blog['published_at'] ?? null)); ?></span>
                            </li>
                        </ul>
                    </div>
                </section>

                <!-- Readiness -->
                <section class="dcp-card">
                    <div class="dcp-card__head">
                        <h3><i class="fas fa-circle-check"></i> Quality Check</h3>
                    </div>
                    <div class="dcp-card__body dcp-card__body--tight">
                        <ul class="dcp-check" id="dcpCheck">
                            <li data-check="title"><span class="box"><i class="fas fa-check"></i></span> Title added</li>
                            <li data-check="slug"><span class="box"><i class="fas fa-check"></i></span> Permalink set</li>
                            <li data-check="content"><span class="box"><i class="fas fa-check"></i></span> Content written</li>
                            <li data-check="category"><span class="box"><i class="fas fa-check"></i></span> Category chosen</li>
                            <li data-check="excerpt"><span class="box"><i class="fas fa-check"></i></span> Short description</li>
                            <li data-check="seo"><span class="box"><i class="fas fa-check"></i></span> SEO meta filled</li>
                            <li data-check="image"><span class="box"><i class="fas fa-check"></i></span> Featured image</li>
                        </ul>
                    </div>
                </section>
            </aside>
        </div>

        <!-- ============ STICKY ACTION BAR ============ -->
        <div class="dcp-bar">
            <div class="dcp-bar__in">
                <span class="dcp-bar__note" id="dcpDirtyNote">
                    <i class="fas fa-circle-check"></i> <span id="dcpDirtyText">No unsaved changes</span>
                </span>
                <button type="reset" class="dcp-btn dcp-btn--quiet">
                    <i class="fas fa-rotate-left"></i> Reset
                </button>
                <?php if ($blog['status'] === 'published'): ?>
                    <a href="/blog/<?php echo $esc($blog['slug']); ?>" target="_blank" rel="noopener" class="dcp-btn dcp-btn--ghost">
                        <i class="fas fa-eye"></i> Preview
                    </a>
                <?php endif; ?>
                <button type="submit" class="dcp-btn dcp-btn--primary">
                    <i class="fas fa-floppy-disk"></i> Update Post
                </button>
            </div>
        </div>
    </form>
</div>
</div>

<script>
(function () {
    'use strict';
    var root = document.getElementById('dcp');
    if (!root) { return; }
    var $ = function (id) { return document.getElementById(id); };

    /* ---------- theme ---------- */
    var THEME_KEY = 'doric-admin-theme';
    var themeBtn = $('dcpTheme');
    function applyTheme(mode) {
        root.setAttribute('data-theme', mode);
        themeBtn.innerHTML = mode === 'dark' ? '<i class="fas fa-sun"></i>' : '<i class="fas fa-moon"></i>';
    }
    var saved = null;
    try { saved = localStorage.getItem(THEME_KEY); } catch (err) {}
    applyTheme(saved || (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'));
    themeBtn.addEventListener('click', function () {
        var next = root.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
        applyTheme(next);
        try { localStorage.setItem(THEME_KEY, next); } catch (err) {}
    });

    /* ---------- elements ---------- */
    var title = $('title'), slug = $('slug'), excerpt = $('excerpt'), content = $('content'),
        category = $('category'), seoTitle = $('seo_title'), seoDesc = $('seo_description'),
        seoKeywords = $('seo_keywords'), fileInput = $('featured_image');

    var ORIGINAL_STATUS = <?php echo json_encode($blog['status']); ?>;
    var HAS_IMAGE = <?php echo !empty($form['featured_image']) ? 'true' : 'false'; ?>;

    /* ---------- status ---------- */
    var chip = $('dcpStatusChip'), chipText = $('dcpStatusText'), statusHelp = $('statusHelp');
    function syncStatus() {
        var published = $('statusPublished').checked;
        chip.className = 'dcp-chip ' + (published ? 'dcp-chip--live' : 'dcp-chip--draft');
        chipText.textContent = published ? 'Published' : 'Draft';

        var msg = '';
        if (published && ORIGINAL_STATUS !== 'published') {
            msg = 'Save karne par ye post live ho jayegi aur publish date aaj ki set hogi.';
        } else if (!published && ORIGINAL_STATUS === 'published') {
            msg = 'Draft karne par post site se hat jayegi aur publish date clear ho jayegi.';
        } else if (published) {
            msg = 'Ye post live hai. Publish date waisi hi rahegi.';
        } else {
            msg = 'Draft posts site par dikhayi nahi dete.';
        }
        statusHelp.innerHTML = '<i class="fas fa-circle-info"></i> ' + msg;
    }
    $('statusDraft').addEventListener('change', syncStatus);
    $('statusPublished').addEventListener('change', syncStatus);
    syncStatus();

    /* ---------- clock ---------- */
    function tick() {
        $('dcpClock').textContent = new Date().toLocaleString('en-IN', {
            day: 'numeric', month: 'short', hour: '2-digit', minute: '2-digit'
        });
    }
    tick(); setInterval(tick, 30000);

    /* ---------- slug ---------- */
    function slugify(value) {
        return value.toLowerCase().trim()
            .replace(/[^a-z0-9]+/g, '-')
            .replace(/^-+|-+$/g, '')
            .slice(0, 90);
    }
    $('slugSync').addEventListener('click', function () {
        if (!title.value.trim()) { return; }
        if (window.confirm('Slug ko title se dobara banayein? Purane links toot sakte hain.')) {
            slug.value = slugify(title.value);
            dirty = true; refresh();
        }
    });
    slug.addEventListener('blur', function () { slug.value = slugify(slug.value); refresh(); });

    $('slugCopy').addEventListener('click', function () {
        var btn = this;
        var url = window.location.origin + '/blog/' + slug.value;
        var done = function () {
            btn.innerHTML = '<i class="fas fa-check"></i>';
            setTimeout(function () { btn.innerHTML = '<i class="fas fa-copy"></i>'; }, 1400);
        };
        if (navigator.clipboard) { navigator.clipboard.writeText(url).then(done, function () {}); }
    });

    /* ---------- counters, SERP, checklist ---------- */
    function meter(el, fillEl, max, countEl) {
        var len = el.value.length;
        countEl.textContent = len;
        var pct = Math.min(100, (len / max) * 100);
        fillEl.style.width = pct + '%';
        var wrap = fillEl.parentNode.parentNode;
        wrap.classList.toggle('is-warn', pct >= 80 && pct < 100);
        wrap.classList.toggle('is-full', pct >= 100);
    }

    function refresh() {
        $('titleCount').textContent = title.value.length;
        meter(excerpt, $('excerptFill'), 160, $('excerptCount'));

        var words = content.value.replace(/<[^>]*>/g, ' ').trim().split(/\s+/).filter(Boolean).length;
        $('contentStat').textContent = words.toLocaleString() + ' words · ' + Math.max(1, Math.round(words / 200)) + ' min read';

        $('serpSlug').textContent = slug.value || 'example-post-title';
        $('serpTitle').textContent = seoTitle.value || title.value || 'Your SEO title will appear here';
        $('serpDesc').textContent = seoDesc.value || excerpt.value
            || 'Add a meta description to control the snippet Google shows for this post.';
        $('seoTitleCount').textContent = seoTitle.value.length;
        $('seoDescCount').textContent = seoDesc.value.length;

        var tags = seoKeywords.value.split(',').map(function (t) { return t.trim(); }).filter(Boolean);
        $('keywordTags').innerHTML = tags.map(function (t) {
            return '<span class="dcp-tag"><i class="fas fa-tag"></i>' +
                t.replace(/[&<>"]/g, function (c) {
                    return ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;' })[c];
                }) + '</span>';
        }).join('');

        var state = {
            title: title.value.trim() !== '',
            slug: slug.value.trim() !== '',
            content: content.value.trim() !== '',
            category: category.value !== '',
            excerpt: excerpt.value.trim().length > 20,
            seo: seoTitle.value.trim() !== '' && seoDesc.value.trim() !== '',
            image: HAS_IMAGE || (fileInput.files && fileInput.files.length > 0)
        };
        Array.prototype.forEach.call($('dcpCheck').children, function (li) {
            li.classList.toggle('is-done', !!state[li.getAttribute('data-check')]);
        });

        var note = $('dcpDirtyNote');
        note.classList.toggle('is-dirty', dirty);
        note.querySelector('i').className = dirty ? 'fas fa-pen' : 'fas fa-circle-check';
        $('dcpDirtyText').textContent = dirty ? 'Unsaved changes' : 'No unsaved changes';
    }

    title.addEventListener('input', refresh);
    [excerpt, content, category, seoTitle, seoDesc, seoKeywords, slug].forEach(function (el) {
        el.addEventListener('input', refresh);
        el.addEventListener('change', refresh);
    });

    /* ---------- editor toolbar ---------- */
    Array.prototype.forEach.call(document.querySelectorAll('.dcp-tool[data-wrap]'), function (btn) {
        btn.addEventListener('click', function () {
            var parts = btn.getAttribute('data-wrap').split('|');
            var start = content.selectionStart, end = content.selectionEnd;
            var selected = content.value.slice(start, end);
            content.value = content.value.slice(0, start) + parts[0] + selected + (parts[1] || '') + content.value.slice(end);
            content.focus();
            content.selectionStart = start + parts[0].length;
            content.selectionEnd = content.selectionStart + selected.length;
            dirty = true; refresh();
        });
    });

    var editor = $('dcpEditor'), fullBtn = $('dcpFull');
    fullBtn.addEventListener('click', function () {
        var on = editor.classList.toggle('is-full');
        fullBtn.innerHTML = on ? '<i class="fas fa-compress"></i>' : '<i class="fas fa-expand"></i>';
        document.body.style.overflow = on ? 'hidden' : '';
    });
    document.addEventListener('keydown', function (ev) {
        if (ev.key === 'Escape' && editor.classList.contains('is-full')) { fullBtn.click(); }
    });

    /* ---------- accordion ---------- */
    Array.prototype.forEach.call(document.querySelectorAll('[data-acc]'), function (head) {
        head.addEventListener('click', function () { head.closest('.dcp-acc').classList.toggle('is-open'); });
    });

    /* ---------- dropzone ---------- */
    var drop = $('dcpDrop'), preview = $('dcpPreview');
    function showFile(file) {
        if (!file) { preview.classList.remove('is-on'); refresh(); return; }
        var reader = new FileReader();
        reader.onload = function (ev) { $('dcpPreviewImg').src = ev.target.result; };
        reader.readAsDataURL(file);
        $('dcpFileName').textContent = file.name;
        $('dcpFileSize').textContent = (file.size / 1048576).toFixed(2) + ' MB'
            + (file.size > 2097152 ? ' · exceeds 2 MB limit' : '');
        preview.classList.add('is-on');
        refresh();
    }
    fileInput.addEventListener('change', function () { showFile(this.files && this.files[0]); });
    ['dragenter', 'dragover'].forEach(function (evt) {
        drop.addEventListener(evt, function (ev) { ev.preventDefault(); drop.classList.add('is-over'); });
    });
    ['dragleave', 'drop'].forEach(function (evt) {
        drop.addEventListener(evt, function (ev) { ev.preventDefault(); drop.classList.remove('is-over'); });
    });
    drop.addEventListener('drop', function (ev) {
        if (ev.dataTransfer && ev.dataTransfer.files.length) {
            fileInput.files = ev.dataTransfer.files;
            showFile(ev.dataTransfer.files[0]);
        }
    });
    $('dcpFileClear').addEventListener('click', function () {
        fileInput.value = '';
        preview.classList.remove('is-on');
        refresh();
    });

    /* ---------- reset ---------- */
    $('dcpForm').addEventListener('reset', function (ev) {
        if (!window.confirm('Saare unsaved changes hata kar original values wapas laayein?')) {
            ev.preventDefault();
            return;
        }
        setTimeout(function () {
            preview.classList.remove('is-on');
            dirty = false;
            syncStatus(); refresh();
        }, 0);
    });

    /* ---------- unsaved-changes guard ---------- */
    var dirty = false, submitting = false;
    $('dcpForm').addEventListener('input', function () { dirty = true; refresh(); });
    $('dcpForm').addEventListener('change', function () { dirty = true; refresh(); });
    $('dcpForm').addEventListener('submit', function () { submitting = true; });
    window.addEventListener('beforeunload', function (ev) {
        if (dirty && !submitting) { ev.preventDefault(); ev.returnValue = ''; }
    });

    refresh();
}());
</script>

<?php require __DIR__ . '/../includes/footer.php'; ?>
