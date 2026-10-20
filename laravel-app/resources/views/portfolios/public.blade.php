<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $portfolio->full_name }} | Portfolio</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #0b0b0b;
            color: #f5f5f5;
            line-height: 1.7;
        }

        a {
            color: var(--accent);
            overflow-wrap: anywhere;
        }

        .template-modern {
            --accent: #dfff9a;
            --surface: #141414;
            --border: #303030;
        }

        .template-classic {
            --accent: #75512b;
            --surface: #fffdf8;
            --border: #ded4c5;
            background: #f0e9dc;
            color: #30291f;
        }

        .template-minimal {
            --accent: #607d63;
            --surface: #ffffff;
            --border: #e5e5e5;
            background: #ffffff;
            color: #222222;
        }

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

@media (max-width: 600px) {
    .topbar {
        padding: 15px 5%;
    }

    .topbar-actions {
        width: 100%;
    }
}

@media print {
    .topbar-actions {
        display: none;
    }
}

        .brand {
            color: var(--accent);
            font-weight: 800;
            font-size: 13px;
            letter-spacing: 2px;
        }

        .container {
            width: 90%;
            max-width: 1000px;
            margin: 45px auto;
        }

        .profile {
            display: flex;
            align-items: center;
            gap: 28px;
            padding: 32px;
            border: 1px solid var(--border);
            border-radius: 14px;
            background: var(--surface);
        }

        .template-classic .profile {
            border-radius: 2px;
            border-top: 5px solid var(--accent);
        }

        .template-minimal .profile,
        .template-minimal .section {
            border-radius: 0;
            box-shadow: none;
        }

        .avatar {
            width: 145px;
            height: 145px;
            flex-shrink: 0;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid var(--accent);
        }

        .profile h1 {
            margin: 0 0 8px;
            font-size: clamp(30px, 5vw, 44px);
            line-height: 1.2;
            overflow-wrap: anywhere;
        }

        .subtitle,
        .contact {
            overflow-wrap: anywhere;
        }

        .subtitle {
            margin: 0 0 10px;
            opacity: 0.75;
        }

        .contact {
            margin: 5px 0;
            font-size: 14px;
        }

        .badge {
            display: inline-block;
            margin-top: 12px;
            padding: 5px 10px;
            border-radius: 5px;
            background: var(--accent);
            color: #111111;
            font-size: 12px;
            font-weight: 700;
            text-transform: capitalize;
        }

        .section {
            margin-top: 22px;
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

        .empty-value {
            opacity: 0.65;
            font-style: italic;
        }

        .footer {
            margin-top: 30px;
            padding: 20px 0;
            text-align: center;
            opacity: 0.65;
            font-size: 12px;
        }

        @media (max-width: 600px) {
            .container {
                margin: 25px auto;
            }

            .profile {
                flex-direction: column;
                align-items: flex-start;
                padding: 23px;
            }

            .avatar {
                width: 110px;
                height: 110px;
            }

            .section {
                padding: 22px;
            }
        }

        @media print {
            body,
            .profile,
            .section {
                background: #ffffff !important;
                color: #111111 !important;
                box-shadow: none !important;
            }

            .topbar,
            .footer {
                display: none;
            }

            .container {
                width: 100%;
                max-width: none;
                margin: 0;
            }

            a {
                color: #111111;
            }
        }
    </style>
</head>

<body class="template-{{ $portfolio->template }}">

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
                >
            @endif

            <div>
                <h1>{{ $portfolio->full_name }}</h1>

                <p class="subtitle">
                    {{ $portfolio->position ?: 'Professional Portfolio' }}
                </p>

                <p class="contact">
                    <a href="mailto:{{ $portfolio->email }}">
                        {{ $portfolio->email }}
                    </a>
                </p>

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
                    {{ $portfolio->template }} template
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
            // No previous page in this tab; stay on the public portfolio.
            window.location.reload();
        }
    }
</script>
</body>
</html>