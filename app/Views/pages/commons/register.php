<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Account — Nexus</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin:0; padding:0; }

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

        body::before {
            content: '';
            position: fixed;
            width: 500px; height: 500px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(0,212,170,0.07) 0%, transparent 70%);
            top: -150px; right: -100px;
            animation: orbFloat 9s ease-in-out infinite;
        }

        body::after {
            content: '';
            position: fixed;
            width: 400px; height: 400px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(255,98,64,0.06) 0%, transparent 70%);
            bottom: -100px; left: -100px;
            animation: orbFloat 7s ease-in-out infinite reverse;
        }

        @keyframes orbFloat {
            0%, 100% { transform: scale(1) translate(0,0); }
            50%       { transform: scale(1.08) translate(20px, 15px); }
        }

        .bg-grid {
            position: fixed;
            inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,0.02) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.02) 1px, transparent 1px);
            background-size: 48px 48px;
            pointer-events: none;
        }

        .reg-wrap {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 460px;
        }

        .reg-logo {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            text-decoration: none;
            margin-bottom: 1.75rem;
            justify-content: center;
        }

        .logo-mark {
            width: 40px; height: 40px;
            background: #00d4aa;
            border-radius: 11px;
            display: flex; align-items: center; justify-content: center;
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
            font-size: 1rem;
            color: #0d0c0b;
            box-shadow: 0 0 24px rgba(0,212,170,0.4);
            flex-shrink: 0;
        }

        .logo-name    { font-family: 'Space Grotesk', sans-serif; font-weight: 700; font-size: 1.3rem; color: #f2ede8; letter-spacing: -0.025em; }
        .logo-tagline { font-size: 0.6rem; font-weight: 600; color: #00d4aa; text-transform: uppercase; letter-spacing: 0.14em; }

        .reg-card {
            background: #151412;
            border: 1px solid rgba(255,255,255,0.07);
            border-radius: 20px;
            padding: 2.25rem;
            box-shadow: 0 40px 80px rgba(0,0,0,0.6), inset 0 1px 0 rgba(255,255,255,0.05);
        }

        .card-eyebrow { font-size:0.68rem; font-weight:700; color:#00d4aa; text-transform:uppercase; letter-spacing:0.14em; margin-bottom:0.4rem; }
        .card-title   { font-family:'Space Grotesk',sans-serif; font-size:1.6rem; font-weight:700; color:#f2ede8; letter-spacing:-0.03em; margin-bottom:0.3rem; }
        .card-subtitle { font-size:0.85rem; color:#7a7368; margin-bottom:1.5rem; }

        .field-group  { margin-bottom:1rem; }
        .field-label  { display:block; font-size:0.75rem; font-weight:600; color:#7a7368; margin-bottom:0.4rem; }
        .field-wrap   { position:relative; }

        .field-icon {
            position:absolute; left:0.875rem; top:50%; transform:translateY(-50%);
            color:#4a4540; font-size:0.9rem; pointer-events:none; transition:color 0.2s;
        }

        .auth-input {
            width:100%; background:#0d0c0b; border:1px solid rgba(255,255,255,0.08);
            border-radius:10px; color:#f2ede8; font-size:0.875rem;
            font-family:'Sora',sans-serif; padding:0.7rem 0.875rem 0.7rem 2.4rem;
            outline:none; transition:all 0.2s;
        }

        .auth-input:focus {
            border-color:rgba(0,212,170,0.45);
            box-shadow:0 0 0 3px rgba(0,212,170,0.08);
            background:#0a0908;
        }

        .auth-input::placeholder { color:#4a4540; }
        .field-wrap:focus-within .field-icon { color:#00d4aa; }

        .row-2 { display:grid; grid-template-columns:1fr 1fr; gap:0.75rem; }

        .btn-register {
            width:100%; padding:0.85rem;
            background:#00d4aa; border:none; border-radius:10px;
            color:#0d0c0b; font-size:0.95rem; font-weight:700;
            font-family:'Sora',sans-serif; cursor:pointer; transition:all 0.2s;
            box-shadow:0 4px 20px rgba(0,212,170,0.35);
            display:flex; align-items:center; justify-content:center; gap:0.5rem;
            margin-top:0.5rem;
        }

        .btn-register:hover { background:#33dbb6; transform:translateY(-1px); box-shadow:0 8px 28px rgba(0,212,170,0.5); }

        .divider { display:flex; align-items:center; gap:1rem; color:#4a4540; font-size:0.75rem; margin:1.25rem 0; }
        .divider::before,.divider::after { content:''; flex:1; height:1px; background:rgba(255,255,255,0.06); }

        .link-row { text-align:center; font-size:0.85rem; color:#4a4540; }
        .link-row a { color:#00d4aa; text-decoration:none; font-weight:600; transition:color 0.2s; }
        .link-row a:hover { color:#33dbb6; }

        .auth-alert { display:flex; align-items:center; gap:0.5rem; padding:0.7rem 1rem; border-radius:10px; font-size:0.83rem; margin-bottom:1.25rem; }
        .auth-alert.error { background:rgba(244,63,94,0.1); border:1px solid rgba(244,63,94,0.2); color:#fb7185; }
        .close-alert { margin-left:auto; background:none; border:none; cursor:pointer; color:inherit; opacity:0.6; font-size:0.85rem; padding:0; }
        .close-alert:hover { opacity:1; }

        @media (max-width: 500px) {
            .row-2 { grid-template-columns:1fr; }
        }
    </style>
</head>
<body>
    <div class="bg-grid"></div>

    <div class="reg-wrap">
        <a href="#" class="reg-logo">
            <div class="logo-mark">N</div>
            <div>
                <div class="logo-name">Nexus</div>
                <div class="logo-tagline">Academic System</div>
            </div>
        </a>

        <div class="reg-card">
            <div class="card-eyebrow">New Account</div>
            <h1 class="card-title">Create Account</h1>
            <p class="card-subtitle">Join the academic portal to get started</p>

            <?php if (session()->getFlashdata('notif_error')): ?>
                <div class="auth-alert error" id="alertErr">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                    <?= session()->getFlashdata('notif_error') ?>
                    <button class="close-alert" onclick="document.getElementById('alertErr').remove();">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('register') ?>" method="POST">
                <div class="field-group">
                    <label class="field-label" for="inputFullname">Full Name</label>
                    <div class="field-wrap">
                        <input type="text" id="inputFullname" name="inputFullname"
                               class="auth-input" placeholder="Juan dela Cruz"
                               value="<?= old('inputFullname') ?>" required>
                        <i class="bi bi-person field-icon"></i>
                    </div>
                </div>

                <div class="field-group">
                    <label class="field-label" for="inputEmail">Email Address</label>
                    <div class="field-wrap">
                        <input type="email" id="inputEmail" name="inputEmail"
                               class="auth-input" placeholder="you@school.edu"
                               value="<?= old('inputEmail') ?>" required>
                        <i class="bi bi-envelope field-icon"></i>
                    </div>
                </div>

                <div class="row-2 field-group">
                    <div>
                        <label class="field-label" for="inputPassword">Password</label>
                        <div class="field-wrap">
                            <input type="password" id="inputPassword" name="inputPassword"
                                   class="auth-input" placeholder="Min. 6 chars" required>
                            <i class="bi bi-lock field-icon"></i>
                        </div>
                    </div>
                    <div>
                        <label class="field-label" for="inputPassword2">Confirm</label>
                        <div class="field-wrap">
                            <input type="password" id="inputPassword2" name="inputPassword2"
                                   class="auth-input" placeholder="Repeat" required>
                            <i class="bi bi-shield-check field-icon"></i>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn-register">
                    <i class="bi bi-person-plus-fill"></i> Create Account
                </button>
            </form>

            <div class="divider">or</div>
            <p class="link-row">Already registered? <a href="<?= base_url('/') ?>">Sign in</a></p>
        </div>
    </div>
</body>
</html>
