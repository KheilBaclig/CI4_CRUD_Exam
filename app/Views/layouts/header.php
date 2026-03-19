<!-- Top App Bar -->
<header class="header-wrapper">
    <!-- Logo -->
    <a href="<?= base_url() ?>" class="topbar-logo" style="text-decoration:none;">
        <div class="topbar-logo-mark">N</div>
        <span class="topbar-logo-name">Nexus</span>
    </a>

    <!-- Right side -->
    <div class="topbar-right">
        <div class="topbar-user">
            <div class="topbar-user-dot"></div>
            <span class="topbar-user-name"><?= esc(session('user')['fullname'] ?? 'User') ?></span>
        </div>

        <div class="dropdown">
            <a href="#" class="d-flex align-items-center justify-content-center text-decoration-none"
               id="topDropdown" data-bs-toggle="dropdown" aria-expanded="false"
               style="width:32px; height:32px; background:var(--bg-raised); border:1px solid var(--border-2); border-radius:var(--radius-sm); color:var(--text-300); transition:all 0.2s;"
               onmouseover="this.style.borderColor='var(--coral-border)'; this.style.color='var(--coral)'"
               onmouseout="this.style.borderColor='var(--border-2)'; this.style.color='var(--text-300)'">
                <i class="bi bi-person-circle" style="font-size:1rem;"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="topDropdown" style="margin-top:0.5rem; min-width:180px;">
                <li><h6 class="dropdown-header"><?= esc(session('user')['role'] ?? 'user') ?></h6></li>
                <li>
                    <a class="dropdown-item" href="<?= base_url('profile') ?>">
                        <i class="bi bi-person me-2" style="color:var(--teal);"></i> My Profile
                    </a>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <a class="dropdown-item" href="<?= base_url('logout') ?>" style="color:#fb7185 !important;">
                        <i class="bi bi-box-arrow-left me-2"></i> Sign Out
                    </a>
                </li>
            </ul>
        </div>
    </div>
</header>
