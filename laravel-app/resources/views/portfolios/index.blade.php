<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Portfolios | Portfolio Generator</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #0b0b0b;
            color: #f5f5f5;
            font-family: Arial, Helvetica, sans-serif;
        }

        nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 20px 6%;
            background: #141414;
            border-bottom: 1px solid #292929;
        }

        .brand {
            color: #dfff9a;
            font-weight: 800;
            font-size: 14px;
            letter-spacing: 1.5px;
        }

        a {
            color: #dfff9a;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        main {
            width: 90%;
            max-width: 1050px;
            margin: 45px auto;
        }

        .heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 30px;
        }

        h1 {
            margin: 0 0 10px;
            font-size: clamp(28px, 4vw, 38px);
        }

        .subtitle {
            margin: 0;
            color: #aaa;
            line-height: 1.6;
        }

        .button {
            display: inline-block;
            padding: 13px 18px;
            border: 1px solid #dfff9a;
            border-radius: 7px;
            background: #dfff9a;
            color: #111;
            font-weight: 700;
            text-decoration: none;
        }

        .button:hover {
            background: #c9ef7b;
            text-decoration: none;
        }

        .portfolio-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
        }

        .card,
        .empty {
            padding: 25px;
            border: 1px solid #292929;
            border-radius: 12px;
            background: #141414;
        }

        .card h2 {
            margin: 0 0 12px;
            overflow-wrap: anywhere;
        }

        .card p {
            color: #aaa;
            line-height: 1.6;
            overflow-wrap: anywhere;
        }

        .template {
            display: inline-block;
            padding: 7px 10px;
            border-radius: 5px;
            background: #242a1b;
            color: #dfff9a;
            font-size: 12px;
            text-transform: capitalize;
        }

        .date {
            font-size: 12px;
            color: #777;
        }

        .empty {
            grid-column: 1 / -1;
            padding: 45px 20px;
            text-align: center;
        }

        .empty h2 {
            margin-top: 0;
        }

        .empty p {
            margin-bottom: 25px;
            color: #aaa;
            line-height: 1.7;
        }

        .success {
            margin-bottom: 22px;
            padding: 13px 16px;
            border: 1px solid #465b2b;
            border-radius: 7px;
            color: #dfff9a;
            background: #182012;
        }

        @media (max-width: 600px) {
            nav {
                padding: 18px 5%;
            }

            main {
                margin-top: 30px;
            }
        }
    </style>
</head>

<body>
    <nav>
        <div class="brand">PORTFOLIO GENERATOR</div>
        <a href="{{ route('dashboard') }}">← Dashboard</a>
    </nav>

    <main>
        <header class="heading">
            <div>
                <h1>My Portfolios</h1>
                <p class="subtitle">
                    View the portfolios you've created and manage your work.
                </p>
            </div>

            <a class="button" href="{{ route('portfolios.create') }}">
                + Create Portfolio
            </a>
        </header>

        @if (session('success'))
            <div class="success">
                {{ session('success') }}
            </div>
        @endif

        <div class="portfolio-grid">
            @forelse ($portfolios as $portfolio)
                <article class="card">
                    <h2>{{ $portfolio->full_name }}</h2>

                    <p>{{ $portfolio->email }}</p>

                    <span class="template">
                        {{ $portfolio->template }}
                    </span>

                    <p class="date">
                        Created
                        {{ $portfolio->created_at->format('M d, Y') }}
                    </p>
                </article>
            @empty
                <section class="empty">
                    <h2>No portfolios yet</h2>

                    <p>
                        Start building your professional portfolio by
                        adding your personal information, education,
                        skills, projects, and experience.
                    </p>

                    <a
                        class="button"
                        href="{{ route('portfolios.create') }}"
                    >
                        Create Your First Portfolio
                    </a>
                </section>
            @endforelse
        </div>
    </main>
</body>
</html>