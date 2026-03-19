<?= $this->extend('layouts/main') ?>
<?= $this->section('breadcrumb') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-5 gap-3 fade-in">
    <div>
        <p style="font-size:0.65rem; font-weight:700; color:var(--teal); text-transform:uppercase; letter-spacing:0.14em; margin-bottom:0.35rem;">Student Portal</p>
        <h1 style="font-size:1.6rem; font-weight:800; letter-spacing:-0.03em; margin:0;">
            Hey, <?= esc($user['fullname'] ?? 'Student') ?> 👋
        </h1>
        <p style="font-size:0.85rem; color:var(--text-300); margin:0.25rem 0 0;">Your academic records at a glance</p>
    </div>
    <a href="<?= base_url('profile/edit') ?>" class="clean-btn-primary text-decoration-none" style="align-self:flex-start;">
        <i class="bi bi-pencil-square me-1"></i> Edit Profile
    </a>
</div>

<!-- Info tiles -->
<div class="row g-3 mb-4 fade-in">
    <div class="col-md-4">
        <div class="stat-card coral">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <span style="font-size:0.68rem; font-weight:700; text-transform:uppercase; color:var(--text-400); letter-spacing:0.1em;">Student ID</span>
                <div class="stat-icon-box coral"><i class="bi bi-person-badge-fill"></i></div>
            </div>
            <div style="font-size:1.3rem; font-weight:700; font-family:monospace; letter-spacing:0.02em; color:var(--text-100);">
                <?= esc($user['student_id'] ?? '—') ?>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card teal">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <span style="font-size:0.68rem; font-weight:700; text-transform:uppercase; color:var(--text-400); letter-spacing:0.1em;">Course / Program</span>
                <div class="stat-icon-box teal"><i class="bi bi-book-fill"></i></div>
            </div>
            <div style="font-size:1.1rem; font-weight:600; color:var(--text-100); line-height:1.4;">
                <?= esc($user['course'] ?? '—') ?>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card amber">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <span style="font-size:0.68rem; font-weight:700; text-transform:uppercase; color:var(--text-400); letter-spacing:0.1em;">Year &amp; Section</span>
                <div class="stat-icon-box amber"><i class="bi bi-calendar3-fill"></i></div>
            </div>
            <div style="font-size:1.1rem; font-weight:600; color:var(--text-100);">
                <?= esc($user['year_level'] ?? '-') ?> &mdash; <?= esc($user['section'] ?? '-') ?>
            </div>
        </div>
    </div>
</div>

<!-- Contact Info -->
<div class="clean-card fade-in">
    <div class="clean-card-header d-flex align-items-center gap-2">
        <div class="stat-icon-box coral" style="width:28px;height:28px;font-size:0.8rem;"><i class="bi bi-person-vcard-fill"></i></div>
        <span style="font-size:0.72rem; font-weight:700; color:var(--coral); text-transform:uppercase; letter-spacing:0.1em;">Contact Information</span>
    </div>
    <div>
        <?php
        $contacts = [
            ['Email Address', 'bi-envelope-fill',  esc($user['email'] ?? '—')],
            ['Phone Number',  'bi-telephone-fill', esc($user['phone'] ?? '—')],
            ['Home Address',  'bi-geo-alt-fill',   esc($user['address'] ?? '—')],
        ];
        foreach ($contacts as $i => [$label, $icon, $val]):
        ?>
        <div class="d-flex align-items-center px-4 py-3" style="border-bottom:<?= $i < count($contacts)-1 ? '1px solid var(--border-1)' : 'none' ?>;">
            <span style="width:220px; font-size:0.82rem; color:var(--text-300); font-weight:500; display:flex; align-items:center; gap:0.5rem;">
                <i class="bi <?= $icon ?>" style="opacity:0.4;"></i> <?= $label ?>
            </span>
            <span style="font-weight:600; font-size:0.875rem; color:var(--text-100);"><?= $val ?></span>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<?= $this->endSection() ?>
