<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Barlow:ital,wght@0,300;0,400;0,500;0,600;0,700;0,900;1,300&family=Barlow+Condensed:wght@600;700;800;900&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            :root {
                --red: #E63B2E;
                --red2: #ff4d3d;
                --dark: #080808;
                --darker: #030303;
                --gray: #141414;
                --gray2: #1e1e1e;
                --white: #f5f5f0;
                --muted: #9a9a95;
            }

            body.app-shell {
                background: var(--darker);
                color: var(--white);
                font-family: 'Barlow', sans-serif;
            }

            .app-heading {
                font-family: 'Barlow Condensed', sans-serif;
                font-weight: 900;
                text-transform: uppercase;
                letter-spacing: -1px;
                color: var(--white);
            }

            .app-eyebrow {
                font-size: .72rem;
                letter-spacing: 3px;
                text-transform: uppercase;
                color: var(--red);
                font-weight: 700;
            }

            .app-card {
                background: var(--gray);
                border: 1px solid rgba(255,255,255,.08);
                border-radius: .75rem;
                transition: border-color .25s, transform .25s;
            }
            a.app-card:hover, .app-card.hoverable:hover {
                border-color: rgba(230,59,46,.5);
                transform: translateY(-2px);
            }

            .app-input, .app-select {
                background: var(--dark);
                border: 1px solid rgba(255,255,255,.12);
                color: var(--white);
                border-radius: .5rem;
                padding: .6rem .85rem;
                font-family: 'Barlow', sans-serif;
                width: 100%;
                outline: none;
                transition: border-color .2s;
            }
            .app-input::placeholder { color: var(--muted); }
            .app-input:focus, .app-select:focus { border-color: var(--red); }

            .app-label {
                font-size: .68rem;
                letter-spacing: 2px;
                text-transform: uppercase;
                color: var(--muted);
                font-weight: 600;
                display: block;
                margin-bottom: .4rem;
            }

            .app-btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: .5rem;
                background: var(--red);
                color: var(--white) !important;
                border: none;
                padding: .65rem 1.5rem;
                font-family: 'Barlow', sans-serif;
                font-size: .8rem;
                font-weight: 700;
                letter-spacing: 1.5px;
                text-transform: uppercase;
                border-radius: .4rem;
                text-decoration: none;
                cursor: pointer;
                transition: background .25s;
            }
            .app-btn:hover { background: var(--red2); }

            .app-btn-outline {
                background: transparent;
                border: 1px solid rgba(255,255,255,.2);
                color: var(--white) !important;
            }
            .app-btn-outline:hover { background: rgba(255,255,255,.06); border-color: rgba(255,255,255,.4); }

            .app-btn-ghost {
                background: rgba(255,255,255,.05);
                color: var(--white) !important;
            }
            .app-btn-ghost:hover { background: rgba(255,255,255,.1); }

            .app-btn.active { background: var(--red); }

            .app-badge {
                font-size: .68rem;
                font-weight: 700;
                letter-spacing: 1px;
                text-transform: uppercase;
                padding: .25rem .65rem;
                border-radius: 999px;
                white-space: nowrap;
            }
            .app-badge-red { background: rgba(230,59,46,.15); color: var(--red2); }
            .app-badge-green { background: rgba(46,204,113,.15); color: #6fe3a0; }
            .app-badge-yellow { background: rgba(241,196,15,.15); color: #f6d365; }
            .app-badge-blue { background: rgba(52,152,219,.15); color: #7fc4ea; }
            .app-badge-gray { background: rgba(255,255,255,.08); color: var(--muted); }

            .app-muted { color: var(--muted); }
            .app-link { color: var(--red2); text-decoration: none; }
            .app-link:hover { color: var(--white); }

            .app-divide > * + * { border-top: 1px solid rgba(255,255,255,.06); }
        </style>
    </head>
    <body class="app-shell font-sans antialiased">
        <div class="min-h-screen">
            <livewire:layout.navigation />

            <!-- Page Heading -->
            @if (isset($header))
                <header style="background: var(--dark); border-bottom: 1px solid rgba(255,255,255,.06);">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
