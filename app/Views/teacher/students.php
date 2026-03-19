<?= $this->extend('layouts/main') ?>
<?= $this->section('breadcrumb') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Page Header -->
<div class="d-flex align-items-center justify-content-between mb-4 gap-3 fade-in">
    <div>
        <div style="font-size:0.65rem; font-weight:700; color:var(--teal-400); text-transform:uppercase; letter-spacing:0.12em; margin-bottom:0.3rem;">Academics</div>
        <h1 style="font-size:1.5rem; font-weight:800; color:var(--text-primary); letter-spacing:-0.03em; margin:0;">Student Roster</h1>
        <p style="font-size:0.85rem; color:var(--text-secondary); margin:0.25rem 0 0;">All enrolled students in the system</p>
    </div>
    <span class="badge-teal" style="font-size:0.8rem; padding:0.4rem 1rem;">
        <i class="bi bi-people-fill me-1"></i> <?= count($students) ?> Students
    </span>
</div>

<!-- Table Card -->
<div class="clean-card fade-in">
    <div class="clean-card-header d-flex align-items-center justify-content-between gap-3">
        <div class="d-flex align-items-center gap-2">
            <div class="stat-icon teal" style="width:30px;height:30px;font-size:0.85rem;"><i class="bi bi-table"></i></div>
            <span style="font-size:0.8rem; font-weight:700; color:var(--text-secondary); text-transform:uppercase; letter-spacing:0.06em;">All Students</span>
        </div>
        <div style="position:relative; max-width:220px; width:100%;">
            <input type="text" id="searchInput"
                   placeholder="Search student..."
                   style="width:100%; background:rgba(7,12,25,0.6); border:1px solid var(--border-light); border-radius:var(--radius-sm); color:var(--text-primary); font-size:0.83rem; padding:0.5rem 0.875rem 0.5rem 2.2rem; font-family:'Plus Jakarta Sans',sans-serif; outline:none; transition:border-color 0.2s;"
                   onfocus="this.style.borderColor='rgba(232,185,35,0.4)'"
                   onblur="this.style.borderColor='var(--border-light)'">
            <i class="bi bi-search" style="position:absolute; left:0.75rem; top:50%; transform:translateY(-50%); color:var(--text-muted); font-size:0.8rem; pointer-events:none;"></i>
        </div>
    </div>

    <div class="table-responsive">
        <table class="clean-table" id="studentTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Student</th>
                    <th>Student ID</th>
                    <th>Course</th>
                    <th>Year &amp; Section</th>
                    <th>Email</th>
                    <th style="text-align:center;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($students)): ?>
                <tr>
                    <td colspan="7" style="text-align:center; padding:3.5rem 1.5rem; color:var(--text-muted);">
                        <i class="bi bi-inbox" style="font-size:2rem; display:block; margin-bottom:0.5rem; opacity:0.4;"></i>
                        No students found in the system.
                    </td>
                </tr>
                <?php else: ?>
                <?php foreach ($students as $i => $s): ?>
                <tr>
                    <td style="color:var(--text-muted); font-size:0.8rem; font-weight:500;"><?= $i + 1 ?></td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <?php if (!empty($s['profile_image'])): ?>
                                <img src="<?= base_url('uploads/profiles/' . esc($s['profile_image'])) ?>"
                                     style="width:34px;height:34px;border-radius:8px;object-fit:cover;border:1px solid var(--border-light);" alt="">
                            <?php else: ?>
                                <div style="width:34px;height:34px;border-radius:8px;background:rgba(22,35,68,0.8);border:1px solid var(--border-light);display:flex;align-items:center;justify-content:center;color:var(--teal-400);font-size:0.9rem;flex-shrink:0;">
                                    <i class="bi bi-person-fill"></i>
                                </div>
                            <?php endif; ?>
                            <span style="font-weight:600; color:var(--text-primary);"><?= esc($s['name']) ?></span>
                        </div>
                    </td>
                    <td style="font-size:0.82rem; color:var(--text-secondary); font-family:monospace; letter-spacing:0.02em;">
                        <?= esc($s['student_id'] ?? '—') ?>
                    </td>
                    <td>
                        <?php if ($s['course']): ?>
                            <span class="badge-teal"><?= esc($s['course']) ?></span>
                        <?php else: ?>
                            <span style="color:var(--text-muted); font-size:0.82rem;">—</span>
                        <?php endif; ?>
                    </td>
                    <td style="font-size:0.85rem; color:var(--text-secondary);">
                        <?= $s['year_level'] ? 'Year ' . $s['year_level'] : '' ?>
                        <?= $s['section'] ? ' — ' . esc($s['section']) : '' ?>
                        <?= (!$s['year_level'] && !$s['section']) ? '—' : '' ?>
                    </td>
                    <td style="font-size:0.82rem; color:var(--text-secondary);"><?= esc($s['email']) ?></td>
                    <td style="text-align:center;">
                        <a href="<?= base_url('/students/show/' . $s['id']) ?>"
                           style="display:inline-flex;align-items:center;gap:0.35rem;padding:0.4rem 0.875rem;background:rgba(45,212,191,0.1);border:1px solid rgba(45,212,191,0.2);border-radius:6px;color:var(--teal-400);font-size:0.78rem;font-weight:600;text-decoration:none;transition:all 0.2s;"
                           onmouseover="this.style.background='rgba(45,212,191,0.2)'"
                           onmouseout="this.style.background='rgba(45,212,191,0.1)'">
                            <i class="bi bi-eye-fill"></i> View
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script>
document.getElementById('searchInput').addEventListener('keyup', function () {
    const q = this.value.toLowerCase();
    document.querySelectorAll('#studentTable tbody tr').forEach(row => {
        row.style.display = row.textContent.toLowerCase().includes(q) ? '' : 'none';
    });
});
</script>
<?= $this->endSection() ?>
