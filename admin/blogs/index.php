<?php
require __DIR__ . '/../includes/auth.php';
require __DIR__ . '/../includes/db.php';
require __DIR__ . '/../includes/blog_helpers.php';

startSecureSession();
requireAdminAuth();

$pageTitle = 'Blog Posts';
$flashMessage = $_SESSION['flash_message'] ?? '';
$flashType = $_SESSION['flash_type'] ?? 'success';
unset($_SESSION['flash_message'], $_SESSION['flash_type']);

$search = trim((string) ($_GET['search'] ?? ''));
$statusFilter = in_array($_GET['status'] ?? 'all', ['all', 'published', 'draft'], true) ? ($_GET['status'] ?? 'all') : 'all';
$categoryFilter = isset($_GET['category']) ? (int) $_GET['category'] : 0;
$page = max(1, (int) ($_GET['page'] ?? 1));
$perPage = 10;

$pdo = getDbConnection();
$categories = $pdo->query('SELECT id, name FROM categories ORDER BY name ASC')->fetchAll();

$where = ['1=1'];
$params = [];

if ($search !== '') {
    $where[] = '(b.title LIKE :search_title OR b.slug LIKE :search_slug)';
    $params['search_title'] = '%' . $search . '%';
    $params['search_slug'] = '%' . $search . '%';
}

if ($statusFilter !== 'all') {
    $where[] = 'b.status = :status';
    $params['status'] = $statusFilter;
}

if ($categoryFilter > 0) {
    $where[] = 'b.category_id = :category_id';
    $params['category_id'] = $categoryFilter;
}

$whereSql = implode(' AND ', $where);

/* ---- filtered count ---- */
$countStmt = $pdo->prepare('SELECT COUNT(*) FROM blogs b WHERE ' . $whereSql);
$countStmt->execute($params);
$totalPosts = (int) $countStmt->fetchColumn();
$totalPages = max(1, (int) ceil($totalPosts / $perPage));
$page = min($page, $totalPages);
$offset = ($page - 1) * $perPage;

/* ---- overall stats (filters ke bina) ---- */
$statTotal = 0;
$statPublished = 0;
$statDraft = 0;
$statThisMonth = 0;
try {
    $statRow = $pdo->query(
        "SELECT
            COUNT(*) AS total,
            SUM(CASE WHEN status = 'published' THEN 1 ELSE 0 END) AS published,
            SUM(CASE WHEN status = 'draft' THEN 1 ELSE 0 END) AS draft,
            SUM(CASE WHEN created_at >= DATE_FORMAT(NOW(), '%Y-%m-01') THEN 1 ELSE 0 END) AS this_month
         FROM blogs"
    )->fetch();
    $statTotal = (int) ($statRow['total'] ?? 0);
    $statPublished = (int) ($statRow['published'] ?? 0);
    $statDraft = (int) ($statRow['draft'] ?? 0);
    $statThisMonth = (int) ($statRow['this_month'] ?? 0);
} catch (Throwable $e) {
    error_log('Blog stats failed: ' . $e->getMessage());
}

/* ---- list ---- */
$listSql = 'SELECT b.*, c.name AS category_name, a.name AS author_name
    FROM blogs b
    LEFT JOIN categories c ON c.id = b.category_id
    LEFT JOIN admins a ON a.id = b.author_id
    WHERE ' . $whereSql . '
    ORDER BY b.updated_at DESC, b.id DESC
    LIMIT ' . (int) $perPage . ' OFFSET ' . (int) $offset;

$listStmt = $pdo->prepare($listSql);
$listStmt->execute($params);
$posts = $listStmt->fetchAll();

$csrfToken = generateCsrfToken();
$hasFilters = ($search !== '' || $statusFilter !== 'all' || $categoryFilter > 0);

/* ---- view helpers ---- */
$esc = static function (?string $value): string {
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
};
$buildUrl = static function (array $overrides = []) use ($search, $statusFilter, $categoryFilter, $page): string {
    $query = array_merge([
        'search' => $search,
        'status' => $statusFilter,
        'category' => $categoryFilter,
        'page' => $page,
    ], $overrides);

    $query = array_filter($query, static function ($value, $key) {
        if ($key === 'status') {
            return $value !== 'all';
        }
        if ($key === 'category') {
            return (int) $value > 0;
        }
        if ($key === 'page') {
            return (int) $value > 1;
        }
        return $value !== '' && $value !== null;
    }, ARRAY_FILTER_USE_BOTH);

    return '/admin/blogs/index.php' . ($query ? '?' . http_build_query($query) : '');
};
$relTime = static function (?string $value): string {
    if (empty($value)) {
        return '—';
    }
    $ts = strtotime($value);
    if (!$ts) {
        return '—';
    }
    $diff = time() - $ts;
    if ($diff < 60) {
        return 'just now';
    }
    if ($diff < 3600) {
        return floor($diff / 60) . 'm ago';
    }
    if ($diff < 86400) {
        return floor($diff / 3600) . 'h ago';
    }
    if ($diff < 604800) {
        return floor($diff / 86400) . 'd ago';
    }
    return date('d M Y', $ts);
};

require __DIR__ . '/../includes/header.php';
?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
/* ==========================================================================
   DORIC ADMIN — BLOG POSTS LIST (premium)
   Fixed horizontal scroll issue
   ========================================================================== */
.dcp{
    --brand:#9d3626;
    --brand-dark:#7a2a1e;
    --brand-light:#c2543f;
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
    --info:#2563eb;

    --sh-xs:0 1px 2px rgba(16,22,31,.05);
    --sh-sm:0 2px 8px rgba(16,22,31,.06),0 1px 2px rgba(16,22,31,.04);
    --sh-md:0 12px 32px -12px rgba(16,22,31,.18),0 2px 6px rgba(16,22,31,.05);
    --sh-lg:0 28px 60px -24px rgba(16,22,31,.28);
    --ring:0 0 0 4px var(--brand-tint-2);

    --r-sm:12px; --r-md:16px; --r-lg:22px; --r-pill:999px;
    --t:220ms cubic-bezier(.4,0,.2,1);

    font-family:'Inter',-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,sans-serif;
    color:var(--ink);
    -webkit-font-smoothing:antialiased;
    
    /* Prevent overflow */
    overflow-x: hidden;
    max-width: 100%;
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
}

.dcp *,.dcp *::before,.dcp *::after{box-sizing:border-box;}
body:has(.dcp){background:var(--bg,#f6f7f9);margin:0;overflow-x:hidden;}

.dcp{
    background:var(--bg);background-image:var(--bg-veil);background-repeat:no-repeat;
    min-height:100vh;padding:26px 28px 60px;
    width:100%;
}
.dcp__wrap{max-width:1400px;margin:0 auto;width:100%;}

/* ---------- Top bar ---------- */
.dcp-top{display:flex;align-items:flex-end;justify-content:space-between;gap:18px;flex-wrap:wrap;margin-bottom:22px;}
.dcp-crumb{
    display:flex;align-items:center;gap:8px;font-size:.74rem;font-weight:600;
    letter-spacing:.04em;text-transform:uppercase;color:var(--ink-3);margin-bottom:10px;
}
.dcp-crumb a{color:var(--ink-3);text-decoration:none;transition:var(--t);}
.dcp-crumb a:hover{color:var(--brand);}
.dcp-crumb i{font-size:.55rem;opacity:.6;}
.dcp-title{margin:0;font-size:clamp(1.5rem,2.4vw,2rem);font-weight:800;letter-spacing:-.035em;line-height:1.1;display:flex;align-items:center;gap:12px;}
.dcp-title .glyph{
    width:42px;height:42px;flex:0 0 42px;border-radius:14px;display:grid;place-items:center;
    color:#fff;font-size:.95rem;background:var(--brand-grad);
    box-shadow:0 10px 22px -10px rgba(157,54,38,.75),inset 0 1px 0 rgba(255,255,255,.28);
}
.dcp-sub{margin:8px 0 0;color:var(--ink-2);font-size:.86rem;line-height:1.5;}
.dcp-top__right{display:flex;align-items:center;gap:10px;flex-wrap:wrap;}

/* ---------- Buttons ---------- */
.dcp-btn{
    display:inline-flex;align-items:center;justify-content:center;gap:8px;
    height:42px;padding:0 20px;border-radius:var(--r-pill);
    font-family:inherit;font-size:.85rem;font-weight:600;letter-spacing:-.01em;
    border:1px solid transparent;cursor:pointer;text-decoration:none;transition:var(--t);white-space:nowrap;
}
.dcp-btn:focus-visible{outline:none;box-shadow:var(--ring);}
.dcp-btn--ghost{background:var(--surface);color:var(--ink-2);border-color:var(--line);box-shadow:var(--sh-xs);}
.dcp-btn--ghost:hover{color:var(--brand);border-color:var(--brand-tint-2);background:var(--brand-tint);transform:translateY(-1px);}
.dcp-btn--primary{background:var(--brand-grad);color:#fff;box-shadow:0 12px 26px -12px rgba(157,54,38,.85),inset 0 1px 0 rgba(255,255,255,.22);}
.dcp-btn--primary:hover{transform:translateY(-2px);color:#fff;box-shadow:0 18px 34px -12px rgba(157,54,38,.9);}
.dcp-btn--icon{width:42px;padding:0;flex:0 0 42px;}

/* ---------- Stat cards ---------- */
.dcp-stats{display:grid;grid-template-columns:repeat(4,1fr);gap:14px;margin-bottom:18px;}
.dcp-stat{
    background:var(--surface);border:1px solid var(--line);border-radius:var(--r-md);
    padding:16px 18px;box-shadow:var(--sh-sm);position:relative;overflow:hidden;
    display:flex;align-items:center;gap:14px;transition:var(--t);
    animation:dcpIn .5s cubic-bezier(.2,.7,.2,1) both;
}
.dcp-stat:hover{transform:translateY(-2px);box-shadow:var(--sh-md);}
.dcp-stat:nth-child(2){animation-delay:.05s;}
.dcp-stat:nth-child(3){animation-delay:.1s;}
.dcp-stat:nth-child(4){animation-delay:.15s;}
.dcp-stat__icon{
    width:40px;height:40px;flex:0 0 40px;border-radius:12px;display:grid;place-items:center;font-size:.9rem;
    background:var(--surface-3);color:var(--ink-2);
}
.dcp-stat--brand .dcp-stat__icon{background:var(--brand-tint);color:var(--brand);}
.dcp-stat--ok .dcp-stat__icon{background:rgba(22,163,74,.11);color:var(--ok);}
.dcp-stat--warn .dcp-stat__icon{background:rgba(217,119,6,.11);color:var(--warn);}
.dcp-stat--info .dcp-stat__icon{background:rgba(37,99,235,.11);color:var(--info);}
.dcp-stat__num{font-size:1.5rem;font-weight:800;letter-spacing:-.03em;line-height:1;font-variant-numeric:tabular-nums;}
.dcp-stat__label{font-size:.72rem;color:var(--ink-3);font-weight:600;letter-spacing:.03em;text-transform:uppercase;margin-top:4px;}

/* ---------- Card ---------- */
.dcp-card{
    background:var(--surface);border:1px solid var(--line);border-radius:var(--r-lg);
    box-shadow:var(--sh-md);overflow:hidden;animation:dcpIn .5s cubic-bezier(.2,.7,.2,1) both;
    width:100%;
}
.dcp-card__head{
    display:flex;align-items:center;justify-content:space-between;gap:12px;
    padding:14px 20px;border-bottom:1px solid var(--line);
    background:linear-gradient(180deg,var(--surface-2),var(--surface));flex-wrap:wrap;
}
.dcp-card__head h3{margin:0;font-size:.9rem;font-weight:700;display:flex;align-items:center;gap:10px;}
.dcp-card__head h3 i{color:var(--brand);font-size:.85rem;}

.dcp-chip{
    display:inline-flex;align-items:center;gap:6px;padding:4px 11px;border-radius:var(--r-pill);
    font-size:.68rem;font-weight:600;letter-spacing:.03em;text-transform:uppercase;
    background:var(--surface-3);color:var(--ink-3);border:1px solid var(--line);
}
.dcp-chip .dot{width:6px;height:6px;border-radius:50%;background:currentColor;}
.dcp-chip--draft{color:var(--warn);background:rgba(217,119,6,.10);border-color:rgba(217,119,6,.22);}
.dcp-chip--live{color:var(--ok);background:rgba(22,163,74,.10);border-color:rgba(22,163,74,.22);}
.dcp-chip--live .dot{box-shadow:0 0 0 0 rgba(22,163,74,.55);animation:dcpPulse 1.9s infinite;}
.dcp-chip--cat{color:var(--brand);background:var(--brand-tint);border-color:var(--brand-tint-2);text-transform:none;letter-spacing:0;}
.dcp[data-theme="dark"] .dcp-chip--cat{color:var(--brand-light);}

/* ---------- Toolbar / filters ---------- */
.dcp-toolbar{
    display:flex;align-items:center;gap:12px;padding:14px 20px;flex-wrap:wrap;
    background:var(--surface-2);border-bottom:1px solid var(--line);
}
.dcp-tabs{display:flex;gap:4px;padding:4px;background:var(--surface-3);border:1px solid var(--line);border-radius:var(--r-sm);flex-wrap:wrap;}
.dcp-tabs a{
    display:inline-flex;align-items:center;gap:7px;padding:8px 14px;border-radius:9px;
    font-size:.8rem;font-weight:600;color:var(--ink-2);text-decoration:none;transition:var(--t);
    border:1px solid transparent;white-space:nowrap;
}
.dcp-tabs a:hover{color:var(--ink);}
.dcp-tabs a.is-active{background:var(--surface);color:var(--brand);border-color:var(--line);box-shadow:var(--sh-xs);}
.dcp-tabs a .n{
    font-size:.68rem;padding:1px 7px;border-radius:var(--r-pill);
    background:var(--surface);color:var(--ink-3);border:1px solid var(--line);font-variant-numeric:tabular-nums;
}
.dcp-tabs a.is-active .n{background:var(--brand-tint);color:var(--brand);border-color:var(--brand-tint-2);}

.dcp-search{
    display:flex;align-items:center;flex:1;min-width:200px;max-width:100%;
    background:var(--surface);border:1px solid var(--line);border-radius:var(--r-sm);
    transition:var(--t);overflow:hidden;
}
.dcp-search:focus-within{border-color:var(--brand-light);box-shadow:var(--ring);}
.dcp-search i{padding:0 4px 0 13px;color:var(--ink-3);font-size:.8rem;}
.dcp-search input{
    flex:1;min-width:0;border:0;outline:none;background:transparent;
    padding:11px 12px;font-family:inherit;font-size:.88rem;color:var(--ink);
    width:100%;
}
.dcp-search input::placeholder{color:var(--ink-3);}
.dcp-search__clear{
    border:0;background:transparent;color:var(--ink-3);width:36px;height:38px;cursor:pointer;transition:var(--t);
}
.dcp-search__clear:hover{color:var(--danger);}

.dcp-select{
    appearance:none;font-family:inherit;font-size:.86rem;color:var(--ink);cursor:pointer;
    background-color:var(--surface);border:1px solid var(--line);border-radius:var(--r-sm);
    padding:11px 36px 11px 14px;outline:none;transition:var(--t);min-width:140px;
    background-image:url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%238b97a8' stroke-width='2.4' stroke-linecap='round'><path d='M6 9l6 6 6-6'/></svg>");
    background-repeat:no-repeat;background-position:right 12px center;background-size:16px;
}
.dcp-select:hover{border-color:var(--line-strong);}
.dcp-select:focus{border-color:var(--brand-light);box-shadow:var(--ring);}

.dcp-applied{
    display:flex;align-items:center;gap:8px;padding:10px 20px;flex-wrap:wrap;
    background:var(--brand-tint);border-bottom:1px solid var(--line);font-size:.78rem;color:var(--ink-2);
}
.dcp-applied__tag{
    display:inline-flex;align-items:center;gap:7px;padding:4px 10px;border-radius:var(--r-pill);
    background:var(--surface);border:1px solid var(--line);font-weight:600;font-size:.74rem;color:var(--ink);
}
.dcp-applied__tag a{color:var(--ink-3);text-decoration:none;transition:var(--t);font-size:.7rem;}
.dcp-applied__tag a:hover{color:var(--danger);}
.dcp-applied__clear{margin-left:auto;color:var(--brand);font-weight:600;text-decoration:none;font-size:.76rem;}
.dcp-applied__clear:hover{text-decoration:underline;}

/* ---------- Table (FIXED OVERFLOW) ---------- */
.dcp-tablewrap{
    overflow-x:auto;
    -webkit-overflow-scrolling:touch;
    width:100%;
}
.dcp-table{
    width:100%;
    min-width:700px;
    border-collapse:collapse;
    font-size:.88rem;
    table-layout:fixed;
}
.dcp-table thead th{
    text-align:left;
    padding:12px 14px;
    font-size:.68rem;
    font-weight:700;
    letter-spacing:.06em;
    text-transform:uppercase;
    color:var(--ink-3);
    background:var(--surface-2);
    border-bottom:1px solid var(--line);
    white-space:nowrap;
}
/* Fixed column widths */
.dcp-table thead th:nth-child(1){width:35%;}
.dcp-table thead th:nth-child(2){width:12%;}
.dcp-table thead th:nth-child(3){width:12%;}
.dcp-table thead th:nth-child(4){width:10%;}
.dcp-table thead th:nth-child(5){width:13%;}
.dcp-table thead th:nth-child(6){width:18%;text-align:right;}

.dcp-table tbody tr{border-bottom:1px solid var(--line);transition:background var(--t);}
.dcp-table tbody tr:last-child{border-bottom:0;}
.dcp-table tbody tr:hover{background:var(--brand-tint);}
.dcp-table tbody td{padding:12px 14px;vertical-align:middle;overflow:hidden;text-overflow:ellipsis;}

/* Post column */
.dcp-post{display:flex;align-items:center;gap:12px;min-width:0;}
.dcp-post__thumb{
    width:52px;height:40px;flex:0 0 52px;border-radius:10px;object-fit:cover;
    border:1px solid var(--line);background:var(--surface-3);transition:var(--t);
}
.dcp-table tbody tr:hover .dcp-post__thumb{transform:scale(1.04);box-shadow:var(--sh-sm);}
.dcp-post__body{min-width:0;flex:1;}
.dcp-post__title{
    display:block;font-weight:650;font-size:.88rem;color:var(--ink);text-decoration:none;
    letter-spacing:-.01em;transition:var(--t);
    overflow:hidden;text-overflow:ellipsis;white-space:nowrap;
}
.dcp-post__title:hover{color:var(--brand);}
.dcp-post__slug{
    display:flex;align-items:center;gap:5px;margin-top:2px;
    font-size:.7rem;color:var(--ink-3);
    overflow:hidden;text-overflow:ellipsis;white-space:nowrap;
}
.dcp-post__slug i{font-size:.6rem;opacity:.7;}

.dcp-author{display:flex;align-items:center;gap:8px;font-size:.8rem;color:var(--ink-2);}
.dcp-avatar{
    width:24px;height:24px;flex:0 0 24px;border-radius:50%;display:grid;place-items:center;
    font-size:.6rem;font-weight:700;color:#fff;background:var(--brand-grad);letter-spacing:.02em;
}
.dcp-when{font-size:.78rem;color:var(--ink-2);white-space:nowrap;}
.dcp-when small{display:block;color:var(--ink-3);font-size:.65rem;margin-top:1px;}

/* row actions - FIXED */
.dcp-actions{
    display:flex;
    align-items:center;
    gap:2px;
    justify-content:flex-end;
    flex-wrap:nowrap;
}
.dcp-act{
    display:inline-flex;align-items:center;justify-content:center;
    width:30px;height:30px;border-radius:8px;border:1px solid transparent;
    background:transparent;color:var(--ink-3);cursor:pointer;text-decoration:none;
    font-size:.75rem;transition:var(--t);
}
.dcp-act:hover{background:var(--surface);border-color:var(--line);color:var(--brand);box-shadow:var(--sh-xs);transform:translateY(-1px);}
.dcp-act--ok:hover{color:var(--ok);border-color:rgba(22,163,74,.3);background:rgba(22,163,74,.08);}
.dcp-act--warn:hover{color:var(--warn);border-color:rgba(217,119,6,.3);background:rgba(217,119,6,.08);}
.dcp-act--danger:hover{color:var(--danger);border-color:rgba(220,38,38,.3);background:rgba(220,38,38,.08);}
.dcp-actions form{display:inline-flex;margin:0;}

/* ---------- Empty state ---------- */
.dcp-empty{padding:64px 28px;text-align:center;}
.dcp-empty__art{
    width:78px;height:78px;margin:0 auto 18px;border-radius:24px;display:grid;place-items:center;
    font-size:1.9rem;color:var(--brand);background:var(--brand-tint);border:1px solid var(--brand-tint-2);
}
.dcp-empty h4{margin:0 0 8px;font-size:1.15rem;font-weight:750;letter-spacing:-.02em;}
.dcp-empty p{margin:0 auto 22px;max-width:400px;color:var(--ink-2);font-size:.88rem;line-height:1.6;}

/* ---------- Pagination ---------- */
.dcp-pager{
    display:flex;align-items:center;justify-content:space-between;gap:14px;flex-wrap:wrap;
    padding:14px 20px;border-top:1px solid var(--line);background:var(--surface-2);
}
.dcp-pager__info{font-size:.8rem;color:var(--ink-3);}
.dcp-pager__info strong{color:var(--ink);font-variant-numeric:tabular-nums;}
.dcp-pager__links{display:flex;align-items:center;gap:5px;flex-wrap:wrap;}
.dcp-pager__links a,.dcp-pager__links span{
    display:inline-flex;align-items:center;justify-content:center;
    min-width:34px;height:34px;padding:0 10px;border-radius:8px;
    border:1px solid var(--line);background:var(--surface);color:var(--ink-2);
    text-decoration:none;font-size:.8rem;font-weight:600;transition:var(--t);
    font-variant-numeric:tabular-nums;
}
.dcp-pager__links a:hover{border-color:var(--brand-tint-2);color:var(--brand);background:var(--brand-tint);transform:translateY(-1px);}
.dcp-pager__links .is-active{background:var(--brand-grad);color:#fff;border-color:transparent;box-shadow:0 8px 18px -10px rgba(157,54,38,.8);}
.dcp-pager__links .is-off{opacity:.4;pointer-events:none;}

/* ---------- Flash toast ---------- */
.dcp-flash{
    display:flex;align-items:center;gap:12px;padding:14px 18px;margin-bottom:18px;
    border-radius:var(--r-md);border:1px solid var(--line);background:var(--surface);
    box-shadow:var(--sh-sm);font-size:.87rem;font-weight:500;
    animation:dcpIn .45s cubic-bezier(.2,.7,.2,1) both;
}
.dcp-flash__icon{width:30px;height:30px;flex:0 0 30px;border-radius:9px;display:grid;place-items:center;color:#fff;font-size:.8rem;}
.dcp-flash--ok{border-color:rgba(22,163,74,.28);background:rgba(22,163,74,.07);color:#14532d;}
.dcp-flash--ok .dcp-flash__icon{background:var(--ok);}
.dcp-flash--err{border-color:rgba(220,38,38,.28);background:rgba(220,38,38,.07);color:#7f1d1d;}
.dcp-flash--err .dcp-flash__icon{background:var(--danger);}
.dcp[data-theme="dark"] .dcp-flash--ok{color:#bbf7d0;}
.dcp[data-theme="dark"] .dcp-flash--err{color:#fecaca;}
.dcp-flash__x{margin-left:auto;border:0;background:transparent;color:inherit;opacity:.55;cursor:pointer;font-size:.9rem;transition:var(--t);}
.dcp-flash__x:hover{opacity:1;}

/* ---------- Animations ---------- */
@keyframes dcpIn{from{opacity:0;transform:translateY(14px);}to{opacity:1;transform:none;}}
@keyframes dcpPulse{0%{box-shadow:0 0 0 0 rgba(22,163,74,.5);}70%{box-shadow:0 0 0 7px rgba(22,163,74,0);}100%{box-shadow:0 0 0 0 rgba(22,163,74,0);}}
@media (prefers-reduced-motion:reduce){.dcp *,.dcp *::before{animation:none !important;transition:none !important;}}

/* ---------- RESPONSIVE ---------- */
@media (max-width:1200px){
    .dcp-stats{grid-template-columns:repeat(2,1fr);}
}
@media (max-width:992px){
    .dcp{padding:18px 16px 40px;}
    .dcp-toolbar{flex-direction:column;align-items:stretch;gap:10px;}
    .dcp-tabs{justify-content:space-between;}
    .dcp-tabs a{flex:1;justify-content:center;padding:6px 10px;font-size:.75rem;}
    .dcp-select{width:100%;}
    .dcp-search{min-width:100%;}
}
@media (max-width:768px){
    .dcp-stats{grid-template-columns:1fr 1fr;gap:10px;}
    .dcp-stat{padding:14px;}
    .dcp-stat__num{font-size:1.25rem;}
    .dcp-title{font-size:1.3rem;}
    .dcp-top__right .dcp-btn:not(.dcp-btn--icon){flex:1;}
    .dcp-pager{flex-direction:column;align-items:center;gap:10px;}
    .dcp-pager__links{justify-content:center;}
    
    /* Table card view on mobile */
    .dcp-table thead{display:none;}
    .dcp-table,.dcp-table tbody,.dcp-table tr,.dcp-table td{display:block;width:100%;}
    .dcp-table{min-width:unset;}
    .dcp-table tbody tr{
        border:1px solid var(--line);border-radius:var(--r-md);margin:10px 0;
        padding:4px 0;background:var(--surface-2);
    }
    .dcp-table tbody td{
        padding:8px 14px;border:0;display:flex;align-items:center;justify-content:space-between;gap:10px;
        overflow:visible;text-overflow:unset;white-space:normal;
    }
    .dcp-table tbody td::before{
        content:attr(data-label);flex:0 0 80px;
        font-size:.65rem;font-weight:700;letter-spacing:.05em;text-transform:uppercase;color:var(--ink-3);
    }
    .dcp-table tbody td:first-child{display:block;padding-bottom:4px;}
    .dcp-table tbody td:first-child::before{display:none;}
    .dcp-post__title{white-space:normal;}
    .dcp-post__slug{white-space:normal;}
    .dcp-actions{justify-content:flex-end;flex-wrap:wrap;}
}
@media (max-width:480px){
    .dcp{padding:12px 10px 32px;}
    .dcp-stats{grid-template-columns:1fr;gap:8px;}
    .dcp-stat{padding:12px;gap:10px;}
    .dcp-stat__num{font-size:1.1rem;}
    .dcp-title{font-size:1.1rem;gap:8px;}
    .dcp-title .glyph{width:34px;height:34px;flex:0 0 34px;font-size:.8rem;}
    .dcp-sub{font-size:.78rem;}
    .dcp-tabs a{font-size:.7rem;padding:4px 8px;}
    .dcp-tabs a .n{font-size:.6rem;padding:0 5px;}
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
                <span>Posts</span>
            </nav>
            <h1 class="dcp-title">
                <span class="glyph"><i class="fas fa-newspaper"></i></span>
                Blog Posts
            </h1>
            <p class="dcp-sub">All content in one place — search, filter, publish or draft.</p>
        </div>
        <div class="dcp-top__right">
            <button type="button" class="dcp-btn dcp-btn--ghost dcp-btn--icon" id="dcpTheme" title="Toggle theme" aria-label="Toggle theme">
                <i class="fas fa-moon"></i>
            </button>
            <a href="/admin/blogs/create.php" class="dcp-btn dcp-btn--primary">
                <i class="fas fa-plus"></i> New Post
            </a>
        </div>
    </header>

    <!-- ============ FLASH ============ -->
    <?php if ($flashMessage !== ''): ?>
        <div class="dcp-flash <?php echo $flashType === 'success' ? 'dcp-flash--ok' : 'dcp-flash--err'; ?>" id="dcpFlash" role="status">
            <span class="dcp-flash__icon">
                <i class="fas <?php echo $flashType === 'success' ? 'fa-check' : 'fa-exclamation'; ?>"></i>
            </span>
            <span><?php echo $esc($flashMessage); ?></span>
            <button type="button" class="dcp-flash__x" aria-label="Dismiss"><i class="fas fa-xmark"></i></button>
        </div>
    <?php endif; ?>

    <!-- ============ STATS ============ -->
    <div class="dcp-stats">
        <div class="dcp-stat dcp-stat--brand">
            <span class="dcp-stat__icon"><i class="fas fa-layer-group"></i></span>
            <div>
                <div class="dcp-stat__num"><?php echo number_format($statTotal); ?></div>
                <div class="dcp-stat__label">Total Posts</div>
            </div>
        </div>
        <div class="dcp-stat dcp-stat--ok">
            <span class="dcp-stat__icon"><i class="fas fa-rocket"></i></span>
            <div>
                <div class="dcp-stat__num"><?php echo number_format($statPublished); ?></div>
                <div class="dcp-stat__label">Published</div>
            </div>
        </div>
        <div class="dcp-stat dcp-stat--warn">
            <span class="dcp-stat__icon"><i class="fas fa-pen-to-square"></i></span>
            <div>
                <div class="dcp-stat__num"><?php echo number_format($statDraft); ?></div>
                <div class="dcp-stat__label">Drafts</div>
            </div>
        </div>
        <div class="dcp-stat dcp-stat--info">
            <span class="dcp-stat__icon"><i class="fas fa-calendar-day"></i></span>
            <div>
                <div class="dcp-stat__num"><?php echo number_format($statThisMonth); ?></div>
                <div class="dcp-stat__label">This Month</div>
            </div>
        </div>
    </div>

    <!-- ============ LIST CARD ============ -->
    <div class="dcp-card">

        <!-- Toolbar -->
        <form method="GET" action="/admin/blogs/index.php" class="dcp-toolbar" id="dcpFilterForm">
            <div class="dcp-tabs">
                <a href="<?php echo $esc($buildUrl(['status' => 'all', 'page' => 1])); ?>"
                   class="<?php echo $statusFilter === 'all' ? 'is-active' : ''; ?>">
                    All <span class="n"><?php echo number_format($statTotal); ?></span>
                </a>
                <a href="<?php echo $esc($buildUrl(['status' => 'published', 'page' => 1])); ?>"
                   class="<?php echo $statusFilter === 'published' ? 'is-active' : ''; ?>">
                    Published <span class="n"><?php echo number_format($statPublished); ?></span>
                </a>
                <a href="<?php echo $esc($buildUrl(['status' => 'draft', 'page' => 1])); ?>"
                   class="<?php echo $statusFilter === 'draft' ? 'is-active' : ''; ?>">
                    Drafts <span class="n"><?php echo number_format($statDraft); ?></span>
                </a>
            </div>

            <input type="hidden" name="status" value="<?php echo $esc($statusFilter); ?>">

            <label class="dcp-search">
                <i class="fas fa-magnifying-glass"></i>
                <input type="text" name="search" value="<?php echo $esc($search); ?>"
                       placeholder="Search by title or slug…" autocomplete="off">
                <?php if ($search !== ''): ?>
                    <button type="button" class="dcp-search__clear" id="dcpClearSearch" title="Clear search" aria-label="Clear search">
                        <i class="fas fa-xmark"></i>
                    </button>
                <?php endif; ?>
            </label>

            <select name="category" class="dcp-select" onchange="this.form.submit()">
                <option value="0">All Categories</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?php echo (int) $category['id']; ?>"
                        <?php echo $categoryFilter === (int) $category['id'] ? 'selected' : ''; ?>>
                        <?php echo $esc($category['name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <button type="submit" class="dcp-btn dcp-btn--ghost">
                <i class="fas fa-filter"></i> Apply
            </button>
        </form>

        <!-- Applied filters -->
        <?php if ($hasFilters): ?>
            <div class="dcp-applied">
                <span>Filters:</span>
                <?php if ($search !== ''): ?>
                    <span class="dcp-applied__tag">
                        <i class="fas fa-magnifying-glass" style="font-size:.62rem;opacity:.6;"></i>
                        <?php echo $esc($search); ?>
                        <a href="<?php echo $esc($buildUrl(['search' => '', 'page' => 1])); ?>" title="Remove"><i class="fas fa-xmark"></i></a>
                    </span>
                <?php endif; ?>
                <?php if ($statusFilter !== 'all'): ?>
                    <span class="dcp-applied__tag">
                        <i class="fas fa-flag" style="font-size:.62rem;opacity:.6;"></i>
                        <?php echo ucfirst($esc($statusFilter)); ?>
                        <a href="<?php echo $esc($buildUrl(['status' => 'all', 'page' => 1])); ?>" title="Remove"><i class="fas fa-xmark"></i></a>
                    </span>
                <?php endif; ?>
                <?php if ($categoryFilter > 0): ?>
                    <?php
                    $activeCategoryName = 'Category';
                    foreach ($categories as $categoryRow) {
                        if ((int) $categoryRow['id'] === $categoryFilter) {
                            $activeCategoryName = (string) $categoryRow['name'];
                            break;
                        }
                    }
                    ?>
                    <span class="dcp-applied__tag">
                        <i class="fas fa-folder" style="font-size:.62rem;opacity:.6;"></i>
                        <?php echo $esc($activeCategoryName); ?>
                        <a href="<?php echo $esc($buildUrl(['category' => 0, 'page' => 1])); ?>" title="Remove"><i class="fas fa-xmark"></i></a>
                    </span>
                <?php endif; ?>
                <a href="/admin/blogs/index.php" class="dcp-applied__clear">Clear all</a>
            </div>
        <?php endif; ?>

        <?php if (empty($posts)): ?>
            <!-- ============ EMPTY ============ -->
            <div class="dcp-empty">
                <div class="dcp-empty__art"><i class="fas fa-feather-pointed"></i></div>
                <h4><?php echo $hasFilters ? 'No posts match your filters' : 'No posts yet'; ?></h4>
                <p>
                    <?php if ($hasFilters): ?>
                        Try changing your search or clearing filters.
                    <?php else: ?>
                        Publish your first article and make the Doric blog section live.
                    <?php endif; ?>
                </p>
                <?php if ($hasFilters): ?>
                    <a href="/admin/blogs/index.php" class="dcp-btn dcp-btn--primary">
                        <i class="fas fa-rotate-left"></i> Clear Filters
                    </a>
                <?php else: ?>
                    <a href="/admin/blogs/create.php" class="dcp-btn dcp-btn--primary">
                        <i class="fas fa-plus"></i> Create Your First Post
                    </a>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <!-- ============ TABLE ============ -->
            <div class="dcp-tablewrap">
                <table class="dcp-table">
                    <thead>
                        <tr>
                            <th>Post</th>
                            <th>Category</th>
                            <th>Author</th>
                            <th>Status</th>
                            <th>Updated</th>
                            <th style="text-align:right;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($posts as $post): ?>
                            <?php
                            $isPublished = strtolower((string) $post['status']) === 'published';
                            $authorName = (string) ($post['author_name'] ?: 'Unknown');
                            $initials = strtoupper(mb_substr(trim($authorName), 0, 1) ?: '?');
                            ?>
                            <tr>
                                <td>
                                    <div class="dcp-post">
                                        <img class="dcp-post__thumb" loading="lazy"
                                             src="<?php echo $esc(blogImageUrl($post['featured_image'] ?? null)); ?>"
                                             alt="<?php echo $esc($post['title']); ?>">
                                        <div class="dcp-post__body">
                                            <a class="dcp-post__title" href="/admin/blogs/edit.php?id=<?php echo (int) $post['id']; ?>">
                                                <?php echo $esc($post['title']); ?>
                                            </a>
                                            <span class="dcp-post__slug">
                                                <i class="fas fa-link"></i> /blog/<?php echo $esc($post['slug']); ?>
                                            </span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="dcp-chip dcp-chip--cat">
                                        <?php echo $esc($post['category_name'] ?: 'Uncategorized'); ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="dcp-author">
                                        <span class="dcp-avatar"><?php echo $esc($initials); ?></span>
                                        <?php echo $esc($authorName); ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="dcp-chip <?php echo $isPublished ? 'dcp-chip--live' : 'dcp-chip--draft'; ?>">
                                        <span class="dot"></span><?php echo $isPublished ? 'Published' : 'Draft'; ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="dcp-when">
                                        <?php echo $esc($relTime($post['updated_at'] ?? null)); ?>
                                        <small><?php echo !empty($post['updated_at']) ? $esc(date('d M Y, g:i A', strtotime((string) $post['updated_at']))) : ''; ?></small>
                                    </span>
                                </td>
                                <td>
                                    <div class="dcp-actions">
                                        <a href="/admin/blogs/view.php?id=<?php echo (int) $post['id']; ?>"
                                           class="dcp-act" title="View" aria-label="View post">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="/admin/blogs/edit.php?id=<?php echo (int) $post['id']; ?>"
                                           class="dcp-act" title="Edit" aria-label="Edit post">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <form method="POST" action="/admin/blogs/status.php">
                                            <input type="hidden" name="csrf_token" value="<?php echo $esc($csrfToken); ?>">
                                            <input type="hidden" name="id" value="<?php echo (int) $post['id']; ?>">
                                            <input type="hidden" name="action" value="<?php echo $isPublished ? 'draft' : 'publish'; ?>">
                                            <button type="submit"
                                                    class="dcp-act <?php echo $isPublished ? 'dcp-act--warn' : 'dcp-act--ok'; ?>"
                                                    title="<?php echo $isPublished ? 'Move to draft' : 'Publish now'; ?>"
                                                    aria-label="Toggle status">
                                                <i class="fas <?php echo $isPublished ? 'fa-eye-slash' : 'fa-circle-check'; ?>"></i>
                                            </button>
                                        </form>
                                        <form method="POST" action="/admin/blogs/delete.php"
                                              onsubmit="return confirm('This post will be permanently deleted. Are you sure?');">
                                            <input type="hidden" name="csrf_token" value="<?php echo $esc($csrfToken); ?>">
                                            <input type="hidden" name="id" value="<?php echo (int) $post['id']; ?>">
                                            <button type="submit" class="dcp-act dcp-act--danger" title="Delete" aria-label="Delete post">
                                                <i class="fas fa-trash-can"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- ============ PAGINATION ============ -->
            <div class="dcp-pager">
                <div class="dcp-pager__info">
                    Showing <strong><?php echo number_format($offset + 1); ?></strong>–<strong><?php echo number_format(min($offset + $perPage, $totalPosts)); ?></strong>
                    of <strong><?php echo number_format($totalPosts); ?></strong> posts
                    <?php if ($totalPages > 1): ?>
                        · page <strong><?php echo $page; ?></strong> / <?php echo $totalPages; ?>
                    <?php endif; ?>
                </div>

                <?php if ($totalPages > 1): ?>
                    <div class="dcp-pager__links">
                        <?php if ($page > 1): ?>
                            <a href="<?php echo $esc($buildUrl(['page' => 1])); ?>" title="First page"><i class="fas fa-angles-left"></i></a>
                            <a href="<?php echo $esc($buildUrl(['page' => $page - 1])); ?>" title="Previous"><i class="fas fa-chevron-left"></i></a>
                        <?php else: ?>
                            <span class="is-off"><i class="fas fa-angles-left"></i></span>
                            <span class="is-off"><i class="fas fa-chevron-left"></i></span>
                        <?php endif; ?>

                        <?php
                        $startPage = max(1, $page - 2);
                        $endPage = min($totalPages, $page + 2);
                        if ($startPage > 1): ?>
                            <span class="is-off">…</span>
                        <?php endif; ?>

                        <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
                            <a href="<?php echo $esc($buildUrl(['page' => $i])); ?>"
                               class="<?php echo $i === $page ? 'is-active' : ''; ?>"><?php echo $i; ?></a>
                        <?php endfor; ?>

                        <?php if ($endPage < $totalPages): ?>
                            <span class="is-off">…</span>
                        <?php endif; ?>

                        <?php if ($page < $totalPages): ?>
                            <a href="<?php echo $esc($buildUrl(['page' => $page + 1])); ?>" title="Next"><i class="fas fa-chevron-right"></i></a>
                            <a href="<?php echo $esc($buildUrl(['page' => $totalPages])); ?>" title="Last page"><i class="fas fa-angles-right"></i></a>
                        <?php else: ?>
                            <span class="is-off"><i class="fas fa-chevron-right"></i></span>
                            <span class="is-off"><i class="fas fa-angles-right"></i></span>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
</div>

<script>
(function () {
    'use strict';
    var root = document.getElementById('dcp');
    if (!root) { return; }

    /* ---------- theme ---------- */
    var THEME_KEY = 'doric-admin-theme';
    var themeBtn = document.getElementById('dcpTheme');
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

    /* ---------- clear search ---------- */
    var clearBtn = document.getElementById('dcpClearSearch');
    if (clearBtn) {
        clearBtn.addEventListener('click', function () {
            var input = clearBtn.parentNode.querySelector('input[name="search"]');
            input.value = '';
            document.getElementById('dcpFilterForm').submit();
        });
    }

    /* ---------- dismiss flash ---------- */
    var flash = document.getElementById('dcpFlash');
    if (flash) {
        var hide = function () {
            flash.style.transition = 'opacity .3s ease, transform .3s ease';
            flash.style.opacity = '0';
            flash.style.transform = 'translateY(-8px)';
            setTimeout(function () { flash.style.display = 'none'; }, 320);
        };
        var closeBtn = flash.querySelector('.dcp-flash__x');
        if (closeBtn) { closeBtn.addEventListener('click', hide); }
        setTimeout(hide, 6000);
    }

    /* ---------- keyboard: "/" focuses search ---------- */
    document.addEventListener('keydown', function (ev) {
        if (ev.key === '/' && document.activeElement.tagName !== 'INPUT' && document.activeElement.tagName !== 'TEXTAREA') {
            var input = document.querySelector('.dcp-search input');
            if (input) { ev.preventDefault(); input.focus(); }
        }
    });
}());
</script>

<?php require __DIR__ . '/../includes/footer.php'; ?>