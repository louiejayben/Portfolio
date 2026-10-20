
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Portfolio Generator</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            background: #0b0b0b;
            color: #f5f5f5;
            font-family: Arial, Helvetica, sans-serif;
        }

        nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
            padding: 18px 5%;
            border-bottom: 1px solid #292929;
            background: #141414;
        }

        .brand {
            color: #dfff9a;
            font-size: 14px;
            font-weight: 800;
            letter-spacing: 1.5px;
            white-space: nowrap;
        }

        .nav-links {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
        }

        .nav-links a {
            padding: 10px 12px;
            border-radius: 6px;
            color: #ddd;
            font-size: 14px;
            text-decoration: none;
        }

        .nav-links a:hover,
        .nav-links a.active {
            background: #242a1b;
            color: #dfff9a;
        }

        .logout-form {
            margin: 0;
        }

        .logout {
            padding: 10px 14px;
            border: 1px solid #444;
            border-radius: 7px;
            background: transparent;
            color: #eee;
            font-size: 14px;
            cursor: pointer;
        }

        .logout:hover {
            border-color: #dfff9a;
            color: #dfff9a;
        }

        main {
            width: 90%;
            max-width: 1050px;
            margin: 55px auto;
        }

        .back-link {
            display: inline-block;
            margin-bottom: 25px;
            color: #dfff9a;
            font-size: 14px;
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        .welcome {
            margin-bottom: 35px;
        }

        .welcome h1 {
            margin: 0 0 10px;
            font-size: clamp(28px, 5vw, 42px);
            overflow-wrap: anywhere;
        }

        .welcome p,
        .panel p {
            color: #aaa;
            line-height: 1.7;
        }

        .highlight {
            color: #dfff9a;
        }

        .panel {
            padding: 32px;
            border: 1px solid #292929;
            border-radius: 14px;
            background: #141414;
        }

        .panel h2 {
            margin-top: 0;
        }

        .status {
            display: inline-block;
            margin-top: 12px;
            padding: 8px 12px;
            border-radius: 5px;
            background: #242a1b;
            color: #dfff9a;
            font-size: 13px;
        }

        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 24px;
        }

        .action-button {
            display: inline-block;
            padding: 13px 18px;
            border: 1px solid #dfff9a;
            border-radius: 7px;
            background: #dfff9a;
            color: #111;
            font-weight: 700;
            text-decoration: none;
        }

        .action-button.secondary {
            background: transparent;
            color: #dfff9a;
        }

        .action-button:hover {
            opacity: 0.85;
        }

        @media (max-width: 650px) {
            nav {
                align-items: flex-start;
                flex-direction: column;
                padding: 18px 5%;
            }

            .nav-links {
                width: 100%;
                gap: 5px;
            }

            .nav-links a {
                padding: 9px;
                font-size: 13px;
            }

            main {
                margin: 32px auto;
            }

            .panel {
                padding: 23px;
            }
        }
    </style>
</head>

<body>
    <nav>
        <div class="brand">PORTFOLIO GENERATOR</div>

        <div class="nav-links">
            <a href="{{ route('dashboard') }}" class="active">Dashboard</a>

            <a href="{{ route('portfolios.create') }}">
                Create Portfolio
            </a>

            <a href="{{ route('portfolios.index') }}">
                My Portfolios
            </a>

            <form
                class="logout-form"
                method="POST"
                action="{{ route('logout') }}"
            >
                @csrf
                <button class="logout" type="submit">Log Out</button>
            </form>
        </div>
    </nav>

    <main>
        <a class="back-link" href="{{ route('dashboard') }}">
            ← Dashboard Home
        </a>

        <section class="welcome">
            <h1>
                Welcome back,
                <span class="highlight">{{ auth()->user()->name }}</span>!
            </h1>

            <p>
                Manage your account and showcase your skills,
                education, projects, and experience.
            </p>
        </section>

        <section class="panel">
            <h2>Your Portfolio Workspace</h2>

            <p>
                Create your professional portfolio, manage your saved
                information, and prepare your work for sharing with employers.
            </p>

            <span class="status">Account authenticated</span>

            <div class="actions">
                <a
                    href="{{ route('portfolios.create') }}"
                    class="action-button"
                >
                    + Create Portfolio
                </a>

                <a
                    href="{{ route('portfolios.index') }}"
                    class="action-button secondary"
                >
                    My Portfolios
                </a>
            </div>
        </section>
    </main>
</body>
</html>