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
            padding: 20px 6%;
            border-bottom: 1px solid #292929;
            background: #141414;
        }

        .brand {
            color: #dfff9a;
            font-size: 14px;
            font-weight: 800;
            letter-spacing: 1.5px;
        }

        .logout {
            padding: 10px 16px;
            border: 1px solid #444;
            border-radius: 7px;
            background: transparent;
            color: white;
            cursor: pointer;
        }

        .logout:hover {
            border-color: #dfff9a;
            color: #dfff9a;
        }

        main {
            width: 90%;
            max-width: 1050px;
            margin: 60px auto;
        }

        .welcome {
            margin-bottom: 35px;
        }

        .welcome h1 {
            margin-bottom: 10px;
            font-size: clamp(28px, 5vw, 42px);
        }

        .welcome p {
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

        .panel p {
            color: #aaa;
            line-height: 1.7;
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

        @media (max-width: 600px) {
            nav {
                padding: 18px 5%;
            }

            main {
                margin-top: 35px;
            }

            .panel {
                padding: 24px;
            }
        }
    </style>
</head>

<body>
    <nav>
        <div class="brand">PORTFOLIO GENERATOR</div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="logout" type="submit">Log Out</button>
        </form>
    </nav>

    <main>
        <section class="welcome">
            <h1>
                Welcome back,
                <span class="highlight">{{ auth()->user()->name }}</span>!
            </h1>

            <p>
                Manage your account and get ready to showcase
                your skills, education, projects, and experience.
            </p>
        </section>

        <section class="panel">
            <h2>Your Portfolio Workspace</h2>

            <p>
                Your account is ready. The next step is to build
                your portfolio creation and management features.
            </p>

            <span class="status">Account authenticated</span>
        </section>
    </main>
</body>
</html>