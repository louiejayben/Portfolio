<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Portfolio Generator</title>

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
            min-height: 580px;
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
            padding: 40px;
        }

        h2 {
            margin: 0 0 10px;
            font-size: 30px;
        }

        .subtitle {
            margin: 0 0 20px;
            color: #aaa;
            line-height: 1.5;
        }

        label {
            display: block;
            margin: 14px 0 7px;
            font-size: 14px;
            font-weight: 600;
        }

        input {
            width: 100%;
            padding: 12px;
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

        button {
            width: 100%;
            margin-top: 22px;
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
            margin-top: 22px;
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
            margin-top: 6px;
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

            <h1>Build your<br>next chapter.</h1>

            <p>
                Create your account and get ready to showcase
                your education, skills, projects, and experience
                in a professional portfolio.
            </p>
        </section>

        <section class="form-panel">
            <h2>Create an account</h2>

            <p class="subtitle">
                Register to start building your portfolio.
            </p>

            <form method="POST" action="{{ route('register.store') }}">
                @csrf

                <label for="name">Full name</label>
                <input
                    id="name"
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="Your full name"
                    autocomplete="name"
                    maxlength="255"
                    required
                    autofocus
                >

                @error('name')
                    <span class="error">{{ $message }}</span>
                @enderror

                <label for="email">Email address</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="you@example.com"
                    autocomplete="email"
                    maxlength="255"
                    required
                >

                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror

                <label for="password">Password</label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    placeholder="At least 8 characters"
                    autocomplete="new-password"
                    minlength="8"
                    required
                >

                @error('password')
                    <span class="error">{{ $message }}</span>
                @enderror

                <label for="password_confirmation">Confirm password</label>
                <input
                    id="password_confirmation"
                    type="password"
                    name="password_confirmation"
                    placeholder="Enter your password again"
                    autocomplete="new-password"
                    minlength="8"
                    required
                >

                <button type="submit">Create Account</button>
            </form>

            <p class="switch">
                Already have an account?
                <a href="{{ route('login') }}">Log in</a>
            </p>
        </section>
    </main>
</body>
</html>