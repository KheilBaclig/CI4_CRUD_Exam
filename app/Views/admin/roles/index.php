<?= $this->extend('layouts/main') ?>

<?= $this->section('breadcrumb') ?>
<!-- Handled by topbar -->
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4 gap-3">
    <div>
        <h2 class="mb-1" style="font-size: 1.5rem; font-weight: 700; color: var(--text-primary);">Role Management</h2>
        <p class="mb-0" style="font-size: 0.875rem; color: var(--text-secondary);">Configure what modules your users can access.</p>
    </div>
    <a href="<?= base_url('/admin/roles/create') ?>" class="clean-btn-primary text-decoration-none shadow-sm-clean d-inline-flex align-items-center">
        <i class="bi bi-plus-circle me-2"></i>Create New Role
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

<div class="alert d-flex align-items-start gap-3 mb-4" style="background: rgba(59,130,246,0.05); border: 1px solid rgba(59,130,246,0.2); color: #93c5fd; border-radius: 8px;">
    <i class="bi bi-shield-lock-fill fs-5 flex-shrink-0 mt-1" style="color: #60a5fa;"></i>
    <div style="font-size: 0.875rem; line-height: 1.5;">
        <strong style="color: #bfdbfe;">Administrator Access Only</strong><br>
        Roles govern the security architecture. The <code>admin</code> core role cannot be deleted. Removing a role automatically unassigns all bound users.
    </div>
</div>

<div class="nexus-table-container fade-in shadow-md-clean border-0">
    <div class="table-responsive">
        <table class="nexus-table align-middle">
            <thead>
                <tr>
                    <th class="ps-4">#</th>
                    <th>Role Identifier</th>
                    <th>Label</th>
                    <th>Description</th>
                    <th class="text-center">Bound Users</th>
                    <th class="text-center pe-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($roles as $i => $role): ?>
                <tr>
                    <td class="ps-4 py-3 nexus-table-meta"><?= sprintf('%02d', $i + 1) ?></td>
                    <td class="py-3">
                        <span class="px-2 py-1 rounded" style="background: rgba(251,113,133,0.1); color: #fb7185; font-size: 0.75rem; font-family: monospace; font-weight: 600; border: 1px solid rgba(251,113,133,0.2);">@<?= esc($role['name']) ?></span>
                        <?php if ($role['name'] === 'admin'): ?>
                            <i class="bi bi-shield-fill-check ms-2" style="color: var(--teal); font-size: 0.8rem; filter: drop-shadow(0 0 5px rgba(0,212,170,0.4));" title="System Protected"></i>
                        <?php endif; ?>
                    </td>
                    <td class="py-3 nexus-table-label"><?= esc($role['label']) ?></td>
                    <td class="py-3" style="font-size: 0.85rem; max-width:280px; color: var(--text-300);"><?= esc($role['description'] ?? '—') ?></td>
                    <td class="py-3 text-center">
                        <span class="px-2 py-1 rounded-pill" style="background: var(--bg-raised); color: var(--text-100); font-size: 0.75rem; font-weight: 600; border: 1px solid var(--border-1);"><?= $role['user_count'] ?></span>
                    </td>
                    <td class="py-3 text-center pe-4">
                        <div class="d-flex justify-content-center gap-2">
                            <a href="<?= base_url('/admin/roles/edit/' . $role['id']) ?>"
                               class="btn btn-sm d-inline-flex align-items-center justify-content-center" 
                               style="width: 32px; height: 32px; border-radius: var(--radius-sm); background: var(--bg-raised); color: var(--text-300); border: 1px solid var(--border-2); transition: all 0.2s;" 
                               onmouseover="this.style.color='var(--text-100)'; this.style.background='var(--bg-hover)'; this.style.borderColor='var(--coral-border)'" 
                               onmouseout="this.style.color='var(--text-300)'; this.style.background='var(--bg-raised)'; this.style.borderColor='var(--border-2)'" 
                               title="Configure">
                                <i class="bi bi-gear-fill"></i>
                            </a>
                            <?php if ($role['name'] !== 'admin'): ?>
                            <button type="button" class="btn btn-sm d-inline-flex align-items-center justify-content-center"
                                    style="width: 32px; height: 32px; border-radius: var(--radius-sm); background: rgba(244,63,94,0.1); color: #fb7185; border: 1px solid rgba(244,63,94,0.2); transition: all 0.2s;"
                                    onmouseover="this.style.background='rgba(244,63,94,0.2)'; this.style.color='#fff'" 
                                    onmouseout="this.style.background='rgba(244,63,94,0.1)'; this.style.color='#fb7185'"
                                    data-bs-toggle="modal" data-bs-target="#deleteModal"
                                    data-id="<?= $role['id'] ?>"
                                    data-label="<?= esc($role['label']) ?>"
                                    data-count="<?= $role['user_count'] ?>" title="Terminate">
                                <i class="bi bi-trash3-fill"></i>
                            </button>
                            <?php else: ?>
                            <button class="btn btn-sm d-inline-flex align-items-center justify-content-center" 
                                    style="width: 32px; height: 32px; border-radius: var(--radius-sm); background: transparent; color: var(--text-400); border: 1px solid transparent; cursor: not-allowed;" 
                                    disabled title="System Core Locked">
                                <i class="bi bi-lock-fill"></i>
                            </button>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="background: var(--bg-surface); backdrop-filter: blur(20px); border: 1px solid var(--border-light) !important;">
            <div class="modal-header border-bottom mx-4 px-0 py-3" style="border-color: rgba(255,255,255,0.05) !important;">
                <h5 class="modal-title" style="color: #f8fafc; font-weight: 600; font-size: 1.1rem;"><i class="bi bi-exclamation-octagon text-rose-500 me-2"></i>Terminate Role</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" style="opacity: 0.5;"></button>
            </div>
            <div class="modal-body px-4 py-4">
                <p class="mb-3" style="color: var(--text-secondary); font-size: 0.95rem;">Are you absolutely sure you want to permanently delete the <strong id="deleteRoleLabel" style="color: #f8fafc; font-family: monospace;"></strong> role?</p>
                <div id="deleteWarning" class="alert d-flex mb-0" style="display:none !important; background: rgba(245,158,11,0.1); border: 1px solid rgba(245,158,11,0.2); color: #fbbf24; font-size: 0.85rem;">
                    <i class="bi bi-people-fill me-2 mt-1"></i><span id="deleteWarningText"></span>
                </div>
            </div>
            <div class="modal-footer border-top mx-4 px-0 py-3" style="border-color: rgba(255,255,255,0.05) !important;">
                <button type="button" class="btn btn-link text-decoration-none text-muted" data-bs-dismiss="modal" style="font-weight: 500; font-size: 0.9rem;">Cancel Operation</button>
                <a href="#" id="deleteConfirmBtn" class="btn border-0" style="background: #e11d48; color: #fff; font-weight: 600; font-size: 0.9rem; padding: 0.5rem 1.25rem;">
                    Execute Deletion
                </a>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script>
document.getElementById('deleteModal').addEventListener('show.bs.modal', function (e) {
    const btn   = e.relatedTarget;
    const count = parseInt(btn.dataset.count);
    document.getElementById('deleteRoleLabel').textContent = '@' + btn.dataset.label;
    document.getElementById('deleteConfirmBtn').href = '<?= base_url('/admin/roles/delete/') ?>' + btn.dataset.id;
    const warn = document.getElementById('deleteWarning');
    if (count > 0) {
        warn.style.setProperty('display', 'flex', 'important');
        document.getElementById('deleteWarningText').textContent =
            'Warning: ' + count + ' user(s) currently operate under this role. They will instantly lose access capabilities upon termination.';
    } else {
        warn.style.setProperty('display', 'none', 'important');
    }
});
</script>
<?= $this->endSection() ?>
