<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Portfolio Generator</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            background: #0b0b0b;
            color: #f5f5f5;
            font-family: Arial, Helvetica, sans-serif;
        }

        .container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            width: 100%;
            max-width: 900px;
            min-height: 530px;
            overflow: hidden;
            border: 1px solid #292929;
            border-radius: 18px;
            background: #141414;
        }

        .intro {
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 48px;
            background: #dfff9a;
            color: #111;
        }

        .brand {
            font-size: 13px;
            font-weight: 800;
            letter-spacing: 2px;
        }

        .intro h1 {
            margin: 35px 0 15px;
            font-size: clamp(30px, 4vw, 43px);
            line-height: 1.1;
        }

        .intro p {
            line-height: 1.7;
            color: #303727;
        }

        .form-panel {
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 44px;
        }

        h2 {
            margin: 0 0 10px;
            font-size: 30px;
        }

        .subtitle {
            margin: 0 0 28px;
            color: #aaa;
            line-height: 1.5;
        }

        label {
            display: block;
            margin: 18px 0 8px;
            font-size: 14px;
            font-weight: 600;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 13px;
            border: 1px solid #393939;
            border-radius: 7px;
            outline: none;
            background: #202020;
            color: white;
            font-size: 15px;
        }

        input:focus {
            border-color: #dfff9a;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 9px;
            margin: 18px 0;
            color: #ccc;
            font-size: 14px;
        }

        .remember label {
            margin: 0;
            font-weight: normal;
        }

        button {
            width: 100%;
            padding: 14px;
            border: 0;
            border-radius: 7px;
            background: #dfff9a;
            color: #111;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
        }

        button:hover {
            background: #c9ef7b;
        }

        .switch {
            margin-top: 24px;
            text-align: center;
            color: #aaa;
            font-size: 14px;
        }

        a {
            color: #dfff9a;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .error {
            display: block;
            margin-top: 7px;
            color: #ff9292;
            font-size: 13px;
        }

        @media (max-width: 650px) {
            .container {
                grid-template-columns: 1fr;
            }

            .intro {
                padding: 30px;
            }

            .intro h1 {
                margin-top: 20px;
            }

            .form-panel {
                padding: 30px;
            }
        }
    </style>
</head>

<body>
    <main class="container">
        <section class="intro">
            <div class="brand">PORTFOLIO GENERATOR</div>

            <h1>Your work.<br>Your story.</h1>

            <p>
                Create and manage your professional portfolio
                in one place. Showcase your skills, projects,
                and experience.
            </p>
        </section>

        <section class="form-panel">
            <h2>Welcome back</h2>

            <p class="subtitle">
                Log in to access your portfolio.
            </p>

            <form method="POST" action="{{ route('login.store') }}">
                @csrf

                <label for="email">Email address</label>

                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="you@example.com"
                    autocomplete="username"
                    required
                    autofocus
                >

                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror

                <label for="password">Password</label>

                <input
                    id="password"
                    type="password"
                    name="password"
                    placeholder="Enter your password"
                    autocomplete="current-password"
                    required
                >

                @error('password')
                    <span class="error">{{ $message }}</span>
                @enderror

                <div class="remember">
                    <input
                        id="remember"
                        type="checkbox"
                        name="remember"
                        value="1"
                    >

                    <label for="remember">Remember me</label>
                </div>

                <button type="submit">Log In</button>
            </form>

            <p class="switch">
                Don't have an account?
                <a href="{{ route('register') }}">Create one</a>
            </p>
        </section>
    </main>
</body>
</html>