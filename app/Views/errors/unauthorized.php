<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>403 Access Denied — Nexus</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/premium.css') ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700;800&family=Space+Grotesk:wght@600;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #0d0c0b;
            color: #f2ede8;
            font-family: 'Sora', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }
        .bg-glow {
            position: absolute;
            width: 400px; height: 400px;
            background: radial-gradient(circle, rgba(255, 98, 64, 0.08) 0%, transparent 70%);
            border-radius: 50%;
            z-index: 0;
        }
        .error-card {
            position: relative;
            z-index: 1;
            text-align: center;
            max-width: 500px;
            padding: 2rem;
        }
        .shield-icon {
            font-size: 4.5rem;
            color: var(--coral);
            margin-bottom: 1.5rem;
            display: inline-block;
            filter: drop-shadow(0 0 20px rgba(255, 98, 64, 0.3));
            animation: pulse-shield 2s infinite ease-in-out;
        }
        @keyframes pulse-shield {
            0%, 100% { transform: scale(1); opacity: 0.8; }
            50% { transform: scale(1.05); opacity: 1; }
        }
        .role-badge {
            background: var(--coral-dim);
            color: var(--coral);
            border: 1px solid var(--coral-border);
            padding: 0.15rem 0.6rem;
            border-radius: 6px;
            text-transform: uppercase;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.05em;
        }
    </style>
</head>
<body>
    <div class="bg-glow"></div>
    
    <div class="error-card fade-in">
        <div class="shield-icon">
            <i class="bi bi-shield-lock-fill"></i>
        </div>

        <h1 style="font-family: 'Space Grotesk', sans-serif; font-weight: 800; font-size: 2.2rem; margin-bottom: 0.75rem; letter-spacing: -0.02em;">
            Access Denied
        </h1>
        
        <p style="color: var(--text-300); font-size: 0.95rem; line-height: 1.6; margin-bottom: 2.5rem;">
            You are currently logged in as a <span class="role-badge"><?= esc(session('user')['role'] ?? 'Guest') ?></span>.<br>
            Your account does not have the necessary clearance to access this system module.
        </p>

        <?php 
            // Better Link Logic — Default to main landing if role unknown
            $target = base_url('/');
            if (session()->has('user')) {
                $role = session('user')['role'] ?? '';
                if ($role === 'student') {
                    $target = base_url('student/dashboard');
                } else {
                    // admin, teacher, or now coordinator
                    $target = base_url('dashboard');
                }
            }
        ?>

        <div class="d-flex flex-column gap-3 align-items-center">
            <a href="<?= $target ?>" class="clean-btn-primary px-4">
                <i class="bi bi-house-door-fill"></i> Return home
            </a>
            
            <a href="<?= base_url('logout') ?>" style="color: var(--text-400); font-size: 0.8rem; text-decoration: none; font-weight: 600;" onmouseover="this.style.color='var(--coral)'" onmouseout="this.style.color='var(--text-400)'">
                Sign out and switch account
            </a>
        </div>
    </div>
</body>
</html>
