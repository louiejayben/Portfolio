
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @php
        $displayTemplate = match ($portfolio->template) {
            'classic' => 'simple',
            'minimal' => 'creative',
            default => $portfolio->template,
        };
    @endphp

    <title>{{ $portfolio->full_name }} | Portfolio</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            --accent: #dfff9a;
            --surface: #141414;
            --border: #303030;

            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #0b0b0b;
            color: #f5f5f5;
            line-height: 1.7;
            overflow-wrap: anywhere;
        }

        a {
            color: var(--accent);
            overflow-wrap: anywhere;
        }

        /* =========================================
           TEMPLATE 1: SIMPLE
        ========================================= */

        body.template-simple {
            --accent: #315b3a;
            --surface: #ffffff;
            --border: #dfe7df;

            background: #f5f7f5;
            color: #222c24;
        }

        .template-simple .profile {
            border-radius: 8px;
            border-top: 4px solid var(--accent);
            box-shadow: none;
        }

        .template-simple .avatar {
            border-radius: 8px;
        }

        .template-simple .section {
            border-radius: 8px;
            box-shadow: none;
        }

        .template-simple .badge {
            background: #e6efe7;
            color: #315b3a;
        }

        .template-simple .subtitle,
        .template-simple .contact {
            color: #4d5b50;
        }

        /* =========================================
           TEMPLATE 2: MODERN
        ========================================= */

        body.template-modern {
            --accent: #dfff9a;
            --surface: #141414;
            --border: #303030;

            background: #0b0b0b;
            color: #f5f5f5;
        }

        .template-modern .profile,
        .template-modern .section {
            border-radius: 14px;
        }

        .template-modern .avatar {
            border-radius: 50%;
        }

        .template-modern .badge {
            background: var(--accent);
            color: #111111;
        }

        /* =========================================
           TEMPLATE 3: CREATIVE
        ========================================= */

        body.template-creative {
            --accent: #ffca7a;
            --surface: #211830;
            --border: #514063;

            background: #130d1d;
            color: #faf4ff;
        }

        .template-creative .topbar {
            border-bottom-color: var(--border);
            background: #1b1326;
        }

        .template-creative .brand {
            letter-spacing: 3px;
        }

        .template-creative .profile {
            border-radius: 24px;
            border: 1px solid var(--border);
            background: linear-gradient(135deg, #30203e, #191225);
            box-shadow: 0 14px 36px rgba(0, 0, 0, 0.2);
        }

        .template-creative .profile h1 {
            color: var(--accent);
            font-size: clamp(32px, 5vw, 48px);
        }

        .template-creative .avatar {
            border-radius: 28%;
            border: 3px solid var(--accent);
        }

        .template-creative .section {
            border-radius: 16px;
            border: 1px solid var(--border);
            border-left: 5px solid var(--accent);
            background: #211830;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.16);
        }

        .template-creative .section h2 {
            border-bottom-color: var(--border);
            color: var(--accent);
        }

        .template-creative .badge {
            border-radius: 999px;
            background: var(--accent);
            color: #24162e;
        }

        .template-creative .subtitle,
        .template-creative .contact {
            color: #e1d5ef;
        }

        .template-creative .section:nth-of-type(even) {
            margin-left: 25px;
        }

        /* =========================================
           SHARED NAVIGATION
        ========================================= */

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 14px;
            padding: 18px 6%;
            border-bottom: 1px solid var(--border);
            background: var(--surface);
        }

        .brand {
            color: var(--accent);
            font-size: 13px;
            font-weight: 800;
            letter-spacing: 2px;
        }

        .topbar-actions {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 10px;
        }

        .back-button,
        .print-button {
            display: inline-block;
            padding: 9px 13px;
            border: 1px solid var(--accent);
            border-radius: 6px;
            background: transparent;
            color: var(--accent);
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
        }

        .back-button:hover,
        .print-button:hover {
            background: var(--accent);
            color: #111;
        }

        /* =========================================
           PORTFOLIO LAYOUT
        ========================================= */

        .container {
            width: 90%;
            max-width: 1000px;
            margin: 45px auto;
        }

        .profile {
            display: flex;
            align-items: center;
            gap: 28px;
            min-width: 0;
            padding: 32px;
            border: 1px solid var(--border);
            border-radius: 14px;
            background: var(--surface);
        }

        .avatar {
            display: block;
            width: 145px;
            height: 145px;
            flex-shrink: 0;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid var(--accent);
            background: var(--surface);
        }

        .profile h1 {
            margin: 0 0 8px;
            font-size: clamp(30px, 5vw, 44px);
            line-height: 1.2;
            overflow-wrap: anywhere;
        }

        .profile-info {
            min-width: 0;
            flex: 1;
        }

        .subtitle {
            margin: 0 0 10px;
            opacity: 0.8;
        }

        .contact {
            margin: 5px 0;
            font-size: 14px;
            overflow-wrap: anywhere;
        }

        .badge {
            display: inline-block;
            margin-top: 12px;
            padding: 5px 10px;
            border-radius: 5px;
            background: var(--accent);
            color: #111;
            font-size: 12px;
            font-weight: 700;
            text-transform: capitalize;
        }

        .section {
            margin-top: 22px;
            min-width: 0;
            padding: 28px 32px;
            border: 1px solid var(--border);
            border-radius: 12px;
            background: var(--surface);
        }

        .section h2 {
            margin: 0 0 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid var(--border);
            font-size: 21px;
        }

        .section p {
            margin: 8px 0;
            overflow-wrap: anywhere;
            white-space: pre-line;
        }

        .links {
            display: flex;
            flex-wrap: wrap;
            gap: 12px 20px;
        }

        .links a {
            font-size: 14px;
            font-weight: 600;
        }

        .footer {
            margin-top: 30px;
            padding: 20px 0;
            text-align: center;
            opacity: 0.65;
            font-size: 12px;
        }

        /* =========================================
           MOBILE RESPONSIVENESS
        ========================================= */

        @media (max-width: 600px) {
            .topbar {
                padding: 15px 5%;
            }

            .topbar-actions {
                width: 100%;
                gap: 8px;
            }

            .back-button,
            .print-button {
                padding: 9px 10px;
                font-size: 12px;
            }

            .container {
                width: 92%;
                margin: 25px auto;
            }

            .profile {
                flex-direction: column;
                align-items: flex-start;
                gap: 18px;
                padding: 23px;
            }

            .avatar {
                width: 110px;
                height: 110px;
            }

            .profile h1 {
                font-size: 30px;
            }

            .section {
                margin-top: 16px;
                padding: 22px;
            }

            .template-creative .section:nth-of-type(even) {
                margin-left: 0;
            }

            .links {
                flex-direction: column;
                gap: 10px;
            }
        }

        /* =========================================
           PRINT / SAVE AS PDF
        ========================================= */

        @media print {
            body,
            .profile,
            .section {
                background: #ffffff !important;
                color: #111111 !important;
                box-shadow: none !important;
            }

            .topbar-actions,
            .footer {
                display: none !important;
            }

            .topbar {
                background: #ffffff !important;
            }

            .brand,
            .section h2,
            .profile h1 {
                color: #111111 !important;
            }

            .container {
                width: 100%;
                max-width: none;
                margin: 0;
            }

            .profile,
            .section {
                break-inside: avoid;
                border-color: #dddddd;
            }

            a {
                color: #111111 !important;
                text-decoration: none;
            }
        }
    </style>
</head>

<body class="template-{{ $displayTemplate }}">

    <header class="topbar">
        <div class="brand">PORTFOLIO GENERATOR</div>

        <div class="topbar-actions">
            <button
                type="button"
                class="back-button"
                onclick="goBack()"
            >
                ← Back
            </button>

            <button
                type="button"
                class="print-button"
                onclick="window.print()"
            >
                Print / Save PDF
            </button>
        </div>
    </header>

    <main class="container">

        <section class="profile">
            @if ($portfolio->photo_path)
                <img
                    class="avatar"
                    src="{{ '/storage/' . ltrim($portfolio->photo_path, '/') }}"
                    alt="Profile picture of {{ $portfolio->full_name }}"
                    onerror="this.hidden = true"
                >
            @endif

            <div class="profile-info">
                <h1>{{ $portfolio->full_name }}</h1>

                <p class="subtitle">
                    {{ $portfolio->position ?: 'Professional Portfolio' }}
                </p>

                @if ($portfolio->email)
                    <p class="contact">
                        <a href="mailto:{{ $portfolio->email }}">
                            {{ $portfolio->email }}
                        </a>
                    </p>
                @endif

                @if ($portfolio->contact_number)
                    <p class="contact">
                        Contact: {{ $portfolio->contact_number }}
                    </p>
                @endif

                @if ($portfolio->address)
                    <p class="contact">
                        Address: {{ $portfolio->address }}
                    </p>
                @endif

                <span class="badge">
                    {{ $displayTemplate }} template
                </span>
            </div>
        </section>

        @if ($portfolio->about_me)
            <section class="section">
                <h2>About Me</h2>
                <p>{{ $portfolio->about_me }}</p>
            </section>
        @endif

        @if ($portfolio->education)
            <section class="section">
                <h2>Education</h2>
                <p>{{ $portfolio->education }}</p>
            </section>
        @endif

        @if ($portfolio->skills)
            <section class="section">
                <h2>Skills</h2>
                <p>{{ $portfolio->skills }}</p>
            </section>
        @endif

        @if ($portfolio->project || $portfolio->project_link)
            <section class="section">
                <h2>Projects</h2>

                @if ($portfolio->project)
                    <p>{{ $portfolio->project }}</p>
                @endif

                @if ($portfolio->project_link)
                    <p>
                        <a
                            href="{{ $portfolio->project_link }}"
                            target="_blank"
                            rel="noopener noreferrer"
                        >
                            View Project
                        </a>
                    </p>
                @endif
            </section>
        @endif

        @if ($portfolio->company || $portfolio->position || $portfolio->work_description)
            <section class="section">
                <h2>Work Experience</h2>

                @if ($portfolio->position)
                    <p><strong>{{ $portfolio->position }}</strong></p>
                @endif

                @if ($portfolio->company)
                    <p>{{ $portfolio->company }}</p>
                @endif

                @if ($portfolio->work_description)
                    <p>{{ $portfolio->work_description }}</p>
                @endif
            </section>
        @endif

        @if ($portfolio->website || $portfolio->facebook || $portfolio->linkedin || $portfolio->github)
            <section class="section">
                <h2>Links and Social Media</h2>

                <div class="links">
                    @foreach ([
                        'website' => 'Personal Website',
                        'facebook' => 'Facebook',
                        'linkedin' => 'LinkedIn',
                        'github' => 'GitHub'
                    ] as $field => $label)
                        @if ($portfolio->$field)
                            <a
                                href="{{ $portfolio->$field }}"
                                target="_blank"
                                rel="noopener noreferrer"
                            >
                                {{ $label }}
                            </a>
                        @endif
                    @endforeach
                </div>
            </section>
        @endif

        <footer class="footer">
            Portfolio created with Portfolio Generator
        </footer>

    </main>

    <script>
        function goBack() {
            if (window.history.length > 1) {
                window.history.back();
            } else {
                // Keep the public page accessible if it was opened directly.
                window.location.reload();
            }
        }
    </script>

</body>
</html>