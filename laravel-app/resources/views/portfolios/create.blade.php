<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Portfolio | Portfolio Generator</title>

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
            gap: 16px;
            padding: 20px 6%;
            background: #141414;
            border-bottom: 1px solid #292929;
        }

        .brand {
            color: #dfff9a;
            font-size: 14px;
            font-weight: 800;
            letter-spacing: 1.5px;
        }

        nav a {
            color: #ddd;
            text-decoration: none;
            font-size: 14px;
        }

        nav a:hover {
            color: #dfff9a;
        }

        main {
            width: 92%;
            max-width: 950px;
            margin: 40px auto;
        }

        .heading {
            margin-bottom: 28px;
        }

        .heading h1 {
            margin-bottom: 10px;
            font-size: clamp(28px, 4vw, 38px);
        }

        .heading p {
            color: #aaa;
            line-height: 1.6;
        }

        form {
            padding: 32px;
            border: 1px solid #292929;
            border-radius: 14px;
            background: #141414;
        }

        .section {
            margin-bottom: 32px;
        }

        .section h2 {
            padding-bottom: 12px;
            border-bottom: 1px solid #303030;
            color: #dfff9a;
            font-size: 19px;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
        }

        .field {
            min-width: 0;
            margin-top: 14px;
        }

        .full {
            grid-column: 1 / -1;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 600;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 12px;
            border: 1px solid #393939;
            border-radius: 7px;
            outline: none;
            background: #202020;
            color: #f5f5f5;
            font: inherit;
        }

        input:focus,
        textarea:focus,
        select:focus {
            border-color: #dfff9a;
        }

        input[type="file"] {
            font-size: 13px;
        }

        textarea {
            min-height: 110px;
            resize: vertical;
            line-height: 1.6;
        }

        .hint {
            margin-top: 7px;
            color: #999;
            font-size: 12px;
        }

        .error {
            margin-top: 7px;
            color: #ff9292;
            font-size: 13px;
        }

        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 25px;
        }

        button,
        .secondary {
            display: inline-block;
            padding: 13px 19px;
            border: 1px solid #dfff9a;
            border-radius: 7px;
            background: #dfff9a;
            color: #111;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
        }

        .secondary {
            background: transparent;
            color: #dfff9a;
        }

        button:hover {
            background: #c9ef7b;
        }

        .secondary:hover {
            background: #222719;
        }

        @media (max-width: 650px) {
            nav {
                padding: 18px 5%;
            }

            main {
                margin: 26px auto;
            }

            form {
                padding: 21px;
            }

            .grid {
                grid-template-columns: 1fr;
            }

            .full {
                grid-column: auto;
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
            <h1>Create Your Portfolio</h1>
            <p>
                Add your details, showcase your work, and choose
                a template for your professional portfolio.
            </p>
        </header>

        <form
            method="POST"
            action="{{ route('portfolios.store') }}"
            enctype="multipart/form-data"
        >
            @csrf

            <section class="section">
                <h2>Personal Information</h2>

                <div class="grid">
                    <div class="field">
                        <label for="full_name">Full Name *</label>
                        <input
                            id="full_name"
                            name="full_name"
                            type="text"
                            value="{{ old('full_name') }}"
                            maxlength="255"
                            required
                        >
                        @error('full_name')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="email">Email Address *</label>
                        <input
                            id="email"
                            name="email"
                            type="email"
                            value="{{ old('email', auth()->user()->email) }}"
                            maxlength="255"
                            required
                        >
                        @error('email')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="contact_number">Contact Number</label>
                        <input
                            id="contact_number"
                            name="contact_number"
                            type="text"
                            value="{{ old('contact_number') }}"
                            maxlength="50"
                        >
                        @error('contact_number')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="address">Address</label>
                        <input
                            id="address"
                            name="address"
                            type="text"
                            value="{{ old('address') }}"
                            maxlength="255"
                        >
                        @error('address')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="field full">
                        <label for="photo">Profile Picture</label>
                        <input
                            id="photo"
                            name="photo"
                            type="file"
                            accept="image/*"
                        >
                        <div class="hint">Maximum file size: 5 MB.</div>
                        @error('photo')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </section>

            <section class="section">
                <h2>About Me</h2>

                <div class="field">
                    <label for="about_me">Introduction</label>
                    <textarea
                        id="about_me"
                        name="about_me"
                        maxlength="5000"
                        placeholder="Tell people about yourself..."
                    >{{ old('about_me') }}</textarea>
                    @error('about_me')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </section>

            <section class="section">
                <h2>Education and Skills</h2>

                <div class="grid">
                    <div class="field full">
                        <label for="education">Educational Background</label>
                        <textarea
                            id="education"
                            name="education"
                            maxlength="5000"
                            placeholder="Your degree, school, and educational background..."
                        >{{ old('education') }}</textarea>
                        @error('education')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="field full">
                        <label for="skills">Skills</label>
                        <textarea
                            id="skills"
                            name="skills"
                            maxlength="5000"
                            placeholder="HTML, CSS, JavaScript, design, and other skills..."
                        >{{ old('skills') }}</textarea>
                        @error('skills')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </section>

            <section class="section">
                <h2>Projects</h2>

                <div class="grid">
                    <div class="field full">
                        <label for="project">Project Description</label>
                        <textarea
                            id="project"
                            name="project"
                            maxlength="5000"
                            placeholder="Describe your projects and achievements..."
                        >{{ old('project') }}</textarea>
                        @error('project')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="field full">
                        <label for="project_link">Project Link</label>
                        <input
                            id="project_link"
                            name="project_link"
                            type="url"
                            value="{{ old('project_link') }}"
                            maxlength="2048"
                            placeholder="https://example.com"
                        >
                        @error('project_link')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </section>

            <section class="section">
                <h2>Work Experience</h2>

                <div class="grid">
                    <div class="field">
                        <label for="company">Company</label>
                        <input
                            id="company"
                            name="company"
                            type="text"
                            value="{{ old('company') }}"
                            maxlength="255"
                        >
                        @error('company')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="position">Position</label>
                        <input
                            id="position"
                            name="position"
                            type="text"
                            value="{{ old('position') }}"
                            maxlength="255"
                        >
                        @error('position')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="field full">
                        <label for="work_description">Work Description</label>
                        <textarea
                            id="work_description"
                            name="work_description"
                            maxlength="5000"
                            placeholder="Describe your responsibilities and experience..."
                        >{{ old('work_description') }}</textarea>
                        @error('work_description')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </section>

            <section class="section">
                <h2>Social Links</h2>

                <div class="grid">
                    @foreach ([
                        'website' => 'Personal Website',
                        'facebook' => 'Facebook URL',
                        'linkedin' => 'LinkedIn URL',
                        'github' => 'GitHub URL'
                    ] as $field => $label)
                        <div class="field">
                            <label for="{{ $field }}">{{ $label }}</label>
                            <input
                                id="{{ $field }}"
                                name="{{ $field }}"
                                type="url"
                                value="{{ old($field) }}"
                                maxlength="2048"
                                placeholder="https://..."
                            >
                            @error($field)
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    @endforeach
                </div>
            </section>

            <section class="section">
                <h2>Choose a Template</h2>

                <div class="field">
                    <label for="template">Portfolio Template *</label>
                    <select id="template" name="template" required>
                        <option
                            value="modern"
                            {{ old('template', 'modern') === 'modern' ? 'selected' : '' }}
                        >
                            Modern
                        </option>

                        <option
                            value="classic"
                            {{ old('template') === 'classic' ? 'selected' : '' }}
                        >
                            Classic
                        </option>

                        <option
                            value="minimal"
                            {{ old('template') === 'minimal' ? 'selected' : '' }}
                        >
                            Minimal
                        </option>
                    </select>
                    @error('template')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </section>

            <div class="actions">
                <button type="submit">Save Portfolio</button>
                <a class="secondary" href="{{ route('portfolios.index') }}">
                    My Portfolios
                </a>
            </div>
        </form>
    </main>
</body>
</html>