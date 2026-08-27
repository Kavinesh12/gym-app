<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GymPro - Forge Your Limits</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Barlow:ital,wght@0,300;0,400;0,500;0,700;0,900;1,300&family=Barlow+Condensed:wght@700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    <style>
        :root {
            --red: #E63B2E;
            --red2: #ff4d3d;
            --dark: #080808;
            --darker: #030303;
            --gray: #141414;
            --gray2: #1e1e1e;
            --white: #f5f5f0;
            --muted: #777;
        }
        *, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }
        html { scroll-behavior: smooth; font-size: 16px; }
        body {
            background: var(--darker);
            color: var(--white);
            font-family: 'Barlow', sans-serif;
            overflow-x: hidden;
            cursor: none;
        }

        /* ── CURSOR ── */
        #cur { width:10px; height:10px; background:var(--red); border-radius:50%; position:fixed; pointer-events:none; z-index:9999; transform:translate(-50%,-50%); transition:transform .15s; }
        #cur-ring { width:38px; height:38px; border:1.5px solid rgba(230,59,46,.5); border-radius:50%; position:fixed; pointer-events:none; z-index:9998; transform:translate(-50%,-50%); transition:width .3s,height .3s,border-color .3s; }
        body:hover #cur-ring { border-color:rgba(230,59,46,.8); }
        a:hover ~ #cur, button:hover ~ #cur { transform:translate(-50%,-50%) scale(2); }

        /* ── NAV ── */
        nav {
            position:fixed; top:0; left:0; right:0; z-index:1000;
            padding:1.8rem 5rem;
            display:flex; align-items:center; justify-content:space-between;
            transition:all .4s;
        }
        nav.scrolled {
            background:rgba(3,3,3,.92);
            backdrop-filter:blur(24px);
            padding:1rem 5rem;
            border-bottom:1px solid rgba(230,59,46,.15);
        }
        .logo { font-family:'Bebas Neue',sans-serif; font-size:2.2rem; letter-spacing:5px; text-decoration:none; color:var(--white); }
        .logo span { color:var(--red); }
        .nav-links { display:flex; gap:2.5rem; list-style:none; }
        .nav-links a { color:rgba(245,245,240,.55); text-decoration:none; font-size:.78rem; letter-spacing:2.5px; text-transform:uppercase; font-weight:600; transition:color .3s; position:relative; padding-bottom:4px; }
        .nav-links a::after { content:''; position:absolute; bottom:0; left:0; width:0; height:1px; background:var(--red); transition:width .35s; }
        .nav-links a:hover { color:var(--white); }
        .nav-links a:hover::after { width:100%; }
        .nav-cta { display:flex; align-items:center; gap:1.2rem; }
        .nav-login { color:rgba(245,245,240,.55); text-decoration:none; font-size:.78rem; letter-spacing:2.5px; text-transform:uppercase; font-weight:600; transition:color .3s; }
        .nav-login:hover { color:var(--white); }
        .nav-btn { background:var(--red); color:var(--white); padding:.65rem 1.8rem; text-decoration:none; font-size:.78rem; font-weight:700; letter-spacing:2.5px; text-transform:uppercase; transition:all .3s; clip-path:polygon(0 0,calc(100% - 8px) 0,100% 8px,100% 100%,8px 100%,0 calc(100% - 8px)); }
        .nav-btn:hover { background:var(--white); color:var(--dark); }

        /* ── HERO ── */
        .hero {
            min-height:100vh; position:relative; overflow:hidden;
            display:flex; align-items:center;
        }
        .hero-bg {
            position:absolute; inset:0; z-index:0;
            background-image: url('https://images.unsplash.com/photo-1534438327276-14e5300c3a48?w=1600&q=80');
            background-size:cover; background-position:center;
            transform:scale(1.05);
            transition:transform 8s ease;
        }
        .hero-bg::after {
            content:''; position:absolute; inset:0;
            background: linear-gradient(105deg, rgba(3,3,3,.92) 0%, rgba(3,3,3,.75) 50%, rgba(3,3,3,.4) 100%);
        }
        .hero-noise {
            position:absolute; inset:0; z-index:1; opacity:.03;
            background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)'/%3E%3C/svg%3E");
            background-repeat:repeat; background-size:128px 128px;
            pointer-events:none;
        }
        .hero-grid-lines {
            position:absolute; inset:0; z-index:1; opacity:.04;
            background-image: linear-gradient(rgba(255,255,255,1) 1px, transparent 1px), linear-gradient(90deg,rgba(255,255,255,1) 1px,transparent 1px);
            background-size:70px 70px;
        }
        .hero-content { position:relative; z-index:2; padding:0 5rem; padding-top:8rem; max-width:780px; }
        .hero-pill {
            display:inline-flex; align-items:center; gap:.6rem;
            border:1px solid rgba(230,59,46,.4); padding:.4rem 1.1rem;
            font-size:.72rem; letter-spacing:3px; text-transform:uppercase; color:var(--red);
            margin-bottom:2rem; opacity:0;
            background:rgba(230,59,46,.06);
        }
        .hero-pill .dot { width:6px; height:6px; border-radius:50%; background:var(--red); animation:blink 2s infinite; }
        @keyframes blink { 0%,100%{opacity:1;transform:scale(1)} 50%{opacity:.4;transform:scale(1.6)} }
        .hero-h1 {
            font-family:'Barlow Condensed',sans-serif;
            font-size:clamp(5.5rem,13vw,11rem);
            font-weight:900; line-height:.88;
            text-transform:uppercase; letter-spacing:-3px;
            opacity:0;
        }
        .hero-h1 .stroke { -webkit-text-stroke:1.5px rgba(245,245,240,.25); color:transparent; }
        .hero-h1 .accent { color:var(--red); }
        .hero-desc {
            font-size:1.05rem; color:rgba(245,245,240,.55);
            line-height:1.75; margin:2rem 0; max-width:460px;
            font-weight:300; opacity:0;
        }
        .hero-btns { display:flex; gap:1.2rem; align-items:center; opacity:0; }
        .btn-main {
            background:var(--red); color:var(--white);
            padding:1.1rem 2.8rem; text-decoration:none;
            font-size:.85rem; font-weight:700; letter-spacing:2.5px; text-transform:uppercase;
            transition:all .35s; position:relative; overflow:hidden;
            clip-path:polygon(0 0,calc(100% - 10px) 0,100% 10px,100% 100%,10px 100%,0 calc(100% - 10px));
        }
        .btn-main::before { content:''; position:absolute; inset:0; background:rgba(255,255,255,.12); transform:translateX(-100%); transition:transform .4s; }
        .btn-main:hover::before { transform:translateX(0); }
        .btn-ghost {
            color:var(--white); text-decoration:none;
            font-size:.82rem; font-weight:600; letter-spacing:2.5px; text-transform:uppercase;
            display:flex; align-items:center; gap:.7rem; transition:gap .3s;
        }
        .btn-ghost:hover { gap:1.2rem; }
        .btn-ghost .circle { width:36px; height:36px; border:1px solid rgba(255,255,255,.25); border-radius:50%; display:flex; align-items:center; justify-content:center; }

        /* ── HERO SIDE CARD ── */
        .hero-card-wrap {
            position:absolute; right:5rem; top:50%; z-index:3;
            transform:translateY(-50%); width:320px; opacity:0;
        }
        .hero-card {
            background:rgba(14,14,14,.88);
            border:1px solid rgba(255,255,255,.07);
            backdrop-filter:blur(20px);
            padding:1.8rem;
            transform-style:preserve-3d;
            transition:box-shadow .3s;
        }
        .hero-card:hover { box-shadow:0 30px 80px rgba(230,59,46,.2); }
        .hc-img { width:100%; height:200px; object-fit:cover; margin-bottom:1.2rem; display:block; }
        .hc-tag { font-size:.65rem; letter-spacing:3px; text-transform:uppercase; color:var(--red); margin-bottom:.4rem; }
        .hc-title { font-family:'Barlow Condensed',sans-serif; font-size:1.7rem; font-weight:800; text-transform:uppercase; margin-bottom:1.2rem; }
        .hc-stats { display:grid; grid-template-columns:repeat(3,1fr); border-top:1px solid rgba(255,255,255,.07); padding-top:1rem; }
        .hc-stat { text-align:center; }
        .hc-num { font-family:'Bebas Neue',sans-serif; font-size:1.9rem; color:var(--red); line-height:1; }
        .hc-lbl { font-size:.6rem; letter-spacing:1.5px; text-transform:uppercase; color:var(--muted); margin-top:.2rem; }

        /* ── TICKER ── */
        .ticker { background:var(--red); padding:.75rem 0; overflow:hidden; white-space:nowrap; }
        .ticker-track { display:inline-flex; gap:2.5rem; animation:tick 25s linear infinite; }
        .ticker-track2 { animation-delay:-12.5s; }
        .t-item { font-family:'Bebas Neue',sans-serif; font-size:.95rem; letter-spacing:3px; color:var(--white); display:flex; align-items:center; gap:1.5rem; }
        .t-item::after { content:'★'; font-size:.6rem; opacity:.6; }
        @keyframes tick { 0%{transform:translateX(0)} 100%{transform:translateX(-100%)} }

        /* ── SECTIONS BASE ── */
        .sec { padding:7rem 5rem; position:relative; }
        .sec-label { font-size:.72rem; letter-spacing:4px; text-transform:uppercase; color:var(--red); margin-bottom:1rem; display:flex; align-items:center; gap:1rem; }
        .sec-label::before { content:''; width:36px; height:1px; background:var(--red); }
        .sec-title { font-family:'Barlow Condensed',sans-serif; font-size:clamp(3rem,6vw,5.5rem); font-weight:900; text-transform:uppercase; line-height:.92; }
        .sec-title .ghost { -webkit-text-stroke:1px rgba(245,245,240,.18); color:transparent; }

        /* ── MUSCLE SECTION ── */
        .muscle-intro { display:grid; grid-template-columns:1fr 1fr; gap:4rem; align-items:end; margin-bottom:3.5rem; }
        .muscle-intro p { color:rgba(245,245,240,.5); line-height:1.8; font-size:1rem; font-weight:300; max-width:420px; }
        .muscles-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:1px; background:rgba(255,255,255,.04); }
        .mc {
            background:var(--dark); position:relative; overflow:hidden; cursor:none;
            aspect-ratio:1/.85;
        }
        .mc-img {
            position:absolute; inset:0; object-fit:cover; width:100%; height:100%;
            transition:transform .6s ease, filter .6s;
            filter:brightness(.35) saturate(.4);
        }
        .mc:hover .mc-img { transform:scale(1.08); filter:brightness(.25) saturate(.3); }
        .mc-overlay {
            position:absolute; inset:0;
            background:linear-gradient(0deg, rgba(0,0,0,.85) 0%, rgba(0,0,0,.2) 60%, transparent 100%);
            transition:background .5s;
        }
        .mc:hover .mc-overlay { background:linear-gradient(0deg, rgba(230,59,46,.9) 0%, rgba(230,59,46,.5) 50%, rgba(230,59,46,.1) 100%); }
        .mc-body { position:absolute; inset:0; padding:2rem; display:flex; flex-direction:column; justify-content:flex-end; z-index:1; }
        .mc-num { font-family:'Bebas Neue',sans-serif; font-size:4.5rem; color:rgba(255,255,255,.06); position:absolute; top:.5rem; right:1rem; line-height:1; transition:color .5s; }
        .mc:hover .mc-num { color:rgba(255,255,255,.12); }
        .mc-name { font-family:'Barlow Condensed',sans-serif; font-size:2rem; font-weight:900; text-transform:uppercase; line-height:1; margin-bottom:.4rem; }
        .mc-count { font-size:.7rem; letter-spacing:2.5px; text-transform:uppercase; color:rgba(255,255,255,.6); }
        .mc-arrow { position:absolute; top:1.5rem; right:1.5rem; width:36px; height:36px; border:1px solid rgba(255,255,255,.2); border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:.9rem; opacity:0; transform:scale(.7); transition:all .4s; }
        .mc:hover .mc-arrow { opacity:1; transform:scale(1); border-color:rgba(255,255,255,.6); }

        /* ── STATS BAR ── */
        .stats-bar { display:grid; grid-template-columns:repeat(4,1fr); border-top:1px solid rgba(255,255,255,.05); border-bottom:1px solid rgba(255,255,255,.05); }
        .sb { padding:4rem 3.5rem; border-right:1px solid rgba(255,255,255,.05); position:relative; overflow:hidden; }
        .sb:last-child { border-right:none; }
        .sb::after { content:''; position:absolute; bottom:0; left:0; right:0; height:2px; background:var(--red); transform:scaleX(0); transform-origin:left; transition:transform .6s ease; }
        .sb:hover::after { transform:scaleX(1); }
        .sb-num { font-family:'Bebas Neue',sans-serif; font-size:clamp(3rem,5vw,5rem); line-height:1; display:flex; align-items:flex-start; }
        .sb-unit { font-size:1.4rem; color:var(--red); margin-top:.4rem; }
        .sb-lbl { font-size:.72rem; letter-spacing:2.5px; text-transform:uppercase; color:var(--muted); margin-top:.4rem; }

        /* ── DIET ── */
        .diet-sec { background:var(--gray); }
        .diet-sec::before { content:''; position:absolute; top:-80px; right:-80px; width:500px; height:500px; background:radial-gradient(circle, rgba(230,59,46,.05) 0%,transparent 70%); pointer-events:none; }
        .diet-layout { display:grid; grid-template-columns:1fr 1.1fr; gap:5rem; align-items:center; }
        .diet-right { display:grid; grid-template-columns:1fr 1fr; gap:.8rem; }
        .dc {
            background:var(--dark); border:1px solid rgba(255,255,255,.05);
            padding:1.5rem; transition:all .35s; position:relative; overflow:hidden;
        }
        .dc::before { content:''; position:absolute; inset:0; background:var(--red); transform:scaleY(0); transform-origin:bottom; transition:transform .4s ease; z-index:0; }
        .dc:hover::before { transform:scaleY(1); }
        .dc:hover { border-color:transparent; }
        .dc:hover .dc-goal, .dc:hover .dc-title, .dc:hover .macro-lbl, .dc:hover .bar-track, .dc:hover .macro-pct { position:relative; z-index:1; }
        .dc-body { position:relative; z-index:1; }
        .dc.featured { background:var(--red); border-color:var(--red); grid-column:span 2; }
        .dc-goal { font-size:.65rem; letter-spacing:3px; text-transform:uppercase; color:var(--red); margin-bottom:.4rem; }
        .dc.featured .dc-goal { color:rgba(255,255,255,.65); }
        .dc:hover .dc-goal { color:rgba(255,255,255,.7); }
        .dc-title { font-family:'Barlow Condensed',sans-serif; font-size:1.6rem; font-weight:800; text-transform:uppercase; margin-bottom:1.1rem; }
        .macro-row { display:flex; align-items:center; gap:.8rem; margin-bottom:.4rem; font-size:.72rem; }
        .macro-lbl { width:55px; color:var(--muted); text-transform:uppercase; letter-spacing:1px; }
        .dc.featured .macro-lbl { color:rgba(255,255,255,.6); }
        .dc:hover .macro-lbl { color:rgba(255,255,255,.7); }
        .bar-track { flex:1; height:2px; background:rgba(255,255,255,.12); border-radius:2px; overflow:hidden; }
        .bar-fill { height:100%; background:var(--red); border-radius:2px; }
        .dc.featured .bar-fill { background:rgba(255,255,255,.85); }
        .dc:hover .bar-fill { background:rgba(255,255,255,.85); }
        .macro-pct { font-size:.68rem; color:var(--muted); min-width:32px; text-align:right; }
        .dc.featured .macro-pct { color:rgba(255,255,255,.65); }
        .dc:hover .macro-pct { color:rgba(255,255,255,.7); }

        /* ── PROGRESS / BMI ── */
        .bmi-sec { background:var(--darker); }
        .bmi-layout { display:grid; grid-template-columns:1fr 1fr; gap:5rem; align-items:center; }
        .bmi-box { background:var(--gray); border:1px solid rgba(255,255,255,.06); padding:2.5rem; }
        .bmi-box-title { font-family:'Barlow Condensed',sans-serif; font-size:1.4rem; font-weight:800; text-transform:uppercase; margin-bottom:2rem; display:flex; align-items:center; gap:1rem; }
        .bmi-box-title::after { content:''; flex:1; height:1px; background:rgba(255,255,255,.07); }
        .inp-group { margin-bottom:1.2rem; }
        .inp-lbl { font-size:.68rem; letter-spacing:2.5px; text-transform:uppercase; color:var(--muted); display:block; margin-bottom:.5rem; }
        .inp { width:100%; background:var(--darker); border:1px solid rgba(255,255,255,.08); color:var(--white); padding:.85rem 1.1rem; font-family:'Barlow',sans-serif; font-size:.95rem; outline:none; transition:border-color .3s; }
        .inp:focus { border-color:var(--red); }
        .inp-row { display:grid; grid-template-columns:1fr 1fr; gap:.8rem; }
        .bmi-submit { width:100%; background:var(--red); color:var(--white); border:none; padding:1rem; font-family:'Barlow',sans-serif; font-size:.85rem; font-weight:700; letter-spacing:3px; text-transform:uppercase; cursor:none; transition:all .3s; margin-top:.5rem; }
        .bmi-submit:hover { background:var(--white); color:var(--dark); }
        .bmi-result { margin-top:1.2rem; padding:1.5rem; background:var(--darker); border:1px solid rgba(255,255,255,.06); display:none; }
        .bmi-result.show { display:block; }
        .bmi-big { font-family:'Bebas Neue',sans-serif; font-size:4.5rem; color:var(--red); line-height:1; }
        .bmi-cat { font-size:.75rem; letter-spacing:2px; text-transform:uppercase; color:var(--muted); margin-top:.3rem; }
        .bmi-scale { display:flex; height:4px; border-radius:2px; overflow:hidden; margin-top:1rem; }
        .bmi-scale span { flex:1; }
        .bmi-scale span:nth-child(1) { background:#5b9bd5; }
        .bmi-scale span:nth-child(2) { background:#70b86e; }
        .bmi-scale span:nth-child(3) { background:#f0b429; }
        .bmi-scale span:nth-child(4) { background:#e05c2e; }

        /* ── COACHES ── */
        .coaches-sec { background:var(--gray); }
        .coaches-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:1.5rem; margin-top:3rem; }
        .coach-card { background:var(--dark); border:1px solid rgba(255,255,255,.05); overflow:hidden; transition:transform .4s, box-shadow .4s; }
        .coach-card:hover { transform:translateY(-8px); box-shadow:0 30px 60px rgba(0,0,0,.5); }
        .coach-img { width:100%; height:280px; object-fit:cover; object-position:top; display:block; filter:saturate(.7); transition:filter .4s; }
        .coach-card:hover .coach-img { filter:saturate(1); }
        .coach-info { padding:1.5rem; }
        .coach-role { font-size:.65rem; letter-spacing:3px; text-transform:uppercase; color:var(--red); margin-bottom:.3rem; }
        .coach-name { font-family:'Barlow Condensed',sans-serif; font-size:1.6rem; font-weight:800; text-transform:uppercase; }
        .coach-spec { font-size:.8rem; color:var(--muted); margin-top:.4rem; }

        /* ── TRANSFORM CTA ── */
        .cta-sec {
            position:relative; overflow:hidden;
            min-height:500px; display:flex; align-items:center; justify-content:center;
            text-align:center;
        }
        .cta-bg {
            position:absolute; inset:0; z-index:0;
            background-image:url('https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=1600&q=80');
            background-size:cover; background-position:center;
        }
        .cta-bg::after { content:''; position:absolute; inset:0; background:rgba(230,59,46,.88); }
        .cta-content { position:relative; z-index:1; padding:6rem 5rem; }
        .cta-ghost { font-family:'Bebas Neue',sans-serif; font-size:22vw; color:rgba(255,255,255,.04); position:absolute; top:50%; left:50%; transform:translate(-50%,-50%); white-space:nowrap; pointer-events:none; z-index:0; }
        .cta-title { font-family:'Barlow Condensed',sans-serif; font-size:clamp(3.5rem,8vw,7rem); font-weight:900; text-transform:uppercase; line-height:.92; margin-bottom:1.5rem; position:relative; z-index:1; }
        .cta-sub { font-size:1.1rem; color:rgba(255,255,255,.72); font-weight:300; margin-bottom:3rem; position:relative; z-index:1; }
        .cta-btn { background:var(--white); color:var(--red); padding:1.2rem 3.5rem; text-decoration:none; font-size:.88rem; font-weight:800; letter-spacing:3px; text-transform:uppercase; transition:all .3s; display:inline-block; position:relative; z-index:1; clip-path:polygon(0 0,calc(100% - 10px) 0,100% 10px,100% 100%,10px 100%,0 calc(100% - 10px)); }
        .cta-btn:hover { background:var(--dark); color:var(--white); }

        /* ── FOOTER ── */
        footer { background:var(--darker); padding:3rem 5rem; display:flex; align-items:center; justify-content:space-between; border-top:1px solid rgba(255,255,255,.04); }
        .foot-logo { font-family:'Bebas Neue',sans-serif; font-size:1.6rem; letter-spacing:5px; }
        .foot-logo span { color:var(--red); }
        .foot-links { display:flex; gap:2rem; }
        .foot-links a { color:var(--muted); text-decoration:none; font-size:.75rem; letter-spacing:1.5px; text-transform:uppercase; transition:color .3s; }
        .foot-links a:hover { color:var(--red); }
        .foot-copy { font-size:.72rem; color:rgba(119,119,119,.6); letter-spacing:1px; }

        /* ── SCROLL PROGRESS ── */
        #prog { position:fixed; top:0; left:0; height:2px; background:var(--red); z-index:9999; width:0%; transition:width .1s; }

        /* ── UTILS ── */
        .reveal { opacity:0; transform:translateY(45px); }
        ::-webkit-scrollbar { width:3px; }
        ::-webkit-scrollbar-track { background:var(--darker); }
        ::-webkit-scrollbar-thumb { background:var(--red); border-radius:2px; }
        @media(max-width:900px) {
            nav { padding:1.2rem 2rem; }
            .hero-content { padding:0 2rem; padding-top:8rem; }
            .hero-card-wrap { display:none; }
            .sec { padding:5rem 2rem; }
            .muscles-grid { grid-template-columns:1fr 1fr; }
            .stats-bar { grid-template-columns:1fr 1fr; }
            .diet-layout, .bmi-layout { grid-template-columns:1fr; gap:3rem; }
            .coaches-grid { grid-template-columns:1fr; }
            footer { flex-direction:column; gap:1.5rem; text-align:center; }
        }
    </style>
</head>
<body>

<div id="cur"></div>
<div id="cur-ring"></div>
<div id="prog"></div>

<!-- NAV -->
<nav id="nav">
    <a href="/" class="logo">Gym<span>Pro</span></a>
    <ul class="nav-links">
        <li><a href="#muscles">Workouts</a></li>
        <li><a href="#diet">Nutrition</a></li>
        <li><a href="#bmi">BMI</a></li>
        <li><a href="#coaches">Coaches</a></li>
    </ul>
    <div class="nav-cta">
        <a href="/login" class="nav-login">Login</a>
        <a href="/register" class="nav-btn">Start Free</a>
    </div>
</nav>

<!-- HERO -->
<section class="hero">
    <div class="hero-bg" id="heroBg"></div>
    <div class="hero-noise"></div>
    <div class="hero-grid-lines"></div>
    <div class="hero-content">
        <div class="hero-pill" id="pill"><span class="dot"></span>Elite Fitness Platform</div>
        <h1 class="hero-h1" id="h1">
            FORGE<br>
            <span class="stroke">YOUR</span><br>
            <span class="accent">LIMITS</span>
        </h1>
        <p class="hero-desc" id="hdesc">Science-backed workouts by muscle group. Personalized diet charts. Real-time progress tracking. Everything you need to build the body you want.</p>
        <div class="hero-btns" id="hbtns">
            <a href="/register" class="btn-main">Start Training Free</a>
            <a href="#muscles" class="btn-ghost">Explore <span class="circle">→</span></a>
        </div>
    </div>
    <div class="hero-card-wrap" id="hcard">
        <div class="hero-card" id="tiltCard">
            <img class="hc-img" src="https://images.unsplash.com/photo-1581009146145-b5ef050c2e1e?w=600&q=80" alt="Chest Workout">
            <div class="hc-tag">Today's Focus</div>
            <div class="hc-title">Chest & Core</div>
            <div class="hc-stats">
                <div class="hc-stat"><div class="hc-num">12</div><div class="hc-lbl">Exercises</div></div>
                <div class="hc-stat"><div class="hc-num">45</div><div class="hc-lbl">Minutes</div></div>
                <div class="hc-stat"><div class="hc-num">480</div><div class="hc-lbl">Cal</div></div>
            </div>
        </div>
    </div>
</section>

<!-- TICKER -->
<div class="ticker" aria-hidden="true">
    <div style="display:inline-flex; white-space:nowrap;">
        <div class="ticker-track">
            <span class="t-item">Muscle-Based Workouts</span>
            <span class="t-item">Personalized Diet Plans</span>
            <span class="t-item">Progress Tracking</span>
            <span class="t-item">BMI Calculator</span>
            <span class="t-item">Expert Coaches</span>
            <span class="t-item">500+ Exercises</span>
            <span class="t-item">Muscle-Based Workouts</span>
            <span class="t-item">Personalized Diet Plans</span>
            <span class="t-item">Progress Tracking</span>
            <span class="t-item">BMI Calculator</span>
            <span class="t-item">Expert Coaches</span>
            <span class="t-item">500+ Exercises</span>
        </div>
    </div>
</div>

<!-- MUSCLES -->
<section class="sec" id="muscles">
    <div class="muscle-intro">
        <div class="reveal">
            <div class="sec-label">Train Smart</div>
            <h2 class="sec-title">TRAIN BY<br><span class="ghost">MUSCLE</span></h2>
        </div>
        <div class="reveal">
            <p>Choose your target muscle group and access science-backed workouts designed by certified trainers. Every exercise includes video demos, tips, and progress tracking.</p>
            <a href="/register" class="btn-main" style="display:inline-block;margin-top:2rem;">View All Workouts</a>
        </div>
    </div>
    <div class="muscles-grid">
        <div class="mc reveal">
            <img class="mc-img" src="https://images.unsplash.com/photo-1534367610401-9f5ed68180aa?w=600&q=80" alt="Chest">
            <div class="mc-overlay"></div>
            <div class="mc-num">01</div>
            <div class="mc-body"><div class="mc-name">Chest</div><div class="mc-count">24 Exercises</div></div>
            <div class="mc-arrow">→</div>
        </div>
        <div class="mc reveal">
            <img class="mc-img" src="https://images.unsplash.com/photo-1532029837206-abbe2b7620e3?w=600&q=80" alt="Back">
            <div class="mc-overlay"></div>
            <div class="mc-num">02</div>
            <div class="mc-body"><div class="mc-name">Back</div><div class="mc-count">32 Exercises</div></div>
            <div class="mc-arrow">→</div>
        </div>
        <div class="mc reveal">
            <img class="mc-img" src="https://images.unsplash.com/photo-1541534741688-6078c6bfb5c5?w=600&q=80" alt="Shoulders">
            <div class="mc-overlay"></div>
            <div class="mc-num">03</div>
            <div class="mc-body"><div class="mc-name">Shoulders</div><div class="mc-count">18 Exercises</div></div>
            <div class="mc-arrow">→</div>
        </div>
        <div class="mc reveal">
            <img class="mc-img" src="https://images.unsplash.com/photo-1434608519344-49d77a699e1d?w=600&q=80" alt="Legs">
            <div class="mc-overlay"></div>
            <div class="mc-num">04</div>
            <div class="mc-body"><div class="mc-name">Legs</div><div class="mc-count">28 Exercises</div></div>
            <div class="mc-arrow">→</div>
        </div>
        <div class="mc reveal">
            <img class="mc-img" src="https://images.unsplash.com/photo-1581009137042-c552e485697a?w=600&q=80" alt="Arms">
            <div class="mc-overlay"></div>
            <div class="mc-num">05</div>
            <div class="mc-body"><div class="mc-name">Arms</div><div class="mc-count">20 Exercises</div></div>
            <div class="mc-arrow">→</div>
        </div>
        <div class="mc reveal">
            <img class="mc-img" src="https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=600&q=80" alt="Core">
            <div class="mc-overlay"></div>
            <div class="mc-num">06</div>
            <div class="mc-body"><div class="mc-name">Core</div><div class="mc-count">16 Exercises</div></div>
            <div class="mc-arrow">→</div>
        </div>
    </div>
</section>

<!-- STATS -->
<div class="stats-bar" id="stats">
    <div class="sb reveal">
        <div class="sb-num"><span class="cnt" data-t="500">0</span><span class="sb-unit">+</span></div>
        <div class="sb-lbl">Exercises Available</div>
    </div>
    <div class="sb reveal">
        <div class="sb-num"><span class="cnt" data-t="50">0</span><span class="sb-unit">+</span></div>
        <div class="sb-lbl">Diet Plans</div>
    </div>
    <div class="sb reveal">
        <div class="sb-num"><span class="cnt" data-t="10">0</span><span class="sb-unit">K+</span></div>
        <div class="sb-lbl">Active Members</div>
    </div>
    <div class="sb reveal">
        <div class="sb-num"><span class="cnt" data-t="98">0</span><span class="sb-unit">%</span></div>
        <div class="sb-lbl">Success Rate</div>
    </div>
</div>

<!-- DIET -->
<section class="sec diet-sec" id="diet">
    <div class="diet-layout">
        <div class="reveal">
            <div class="sec-label">Fuel Your Body</div>
            <h2 class="sec-title">SMART<br><span class="ghost">NUTRITION</span></h2>
            <p style="color:rgba(245,245,240,.5);line-height:1.8;margin-top:1.5rem;font-size:1rem;font-weight:300;max-width:400px;">Personalized diet charts based on your goal — bulking, cutting, or maintaining. Macro-balanced, calorie-tracked meal plans built for real results.</p>
            <a href="/register" class="btn-main" style="display:inline-block;margin-top:2rem;">View Diet Plans</a>
        </div>
        <div class="diet-right reveal">
            <div class="dc featured">
                <div class="dc-body">
                    <div class="dc-goal">Muscle Gain</div>
                    <div class="dc-title">Bulk Plan — 3200 kcal</div>
                    <div class="macro-row"><span class="macro-lbl">Protein</span><div class="bar-track"><div class="bar-fill" style="width:40%"></div></div><span class="macro-pct">40%</span></div>
                    <div class="macro-row"><span class="macro-lbl">Carbs</span><div class="bar-track"><div class="bar-fill" style="width:40%"></div></div><span class="macro-pct">40%</span></div>
                    <div class="macro-row"><span class="macro-lbl">Fats</span><div class="bar-track"><div class="bar-fill" style="width:20%"></div></div><span class="macro-pct">20%</span></div>
                </div>
            </div>
            <div class="dc">
                <div class="dc-body">
                    <div class="dc-goal">Fat Loss</div>
                    <div class="dc-title">Cut Plan — 1800 kcal</div>
                    <div class="macro-row"><span class="macro-lbl">Protein</span><div class="bar-track"><div class="bar-fill" style="width:45%"></div></div><span class="macro-pct">45%</span></div>
                    <div class="macro-row"><span class="macro-lbl">Carbs</span><div class="bar-track"><div class="bar-fill" style="width:30%"></div></div><span class="macro-pct">30%</span></div>
                    <div class="macro-row"><span class="macro-lbl">Fats</span><div class="bar-track"><div class="bar-fill" style="width:25%"></div></div><span class="macro-pct">25%</span></div>
                </div>
            </div>
            <div class="dc">
                <div class="dc-body">
                    <div class="dc-goal">Stay Fit</div>
                    <div class="dc-title">Maintain — 2400 kcal</div>
                    <div class="macro-row"><span class="macro-lbl">Protein</span><div class="bar-track"><div class="bar-fill" style="width:35%"></div></div><span class="macro-pct">35%</span></div>
                    <div class="macro-row"><span class="macro-lbl">Carbs</span><div class="bar-track"><div class="bar-fill" style="width:40%"></div></div><span class="macro-pct">40%</span></div>
                    <div class="macro-row"><span class="macro-lbl">Fats</span><div class="bar-track"><div class="bar-fill" style="width:25%"></div></div><span class="macro-pct">25%</span></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- BMI -->
<section class="sec bmi-sec" id="bmi">
    <div class="bmi-layout">
        <div class="reveal">
            <div class="sec-label">Know Your Body</div>
            <h2 class="sec-title">BMI<br><span class="ghost">CALCULATOR</span></h2>
            <p style="color:rgba(245,245,240,.5);line-height:1.8;margin-top:1.5rem;font-size:1rem;font-weight:300;max-width:400px;">Instantly calculate your Body Mass Index and get personalized workout & diet recommendations tailored to your body stats and fitness goals.</p>
        </div>
        <div class="bmi-box reveal">
            <div class="bmi-box-title">Calculate Your BMI</div>
            <div class="inp-row">
                <div class="inp-group"><label class="inp-lbl">Height (cm)</label><input type="number" class="inp" id="ht" placeholder="e.g. 175"></div>
                <div class="inp-group"><label class="inp-lbl">Weight (kg)</label><input type="number" class="inp" id="wt" placeholder="e.g. 70"></div>
            </div>
            <div class="inp-group"><label class="inp-lbl">Age</label><input type="number" class="inp" id="age" placeholder="e.g. 25"></div>
            <button class="bmi-submit" onclick="calcBMI()">Calculate BMI</button>
            <div class="bmi-result" id="bmiRes">
                <div class="bmi-big" id="bmiVal">—</div>
                <div class="bmi-cat" id="bmiCat">—</div>
                <div class="bmi-scale"><span></span><span></span><span></span><span></span></div>
            </div>
        </div>
    </div>
</section>

<!-- COACHES -->
<section class="sec coaches-sec" id="coaches">
    <div class="reveal" style="text-align:center;margin-bottom:0;">
        <div class="sec-label" style="justify-content:center;">Expert Team</div>
        <h2 class="sec-title" style="text-align:center;">MEET YOUR<br><span class="ghost">COACHES</span></h2>
    </div>
    <div class="coaches-grid">
        <div class="coach-card reveal">
            <img class="coach-img" src="https://images.unsplash.com/photo-1571019614242-c5c5dee9f50b?w=600&q=80" alt="Coach">
            <div class="coach-info">
                <div class="coach-role">Head Trainer</div>
                <div class="coach-name">Arjun Sharma</div>
                <div class="coach-spec">Strength & Hypertrophy · 8 Years Exp</div>
            </div>
        </div>
        <div class="coach-card reveal">
            <img class="coach-img" src="https://images.unsplash.com/photo-1609899537878-48e34e6c8b3c?w=600&q=80" alt="Coach">
            <div class="coach-info">
                <div class="coach-role">Nutrition Coach</div>
                <div class="coach-name">Priya Menon</div>
                <div class="coach-spec">Sports Nutrition · Certified Dietitian</div>
            </div>
        </div>
        <div class="coach-card reveal">
            <img class="coach-img" src="https://images.unsplash.com/photo-1567013127542-490d757e51fc?w=600&q=80" alt="Coach">
            <div class="coach-info">
                <div class="coach-role">Cardio Specialist</div>
                <div class="coach-name">Vikram Nair</div>
                <div class="coach-spec">HIIT & Endurance · 6 Years Exp</div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="cta-sec">
    <div class="cta-bg"></div>
    <div class="cta-ghost">JOIN</div>
    <div class="cta-content">
        <h2 class="cta-title reveal">READY TO<br>TRANSFORM?</h2>
        <p class="cta-sub reveal">Join 10,000+ athletes already training smarter with GymPro.</p>
        <a href="/register" class="cta-btn reveal">Create Free Account →</a>
    </div>
</section>

<!-- FOOTER -->
<footer>
    <div class="foot-logo">Gym<span>Pro</span></div>
    <div class="foot-links">
        <a href="#">Workouts</a>
        <a href="#">Nutrition</a>
        <a href="#">Coaches</a>
        <a href="#">Contact</a>
    </div>
    <div class="foot-copy">© 2026 GymPro · Built for Champions</div>
</footer>

<script>
gsap.registerPlugin(ScrollTrigger);

// ── CURSOR ──
const cur = document.getElementById('cur');
const ring = document.getElementById('cur-ring');
let mx=0,my=0,rx=0,ry=0;
document.addEventListener('mousemove', e => {
    mx=e.clientX; my=e.clientY;
    cur.style.left=mx+'px'; cur.style.top=my+'px';
});
(function loop(){
    rx+=(mx-rx)*.1; ry+=(my-ry)*.1;
    ring.style.left=rx+'px'; ring.style.top=ry+'px';
    requestAnimationFrame(loop);
})();
document.querySelectorAll('a,button').forEach(el=>{
    el.addEventListener('mouseenter',()=>{ ring.style.width='60px'; ring.style.height='60px'; ring.style.borderColor='rgba(230,59,46,.9)'; });
    el.addEventListener('mouseleave',()=>{ ring.style.width='38px'; ring.style.height='38px'; ring.style.borderColor='rgba(230,59,46,.5)'; });
});

// ── SCROLL PROGRESS ──
window.addEventListener('scroll',()=>{
    const p=(window.scrollY/(document.body.scrollHeight-window.innerHeight))*100;
    document.getElementById('prog').style.width=p+'%';
    document.getElementById('nav').classList.toggle('scrolled',window.scrollY>60);
});

// ── HERO ANIM ──
gsap.timeline()
    .to('#pill',{opacity:1,y:0,duration:.6,delay:.3})
    .to('#h1',{opacity:1,y:0,duration:.9},'-=.2')
    .to('#hdesc',{opacity:1,y:0,duration:.6},'-=.4')
    .to('#hbtns',{opacity:1,y:0,duration:.6},'-=.3')
    .to('#hcard',{opacity:1,x:0,duration:.9,ease:'power3.out'},'-=.7');

// ── PARALLAX HERO BG ──
window.addEventListener('scroll',()=>{
    document.getElementById('heroBg').style.transform=`scale(1.05) translateY(${window.scrollY*.18}px)`;
});

// ── 3D TILT CARD ──
const tilt=document.getElementById('tiltCard');
if(tilt){
    document.addEventListener('mousemove',e=>{
        const r=tilt.getBoundingClientRect();
        const cx=r.left+r.width/2, cy=r.top+r.height/2;
        const ry2=(e.clientX-cx)/20, rx2=-(e.clientY-cy)/20;
        tilt.style.transform=`perspective(900px) rotateX(${rx2}deg) rotateY(${ry2}deg)`;
    });
    gsap.to('#tiltCard',{y:-14,duration:2.8,repeat:-1,yoyo:true,ease:'sine.inOut'});
}

// ── SCROLL REVEAL ──
gsap.utils.toArray('.reveal').forEach(el=>{
    gsap.fromTo(el,{opacity:0,y:48},{
        opacity:1,y:0,duration:.85,ease:'power2.out',
        scrollTrigger:{trigger:el,start:'top 88%',toggleActions:'play none none none'}
    });
});

// ── COUNTERS ──
gsap.utils.toArray('.cnt').forEach(el=>{
    ScrollTrigger.create({trigger:el,start:'top 88%',once:true,onEnter:()=>{
        const target=+el.dataset.t, dur=1800, step=target/dur*16;
        let v=0;
        const t=setInterval(()=>{
            v+=step; if(v>=target){v=target;clearInterval(t);}
            el.textContent=Math.floor(v);
        },16);
    }});
});

// ── BMI CALC ──
function calcBMI(){
    const h=parseFloat(document.getElementById('ht').value)/100;
    const w=parseFloat(document.getElementById('wt').value);
    if(!h||!w||h<=0||w<=0){alert('Please enter valid values!');return;}
    const bmi=(w/(h*h)).toFixed(1);
    let cat='';
    if(bmi<18.5) cat='Underweight — Increase calories & protein intake';
    else if(bmi<25) cat='Normal Weight — Keep up your routine!';
    else if(bmi<30) cat='Overweight — Focus on cardio & calorie deficit';
    else cat='Obese — Consult a fitness expert ASAP';
    document.getElementById('bmiVal').textContent=bmi;
    document.getElementById('bmiCat').textContent=cat;
    const res=document.getElementById('bmiRes');
    res.classList.add('show');
    gsap.fromTo(res,{opacity:0,y:20},{opacity:1,y:0,duration:.5});
}
</script>
</body>
</html>
