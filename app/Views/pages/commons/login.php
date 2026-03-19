<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign In — Nexus</title>
    <meta name="description" content="Sign in to Nexus — your academic management portal.">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Sora', system-ui, sans-serif;
            background: #0d0c0b;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            -webkit-font-smoothing: antialiased;
            position: relative;
            overflow: hidden;
        }

        /* Animated gradient orbs in background */
        body::before {
            content: '';
            position: fixed;
            width: 600px; height: 600px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(255,98,64,0.08) 0%, transparent 70%);
            top: -200px; left: -150px;
            animation: orbFloat 8s ease-in-out infinite;
        }

        body::after {
            content: '';
            position: fixed;
            width: 500px; height: 500px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(0,212,170,0.06) 0%, transparent 70%);
            bottom: -150px; right: -100px;
            animation: orbFloat 10s ease-in-out infinite reverse;
        }

        @keyframes orbFloat {
            0%, 100% { transform: translate(0, 0) scale(1); }
            50%       { transform: translate(30px, 20px) scale(1.05); }
        }

        /* Subtle grid */
        .bg-grid {
            position: fixed;
            inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,0.02) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.02) 1px, transparent 1px);
            background-size: 48px 48px;
            pointer-events: none;
        }

        /* Central card */
        .login-wrap {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 420px;
        }

        /* Logo at top */
        .login-logo {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            text-decoration: none;
            margin-bottom: 2rem;
            justify-content: center;
        }

        .logo-mark {
            width: 42px; height: 42px;
            background: #ff6240;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
            font-size: 1.1rem;
            color: #fff;
            box-shadow: 0 0 28px rgba(255,98,64,0.45);
            flex-shrink: 0;
        }

        .logo-name {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
            font-size: 1.4rem;
            color: #f2ede8;
            letter-spacing: -0.025em;
        }

        .logo-tagline {
            font-size: 0.62rem;
            font-weight: 600;
            color: #ff6240;
            text-transform: uppercase;
            letter-spacing: 0.14em;
        }

        /* Card */
        .login-card {
            background: #151412;
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 20px;
            padding: 2.25rem;
            box-shadow:
                0 40px 80px rgba(0,0,0,0.6),
                0 0 0 1px rgba(255,255,255,0.04),
                inset 0 1px 0 rgba(255,255,255,0.05);
        }

        .card-eyebrow {
            font-size: 0.68rem;
            font-weight: 700;
            color: #ff6240;
            text-transform: uppercase;
            letter-spacing: 0.14em;
            margin-bottom: 0.4rem;
        }

        .card-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.75rem;
            font-weight: 700;
            color: #f2ede8;
            letter-spacing: -0.03em;
            margin-bottom: 0.3rem;
        }

        .card-subtitle {
            font-size: 0.85rem;
            color: #7a7368;
            margin-bottom: 1.75rem;
        }

        /* Role pills row */
        .role-row {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 1.75rem;
            flex-wrap: wrap;
        }

        .role-pill {
            display: flex;
            align-items: center;
            gap: 0.35rem;
            padding: 0.3rem 0.75rem;
            border-radius: 999px;
            font-size: 0.7rem;
            font-weight: 600;
        }

        .role-pill.admin   { background: rgba(244,63,94,0.1);  color: #fb7185; border: 1px solid rgba(244,63,94,0.2); }
        .role-pill.teacher { background: rgba(0,212,170,0.1);  color: #00d4aa; border: 1px solid rgba(0,212,170,0.2); }
        .role-pill.student { background: rgba(255,98,64,0.1);  color: #ff8060; border: 1px solid rgba(255,98,64,0.2); }

        /* Fields */
        .field-group { margin-bottom: 1.125rem; }

        .field-label {
            display: block;
            font-size: 0.75rem;
            font-weight: 600;
            color: #7a7368;
            margin-bottom: 0.4rem;
            letter-spacing: 0.02em;
        }

        .field-wrap { position: relative; }

        .field-icon {
            position: absolute;
            left: 0.9rem;
            top: 50%;
            transform: translateY(-50%);
            color: #4a4540;
            font-size: 0.9rem;
            pointer-events: none;
            transition: color 0.2s;
        }

        .auth-input {
            width: 100%;
            background: #0d0c0b;
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 10px;
            color: #f2ede8;
            font-size: 0.875rem;
            font-family: 'Sora', sans-serif;
            padding: 0.7rem 0.9rem 0.7rem 2.5rem;
            outline: none;
            transition: all 0.2s;
        }

        .auth-input:focus {
            border-color: rgba(255,98,64,0.5);
            background: #0a0908;
            box-shadow: 0 0 0 3px rgba(255,98,64,0.1);
        }

        .auth-input::placeholder { color: #4a4540; }
        .field-wrap:focus-within .field-icon { color: #ff6240; }

        .toggle-pw-btn {
            position: absolute;
            right: 0.9rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #4a4540;
            cursor: pointer;
            font-size: 0.9rem;
            padding: 0;
            transition: color 0.2s;
        }

        .toggle-pw-btn:hover { color: #ff6240; }

        /* Submit button */
        .btn-login {
            width: 100%;
            padding: 0.85rem;
            background: #ff6240;
            border: none;
            border-radius: 10px;
            color: #fff;
            font-size: 0.95rem;
            font-weight: 700;
            font-family: 'Sora', sans-serif;
            cursor: pointer;
            transition: all 0.2s;
            box-shadow: 0 4px 20px rgba(255,98,64,0.4);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 0.5rem;
        }

        .btn-login:hover {
            background: #ff8060;
            transform: translateY(-1px);
            box-shadow: 0 8px 28px rgba(255,98,64,0.55);
        }

        .divider {
            display: flex;
            align-items: center;
            gap: 1rem;
            color: #4a4540;
            font-size: 0.75rem;
            margin: 1.25rem 0;
        }

        .divider::before,
        .divider::after { content: ''; flex: 1; height: 1px; background: rgba(255,255,255,0.06); }

        .link-row {
            text-align: center;
            font-size: 0.85rem;
            color: #4a4540;
        }

        .link-row a {
            color: #ff6240;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s;
        }

        .link-row a:hover { color: #ff8060; }

        /* Alert */
        .auth-alert {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.7rem 1rem;
            border-radius: 10px;
            font-size: 0.83rem;
            margin-bottom: 1.25rem;
        }

        .auth-alert.error {
            background: rgba(244,63,94,0.1);
            border: 1px solid rgba(244,63,94,0.2);
            color: #fb7185;
        }

        .auth-alert.success {
            background: rgba(34,197,94,0.1);
            border: 1px solid rgba(34,197,94,0.2);
            color: #4ade80;
        }

        .close-alert { margin-left:auto; background:none; border:none; cursor:pointer; color:inherit; opacity:0.6; font-size:0.85rem; padding:0; }
        .close-alert:hover { opacity:1; }
    </style>
</head>
<body>
    <div class="bg-grid"></div>

    <div class="login-wrap">
        <!-- Logo -->
        <a href="#" class="login-logo">
            <div class="logo-mark">N</div>
            <div>
                <div class="logo-name">Nexus</div>
                <div class="logo-tagline">Academic System</div>
            </div>
        </a>

        <!-- Card -->
        <div class="login-card">
            <div class="card-eyebrow">Secure Access</div>
            <h1 class="card-title">Welcome back</h1>
            <p class="card-subtitle">Sign in to your academic portal</p>



            <?php if (session()->getFlashdata('notif_error')): ?>
                <div class="auth-alert error" id="alertErr">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                    <?= session()->getFlashdata('notif_error') ?>
                    <button class="close-alert" onclick="document.getElementById('alertErr').remove()">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('notif_success')): ?>
                <div class="auth-alert success" id="alertOk">
                    <i class="bi bi-check-circle-fill"></i>
                    <?= session()->getFlashdata('notif_success') ?>
                    <button class="close-alert" onclick="document.getElementById('alertOk').remove()">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('login') ?>" method="POST" autocomplete="off">
                <div class="field-group">
                    <label class="field-label" for="inputEmail">Email Address</label>
                    <div class="field-wrap">
                        <input type="email" id="inputEmail" name="inputEmail"
                               class="auth-input" placeholder="you@school.edu" required>
                        <i class="bi bi-envelope field-icon"></i>
                    </div>
                </div>

                <div class="field-group">
                    <label class="field-label" for="inputPassword">Password</label>
                    <div class="field-wrap">
                        <input type="password" id="inputPassword" name="inputPassword"
                               class="auth-input" style="padding-right:2.8rem;"
                               placeholder="••••••••" required>
                        <i class="bi bi-lock field-icon"></i>
                        <button type="button" class="toggle-pw-btn" id="eyeBtn">
                            <i class="bi bi-eye" id="eyeIcon"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn-login">
                    <i class="bi bi-box-arrow-in-right"></i> Sign In
                </button>
            </form>

            <div class="divider">or</div>

            <p class="link-row">
                No account yet? <a href="<?= base_url('register') ?>">Register here</a>
            </p>
        </div>
    </div>

    <script>
    document.getElementById('eyeBtn').addEventListener('click', function () {
        const inp = document.getElementById('inputPassword');
        const ico = document.getElementById('eyeIcon');
        if (inp.type === 'password') { inp.type = 'text'; ico.className = 'bi bi-eye-slash'; }
        else { inp.type = 'password'; ico.className = 'bi bi-eye'; }
    });
    </script>
</body>
</html>
