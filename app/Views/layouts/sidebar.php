<?php
$role       = session('user')['role'] ?? 'guest';
$segment    = service('uri')->getSegment(1);
$subsegment = service('uri')->getSegment(2);
?>
<!-- ======================================================
     FLOATING BOTTOM DOCK — replaces sidebar entirely
     ====================================================== -->
<nav class="float-dock" aria-label="Main Navigation">

    <?php if ($role === 'teacher' || $role === 'admin' || $role === 'coordinator'): ?>

        <a href="<?= base_url('dashboard') ?>"
           class="dock-item <?= ($segment === 'dashboard') ? 'active' : '' ?>">
            <i class="bi bi-grid-fill"></i>
            <span>Dashboard</span>
        </a>

        <a href="<?= base_url('students') ?>"
           class="dock-item <?= ($segment === 'students') ? 'active' : '' ?>">
            <i class="bi bi-journal-richtext"></i>
            <span>Roster</span>
        </a>

        <?php if ($role === 'admin'): ?>
            <div class="dock-sep"></div>

            <a href="<?= base_url('admin/roles') ?>"
               class="dock-item <?= ($segment === 'admin' && $subsegment === 'roles') ? 'active' : '' ?>">
                <i class="bi bi-shield-fill"></i>
                <span>Roles</span>
            </a>

            <a href="<?= base_url('admin/users') ?>"
               class="dock-item <?= ($segment === 'admin' && $subsegment === 'users') ? 'active' : '' ?>">
                <i class="bi bi-people-fill"></i>
                <span>Users</span>
            </a>
        <?php endif; ?>

    <?php else: ?>

        <a href="<?= base_url('student/dashboard') ?>"
           class="dock-item <?= ($segment === 'student' || $segment === 'dashboard') ? 'active' : '' ?>">
            <i class="bi bi-house-fill"></i>
            <span>Home</span>
        </a>

        <a href="<?= base_url('profile') ?>"
           class="dock-item <?= ($segment === 'profile' && empty($subsegment)) ? 'active' : '' ?>">
            <i class="bi bi-person-fill"></i>
            <span>Profile</span>
        </a>

        <a href="<?= base_url('profile/edit') ?>"
           class="dock-item <?= ($segment === 'profile' && $subsegment === 'edit') ? 'active' : '' ?>">
            <i class="bi bi-pencil-fill"></i>
            <span>Edit</span>
        </a>

    <?php endif; ?>

    <div class="dock-sep"></div>

    <a href="<?= base_url('logout') ?>" class="dock-item danger">
        <i class="bi bi-power"></i>
        <span>Logout</span>
    </a>

</nav>
