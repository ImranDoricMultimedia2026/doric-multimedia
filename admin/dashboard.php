<?php
require __DIR__ . '/includes/auth.php';
requireAdminAuth();
require __DIR__ . '/includes/db.php';

$pageTitle = 'Dashboard';

// Initialize stats with defaults
$stats = [
    'total_posts' => 0,
    'published_posts' => 0,
    'draft_posts' => 0,
    'categories_count' => 0,
    'total_views' => 0,
    'last30' => 0,
];
$recentPosts = [];
$categoryStats = [];
$monthlyPosts = [];
$dashboardError = '';
$hasViews = false;

try {
    $pdo = getDbConnection();

    // Total posts
    $stats['total_posts'] = (int) $pdo->query('SELECT COUNT(*) FROM blogs')->fetchColumn();

    // Published posts
    $publishedStmt = $pdo->prepare('SELECT COUNT(*) FROM blogs WHERE status = :status');
    $publishedStmt->execute([':status' => 'published']);
    $stats['published_posts'] = (int) $publishedStmt->fetchColumn();

    // Draft posts
    $draftStmt = $pdo->prepare('SELECT COUNT(*) FROM blogs WHERE status = :status');
    $draftStmt->execute([':status' => 'draft']);
    $stats['draft_posts'] = (int) $draftStmt->fetchColumn();

    // Categories count
    $stats['categories_count'] = (int) $pdo->query('SELECT COUNT(*) FROM categories')->fetchColumn();

    // Published in the last 30 days
    $stats['last30'] = (int) $pdo->query(
        "SELECT COUNT(*) FROM blogs
         WHERE status = 'published' AND published_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)"
    )->fetchColumn();

    // Recent posts with author
    $recentPostsStmt = $pdo->prepare(
        'SELECT b.id, b.title, b.status, b.updated_at, b.published_at,
                a.name AS author_name, c.name AS category_name
         FROM blogs b
         LEFT JOIN admins a ON a.id = b.author_id
         LEFT JOIN categories c ON c.id = b.category_id
         ORDER BY b.updated_at DESC, b.id DESC
         LIMIT 6'
    );
    $recentPostsStmt->execute();
    $recentPosts = $recentPostsStmt->fetchAll();

    // Category distribution
    $categoryStmt = $pdo->query(
        "SELECT c.name, COUNT(b.id) AS count
         FROM categories c
         LEFT JOIN blogs b ON b.category_id = c.id AND b.status = 'published'
         GROUP BY c.id, c.name
         ORDER BY count DESC
         LIMIT 5"
    );
    $categoryStats = $categoryStmt->fetchAll();

    // Monthly posts for the last 6 months
    $monthlyStmt = $pdo->query(
        "SELECT DATE_FORMAT(published_at, '%Y-%m') AS month, COUNT(*) AS count
         FROM blogs
         WHERE status = 'published'
           AND published_at >= DATE_SUB(NOW(), INTERVAL 6 MONTH)
         GROUP BY DATE_FORMAT(published_at, '%Y-%m')
         ORDER BY month ASC"
    );
    $monthlyPosts = $monthlyStmt->fetchAll();
} catch (Throwable $e) {
    $dashboardError = 'Unable to load dashboard data at the moment.';
    error_log('Dashboard Error: ' . $e->getMessage());
}

/* views column optional — apni try me rakha hai taki column na ho to
   poora dashboard blank na ho jaye */
if (isset($pdo)) {
    try {
        $stats['total_views'] = (int) $pdo->query('SELECT COALESCE(SUM(views), 0) FROM blogs')->fetchColumn();
        $hasViews = true;
    } catch (Throwable $e) {
        error_log('Dashboard views column missing: ' . $e->getMessage());
    }
}

$publishRate = $stats['total_posts'] > 0
    ? (int) round(($stats['published_posts'] / $stats['total_posts']) * 100)
    : 0;
$maxCategoryCount = 0;
foreach ($categoryStats as $categoryRow) {
    $maxCategoryCount = max($maxCategoryCount, (int) $categoryRow['count']);
}

$esc = static function (?string $value): string {
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
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
    if ($diff < 60)    { return 'just now'; }
    if ($diff < 3600)  { return floor($diff / 60) . 'm ago'; }
    if ($diff < 86400) { return floor($diff / 3600) . 'h ago'; }
    if ($diff < 604800){ return floor($diff / 86400) . 'd ago'; }
    return date('d M Y', $ts);
};

require __DIR__ . '/includes/header.php';
?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
/* ==========================================================================
   DORIC ADMIN — DASHBOARD (premium)
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
    --ring:0 0 0 4px var(--brand-tint-2);

    --r-sm:12px; --r-md:16px; --r-lg:22px; --r-pill:999px;
    --t:220ms cubic-bezier(.4,0,.2,1);

    font-family:'Inter',-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,sans-serif;
    color:var(--ink);
    -webkit-font-smoothing:antialiased;
    
    /* FIX: Prevent horizontal overflow */
    overflow-x: hidden;
    width: 100%;
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
body:has(.dcp){
    background:var(--bg,#f6f7f9);
    margin:0;
    overflow-x:hidden;
    width:100%;
    max-width:100%;
}

.dcp{
    background:var(--bg);
    background-image:var(--bg-veil);
    background-repeat:no-repeat;
    min-height:100vh;
    padding:26px 28px 60px;
    width:100%;
    max-width:100%;
}
.dcp__wrap{
    max-width:1400px;
    margin:0 auto;
    width:100%;
    overflow:hidden;
}

/* ---------- Top bar ---------- */
.dcp-top{display:flex;align-items:flex-end;justify-content:space-between;gap:18px;flex-wrap:wrap;margin-bottom:22px;}
.dcp-crumb{
    display:flex;align-items:center;gap:8px;font-size:.74rem;font-weight:600;
    letter-spacing:.04em;text-transform:uppercase;color:var(--ink-3);margin-bottom:10px;
}
.dcp-crumb i{font-size:.55rem;opacity:.6;}
.dcp-title{margin:0;font-size:clamp(1.5rem,2.4vw,2rem);font-weight:800;letter-spacing:-.035em;line-height:1.1;display:flex;align-items:center;gap:12px;}
.dcp-title .glyph{
    width:42px;height:42px;flex:0 0 42px;border-radius:14px;display:grid;place-items:center;
    color:#fff;font-size:.95rem;background:var(--brand-grad);
    box-shadow:0 10px 22px -10px rgba(157,54,38,.75),inset 0 1px 0 rgba(255,255,255,.28);
}
.dcp-sub{margin:8px 0 0;color:var(--ink-2);font-size:.86rem;line-height:1.5;display:flex;align-items:center;gap:8px;flex-wrap:wrap;}
.dcp-sub .live{width:7px;height:7px;border-radius:50%;background:var(--ok);box-shadow:0 0 0 0 rgba(22,163,74,.5);animation:dcpPulse 1.9s infinite;}
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
.dcp-btn--sm{height:34px;padding:0 15px;font-size:.79rem;}

/* ---------- Metric cards ---------- */
.dcp-metrics{display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-bottom:22px;}
.dcp-metric{
    background:var(--surface);border:1px solid var(--line);border-radius:var(--r-md);
    padding:20px 22px;box-shadow:var(--sh-sm);position:relative;overflow:hidden;transition:var(--t);
    animation:dcpIn .5s cubic-bezier(.2,.7,.2,1) both;
}
.dcp-metric::before{
    content:'';position:absolute;inset:0 0 auto 0;height:3px;background:var(--brand-grad);
    opacity:0;transition:var(--t);
}
.dcp-metric:hover::before{opacity:1;}
.dcp-metric:hover{transform:translateY(-4px);box-shadow:var(--sh-md);}
.dcp-metric:nth-child(2){animation-delay:.05s;}
.dcp-metric:nth-child(3){animation-delay:.1s;}
.dcp-metric:nth-child(4){animation-delay:.15s;}
.dcp-metric__head{display:flex;align-items:center;justify-content:space-between;gap:10px;margin-bottom:14px;}
.dcp-metric__label{font-size:.71rem;font-weight:700;letter-spacing:.06em;text-transform:uppercase;color:var(--ink-3);}
.dcp-metric__icon{
    width:38px;height:38px;flex:0 0 38px;border-radius:11px;display:grid;place-items:center;
    font-size:.9rem;background:var(--surface-3);color:var(--ink-2);
}
.dcp-metric--brand .dcp-metric__icon{background:var(--brand-tint);color:var(--brand);}
.dcp-metric--ok .dcp-metric__icon{background:rgba(22,163,74,.11);color:var(--ok);}
.dcp-metric--warn .dcp-metric__icon{background:rgba(217,119,6,.11);color:var(--warn);}
.dcp-metric--info .dcp-metric__icon{background:rgba(37,99,235,.11);color:var(--info);}
.dcp-metric__value{font-size:2rem;font-weight:800;letter-spacing:-.035em;line-height:1;margin:0;font-variant-numeric:tabular-nums;}
.dcp-metric__foot{display:flex;align-items:center;gap:7px;margin-top:9px;font-size:.76rem;font-weight:500;color:var(--ink-3);}
.dcp-metric__foot i{font-size:.66rem;}
.dcp-metric--ok .dcp-metric__foot i{color:var(--ok);}
.dcp-metric--warn .dcp-metric__foot i{color:var(--warn);}
.dcp-metric--brand .dcp-metric__foot i{color:var(--brand);}
.dcp-metric--info .dcp-metric__foot i{color:var(--info);}

/* ---------- Grid + panels ---------- */
.dcp-grid{display:grid;grid-template-columns:1fr 380px;gap:20px;align-items:start;}
.dcp-card{
    background:var(--surface);border:1px solid var(--line);border-radius:var(--r-lg);
    box-shadow:var(--sh-md);overflow:hidden;animation:dcpIn .55s cubic-bezier(.2,.7,.2,1) both;
    animation-delay:.2s;
    width:100%;
}
.dcp-card+.dcp-card{margin-top:20px;}
.dcp-card__head{
    display:flex;align-items:center;justify-content:space-between;gap:12px;
    padding:15px 22px;border-bottom:1px solid var(--line);
    background:linear-gradient(180deg,var(--surface-2),var(--surface));flex-wrap:wrap;
}
.dcp-card__head h3{margin:0;font-size:.92rem;font-weight:700;display:flex;align-items:center;gap:10px;letter-spacing:-.01em;}
.dcp-card__head h3 i{color:var(--brand);font-size:.88rem;}
.dcp-card__body{padding:20px 22px;}

.dcp-chip{
    display:inline-flex;align-items:center;gap:6px;padding:4px 11px;border-radius:var(--r-pill);
    font-size:.68rem;font-weight:600;letter-spacing:.03em;text-transform:uppercase;
    background:var(--surface-3);color:var(--ink-3);border:1px solid var(--line);white-space:nowrap;
}
.dcp-chip .dot{width:6px;height:6px;border-radius:50%;background:currentColor;}
.dcp-chip--draft{color:var(--warn);background:rgba(217,119,6,.10);border-color:rgba(217,119,6,.22);}
.dcp-chip--live{color:var(--ok);background:rgba(22,163,74,.10);border-color:rgba(22,163,74,.22);}
.dcp-chip--live .dot{box-shadow:0 0 0 0 rgba(22,163,74,.55);animation:dcpPulse 1.9s infinite;}
.dcp-chip--cat{color:var(--brand);background:var(--brand-tint);border-color:var(--brand-tint-2);text-transform:none;letter-spacing:0;}
.dcp[data-theme="dark"] .dcp-chip--cat{color:var(--brand-light);}

/* ---------- Table (FIXED OVERFLOW) ---------- */
.dcp-tablewrap{
    overflow-x:auto;
    -webkit-overflow-scrolling:touch;
    width:100%;
}
.dcp-table{
    width:100%;
    min-width:600px;
    border-collapse:collapse;
    font-size:.88rem;
    table-layout:fixed;
}
.dcp-table thead th{
    text-align:left;
    padding:11px 16px;
    font-size:.67rem;
    font-weight:700;
    letter-spacing:.06em;
    text-transform:uppercase;
    color:var(--ink-3);
    background:var(--surface-2);
    border-bottom:1px solid var(--line);
    white-space:nowrap;
}
/* Fixed column widths */
.dcp-table thead th:nth-child(1){width:42%;}
.dcp-table thead th:nth-child(2){width:18%;}
.dcp-table thead th:nth-child(3){width:18%;}
.dcp-table thead th:nth-child(4){width:22%;}

.dcp-table tbody tr{border-bottom:1px solid var(--line);transition:background var(--t);}
.dcp-table tbody tr:last-child{border-bottom:0;}
.dcp-table tbody tr:hover{background:var(--brand-tint);}
.dcp-table tbody td{padding:11px 16px;vertical-align:middle;overflow:hidden;text-overflow:ellipsis;}

.dcp-tlink{
    display:block;font-weight:600;color:var(--ink);text-decoration:none;transition:var(--t);
    letter-spacing:-.01em;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;
}
.dcp-tlink:hover{color:var(--brand);}
.dcp-tsub{display:flex;align-items:center;gap:6px;margin-top:3px;font-size:.72rem;color:var(--ink-3);}
.dcp-tsub .dcp-avatar{display:inline-flex;}
.dcp-when{font-size:.8rem;color:var(--ink-2);white-space:nowrap;}
.dcp-avatar{
    width:24px;height:24px;flex:0 0 24px;border-radius:50%;display:inline-grid;place-items:center;
    font-size:.62rem;font-weight:700;color:#fff;background:var(--brand-grad);
}

/* ---------- Distribution bars ---------- */
.dcp-dist{display:flex;flex-direction:column;gap:14px;}
.dcp-dist__row{display:block;}
.dcp-dist__top{display:flex;align-items:center;justify-content:space-between;gap:10px;margin-bottom:7px;}
.dcp-dist__name{font-size:.84rem;font-weight:600;color:var(--ink-2);}
.dcp-dist__num{font-size:.8rem;font-weight:700;color:var(--brand);font-variant-numeric:tabular-nums;}
.dcp[data-theme="dark"] .dcp-dist__num{color:var(--brand-light);}
.dcp-dist__track{height:7px;border-radius:var(--r-pill);background:var(--surface-3);overflow:hidden;}
.dcp-dist__fill{
    display:block;height:100%;border-radius:var(--r-pill);background:var(--brand-grad);
    transform-origin:left;animation:dcpGrow .8s cubic-bezier(.2,.7,.2,1) both;
}

/* ---------- Summary list ---------- */
.dcp-meta{display:flex;flex-direction:column;gap:9px;}
.dcp-meta__row{
    display:flex;align-items:center;justify-content:space-between;gap:12px;
    padding:11px 14px;border-radius:var(--r-sm);background:var(--surface-3);
    border:1px solid transparent;transition:var(--t);
}
.dcp-meta__row:hover{background:var(--brand-tint);border-color:var(--brand-tint-2);}
.dcp-meta__k{display:flex;align-items:center;gap:10px;font-size:.85rem;color:var(--ink-2);}
.dcp-meta__k i{color:var(--brand);font-size:.88rem;width:17px;text-align:center;}
.dcp[data-theme="dark"] .dcp-meta__k i{color:var(--brand-light);}
.dcp-meta__v{font-size:1rem;font-weight:750;letter-spacing:-.02em;font-variant-numeric:tabular-nums;}
.dcp-meta__v--brand{color:var(--brand);}
.dcp[data-theme="dark"] .dcp-meta__v--brand{color:var(--brand-light);}

/* publish-rate ring */
.dcp-rate{display:flex;align-items:center;gap:18px;padding:4px 0 18px;flex-wrap:wrap;}
.dcp-rate__ring{
    width:86px;height:86px;flex:0 0 86px;border-radius:50%;display:grid;place-items:center;
    background:conic-gradient(var(--brand) calc(var(--p) * 1%),var(--surface-3) 0);
    position:relative;
}
.dcp-rate__ring::after{
    content:'';position:absolute;inset:9px;border-radius:50%;background:var(--surface);
}
.dcp-rate__num{position:relative;z-index:1;font-size:1.2rem;font-weight:800;letter-spacing:-.03em;}
.dcp-rate__txt{font-size:.82rem;color:var(--ink-2);line-height:1.5;}
.dcp-rate__txt strong{display:block;font-size:.9rem;color:var(--ink);margin-bottom:3px;}

/* ---------- Activity chart ---------- */
.dcp-chart{
    display:flex;align-items:flex-end;gap:12px;height:190px;
    padding:26px 6px 34px;background:var(--surface-3);border-radius:var(--r-md);
    overflow-x:auto;
    -webkit-overflow-scrolling:touch;
}
.dcp-chart__col{flex:1;display:flex;flex-direction:column;justify-content:flex-end;align-items:center;height:100%;position:relative;min-width:30px;}
.dcp-chart__bar{
    width:100%;max-width:56px;border-radius:8px 8px 3px 3px;background:var(--brand-grad);
    transition:var(--t);animation:dcpRise .75s cubic-bezier(.2,.7,.2,1) both;
    box-shadow:0 -4px 14px -6px rgba(157,54,38,.6);
}
.dcp-chart__col:hover .dcp-chart__bar{filter:brightness(1.12);transform:translateY(-3px);}
.dcp-chart__v{
    position:absolute;top:-22px;font-size:.74rem;font-weight:700;color:var(--ink-2);
    font-variant-numeric:tabular-nums;
}
.dcp-chart__l{
    position:absolute;bottom:-24px;font-size:.71rem;font-weight:600;color:var(--ink-3);
    letter-spacing:.03em;text-transform:uppercase;white-space:nowrap;
}

/* ---------- Quick actions ---------- */
.dcp-quick{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.dcp-quick a{
    display:flex;flex-direction:column;align-items:flex-start;gap:8px;
    padding:14px 15px;border-radius:var(--r-sm);text-decoration:none;
    background:var(--surface-3);border:1px solid transparent;transition:var(--t);
}
.dcp-quick a:hover{background:var(--brand-tint);border-color:var(--brand-tint-2);transform:translateY(-2px);}
.dcp-quick i{color:var(--brand);font-size:.95rem;}
.dcp[data-theme="dark"] .dcp-quick i{color:var(--brand-light);}
.dcp-quick span{font-size:.83rem;font-weight:600;color:var(--ink);}

/* ---------- Alert / empty ---------- */
.dcp-alert{
    display:flex;align-items:center;gap:12px;padding:14px 18px;margin-bottom:18px;
    border-radius:var(--r-md);border:1px solid rgba(220,38,38,.28);background:rgba(220,38,38,.07);
    color:#7f1d1d;font-size:.87rem;font-weight:500;
}
.dcp-alert__icon{width:30px;height:30px;flex:0 0 30px;border-radius:9px;display:grid;place-items:center;background:var(--danger);color:#fff;font-size:.8rem;}
.dcp[data-theme="dark"] .dcp-alert{color:#fecaca;}

.dcp-empty{padding:56px 26px;text-align:center;}
.dcp-empty__art{
    width:74px;height:74px;margin:0 auto 18px;border-radius:23px;display:grid;place-items:center;
    font-size:1.8rem;color:var(--brand);background:var(--brand-tint);border:1px solid var(--brand-tint-2);
}
.dcp-empty h4{margin:0 0 8px;font-size:1.12rem;font-weight:750;letter-spacing:-.02em;}
.dcp-empty p{margin:0 auto 22px;max-width:380px;color:var(--ink-2);font-size:.88rem;line-height:1.6;}

/* ---------- Animations ---------- */
@keyframes dcpIn{from{opacity:0;transform:translateY(16px);}to{opacity:1;transform:none;}}
@keyframes dcpPulse{0%{box-shadow:0 0 0 0 rgba(22,163,74,.5);}70%{box-shadow:0 0 0 7px rgba(22,163,74,0);}100%{box-shadow:0 0 0 0 rgba(22,163,74,0);}}
@keyframes dcpGrow{from{transform:scaleX(0);}to{transform:scaleX(1);}}
@keyframes dcpRise{from{height:0 !important;opacity:0;}to{opacity:1;}}
@media (prefers-reduced-motion:reduce){.dcp *,.dcp *::before{animation:none !important;transition:none !important;}}

/* ---------- RESPONSIVE ---------- */
@media (max-width:1200px){
    .dcp-metrics{grid-template-columns:repeat(2,1fr);}
    .dcp-grid{grid-template-columns:1fr;}
    .dcp-tlink{max-width:none;white-space:normal;}
}
@media (max-width:820px){
    .dcp{padding:18px 16px 40px;}
    
    /* Table card view on mobile */
    .dcp-table thead{display:none;}
    .dcp-table,.dcp-table tbody,.dcp-table tr,.dcp-table td{display:block;width:100%;}
    .dcp-table{min-width:unset;table-layout:auto;}
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
    .dcp-tlink{white-space:normal;font-size:.93rem;line-height:1.35;}
    .dcp-tsub{white-space:normal;}
}
@media (max-width:600px){
    .dcp{padding:14px 10px 32px;}
    .dcp-metrics{grid-template-columns:1fr 1fr;gap:10px;}
    .dcp-metric{padding:15px 16px;}
    .dcp-metric__value{font-size:1.5rem;}
    .dcp-metric__head{margin-bottom:10px;}
    .dcp-title{font-size:1.35rem;}
    .dcp-top__right{width:100%;}
    .dcp-top__right .dcp-btn:not(.dcp-btn--icon){flex:1;}
    .dcp-chart{gap:7px;height:160px;padding:20px 4px 30px;}
    .dcp-quick{grid-template-columns:1fr;}
    .dcp-card__head{padding:12px 16px;}
    .dcp-card__body{padding:14px 16px;}
    .dcp-rate{flex-direction:column;align-items:center;text-align:center;}
}
@media (max-width:400px){
    .dcp-metrics{grid-template-columns:1fr;gap:8px;}
    .dcp-metric{padding:12px 14px;}
    .dcp-metric__value{font-size:1.3rem;}
}
</style>

<div class="dcp" id="dcp" data-theme="light">
<div class="dcp__wrap">

    <!-- ============ TOP BAR ============ -->
    <header class="dcp-top">
        <div>
            <nav class="dcp-crumb">
                <span>Doric Multimedia</span>
                <i class="fas fa-chevron-right"></i>
                <span>Admin</span>
            </nav>
            <h1 class="dcp-title">
                <span class="glyph"><i class="fas fa-chart-pie"></i></span>
                Dashboard
            </h1>
           <p class="dcp-sub">
    <span class="live"></span>
    Welcome back — here’s the latest from the blog.
</p>
        </div>
        <div class="dcp-top__right">
            <button type="button" class="dcp-btn dcp-btn--ghost dcp-btn--icon" id="dcpTheme" title="Toggle theme" aria-label="Toggle theme">
                <i class="fas fa-moon"></i>
            </button>
            <a href="/blog.php" target="_blank" rel="noopener" class="dcp-btn dcp-btn--ghost">
                <i class="fas fa-arrow-up-right-from-square"></i> View Blog
            </a>
            <a href="/admin/blogs/create.php" class="dcp-btn dcp-btn--primary">
                <i class="fas fa-plus"></i> New Post
            </a>
        </div>
    </header>

    <!-- ============ ERROR ============ -->
    <?php if ($dashboardError !== ''): ?>
        <div class="dcp-alert" role="alert">
            <span class="dcp-alert__icon"><i class="fas fa-triangle-exclamation"></i></span>
            <span><?php echo $esc($dashboardError); ?></span>
        </div>
    <?php endif; ?>

    <!-- ============ METRICS ============ -->
    <section class="dcp-metrics">
        <article class="dcp-metric dcp-metric--brand">
            <div class="dcp-metric__head">
                <span class="dcp-metric__label">Total Posts</span>
                <span class="dcp-metric__icon"><i class="fas fa-newspaper"></i></span>
            </div>
            <p class="dcp-metric__value"><?php echo number_format($stats['total_posts']); ?></p>
           <div class="dcp-metric__foot">
    <i class="fas fa-layer-group"></i> Content Overview
</div>
        </article>

        <article class="dcp-metric dcp-metric--ok">
            <div class="dcp-metric__head">
                <span class="dcp-metric__label">Published</span>
                <span class="dcp-metric__icon"><i class="fas fa-rocket"></i></span>
            </div>
            <p class="dcp-metric__value"><?php echo number_format($stats['published_posts']); ?></p>
            <div class="dcp-metric__foot"><i class="fas fa-circle-check"></i> Live on site</div>
        </article>

        <article class="dcp-metric dcp-metric--warn">
            <div class="dcp-metric__head">
                <span class="dcp-metric__label">Drafts</span>
                <span class="dcp-metric__icon"><i class="fas fa-pen-to-square"></i></span>
            </div>
            <p class="dcp-metric__value"><?php echo number_format($stats['draft_posts']); ?></p>
            <div class="dcp-metric__foot"><i class="fas fa-clock"></i> In progress</div>
        </article>

        <article class="dcp-metric dcp-metric--info">
            <div class="dcp-metric__head">
                <span class="dcp-metric__label">Categories</span>
                <span class="dcp-metric__icon"><i class="fas fa-tags"></i></span>
            </div>
            <p class="dcp-metric__value"><?php echo number_format($stats['categories_count']); ?></p>
            <div class="dcp-metric__foot"><i class="fas fa-folder-open"></i> Topics</div>
        </article>
    </section>

    <!-- ============ MAIN GRID ============ -->
    <section class="dcp-grid">

        <!-- ---------- LEFT ---------- -->
        <div>
            <!-- Recent posts -->
            <div class="dcp-card">
                <div class="dcp-card__head">
                    <h3><i class="fas fa-clock-rotate-left"></i> Recent Posts</h3>
                    <div style="display:flex;align-items:center;gap:9px;flex-wrap:wrap;">
                        <span class="dcp-chip dcp-chip--live">
                            <span class="dot"></span><?php echo number_format($stats['published_posts']); ?> published
                        </span>
                        <a href="/admin/blogs/index.php" class="dcp-btn dcp-btn--ghost dcp-btn--sm">
                            View all <i class="fas fa-arrow-right" style="font-size:.7rem;"></i>
                        </a>
                    </div>
                </div>

                <?php if (!empty($recentPosts)): ?>
                    <div class="dcp-tablewrap">
                        <table class="dcp-table">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Updated</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($recentPosts as $post): ?>
                                    <?php
                                    $isPublished = strtolower((string) $post['status']) === 'published';
                                    $authorName = (string) ($post['author_name'] ?: 'Unknown');
                                    $initial = strtoupper(mb_substr(trim($authorName), 0, 1) ?: '?');
                                    ?>
                                    <tr>
                                        <td>
                                            <a class="dcp-tlink" href="/admin/blogs/edit.php?id=<?php echo (int) $post['id']; ?>">
                                                <?php echo $esc($post['title']); ?>
                                            </a>
                                            <span class="dcp-tsub">
                                                <span class="dcp-avatar"><?php echo $esc($initial); ?></span>
                                                <?php echo $esc($authorName); ?>
                                            </span>
                                        </td>
                                        <td data-label="Category">
                                            <span class="dcp-chip dcp-chip--cat">
                                                <?php echo $esc($post['category_name'] ?: 'Uncategorized'); ?>
                                            </span>
                                        </td>
                                        <td data-label="Status">
                                            <span class="dcp-chip <?php echo $isPublished ? 'dcp-chip--live' : 'dcp-chip--draft'; ?>">
                                                <span class="dot"></span><?php echo $isPublished ? 'Published' : 'Draft'; ?>
                                            </span>
                                        </td>
                                        <td data-label="Updated">
                                            <span class="dcp-when"><?php echo $esc($relTime($post['updated_at'] ?? null)); ?></span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="dcp-empty">
                        <div class="dcp-empty__art"><i class="fas fa-feather-pointed"></i></div>
                        <h4>Abhi koi post nahi hai</h4>
                        <p>Apna pehla article publish karo aur Doric blog section live ho jayega.</p>
                        <a href="/admin/blogs/create.php" class="dcp-btn dcp-btn--primary">
                            <i class="fas fa-plus"></i> Create Your First Blog
                        </a>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Activity chart -->
            <?php if (!empty($monthlyPosts) && count($monthlyPosts) > 1): ?>
                <?php
                $counts = array_map('intval', array_column($monthlyPosts, 'count'));
                $maxCount = max($counts) > 0 ? max($counts) : 1;
                ?>
                <div class="dcp-card">
                    <div class="dcp-card__head">
                        <h3><i class="fas fa-chart-column"></i> Post Activity</h3>
                        <span class="dcp-chip"><i class="fas fa-calendar" style="font-size:.62rem;"></i> Last 6 months</span>
                    </div>
                    <div class="dcp-card__body">
                        <div class="dcp-chart">
                            <?php $barIndex = 0; foreach ($monthlyPosts as $data): ?>
                                <?php
                                $count = (int) $data['count'];
                                $heightPct = max(6, (int) round(($count / $maxCount) * 100));
                                $monthLabel = date('M', strtotime((string) $data['month'] . '-01'));
                                $delay = number_format($barIndex * 0.07, 2, '.', '');
                                $barIndex++;
                                ?>
                                <div class="dcp-chart__col">
                                    <span class="dcp-chart__v"><?php echo $count; ?></span>
                                    <span class="dcp-chart__bar"
                                          style="height:<?php echo $heightPct; ?>%;animation-delay:<?php echo $delay; ?>s;"></span>
                                    <span class="dcp-chart__l"><?php echo $esc($monthLabel); ?></span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- ---------- RIGHT ---------- -->
        <aside>
            <!-- Quick summary -->
            <div class="dcp-card">
                <div class="dcp-card__head">
                    <h3><i class="fas fa-gauge-high"></i> Quick Summary</h3>
                </div>
                <div class="dcp-card__body">
                    <div class="dcp-rate">
                        <div class="dcp-rate__ring" style="--p:<?php echo $publishRate; ?>;">
                            <span class="dcp-rate__num"><?php echo $publishRate; ?>%</span>
                        </div>
                        <div class="dcp-rate__txt">
                            <strong>Publish rate</strong>
                            <?php echo number_format($stats['published_posts']); ?> of
                            <?php echo number_format($stats['total_posts']); ?> posts live hain.
                            <?php if ($stats['draft_posts'] > 0): ?>
                                <?php echo number_format($stats['draft_posts']); ?> draft pending.
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="dcp-meta">
                        <?php if ($hasViews): ?>
                            <div class="dcp-meta__row">
                                <span class="dcp-meta__k"><i class="fas fa-eye"></i> Total Views</span>
                                <span class="dcp-meta__v dcp-meta__v--brand"><?php echo number_format($stats['total_views']); ?></span>
                            </div>
                        <?php endif; ?>
                        <div class="dcp-meta__row">
                            <span class="dcp-meta__k"><i class="fas fa-calendar-day"></i> Last 30 days</span>
                            <span class="dcp-meta__v"><?php echo number_format($stats['last30']); ?></span>
                        </div>
                        <div class="dcp-meta__row">
                            <span class="dcp-meta__k"><i class="fas fa-pen-to-square"></i> Pending drafts</span>
                            <span class="dcp-meta__v"><?php echo number_format($stats['draft_posts']); ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Category distribution -->
            <?php if (!empty($categoryStats)): ?>
                <div class="dcp-card">
                    <div class="dcp-card__head">
                        <h3><i class="fas fa-chart-simple"></i> Top Categories</h3>
                        <span class="dcp-chip">Published</span>
                    </div>
                    <div class="dcp-card__body">
                        <div class="dcp-dist">
                            <?php $distIndex = 0; foreach ($categoryStats as $cat): ?>
                                <?php
                                $count = (int) $cat['count'];
                                $width = $maxCategoryCount > 0 ? (int) round(($count / $maxCategoryCount) * 100) : 0;
                                $delay = number_format($distIndex * 0.08, 2, '.', '');
                                $distIndex++;
                                ?>
                                <div class="dcp-dist__row">
                                    <div class="dcp-dist__top">
                                        <span class="dcp-dist__name"><?php echo $esc($cat['name']); ?></span>
                                        <span class="dcp-dist__num"><?php echo $count; ?></span>
                                    </div>
                                    <div class="dcp-dist__track">
                                        <span class="dcp-dist__fill"
                                              style="width:<?php echo max(2, $width); ?>%;animation-delay:<?php echo $delay; ?>s;"></span>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Quick actions -->
            <div class="dcp-card">
                <div class="dcp-card__head">
                    <h3><i class="fas fa-bolt"></i> Quick Actions</h3>
                </div>
                <div class="dcp-card__body">
                    <div class="dcp-quick">
                        <a href="/admin/blogs/create.php">
                            <i class="fas fa-plus"></i><span>New Post</span>
                        </a>
                        <a href="/admin/blogs/index.php">
                            <i class="fas fa-list-ul"></i><span>All Posts</span>
                        </a>
                        <a href="/admin/categories/">
                            <i class="fas fa-tags"></i><span>Categories</span>
                        </a>
                        <a href="/admin/blogs/index.php?status=draft">
                            <i class="fas fa-pen-to-square"></i><span>Drafts</span>
                        </a>
                    </div>
                </div>
            </div>
        </aside>
    </section>
</div>
</div>

<script>
(function () {
    'use strict';
    var root = document.getElementById('dcp');
    if (!root) { return; }

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
}());
</script>

<?php require __DIR__ . '/includes/footer.php'; ?>