<?php
/* ==========================================================================
   DORIC ADMIN — HEADER
   Shell open karta hai: .admin-shell > .admin-main > topbar
   footer.php inhe close karta hai (class names purane hi rakhe hain).
   ========================================================================== */
startSecureSession();

$adminName  = $_SESSION['admin_name'] ?? 'Admin';
$adminEmail = $_SESSION['admin_email'] ?? 'admin@doricmultimedia.com';
$adminRole  = $_SESSION['admin_role'] ?? 'Administrator';

/* initials — mb_* use kar rahe hain taki non-ASCII naam na toote */
$nameParts = preg_split('/\s+/', trim((string) $adminName), -1, PREG_SPLIT_NO_EMPTY) ?: [];
$adminInitials = 'A';
if (!empty($nameParts)) {
    $adminInitials = mb_strtoupper(mb_substr($nameParts[0], 0, 1));
    if (isset($nameParts[1])) {
        $adminInitials .= mb_strtoupper(mb_substr($nameParts[1], 0, 1));
    }
}

$hdrTitle = $pageTitle ?? 'Dashboard';
$hdrEyebrow = $pageEyebrow ?? 'Operations';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($hdrTitle, ENT_QUOTES, 'UTF-8'); ?> | Doric Multimedia</title>
    <meta name="description" content="Doric Multimedia admin dashboard for managing business blog content.">
    <meta name="robots" content="noindex, nofollow">
    <meta name="theme-color" content="#9d3626">
    <link rel="icon" href="/images/dmpl_logo.png">

    <!-- theme ko paint se pehle set karo — dark mode me flash na ho -->
    <script>
    (function () {
        var mode = 'light';
        try {
            mode = localStorage.getItem('doric-admin-theme')
                || (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
        } catch (err) {}
        document.documentElement.setAttribute('data-dsb-theme', mode);
    }());
    </script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="/admin/assets/css/admin.css">

<style>
/* ==========================================================================
   SHELL + TOPBAR — brand #9d3626
   ========================================================================== */
:root{
    --hdr-brand:#9d3626;
    --hdr-brand-light:#c2543f;
    --hdr-grad:linear-gradient(135deg,#b8412d 0%,#9d3626 45%,#6f2418 100%);
    --hdr-t:220ms cubic-bezier(.4,0,.2,1);

    --hdr-bg:#f6f7f9;
    --hdr-surface:#ffffff;
    --hdr-surface-2:#fbfbfc;
    --hdr-surface-3:#f1f3f7;
    --hdr-ink:#10161f;
    --hdr-ink-2:#495468;
    --hdr-ink-3:#8b97a8;
    --hdr-line:rgba(16,22,31,.09);
    --hdr-hover:rgba(157,54,38,.07);
    --hdr-hover-2:rgba(157,54,38,.14);
    --hdr-danger:#dc2626;
    --hdr-glass:rgba(255,255,255,.82);
}
html[data-dsb-theme="dark"]{
    --hdr-bg:#0b0e14;
    --hdr-surface:#141922;
    --hdr-surface-2:#171d27;
    --hdr-surface-3:#1e2531;
    --hdr-ink:#eef2f8;
    --hdr-ink-2:#a7b2c4;
    --hdr-ink-3:#6f7d92;
    --hdr-line:rgba(255,255,255,.09);
    --hdr-hover:rgba(194,84,63,.16);
    --hdr-hover-2:rgba(194,84,63,.26);
    --hdr-danger:#f87171;
    --hdr-glass:rgba(16,21,29,.8);
}

.admin-body{
    margin:0;background:var(--hdr-bg);color:var(--hdr-ink);
    font-family:'Inter',-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,sans-serif;
    -webkit-font-smoothing:antialiased;
}
.admin-shell{min-height:100vh;}
.admin-main{min-width:0;display:flex;flex-direction:column;}

/* sidebar.php apna floating burger deta hai — hum topbar ka use kar rahe hain */
.dsb-burger{display:none !important;}

/* ---------- Topbar ---------- */
.topbar{
    position:sticky;top:0;z-index:820;
    display:flex;align-items:center;justify-content:space-between;gap:18px;
    padding:13px 28px;
    background:var(--hdr-glass);
    -webkit-backdrop-filter:saturate(180%) blur(14px);
    backdrop-filter:saturate(180%) blur(14px);
    border-bottom:1px solid var(--hdr-line);
}
.topbar-left{display:flex;align-items:center;gap:14px;min-width:0;}
.topbar-right{display:flex;align-items:center;gap:10px;}

.eyebrow{
    margin:0;font-size:.68rem;font-weight:700;letter-spacing:.1em;
    text-transform:uppercase;color:var(--hdr-ink-3);
}
.page-title{
    margin:2px 0 0;font-size:1.22rem;font-weight:800;letter-spacing:-.03em;
    line-height:1.15;color:var(--hdr-ink);
    overflow:hidden;text-overflow:ellipsis;white-space:nowrap;max-width:44vw;
}

/* icon buttons */
.topbar-icon,.mobile-sidebar-toggle{
    position:relative;
    display:inline-flex;align-items:center;justify-content:center;
    width:40px;height:40px;flex:0 0 40px;border-radius:12px;
    background:var(--hdr-surface);border:1px solid var(--hdr-line);
    color:var(--hdr-ink-2);font-size:.9rem;cursor:pointer;
    transition:var(--hdr-t);text-decoration:none;
}
.topbar-icon:hover,.mobile-sidebar-toggle:hover{
    color:var(--hdr-brand);border-color:var(--hdr-hover-2);
    background:var(--hdr-hover);transform:translateY(-1px);
}
html[data-dsb-theme="dark"] .topbar-icon:hover,
html[data-dsb-theme="dark"] .mobile-sidebar-toggle:hover{color:var(--hdr-brand-light);}
.topbar-icon:focus-visible,.mobile-sidebar-toggle:focus-visible{
    outline:none;box-shadow:0 0 0 4px var(--hdr-hover-2);
}
.mobile-sidebar-toggle{display:none;}

.topbar-icon .badge-dot{
    position:absolute;top:8px;right:9px;
    min-width:16px;height:16px;padding:0 4px;border-radius:99px;
    display:grid;place-items:center;
    background:var(--hdr-brand);color:#fff;
    font-size:.6rem;font-weight:700;line-height:1;
    border:2px solid var(--hdr-surface);
}

/* quick search */
.topbar-search{
    display:flex;align-items:center;width:250px;
    background:var(--hdr-surface);border:1px solid var(--hdr-line);
    border-radius:12px;overflow:hidden;transition:var(--hdr-t);
}
.topbar-search:focus-within{border-color:var(--hdr-brand-light);box-shadow:0 0 0 4px var(--hdr-hover-2);}
.topbar-search i{padding:0 5px 0 13px;color:var(--hdr-ink-3);font-size:.8rem;}
.topbar-search input{
    flex:1;min-width:0;border:0;outline:none;background:transparent;
    padding:10px 6px;font-family:inherit;font-size:.85rem;color:var(--hdr-ink);
}
.topbar-search input::placeholder{color:var(--hdr-ink-3);}
.topbar-search kbd{
    margin-right:9px;padding:2px 6px;border-radius:6px;
    background:var(--hdr-surface-3);border:1px solid var(--hdr-line);
    font-family:inherit;font-size:.66rem;font-weight:600;color:var(--hdr-ink-3);
}

/* user chip + dropdown */
.admin-user-chip{
    position:relative;
    display:flex;align-items:center;gap:11px;
    padding:6px 13px 6px 7px;border-radius:999px;
    background:var(--hdr-surface);border:1px solid var(--hdr-line);
    cursor:pointer;transition:var(--hdr-t);
}
.admin-user-chip:hover{border-color:var(--hdr-hover-2);background:var(--hdr-hover);}
.admin-user-chip:focus-visible{outline:none;box-shadow:0 0 0 4px var(--hdr-hover-2);}
.user-avatar{
    width:34px;height:34px;flex:0 0 34px;border-radius:50%;
    display:grid;place-items:center;
    background:var(--hdr-grad);color:#fff;
    font-size:.76rem;font-weight:700;letter-spacing:.02em;
    box-shadow:0 6px 14px -8px rgba(157,54,38,.8);
}
.user-meta{min-width:0;text-align:left;line-height:1.25;}
.user-meta strong{
    display:block;font-size:.83rem;font-weight:650;color:var(--hdr-ink);
    letter-spacing:-.01em;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;max-width:150px;
}
.user-meta span{
    display:block;font-size:.71rem;color:var(--hdr-ink-3);
    overflow:hidden;text-overflow:ellipsis;white-space:nowrap;max-width:150px;
}
.admin-user-chip .caret{font-size:.62rem;color:var(--hdr-ink-3);transition:var(--hdr-t);}
.admin-user-chip[aria-expanded="true"] .caret{transform:rotate(180deg);}

.user-menu{
    position:absolute;top:calc(100% + 10px);right:0;z-index:830;
    min-width:230px;padding:7px;
    background:var(--hdr-surface);border:1px solid var(--hdr-line);
    border-radius:16px;box-shadow:0 24px 50px -20px rgba(16,22,31,.35);
    opacity:0;visibility:hidden;transform:translateY(-8px);
    transition:var(--hdr-t);
}
.user-menu.is-open{opacity:1;visibility:visible;transform:none;}
.user-menu__head{padding:11px 13px 12px;border-bottom:1px solid var(--hdr-line);margin-bottom:6px;}
.user-menu__head strong{display:block;font-size:.87rem;font-weight:700;letter-spacing:-.01em;color:var(--hdr-ink);}
.user-menu__head span{display:block;font-size:.73rem;color:var(--hdr-ink-3);margin-top:2px;word-break:break-all;}
.user-menu__role{
    display:inline-flex;align-items:center;gap:5px;margin-top:8px;
    padding:3px 10px;border-radius:999px;
    font-size:.66rem;font-weight:700;letter-spacing:.04em;text-transform:uppercase;
    background:var(--hdr-hover);color:var(--hdr-brand);border:1px solid var(--hdr-hover-2);
}
html[data-dsb-theme="dark"] .user-menu__role{color:var(--hdr-brand-light);}
.user-menu a,.user-menu button{
    display:flex;align-items:center;gap:11px;width:100%;
    padding:10px 13px;border-radius:11px;
    font-family:inherit;font-size:.85rem;font-weight:550;
    color:var(--hdr-ink-2);text-decoration:none;
    background:transparent;border:0;cursor:pointer;text-align:left;
    transition:var(--hdr-t);
}
.user-menu a i,.user-menu button i{width:17px;text-align:center;font-size:.85rem;color:var(--hdr-ink-3);transition:var(--hdr-t);}
.user-menu a:hover,.user-menu button:hover{background:var(--hdr-hover);color:var(--hdr-brand);}
.user-menu a:hover i,.user-menu button:hover i{color:var(--hdr-brand);}
html[data-dsb-theme="dark"] .user-menu a:hover,
html[data-dsb-theme="dark"] .user-menu button:hover{color:var(--hdr-brand-light);}
.user-menu a:hover i{color:inherit;}
.user-menu__sep{height:1px;background:var(--hdr-line);margin:6px 4px;}
.user-menu a.danger:hover{background:rgba(220,38,38,.09);color:var(--hdr-danger);}
.user-menu a.danger:hover i{color:var(--hdr-danger);}

/* ---------- Responsive ---------- */
@media (max-width:1024px){
    .mobile-sidebar-toggle{display:inline-flex;}
    .topbar{padding:11px 16px;}
    .page-title{max-width:38vw;}
}
@media (max-width:900px){
    .topbar-search{display:none;}
}
@media (max-width:700px){
    .user-meta{display:none;}
    .admin-user-chip{padding:5px;gap:0;}
    .admin-user-chip .caret{display:none;}
}
@media (max-width:600px){
    .topbar{padding:10px 12px;gap:10px;}
    .eyebrow{font-size:.62rem;}
    .page-title{font-size:1.05rem;max-width:42vw;}
    .topbar-right{gap:7px;}
    .topbar-icon,.mobile-sidebar-toggle{width:37px;height:37px;flex:0 0 37px;}
}
@media (prefers-reduced-motion:reduce){
    .topbar *,.user-menu{transition:none !important;}
}
@media print{
    .topbar{display:none !important;}
}
</style>
</head>
<body class="admin-body">
    <div class="admin-shell">
        <?php require __DIR__ . '/sidebar.php'; ?>

        <div class="admin-main">
            <header class="topbar">
                <div class="topbar-left">
                    <button class="mobile-sidebar-toggle" type="button" id="hdrSidebarToggle"
                            aria-label="Toggle sidebar" aria-controls="sidebar" aria-expanded="false">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                    <div>
                        <p class="eyebrow"><?php echo htmlspecialchars($hdrEyebrow, ENT_QUOTES, 'UTF-8'); ?></p>
                        <h1 class="page-title"><?php echo htmlspecialchars($hdrTitle, ENT_QUOTES, 'UTF-8'); ?></h1>
                    </div>
                </div>

                <div class="topbar-right">
                    <form class="topbar-search" method="GET" action="/admin/blogs/index.php" role="search">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" name="search" placeholder="Posts search karo…"
                               autocomplete="off" aria-label="Search posts" id="hdrSearch">
                        <kbd>/</kbd>
                    </form>

                    <button class="topbar-icon" type="button" id="hdrTheme"
                            aria-label="Toggle dark mode" title="Toggle dark mode">
                        <i class="fa-solid fa-moon"></i>
                    </button>

                    <a class="topbar-icon" href="/blog.php" target="_blank" rel="noopener"
                       aria-label="View live blog" title="View live blog">
                        <i class="fa-solid fa-arrow-up-right-from-square"></i>
                    </a>

                    <button class="topbar-icon" type="button" aria-label="Notifications" title="Notifications">
                        <i class="fa-regular fa-bell"></i>
                        <span class="badge-dot">0</span>
                    </button>

                    <div class="admin-user-chip" role="button" tabindex="0" id="hdrUserChip"
                         aria-haspopup="true" aria-expanded="false">
                        <div class="user-avatar"><?php echo htmlspecialchars($adminInitials, ENT_QUOTES, 'UTF-8'); ?></div>
                        <div class="user-meta">
                            <strong><?php echo htmlspecialchars($adminName, ENT_QUOTES, 'UTF-8'); ?></strong>
                            <span><?php echo htmlspecialchars($adminEmail, ENT_QUOTES, 'UTF-8'); ?></span>
                        </div>
                        <i class="fa-solid fa-chevron-down caret"></i>

                        <div class="user-menu" id="hdrUserMenu" role="menu">
                            <div class="user-menu__head">
                                <strong><?php echo htmlspecialchars($adminName, ENT_QUOTES, 'UTF-8'); ?></strong>
                                <span><?php echo htmlspecialchars($adminEmail, ENT_QUOTES, 'UTF-8'); ?></span>
                                <span class="user-menu__role">
                                    <i class="fa-solid fa-shield-halved" style="font-size:.6rem;"></i>
                                    <?php echo htmlspecialchars($adminRole, ENT_QUOTES, 'UTF-8'); ?>
                                </span>
                            </div>
                            <a href="/admin/dashboard.php" role="menuitem"><i class="fa-solid fa-gauge-high"></i> Dashboard</a>
                            <a href="/admin/blogs/create.php" role="menuitem"><i class="fa-regular fa-square-plus"></i> New Post</a>
                            <a href="/admin/blogs/index.php?status=draft" role="menuitem"><i class="fa-regular fa-pen-to-square"></i> My Drafts</a>
                            <div class="user-menu__sep"></div>
                            <a href="/admin/logout.php" class="danger" role="menuitem"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
                        </div>
                    </div>
                </div>
            </header>

<script>
(function () {
    'use strict';
    var THEME_KEY = 'doric-admin-theme';
    var html = document.documentElement;

    /* ---------- theme (global) ---------- */
    var themeBtn = document.getElementById('hdrTheme');

    function applyTheme(mode) {
        html.setAttribute('data-dsb-theme', mode);
        var page = document.getElementById('dcp');
        if (page) { page.setAttribute('data-theme', mode); }
        if (themeBtn) {
            themeBtn.innerHTML = mode === 'dark'
                ? '<i class="fa-solid fa-sun"></i>'
                : '<i class="fa-solid fa-moon"></i>';
        }
    }

    applyTheme(html.getAttribute('data-dsb-theme') || 'light');

    if (themeBtn) {
        themeBtn.addEventListener('click', function () {
            var next = html.getAttribute('data-dsb-theme') === 'dark' ? 'light' : 'dark';
            applyTheme(next);
            try { localStorage.setItem(THEME_KEY, next); } catch (err) {}
        });
    }

    /* page ka .dcp wrapper header ke baad render hota hai — theme apply kar do */
    document.addEventListener('DOMContentLoaded', function () {
        applyTheme(html.getAttribute('data-dsb-theme') || 'light');
    });

    /* ---------- sidebar toggle (sidebar.php ka logic reuse) ---------- */
    var toggle = document.getElementById('hdrSidebarToggle');
    if (toggle) {
        toggle.addEventListener('click', function () {
            var sidebarBurger = document.getElementById('dsbBurger');
            if (sidebarBurger) {
                sidebarBurger.click();
                var open = document.getElementById('sidebar').classList.contains('is-open');
                toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
                toggle.innerHTML = open ? '<i class="fa-solid fa-xmark"></i>' : '<i class="fa-solid fa-bars"></i>';
            }
        });
    }

    /* ---------- user dropdown ---------- */
    var chip = document.getElementById('hdrUserChip');
    var menu = document.getElementById('hdrUserMenu');

    if (chip && menu) {
        var setMenu = function (open) {
            menu.classList.toggle('is-open', open);
            chip.setAttribute('aria-expanded', open ? 'true' : 'false');
        };

        chip.addEventListener('click', function (ev) {
            if (ev.target.closest('.user-menu')) { return; }
            setMenu(!menu.classList.contains('is-open'));
        });
        chip.addEventListener('keydown', function (ev) {
            if (ev.key === 'Enter' || ev.key === ' ') {
                ev.preventDefault();
                setMenu(!menu.classList.contains('is-open'));
            }
        });
        document.addEventListener('click', function (ev) {
            if (!chip.contains(ev.target)) { setMenu(false); }
        });
        document.addEventListener('keydown', function (ev) {
            if (ev.key === 'Escape') { setMenu(false); }
        });
    }

    /* ---------- "/" se search focus ---------- */
    document.addEventListener('keydown', function (ev) {
        var tag = document.activeElement ? document.activeElement.tagName : '';
        if (ev.key === '/' && tag !== 'INPUT' && tag !== 'TEXTAREA' && !document.activeElement.isContentEditable) {
            var input = document.getElementById('hdrSearch');
            if (input && input.offsetParent !== null) { ev.preventDefault(); input.focus(); }
        }
    });
}());
</script>
