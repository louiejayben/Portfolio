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
            padding: 11px 15px;
            border: 1px solid #dfff9a;
            border-radius: 7px;
            background: #dfff9a;
            color: #111;
            font-family: inherit;
            font-size: 13px;
            font-weight: 700;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
        }

        .button:hover {
            background: #c9ef7b;
            text-decoration: none;
        }

        .button.secondary {
            background: transparent;
            color: #dfff9a;
        }

        .button.danger {
            border-color: #813b3b;
            background: transparent;
            color: #ffaaaa;
        }

        .button.danger:hover {
            background: #301919;
        }

        .portfolio-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 20px;
        }

        .card,
        .empty {
            min-width: 0;
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
            color: #777;
            font-size: 12px;
        }

        .card-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 9px;
            margin-top: 20px;
        }

        .card-actions form {
            display: inline;
            margin: 0;
        }

        .share-url {
            margin-top: 18px;
            padding: 12px;
            border: 1px solid #303030;
            border-radius: 7px;
            background: #101010;
        }

        .share-url label {
            display: block;
            margin-bottom: 8px;
            color: #aaa;
            font-size: 12px;
        }

        .share-url input {
            width: 100%;
            padding: 9px;
            border: 1px solid #393939;
            border-radius: 5px;
            background: #202020;
            color: #dfff9a;
            font-size: 12px;
        }

        .empty {
            grid-column: 1 / -1;
            padding: 45px 20px;
            text-align: center;
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
            background: #182012;
            color: #dfff9a;
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
                    View, edit, delete, and share your portfolios.
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
                        Created {{ $portfolio->created_at->format('M d, Y') }}
                    </p>

                    <div class="card-actions">
                        <a
                            class="button"
                            href="{{ route('portfolios.public', $portfolio->public_token) }}"
                            target="_blank"
                            rel="noopener noreferrer"
                        >
                            View Portfolio
                        </a>

                        <a
                            class="button secondary"
                            href="{{ route('portfolios.edit', $portfolio->id) }}"
                        >
                            Edit
                        </a>

                        <button
                            class="button secondary"
                            type="button"
                            onclick="copyPortfolioLink(
                                {{ \Illuminate\Support\Js::from(route('portfolios.public', $portfolio->public_token)) }},
                                this
                            )"
                        >
                            Copy Share Link
                        </button>

                        <form
                            method="POST"
                            action="{{ route('portfolios.destroy', $portfolio->id) }}"
                            onsubmit="return confirm('Are you sure you want to permanently delete this portfolio? This cannot be undone.')"
                        >
                            @csrf
                            @method('DELETE')

                            <button class="button danger" type="submit">
                                Delete
                            </button>
                        </form>
                    </div>

                    <div class="share-url">
                        <label for="share-{{ $portfolio->id }}">
                            Public sharing URL
                        </label>

                        <input
                            id="share-{{ $portfolio->id }}"
                            type="text"
                            readonly
                            value="{{ route('portfolios.public', $portfolio->public_token) }}"
                            onclick="this.select()"
                        >
                    </div>
                </article>
            @empty
                <section class="empty">
                    <h2>No portfolios yet</h2>

                    <p>
                        Create your first portfolio to showcase your
                        education, skills, projects, and experience.
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

    <script>
        async function copyPortfolioLink(url, button) {
            try {
                await navigator.clipboard.writeText(url);
                button.textContent = 'Link Copied!';
            } catch (error) {
                const input = button.closest('.card')
                    .querySelector('.share-url input');

                input.focus();
                input.select();

                const copied = document.execCommand('copy');
                button.textContent = copied
                    ? 'Link Copied!'
                    : 'Select URL to Copy';
            }

            setTimeout(() => {
                button.textContent = 'Copy Share Link';
            }, 2000);
        }
    </script>
</body>
</html>