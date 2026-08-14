<?php
/* ==========================================================================
   DORIC ADMIN — SIDEBAR
   header.php me include karo. Self-contained hai (CSS + JS andar hi).
   ========================================================================== */

/* Active state ke liye poora path dekh rahe hain, sirf filename nahi —
   isse /admin/blogs/edit.php par bhi "Blog Posts" highlight hota hai. */
$dsbPath = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH) ?: '';
$dsbPath = rtrim($dsbPath, '/');
if ($dsbPath === '' || substr($dsbPath, -1) === '/') {
    $dsbPath .= '/index.php';
}

/** @return string 'active' ya '' */
$dsbActive = static function (array $patterns) use ($dsbPath): string {
    foreach ($patterns as $pattern) {
        if (substr($pattern, -1) === '*') {
            if (strpos($dsbPath, rtrim($pattern, '*')) === 0) {
                return 'active';
            }
        } elseif ($dsbPath === $pattern) {
            return 'active';
        }
    }
    return '';
};

$isCreate  = $dsbActive(['/admin/blogs/create.php']);
$isEdit    = $dsbActive(['/admin/blogs/edit.php', '/admin/blogs/view.php']);
$isList    = $dsbActive(['/admin/blogs/index.php']) ?: $isEdit;   // edit/view bhi Blog Posts ke andar
$isDash    = $dsbActive(['/admin/dashboard.php', '/admin/index.php']);
$isCats    = $dsbActive(['/admin/categories*']);
?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
/* ==========================================================================
   SIDEBAR — brand #9d3626, same tokens as dashboard / blogs pages
   ========================================================================== */
:root{
    --dsb-w:266px;
    --dsb-brand:#9d3626;
    --dsb-brand-light:#c2543f;
    --dsb-grad:linear-gradient(135deg,#b8412d 0%,#9d3626 45%,#6f2418 100%);
    --dsb-t:220ms cubic-bezier(.4,0,.2,1);
}

/* light (default) */
.dsb{
    --dsb-bg:#ffffff;
    --dsb-bg-2:#fbfbfc;
    --dsb-ink:#10161f;
    --dsb-ink-2:#495468;
    --dsb-ink-3:#8b97a8;
    --dsb-line:rgba(16,22,31,.09);
    --dsb-hover:rgba(157,54,38,.07);
    --dsb-hover-2:rgba(157,54,38,.14);
    --dsb-danger:#dc2626;
}
/* dark — page ke theme toggle ke saath sync hota hai */
html[data-dsb-theme="dark"] .dsb,
.dsb[data-theme="dark"]{
    --dsb-bg:#101520;
    --dsb-bg-2:#141a25;
    --dsb-ink:#eef2f8;
    --dsb-ink-2:#a7b2c4;
    --dsb-ink-3:#6f7d92;
    --dsb-line:rgba(255,255,255,.08);
    --dsb-hover:rgba(194,84,63,.16);
    --dsb-hover-2:rgba(194,84,63,.26);
    --dsb-danger:#f87171;
}

.dsb *,.dsb *::before,.dsb *::after{box-sizing:border-box;}

/* ---------- shell ---------- */
.dsb{
    position:fixed;top:0;left:0;bottom:0;z-index:900;
    width:var(--dsb-w);
    display:flex;flex-direction:column;
    background:var(--dsb-bg);
    border-right:1px solid var(--dsb-line);
    font-family:'Inter',-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,sans-serif;
    -webkit-font-smoothing:antialiased;
    transition:transform var(--dsb-t);
}
/* content ko sidebar ke neeche na aane do */
body{padding-left:var(--dsb-w);margin:0;transition:padding-left var(--dsb-t);}

/* ---------- brand ---------- */
.dsb__brand{
    display:flex;align-items:center;gap:13px;
    padding:20px 20px 18px;
    border-bottom:1px solid var(--dsb-line);
    background:linear-gradient(180deg,var(--dsb-bg-2),var(--dsb-bg));
    position:relative;
}
.dsb__brand::after{
    content:'';position:absolute;left:20px;right:20px;bottom:-1px;height:2px;
    background:var(--dsb-grad);border-radius:2px;opacity:.9;
}
.dsb__mark{
    width:44px;height:44px;flex:0 0 44px;border-radius:14px;
    display:grid;place-items:center;overflow:hidden;
    background:var(--dsb-grad);
    box-shadow:0 10px 22px -10px rgba(157,54,38,.75),inset 0 1px 0 rgba(255,255,255,.28);
}
.dsb__mark img{width:100%;height:100%;object-fit:contain;padding:7px;display:block;}
.dsb__name{
    display:block;font-size:1.06rem;font-weight:800;letter-spacing:-.03em;
    color:var(--dsb-ink);line-height:1.15;
}
.dsb__tag{
    display:block;font-size:.68rem;font-weight:600;letter-spacing:.07em;
    text-transform:uppercase;color:var(--dsb-ink-3);margin-top:3px;
}

/* ---------- nav ---------- */
.dsb__nav{
    flex:1;overflow-y:auto;overscroll-behavior:contain;
    padding:16px 12px 12px;
    display:flex;flex-direction:column;gap:2px;
}
.dsb__nav::-webkit-scrollbar{width:6px;}
.dsb__nav::-webkit-scrollbar-thumb{background:var(--dsb-line);border-radius:99px;}

.dsb__label{
    padding:16px 12px 7px;
    font-size:.66rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;
    color:var(--dsb-ink-3);
}
.dsb__label:first-child{padding-top:4px;}

.dsb__item{
    position:relative;display:flex;align-items:center;gap:12px;
    padding:11px 13px;border-radius:12px;
    font-size:.89rem;font-weight:550;letter-spacing:-.01em;
    color:var(--dsb-ink-2);text-decoration:none;
    border:1px solid transparent;
    transition:var(--dsb-t);
}
.dsb__item i{
    width:20px;flex:0 0 20px;text-align:center;font-size:.95rem;
    color:var(--dsb-ink-3);transition:var(--dsb-t);
}
.dsb__item span{flex:1;min-width:0;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;}

.dsb__item:hover{
    background:var(--dsb-hover);color:var(--dsb-brand);
    border-color:var(--dsb-hover-2);transform:translateX(2px);
}
.dsb__item:hover i{color:var(--dsb-brand);}
html[data-dsb-theme="dark"] .dsb__item:hover,
html[data-dsb-theme="dark"] .dsb__item:hover i{color:var(--dsb-brand-light);}

.dsb__item:focus-visible{
    outline:none;box-shadow:0 0 0 3px var(--dsb-hover-2);
}

/* active */
.dsb__item.active{
    background:var(--dsb-grad);color:#fff;border-color:transparent;
    box-shadow:0 12px 24px -12px rgba(157,54,38,.85),inset 0 1px 0 rgba(255,255,255,.2);
}
.dsb__item.active i{color:#fff;}
.dsb__item.active:hover{transform:none;color:#fff;}
.dsb__item.active::before{
    content:'';position:absolute;left:-12px;top:50%;transform:translateY(-50%);
    width:4px;height:22px;border-radius:0 4px 4px 0;background:var(--dsb-brand);
}
html[data-dsb-theme="dark"] .dsb__item.active::before{background:var(--dsb-brand-light);}

/* count / badge pill */
.dsb__pill{
    flex:0 0 auto;padding:2px 8px;border-radius:999px;
    font-size:.68rem;font-weight:700;font-variant-numeric:tabular-nums;
    background:var(--dsb-hover);color:var(--dsb-brand);
    border:1px solid var(--dsb-hover-2);
}
.dsb__item.active .dsb__pill{
    background:rgba(255,255,255,.22);color:#fff;border-color:rgba(255,255,255,.3);
}
html[data-dsb-theme="dark"] .dsb__pill{color:var(--dsb-brand-light);}

/* danger item */
.dsb__item.danger:hover{
    background:rgba(220,38,38,.08);color:var(--dsb-danger);border-color:rgba(220,38,38,.24);
}
.dsb__item.danger:hover i{color:var(--dsb-danger);}

.dsb__sep{height:1px;background:var(--dsb-line);margin:12px 13px;}

/* ---------- footer ---------- */
.dsb__foot{
    padding:14px 16px;border-top:1px solid var(--dsb-line);
    background:var(--dsb-bg-2);
    display:flex;align-items:center;gap:11px;
}
.dsb__avatar{
    width:34px;height:34px;flex:0 0 34px;border-radius:50%;
    display:grid;place-items:center;color:#fff;font-size:.76rem;font-weight:700;
    background:var(--dsb-grad);
}
.dsb__who{min-width:0;flex:1;}
.dsb__who strong{
    display:block;font-size:.82rem;font-weight:650;color:var(--dsb-ink);
    overflow:hidden;text-overflow:ellipsis;white-space:nowrap;letter-spacing:-.01em;
}
.dsb__who small{
    display:flex;align-items:center;gap:5px;
    font-size:.7rem;color:var(--dsb-ink-3);margin-top:2px;
}
.dsb__who small .dot{
    width:6px;height:6px;border-radius:50%;background:#16a34a;
    box-shadow:0 0 0 0 rgba(22,163,74,.5);animation:dsbPulse 1.9s infinite;
}
.dsb__out{
    width:32px;height:32px;flex:0 0 32px;border-radius:10px;
    display:grid;place-items:center;border:1px solid var(--dsb-line);
    background:var(--dsb-bg);color:var(--dsb-ink-3);
    text-decoration:none;font-size:.8rem;transition:var(--dsb-t);
}
.dsb__out:hover{color:var(--dsb-danger);border-color:rgba(220,38,38,.3);background:rgba(220,38,38,.08);}

/* ---------- mobile trigger + overlay ---------- */
.dsb-burger{
    display:none;position:fixed;top:14px;left:14px;z-index:920;
    width:44px;height:44px;border-radius:13px;
    align-items:center;justify-content:center;
    background:#fff;border:1px solid rgba(16,22,31,.09);color:#10161f;
    box-shadow:0 8px 22px -10px rgba(16,22,31,.35);
    cursor:pointer;font-size:1rem;transition:var(--dsb-t);
}
.dsb-burger:hover{color:var(--dsb-brand);}
html[data-dsb-theme="dark"] .dsb-burger{background:#141a25;color:#eef2f8;border-color:rgba(255,255,255,.1);}

.dsb-veil{
    display:none;position:fixed;inset:0;z-index:890;
    background:rgba(8,11,17,.5);backdrop-filter:blur(3px);
    opacity:0;transition:opacity var(--dsb-t);
}
.dsb-veil.is-open{display:block;opacity:1;}

@keyframes dsbPulse{0%{box-shadow:0 0 0 0 rgba(22,163,74,.5);}70%{box-shadow:0 0 0 6px rgba(22,163,74,0);}100%{box-shadow:0 0 0 0 rgba(22,163,74,0);}}
@media (prefers-reduced-motion:reduce){.dsb *,.dsb-veil,.dsb{animation:none !important;transition:none !important;}}

/* ---------- responsive ---------- */
@media (max-width:1024px){
    body{padding-left:0;}
    .dsb{transform:translateX(-100%);box-shadow:none;}
    .dsb.is-open{transform:none;box-shadow:0 0 60px -10px rgba(8,11,17,.5);}
    .dsb-burger{display:flex;}
    /* burger ke neeche page heading na chhupe */
    body > main:first-of-type,body > .dcp:first-of-type{padding-top:64px;}
}
@media (max-width:420px){
    .dsb{width:88vw;max-width:300px;}
}
@media print{
    .dsb,.dsb-burger,.dsb-veil{display:none !important;}
    body{padding-left:0 !important;}
}
</style>

<button type="button" class="dsb-burger" id="dsbBurger" aria-label="Open menu" aria-controls="sidebar" aria-expanded="false">
    <i class="fa-solid fa-bars"></i>
</button>
<div class="dsb-veil" id="dsbVeil" hidden></div>

<aside class="dsb" id="sidebar">

    <!-- ============ BRAND ============ -->
    <div class="dsb__brand">
        <div class="dsb__mark">
            <img src="/images/dmpllogo.jpg" alt="Doric Multimedia logo">
        </div>
        <div>
            <span class="dsb__name">Doric</span>
            <small class="dsb__tag">Admin Console</small>
        </div>
    </div>

    <!-- ============ NAV ============ -->
    <nav class="dsb__nav" aria-label="Admin navigation">

        <div class="dsb__label">Overview</div>
        <a href="/admin/dashboard.php" class="dsb__item <?php echo $isDash; ?>"
           <?php echo $isDash ? 'aria-current="page"' : ''; ?>>
            <i class="fa-solid fa-gauge-high"></i>
            <span>Dashboard</span>
        </a>

        <div class="dsb__label">Content</div>
        <a href="/admin/blogs/index.php" class="dsb__item <?php echo $isList; ?>"
           <?php echo $isList ? 'aria-current="page"' : ''; ?>>
            <i class="fa-regular fa-newspaper"></i>
            <span>Blog Posts</span>
        </a>
        <a href="/admin/blogs/create.php" class="dsb__item <?php echo $isCreate; ?>"
           <?php echo $isCreate ? 'aria-current="page"' : ''; ?>>
            <i class="fa-regular fa-square-plus"></i>
            <span>Create Post</span>
        </a>
        <a href="/admin/blogs/index.php?status=draft" class="dsb__item">
            <i class="fa-regular fa-pen-to-square"></i>
            <span>Drafts</span>
        </a>
        <a href="/admin/categories/" class="dsb__item <?php echo $isCats; ?>"
           <?php echo $isCats ? 'aria-current="page"' : ''; ?>>
            <i class="fa-solid fa-tags"></i>
            <span>Categories</span>
        </a>

        <div class="dsb__label">Site</div>
        <a href="/blog.php" target="_blank" rel="noopener" class="dsb__item">
            <i class="fa-solid fa-arrow-up-right-from-square"></i>
            <span>View Blog</span>
        </a>

        <div class="dsb__sep"></div>

        <a href="/admin/logout.php" class="dsb__item danger">
            <i class="fa-solid fa-right-from-bracket"></i>
            <span>Logout</span>
        </a>
    </nav>

    <!-- ============ FOOTER ============ -->
    <?php
    $dsbUser = $_SESSION['admin_name'] ?? ($_SESSION['admin_username'] ?? 'Admin');
    $dsbInitial = strtoupper(mb_substr(trim((string) $dsbUser), 0, 1) ?: 'A');
    ?>
    <div class="dsb__foot">
        <span class="dsb__avatar"><?php echo htmlspecialchars($dsbInitial, ENT_QUOTES, 'UTF-8'); ?></span>
        <div class="dsb__who">
            <strong><?php echo htmlspecialchars((string) $dsbUser, ENT_QUOTES, 'UTF-8'); ?></strong>
            <small><span class="dot"></span> Signed in</small>
        </div>
        <a href="/admin/logout.php" class="dsb__out" title="Logout" aria-label="Logout">
            <i class="fa-solid fa-power-off"></i>
        </a>
    </div>
</aside>

<script>
(function () {
    'use strict';
    var sidebar = document.getElementById('sidebar');
    var burger  = document.getElementById('dsbBurger');
    var veil    = document.getElementById('dsbVeil');
    if (!sidebar || !burger || !veil) { return; }

    function setOpen(open) {
        sidebar.classList.toggle('is-open', open);
        veil.classList.toggle('is-open', open);
        veil.hidden = !open;
        burger.setAttribute('aria-expanded', open ? 'true' : 'false');
        burger.innerHTML = open ? '<i class="fa-solid fa-xmark"></i>' : '<i class="fa-solid fa-bars"></i>';
        document.body.style.overflow = open && window.innerWidth <= 1024 ? 'hidden' : '';
    }

    burger.addEventListener('click', function () {
        setOpen(!sidebar.classList.contains('is-open'));
    });
    veil.addEventListener('click', function () { setOpen(false); });

    document.addEventListener('keydown', function (ev) {
        if (ev.key === 'Escape' && sidebar.classList.contains('is-open')) { setOpen(false); }
    });

    // link click par mobile me band ho jaye
    sidebar.addEventListener('click', function (ev) {
        if (ev.target.closest('.dsb__item') && window.innerWidth <= 1024) { setOpen(false); }
    });

    // desktop par wapas aate hi reset
    window.addEventListener('resize', function () {
        if (window.innerWidth > 1024) { setOpen(false); }
    });

    /* page ke theme toggle ke saath sidebar bhi dark ho jaye.
       Pages localStorage key 'doric-admin-theme' use karte hain. */
    function syncTheme() {
        var mode = 'light';
        try { mode = localStorage.getItem('doric-admin-theme') || mode; } catch (err) {}
        var page = document.getElementById('dcp');
        if (page && page.getAttribute('data-theme')) { mode = page.getAttribute('data-theme'); }
        document.documentElement.setAttribute('data-dsb-theme', mode);
    }
    syncTheme();

    var page = document.getElementById('dcp');
    if (page && window.MutationObserver) {
        new MutationObserver(syncTheme).observe(page, { attributes: true, attributeFilter: ['data-theme'] });
    }
}());
</script>
