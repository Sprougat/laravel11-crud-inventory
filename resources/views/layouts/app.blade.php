<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') — Inventaris Nana</title>

    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        /* ═══════════════════════════════════════
           CSS VARIABLES — BLACKPINK THEME
        ═══════════════════════════════════════ */
        :root {
            --pink:          #FF0080;
            --pink-light:    #FF4DA6;
            --pink-dim:      rgba(255, 0, 128, 0.15);
            --pink-border:   rgba(255, 0, 128, 0.30);
            --bg:            #09090F;
            --bg-card:       #111118;
            --bg-card2:      #18181F;
            --bg-sidebar:    #0C0C13;
            --text:          #EFEFFA;
            --text-muted:    #8888AA;
            --text-faint:    #444466;
            --border:        #1E1E2E;
            --green:         #00E676;
            --yellow:        #FFD600;
            --red:           #FF1744;
            --cyan:          #00C8FF;
            --sidebar-w:     256px;
        }

        /* ═══════════════════════════════════════
           BASE
        ═══════════════════════════════════════ */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
        }

        a { text-decoration: none; }
        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: var(--bg); }
        ::-webkit-scrollbar-thumb { background: #2a2a3a; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: var(--pink); }

        /* ═══════════════════════════════════════
           SIDEBAR
        ═══════════════════════════════════════ */
        .sidebar {
            position: fixed;
            top: 0; left: 0;
            width: var(--sidebar-w);
            height: 100vh;
            background: var(--bg-sidebar);
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            z-index: 200;
            overflow-y: auto;
            transition: transform .25s ease;
        }

        /* brand */
        .s-brand {
            padding: 22px 18px 18px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 11px;
        }
        .s-brand-icon {
            width: 40px; height: 40px;
            background: var(--pink);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 19px;
            flex-shrink: 0;
            box-shadow: 0 0 18px var(--pink-dim);
        }
        .s-brand-title  { font-size: 12.5px; font-weight: 700; color: var(--text); line-height: 1.3; }
        .s-brand-sub    { font-size: 10.5px; color: var(--pink-light); font-weight: 500; margin-top: 1px; }

        /* nav */
        .s-nav { flex: 1; padding: 14px 10px; }
        .s-section-label {
            font-size: 9.5px; font-weight: 700; letter-spacing: 1.4px;
            text-transform: uppercase; color: var(--text-faint);
            padding: 8px 10px 4px; margin-top: 6px;
        }
        .s-link {
            display: flex; align-items: center; gap: 11px;
            padding: 10px 12px;
            border-radius: 9px;
            color: var(--text-muted);
            font-size: 13.5px; font-weight: 500;
            transition: all .18s;
            margin-bottom: 2px;
            border: 1px solid transparent;
        }
        .s-link:hover {
            background: var(--bg-card2);
            color: var(--text);
        }
        .s-link.active {
            background: var(--pink-dim);
            color: var(--pink-light);
            border-color: var(--pink-border);
        }
        .s-link .s-icon { font-size: 16px; width: 18px; text-align: center; flex-shrink: 0; }

        /* footer */
        .s-footer {
            padding: 14px 10px;
            border-top: 1px solid var(--border);
        }
        .s-user {
            display: flex; align-items: center; gap: 9px;
            background: var(--bg-card2);
            border-radius: 9px;
            padding: 9px 12px;
            margin-bottom: 10px;
        }
        .s-avatar {
            width: 32px; height: 32px;
            background: var(--pink);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 13px; font-weight: 700; color: #fff;
            flex-shrink: 0;
        }
        .s-uname { font-size: 12.5px; font-weight: 600; color: var(--text); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .s-urole { font-size: 10.5px; color: var(--pink-light); }

        /* ═══════════════════════════════════════
           MAIN CONTENT
        ═══════════════════════════════════════ */
        .main-wrap {
            margin-left: var(--sidebar-w);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* topbar */
        .topbar {
            position: sticky; top: 0; z-index: 100;
            background: var(--bg-card);
            border-bottom: 1px solid var(--border);
            padding: 13px 26px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .topbar-title { font-size: 17px; font-weight: 700; color: var(--text); }
        .topbar-sub   { font-size: 11.5px; color: var(--text-muted); margin-top: 1px; }

        /* content */
        .content { padding: 26px; flex: 1; }

        /* footer */
        .site-footer {
            padding: 14px 26px;
            border-top: 1px solid var(--border);
            text-align: center;
            font-size: 11.5px;
            color: var(--text-faint);
        }

        /* ═══════════════════════════════════════
           BUTTONS
        ═══════════════════════════════════════ */
        .btn-pink {
            display: inline-flex; align-items: center; gap: 6px;
            background: var(--pink);
            color: #fff !important;
            border: none;
            font-weight: 600; font-size: 13px;
            padding: 9px 18px;
            border-radius: 8px;
            cursor: pointer;
            transition: all .18s;
            box-shadow: 0 3px 14px rgba(255,0,128,.30);
            text-decoration: none;
        }
        .btn-pink:hover {
            background: var(--pink-light);
            box-shadow: 0 4px 20px rgba(255,0,128,.45);
            transform: translateY(-1px);
        }
        .btn-ghost {
            display: inline-flex; align-items: center; gap: 6px;
            background: transparent;
            border: 1px solid var(--pink-border);
            color: var(--pink-light) !important;
            font-weight: 500; font-size: 13px;
            padding: 8px 16px;
            border-radius: 8px;
            cursor: pointer;
            transition: all .18s;
            text-decoration: none;
        }
        .btn-ghost:hover {
            background: var(--pink-dim);
            border-color: var(--pink);
        }
        .btn-ghost-danger {
            display: inline-flex; align-items: center; gap: 6px;
            background: transparent;
            border: 1px solid rgba(255,23,68,.30);
            color: #FF5252 !important;
            font-weight: 500; font-size: 13px;
            padding: 8px 16px;
            border-radius: 8px;
            cursor: pointer;
            transition: all .18s;
            text-decoration: none;
        }
        .btn-ghost-danger:hover { background: rgba(255,23,68,.10); border-color: var(--red); }

        /* icon buttons */
        .ibtn {
            width: 33px; height: 33px;
            border-radius: 7px;
            display: inline-flex; align-items: center; justify-content: center;
            font-size: 14px;
            cursor: pointer; border: none;
            transition: all .18s;
        }
        .ibtn-view   { background: rgba(180,0,255,.12); color: #B44FFF; }
        .ibtn-view:hover  { background: rgba(180,0,255,.22); }
        .ibtn-edit   { background: rgba(0,200,255,.12); color: var(--cyan); }
        .ibtn-edit:hover  { background: rgba(0,200,255,.22); }
        .ibtn-del    { background: rgba(255,23,68,.10); color: #FF5252; }
        .ibtn-del:hover   { background: rgba(255,23,68,.22); }

        /* ═══════════════════════════════════════
           CARDS
        ═══════════════════════════════════════ */
        .card-dark {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 22px;
        }
        .card-dark-sm {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 14px 16px;
        }

        /* ═══════════════════════════════════════
           BADGES
        ═══════════════════════════════════════ */
        .badge-aktif {
            display: inline-flex; align-items: center; gap: 5px;
            background: rgba(0,230,118,.12);
            color: var(--green);
            border: 1px solid rgba(0,230,118,.25);
            font-size: 11px; font-weight: 600;
            padding: 3px 10px; border-radius: 20px;
        }
        .badge-nonaktif {
            display: inline-flex; align-items: center; gap: 5px;
            background: rgba(255,23,68,.10);
            color: #FF5252;
            border: 1px solid rgba(255,23,68,.20);
            font-size: 11px; font-weight: 600;
            padding: 3px 10px; border-radius: 20px;
        }

        /* ═══════════════════════════════════════
           FORMS
        ═══════════════════════════════════════ */
        .f-label {
            display: block;
            font-size: 12.5px; font-weight: 600;
            color: var(--text-muted);
            margin-bottom: 6px;
        }
        .f-input,
        .f-select,
        .f-textarea {
            width: 100%;
            background: var(--bg-card2);
            border: 1px solid var(--border);
            color: var(--text);
            border-radius: 8px;
            padding: 10px 13px;
            font-size: 13.5px;
            font-family: 'Inter', sans-serif;
            transition: border-color .18s, box-shadow .18s;
            outline: none;
        }
        .f-input:focus,
        .f-select:focus,
        .f-textarea:focus {
            border-color: var(--pink);
            box-shadow: 0 0 0 3px var(--pink-dim);
        }
        .f-input::placeholder,
        .f-textarea::placeholder { color: var(--text-faint); }
        .f-input.is-invalid,
        .f-select.is-invalid,
        .f-textarea.is-invalid { border-color: var(--red); }
        .f-textarea { resize: vertical; }
        .f-error {
            font-size: 11.5px; color: #FF5252;
            margin-top: 4px;
            display: flex; align-items: center; gap: 4px;
        }
        .f-hint { font-size: 11px; color: var(--text-faint); margin-top: 3px; }

        /* input with prefix icon */
        .f-input-wrap { position: relative; }
        .f-prefix {
            position: absolute; left: 12px; top: 50%;
            transform: translateY(-50%);
            font-size: 13px; color: var(--text-muted);
            pointer-events: none;
        }
        .f-input-wrap .f-input { padding-left: 36px; }

        /* ═══════════════════════════════════════
           TABLE
        ═══════════════════════════════════════ */
        .t-wrap { overflow-x: auto; }
        .tbl {
            width: 100%;
            border-collapse: collapse;
            color: var(--text);
        }
        .tbl thead th {
            background: var(--bg-card2);
            color: var(--text-muted);
            font-size: 11px; font-weight: 700;
            letter-spacing: .8px;
            text-transform: uppercase;
            padding: 11px 14px;
            border-bottom: 1px solid var(--border);
            white-space: nowrap;
        }
        .tbl tbody td {
            font-size: 13.5px;
            padding: 11px 14px;
            border-bottom: 1px solid var(--border);
            vertical-align: middle;
        }
        .tbl tbody tr:last-child td { border-bottom: none; }
        .tbl tbody tr:hover td { background: rgba(255,0,128,.03); }

        /* sort link in th */
        .sort-link {
            display: inline-flex; align-items: center; gap: 4px;
            color: var(--text-muted); text-decoration: none;
        }
        .sort-link:hover { color: var(--text); }

        /* kode badge */
        .kode {
            font-family: 'Courier New', monospace;
            font-size: 12px;
            background: var(--bg-card2);
            color: var(--pink-light);
            padding: 2px 8px; border-radius: 5px;
            border: 1px solid var(--border);
        }

        /* ═══════════════════════════════════════
           FLASH MESSAGES
        ═══════════════════════════════════════ */
        .flash {
            display: flex; align-items: center; gap: 10px;
            padding: 13px 16px;
            border-radius: 10px;
            font-size: 13.5px; font-weight: 500;
            margin-bottom: 22px;
        }
        .flash-success {
            background: rgba(0,230,118,.10);
            color: var(--green);
            border: 1px solid rgba(0,230,118,.22);
        }
        .flash-danger {
            background: rgba(255,23,68,.09);
            color: #FF5252;
            border: 1px solid rgba(255,23,68,.18);
        }
        .flash-close {
            margin-left: auto;
            background: none; border: none;
            color: inherit; cursor: pointer; font-size: 16px;
            line-height: 1; padding: 0;
        }

        /* ═══════════════════════════════════════
           MODAL
        ═══════════════════════════════════════ */
        .modal-content {
            background: var(--bg-card) !important;
            border: 1px solid var(--border) !important;
            border-radius: 16px !important;
            color: var(--text) !important;
        }
        .modal-header { border-bottom: 1px solid var(--border) !important; padding: 18px 22px !important; }
        .modal-body   { padding: 22px !important; }
        .modal-footer { border-top: 1px solid var(--border) !important; padding: 14px 22px !important; }
        .modal-title  { font-weight: 700; font-size: 15px; color: var(--text) !important; }
        .btn-close    { filter: invert(1) opacity(.5); }

        /* ═══════════════════════════════════════
           PAGINATION
        ═══════════════════════════════════════ */
        .pagination { margin: 0; gap: 3px; }
        .page-link {
            background: var(--bg-card2) !important;
            border-color: var(--border) !important;
            color: var(--text-muted) !important;
            border-radius: 7px !important;
            font-size: 13px !important;
            padding: 6px 12px !important;
            transition: all .15s;
        }
        .page-link:hover {
            background: var(--pink-dim) !important;
            color: var(--pink-light) !important;
            border-color: var(--pink-border) !important;
        }
        .page-item.active .page-link {
            background: var(--pink) !important;
            border-color: var(--pink) !important;
            color: #fff !important;
        }
        .page-item.disabled .page-link { opacity: .4; }

        /* ═══════════════════════════════════════
           EMPTY STATE
        ═══════════════════════════════════════ */
        .empty-state { text-align: center; padding: 52px 20px; }
        .empty-icon  { font-size: 52px; opacity: .35; margin-bottom: 14px; }

        /* ═══════════════════════════════════════
           UTILITIES
        ═══════════════════════════════════════ */
        .text-pink   { color: var(--pink-light) !important; }
        .text-muted2 { color: var(--text-muted) !important; }
        .dot-online  {
            width: 7px; height: 7px;
            background: var(--pink);
            border-radius: 50%;
            display: inline-block;
            box-shadow: 0 0 6px var(--pink);
        }

        /* ═══════════════════════════════════════
           RESPONSIVE
        ═══════════════════════════════════════ */
        @media (max-width: 991px) {
            .sidebar   { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .main-wrap { margin-left: 0; }
            .mob-toggle { display: flex !important; }
        }

        .mob-toggle {
            display: none;
            align-items: center; justify-content: center;
            width: 34px; height: 34px;
            background: var(--bg-card2);
            border: 1px solid var(--border);
            border-radius: 8px;
            color: var(--text); cursor: pointer;
            font-size: 18px;
        }
    </style>

    @stack('styles')
</head>
<body>

{{-- ═══ SIDEBAR ═══════════════════════════════════════════════════════════════ --}}
<aside class="sidebar" id="sidebar">

    {{-- Brand --}}
    <div class="s-brand">
        <div class="s-brand-icon">🛍️</div>
        <div>
            <div class="s-brand-title">Pak Cik &amp; Mas Aimar</div>
            <div class="s-brand-sub">✦ INVENTARIS NANA ✦</div>
        </div>
    </div>

    {{-- Navigation --}}
    <nav class="s-nav">
        <div class="s-section-label">Menu Utama</div>

        <a href="{{ route('dashboard') }}"
           class="s-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="bi bi-grid-fill s-icon"></i>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('products.index') }}"
           class="s-link {{ request()->routeIs('products.index') ? 'active' : '' }}">
            <i class="bi bi-box-seam-fill s-icon"></i>
            <span>Daftar Produk</span>
        </a>

        <a href="{{ route('products.create') }}"
           class="s-link {{ request()->routeIs('products.create') ? 'active' : '' }}">
            <i class="bi bi-plus-circle-fill s-icon"></i>
            <span>Tambah Produk</span>
        </a>
    </nav>

    {{-- User + Logout --}}
    <div class="s-footer">
        <div class="s-user">
            <div class="s-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
            <div style="min-width:0;">
                <div class="s-uname">{{ Auth::user()->name }}</div>
                <div class="s-urole">Administrator</div>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-ghost" style="width:100%; justify-content:center; padding:9px;">
                <i class="bi bi-box-arrow-right"></i> Logout
            </button>
        </form>
    </div>
</aside>

{{-- ═══ MAIN CONTENT ══════════════════════════════════════════════════════════ --}}
<div class="main-wrap">

    {{-- Topbar --}}
    <header class="topbar">
        <div style="display:flex; align-items:center; gap:12px;">
            <button class="mob-toggle" id="mobToggle">
                <i class="bi bi-list"></i>
            </button>
            <div>
                <div class="topbar-title">@yield('page-title', 'Dashboard')</div>
                <div class="topbar-sub">@yield('page-subtitle', '')</div>
            </div>
        </div>
        <div style="display:flex; align-items:center; gap:10px;">
            <span style="font-size:12px; color:var(--text-muted); display:flex; align-items:center; gap:6px;">
                <span class="dot-online"></span>
                {{ now()->locale('id')->isoFormat('ddd, D MMM Y') }}
            </span>
        </div>
    </header>

    {{-- Page Content --}}
    <main class="content">

        {{-- Flash success --}}
        @if(session('success'))
        <div class="flash flash-success" id="flashMsg">
            <i class="bi bi-check-circle-fill" style="font-size:17px; flex-shrink:0;"></i>
            <span>{!! session('success') !!}</span>
            <button class="flash-close" onclick="this.closest('.flash').remove()">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
        @endif

        {{-- Flash error --}}
        @if(session('error'))
        <div class="flash flash-danger" id="flashMsg">
            <i class="bi bi-exclamation-circle-fill" style="font-size:17px; flex-shrink:0;"></i>
            <span>{!! session('error') !!}</span>
            <button class="flash-close" onclick="this.closest('.flash').remove()">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
        @endif

        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="site-footer">
        © {{ date('Y') }} Inventaris Nana — Pak Cik &amp; Mas Aimar &nbsp;·&nbsp; Built with ❤️ &amp; ✨
    </footer>
</div>

{{-- ═══ SCRIPTS ════════════════════════════════════════════════════════════════ --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Mobile sidebar toggle
    const mobToggle = document.getElementById('mobToggle');
    const sidebar   = document.getElementById('sidebar');
    if (mobToggle) {
        mobToggle.addEventListener('click', () => sidebar.classList.toggle('open'));
    }
    // Close sidebar on outside click (mobile)
    document.addEventListener('click', function(e) {
        if (window.innerWidth < 992 &&
            sidebar.classList.contains('open') &&
            !sidebar.contains(e.target) &&
            e.target !== mobToggle) {
            sidebar.classList.remove('open');
        }
    });
    // Auto dismiss flash after 5 s
    setTimeout(() => {
        const f = document.getElementById('flashMsg');
        if (f) { f.style.opacity = '0'; f.style.transition = 'opacity .4s'; setTimeout(() => f.remove(), 400); }
    }, 5000);
</script>

@stack('scripts')
</body>
</html>
