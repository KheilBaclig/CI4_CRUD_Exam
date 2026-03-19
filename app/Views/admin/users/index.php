<?= $this->extend('layouts/main') ?>

<?= $this->section('breadcrumb') ?>
<!-- Handled by topbar -->
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4 gap-3">
    <div>
        <h2 class="mb-1" style="font-size: 1.5rem; font-weight: 700; color: var(--text-primary);">User Identity & Access</h2>
        <p class="mb-0" style="font-size: 0.875rem; color: var(--text-secondary);">Manage system privileges and enforce RBAC topology.</p>
    </div>
    <a href="<?= base_url('/admin/roles') ?>" class="btn shadow-sm-clean d-inline-flex align-items-center" style="background: rgba(255,255,255,0.05); color: #f8fafc; border: 1px solid var(--border-light); font-weight: 500; font-size: 0.9rem; transition: background 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.1)'" onmouseout="this.style.background='rgba(255,255,255,0.05)'">
        <i class="bi bi-sliders2 me-2" style="color: #6366f1;"></i> Configure Roles
    </a>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success d-flex align-items-center mb-4" style="background: rgba(16,185,129,0.1); border: 1px solid rgba(16,185,129,0.2); color: #34d399; font-size: 0.875rem; border-radius: 8px;">
        <i class="bi bi-check-circle-fill me-2"></i><?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="alert" style="opacity: 0.5;"></button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger d-flex align-items-center mb-4" style="background: rgba(244,63,94,0.1); border: 1px solid rgba(244,63,94,0.2); color: #fb7185; font-size: 0.875rem; border-radius: 8px;">
        <i class="bi bi-exclamation-triangle-fill me-2"></i><?= session()->getFlashdata('error') ?>
        <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="alert" style="opacity: 0.5;"></button>
    </div>
<?php endif; ?>

<div class="alert d-flex align-items-start gap-3 mb-4" style="background: rgba(99,102,241,0.05); border: 1px solid rgba(99,102,241,0.2); color: #a5b4fc; border-radius: 8px;">
    <i class="bi bi-lightning-charge-fill fs-5 flex-shrink-0 mt-1" style="color: #818cf8; filter: drop-shadow(0 0 8px rgba(129,140,248,0.5));"></i>
    <div style="font-size: 0.875rem; line-height: 1.5;">
        <strong style="color: #c7d2fe;">Privilege Distribution Center</strong><br>
        Changes made here manipulate session tokens and take effect upon the target user's next authenticated login cycle.
    </div>
</div>

<div class="nexus-table-container fade-in shadow-md-clean border-0">
    <div class="px-4 py-3 border-bottom d-flex align-items-center" style="border-color: var(--border-1) !important; background: rgba(0,0,0,0.2);">
        <h6 class="mb-0" style="color: var(--text-100); font-size: 0.9rem; font-weight: 600;">System Identities</h6>
        <span class="ms-2 px-2 py-1 rounded-pill" style="background: var(--bg-raised); color: var(--text-300); font-size: 0.7rem; font-weight: 600; border: 1px solid var(--border-1);"><?= count($users) ?> DETECTED</span>
    </div>
    
    <div class="table-responsive">
        <table class="nexus-table align-middle">
            <thead>
                <tr>
                    <th class="ps-4">ID</th>
                    <th>Identity Root</th>
                    <th>Email Vector</th>
                    <th>Clearance Level</th>
                    <th class="pe-4 text-end">Topology Assignment</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $i => $u): ?>
                <?php
                    $isSelf = ($u['id'] == (session('user')['id'] ?? 0));
                    
                    $badgeBg = 'var(--bg-raised)';
                    $badgeColor = 'var(--text-300)';
                    $badgeBorder = 'var(--border-2)';
                    
                    if ($u['role_name'] === 'admin') {
                        $badgeBg = 'rgba(255, 98, 64, 0.1)'; $badgeColor = 'var(--coral)'; $badgeBorder = 'var(--coral-border)';
                    } elseif ($u['role_name'] === 'teacher') {
                        $badgeBg = 'rgba(0, 212, 170, 0.1)'; $badgeColor = 'var(--teal)'; $badgeBorder = 'var(--teal-border)';
                    } elseif ($u['role_name'] === 'student') {
                        $badgeBg = 'rgba(244, 185, 66, 0.1)'; $badgeColor = 'var(--amber)'; $badgeBorder = 'rgba(244, 185, 66, 0.2)';
                    }
                ?>
                <tr>
                    <td class="ps-4 py-3 nexus-table-meta">#<?= sprintf('%04d', $u['id']) ?></td>
                    <td class="py-3">
                        <div class="d-flex align-items-center gap-3">
                            <?php if (!empty($u['profile_image'])): ?>
                                <img src="<?= base_url('uploads/profiles/' . esc($u['profile_image'])) ?>"
                                     class="rounded-circle" style="width:40px;height:40px;object-fit:cover; border: 2px solid var(--border-2);" alt="">
                            <?php else: ?>
                                <div class="rounded-circle d-flex align-items-center justify-content-center"
                                     style="width:40px;height:40px;flex-shrink:0; background: var(--bg-raised); border: 1px solid var(--border-2);">
                                    <i class="bi bi-person-fill" style="color: var(--text-300); font-size: 1.2rem;"></i>
                                </div>
                            <?php endif; ?>
                            <div>
                                <div class="nexus-table-label" style="font-size: 0.95rem;"><?= esc($u['name']) ?></div>
                                <?php if ($isSelf): ?>
                                    <div style="font-size: 0.65rem; font-weight: 700; color: var(--amber); text-transform: uppercase; letter-spacing: 0.1em; margin-top: 2px;">Active Unit (You)</div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </td>
                    <td class="py-3" style="font-size: 0.85rem; color: var(--text-300); font-family: monospace;">
                        <?= esc($u['email']) ?>
                    </td>
                    <td class="py-3">
                        <span class="px-2 py-1 rounded" style="background: <?= $badgeBg ?>; color: <?= $badgeColor ?>; border: 1px solid <?= $badgeBorder ?>; font-size: 0.72rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.02em;">
                            <?= esc($u['role_label'] ?? 'UNASSIGNED') ?>
                        </span>
                    </td>
                    <td class="py-3 pe-4 text-end">
                        <?php if ($isSelf): ?>
                            <span class="d-inline-flex align-items-center" style="color: var(--text-400); font-size: 0.8rem; font-weight: 500;">
                                <i class="bi bi-shield-lock-fill me-2" style="font-size: 0.9rem;"></i> Self-modification locked
                            </span>
                        <?php else: ?>
                        <form action="<?= base_url('/admin/users/assign-role/' . $u['id']) ?>" method="POST" class="d-flex align-items-center justify-content-end gap-2 m-0">
                            <?= csrf_field() ?>
                            <select name="role_id" class="clean-input py-0 px-2 m-0" style="font-size: 0.8rem; height: 32px; width: auto; max-width: 130px; background: rgba(0,0,0,0.2); border-color: var(--border-2);">
                                <?php foreach ($roles as $roleId => $roleLabel): ?>
                                    <option value="<?= $roleId ?>" style="background: var(--bg-surface);" <?= $u['role_id'] == $roleId ? 'selected' : '' ?>>
                                        <?= esc($roleLabel) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <button type="submit" class="clean-btn-primary py-0 px-3" style="height: 32px; font-size: 0.75rem; border-radius: var(--radius-sm);">
                                Commit
                            </button>
                        </form>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
