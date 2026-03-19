<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Nexus — Academic System</title>
    <meta name="description" content="Nexus Academic System — Modern student information portal." />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= base_url('assets/css/premium.css') ?>?v=<?= time() ?>" />
</head>
<body>
    <div class="layout-wrapper">

        <div class="main-wrapper">
            <!-- Top Bar -->
            <?= $this->include('layouts/header') ?>

            <!-- Page Content -->
            <main class="content-wrapper">
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success d-flex align-items-center gap-2 mb-4 fade-in">
                        <i class="bi bi-check-circle-fill flex-shrink-0"></i>
                        <span><?= session()->getFlashdata('success') ?></span>
                        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <?= $this->renderSection('content') ?>
            </main>
        </div>

        <!-- Floating Bottom Dock Navigation -->
        <?= $this->include('layouts/sidebar') ?>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <?= $this->renderSection('javascript') ?>
</body>
</html>
