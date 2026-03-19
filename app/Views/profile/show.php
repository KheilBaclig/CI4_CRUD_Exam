<?= $this->extend('layouts/main') ?>
<?= $this->section('breadcrumb') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-5 gap-3 fade-in">
    <div>
        <p style="font-size:0.65rem; font-weight:700; color:var(--coral); text-transform:uppercase; letter-spacing:0.14em; margin-bottom:0.35rem;">My Account</p>
        <h1 style="font-size:1.6rem; font-weight:800; letter-spacing:-0.03em; margin:0;">My Profile</h1>
        <p style="font-size:0.85rem; color:var(--text-300); margin:0.25rem 0 0;">View your academic identification and records</p>
    </div>
    <a href="<?= base_url('profile/edit') ?>" class="clean-btn-primary" style="align-self:flex-start;">
        <i class="bi bi-pencil-square"></i> Edit Profile
    </a>
</div>

<div class="row g-4 fade-in">

    <!-- Profile Card -->
    <div class="col-lg-4">
        <div class="clean-card" style="border-color: var(--coral-border);">

            <div class="text-center px-4 pt-4 pb-2">
                <?php if (!empty($user['profile_image'])): ?>
                    <img src="<?= base_url('uploads/profiles/' . esc($user['profile_image'])) ?>"
                         alt="Profile"
                         style="width:96px; height:96px; border-radius:50%; object-fit:cover; border:3px solid var(--bg-mid); box-shadow:0 4px 16px rgba(0,0,0,0.5); display:inline-block; margin-bottom:1rem;">
                <?php else: ?>
                    <div style="width:96px; height:96px; border-radius:50%; border:3px solid var(--bg-mid); background:var(--bg-raised); display:inline-flex; align-items:center; justify-content:center; color:var(--coral); font-size:2.75rem; margin-bottom:1rem;">
                        <i class="bi bi-person-fill"></i>
                    </div>
                <?php endif; ?>

                <h2 style="font-size:1.1rem; font-weight:800; letter-spacing:-0.02em; margin-bottom:0.2rem;">
                    <?= esc($user['fullname']) ?>
                </h2>
                <p style="font-size:0.8rem; color:var(--coral); font-weight:600; margin-bottom:0.875rem;">
                    @<?= esc($user['username']) ?>
                </p>
                <span class="badge-coral" style="font-size:0.68rem;"><?= esc(session('user')['role'] ?? 'Student') ?></span>
            </div>

            <div class="px-4 pb-4" style="border-top:1px solid var(--border-1); margin-top:0.5rem; padding-top:1rem;">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span style="font-size:0.78rem; color:var(--text-300);"><i class="bi bi-calendar3 me-1 opacity-60"></i> Joined</span>
                    <span style="font-size:0.78rem; font-weight:700; color:var(--text-100);">
                        <?= isset($user['created_at']) ? date('M Y', strtotime($user['created_at'])) : 'Unknown' ?>
                    </span>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span style="font-size:0.78rem; color:var(--text-300);"><i class="bi bi-activity me-1 opacity-60"></i> Status</span>
                    <span class="badge-green" style="font-size:0.65rem;">
                        <i class="bi bi-circle-fill me-1" style="font-size:0.35rem;"></i> Active
                    </span>
                </div>
                <a href="<?= base_url('profile/edit') ?>" class="clean-btn-primary w-100 d-block text-center" style="font-size:0.82rem;">
                    <i class="bi bi-pencil-square me-1"></i> Edit Profile
                </a>
            </div>
        </div>
    </div>

    <!-- Details -->
    <div class="col-lg-8">

        <!-- Academic Record -->
        <div class="clean-card mb-4">
            <div class="clean-card-header d-flex align-items-center gap-2">
                <div class="stat-icon-box teal" style="width:28px;height:28px;font-size:0.8rem;"><i class="bi bi-mortarboard-fill"></i></div>
                <span style="font-size:0.72rem; font-weight:700; color:var(--teal); text-transform:uppercase; letter-spacing:0.1em;">Academic Record</span>
            </div>
            <div>
                <?php
                $rows = [
                    ['Student ID',      'bi-person-badge-fill', $user['student_id'] ?? 'Not Set'],
                    ['Course / Program','bi-book-fill',         $user['course'] ?? 'Not Set'],
                    ['Year Level',      'bi-bar-chart-fill',    $user['year_level'] ? 'Year ' . esc($user['year_level']) : 'Not Set'],
                    ['Section',         'bi-collection-fill',   $user['section'] ?? 'Not Set'],
                ];
                foreach ($rows as $i => [$label, $icon, $value]):
                ?>
                <div class="d-flex align-items-center px-4 py-3" style="border-bottom:<?= $i < count($rows)-1 ? '1px solid var(--border-1)' : 'none' ?>;">
                    <span style="width:40%; font-size:0.82rem; color:var(--text-300); font-weight:500; display:flex; align-items:center; gap:0.5rem;">
                        <i class="bi <?= $icon ?>" style="opacity:0.4;"></i> <?= $label ?>
                    </span>
                    <span style="font-weight:700; font-size:0.875rem; color:var(--text-100);"><?= esc($value) ?></span>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Contact Details -->
        <div class="clean-card">
            <div class="clean-card-header d-flex align-items-center gap-2">
                <div class="stat-icon-box coral" style="width:28px;height:28px;font-size:0.8rem;"><i class="bi bi-person-vcard-fill"></i></div>
                <span style="font-size:0.72rem; font-weight:700; color:var(--coral); text-transform:uppercase; letter-spacing:0.1em;">Contact Details</span>
            </div>
            <div>
                <?php
                $contacts = [
                    ['Email Address', 'bi-envelope-fill',   esc($user['username'] ?? 'Not Set')],
                    ['Phone Number',  'bi-telephone-fill',  esc($user['phone'] ?? 'Not Set')],
                    ['Home Address',  'bi-geo-alt-fill',    nl2br(esc($user['address'] ?? 'Not Set'))],
                ];
                foreach ($contacts as $i => [$label, $icon, $value]):
                ?>
                <div class="d-flex align-items-<?= $i === 2 ? 'start' : 'center' ?> px-4 py-3" style="border-bottom:<?= $i < count($contacts)-1 ? '1px solid var(--border-1)' : 'none' ?>; <?= $i===2 ? 'padding-top:0.9rem;' : '' ?>">
                    <span style="width:40%; font-size:0.82rem; color:var(--text-300); font-weight:500; display:flex; align-items:center; gap:0.5rem; <?= $i===2 ? 'margin-top:0.1rem;' : '' ?>">
                        <i class="bi <?= $icon ?>" style="opacity:0.4;"></i> <?= $label ?>
                    </span>
                    <span style="font-weight:600; font-size:0.875rem; color:var(--text-100); line-height:1.55;"><?= $value ?></span>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
</div>
<?= $this->endSection() ?>
