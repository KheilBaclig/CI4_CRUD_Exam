<?= $this->extend('layouts/main') ?>

<?= $this->section('breadcrumb') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<form action="<?= base_url('profile/update') ?>" method="post" enctype="multipart/form-data" id="profileForm">
    <?= csrf_field() ?>

    <?php if (session('errors')): ?>
        <div class="alert alert-danger d-flex align-items-start gap-2 mb-4 fade-in">
            <i class="bi bi-exclamation-triangle-fill mt-1 flex-shrink-0"></i>
            <div>
                <strong>Please fix the following:</strong>
                <ul class="mb-0 mt-1 ps-3" style="font-size:0.85rem;">
                    <?php foreach (session('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    <?php endif; ?>

    <!-- Profile Header Banner -->
    <div class="clean-card mb-4 fade-in" style="overflow:visible; border-color:var(--border-gold);">
        <!-- Gold banner -->
        <div style="height:120px; background:linear-gradient(130deg, #0d2044 0%, #162344 40%, #0f1c38 100%); border-radius:var(--radius-lg) var(--radius-lg) 0 0; position:relative; overflow:hidden;">
            <div style="position:absolute; inset:0; background-image: linear-gradient(rgba(245,200,66,0.03) 1px,transparent 1px), linear-gradient(90deg,rgba(245,200,66,0.03) 1px,transparent 1px); background-size:30px 30px;"></div>
            <div style="position:absolute; bottom:-1px; left:0; right:0; height:2px; background:var(--gradient-gold); opacity:0.5;"></div>
        </div>

        <!-- Avatar + info row -->
        <div class="px-4 pb-4 d-flex flex-column flex-md-row align-items-center align-items-md-end gap-3" style="margin-top:-55px;">
            <!-- Avatar -->
            <div class="position-relative flex-shrink-0" style="margin-bottom:0.5rem;">
                <?php if (!empty($user['profile_image'])): ?>
                    <img id="preview" src="<?= base_url('uploads/profiles/' . esc($user['profile_image'])) ?>"
                         alt="Profile"
                         style="width:110px; height:110px; border-radius:16px; object-fit:cover; border:3px solid var(--bg-card); box-shadow:0 8px 24px rgba(0,0,0,0.6); display:block;">
                <?php else: ?>
                    <div id="preview" style="width:110px; height:110px; border-radius:16px; background:rgba(22,35,68,0.9); color:var(--gold-400); display:flex; align-items:center; justify-content:center; border:3px solid var(--bg-card); box-shadow:0 8px 24px rgba(0,0,0,0.6);">
                        <i class="bi bi-person-fill" style="font-size:3.5rem;"></i>
                    </div>
                <?php endif; ?>

                <label for="profile_image" id="cameraBtn" title="Change photo"
                       class="position-absolute bottom-0 end-0 d-flex align-items-center justify-content-center"
                       style="width:32px; height:32px; cursor:pointer; background:var(--gradient-gold); color:#07111f; border-radius:8px; border:2px solid var(--bg-card); box-shadow:var(--shadow-gold); transition:transform 0.2s; font-size:0.85rem;">
                    <i class="bi bi-camera-fill"></i>
                </label>
                <input type="file" name="profile_image" id="profile_image" class="d-none" accept="image/jpeg,image/png,image/webp">
            </div>

            <div class="flex-grow-1 text-center text-md-start">
                <h2 style="font-size:1.3rem; font-weight:800; color:var(--text-primary); letter-spacing:-0.02em; margin-bottom:0.15rem;">
                    <?= esc($user['fullname']) ?>
                </h2>
                <p style="font-size:0.85rem; color:var(--text-secondary); margin:0;">
                    <i class="bi bi-pencil-square me-1" style="color:var(--gold-500);"></i> Editing your profile
                </p>
                <p id="fileInfo" style="font-size:0.75rem; color:var(--teal-400); display:none; margin:0.3rem 0 0;"></p>
            </div>

            <div class="d-flex gap-2 flex-shrink-0">
                <a href="<?= base_url('profile') ?>" class="clean-btn-secondary">
                    <i class="bi bi-x-lg"></i> Discard
                </a>
                <button type="submit" class="clean-btn-primary">
                    <i class="bi bi-check-lg"></i> Save Changes
                </button>
            </div>
        </div>
    </div>

    <!-- Form Grid -->
    <div class="row g-4 fade-in">

        <!-- Personal Details -->
        <div class="col-lg-6">
            <div class="clean-card h-100">
                <div class="clean-card-header d-flex align-items-center gap-2">
                    <div class="stat-icon gold" style="width:30px;height:30px;font-size:0.85rem;"><i class="bi bi-person-vcard-fill"></i></div>
                    <span style="font-size:0.75rem; font-weight:700; color:var(--gold-400); text-transform:uppercase; letter-spacing:0.08em;">Personal Details</span>
                </div>
                <div class="p-4">
                    <div class="mb-4">
                        <label class="form-label">Full Name <span style="color:var(--rose-400);">*</span></label>
                        <input type="text" name="fullname" class="clean-input <?= session('errors.fullname') ? 'border-danger' : '' ?>"
                               value="<?= old('fullname', esc($user['fullname'])) ?>" placeholder="Your full name" required>
                        <?php if (session('errors.fullname')): ?>
                            <div class="mt-1 d-flex align-items-center gap-1" style="font-size:0.75rem; color:var(--rose-400);">
                                <i class="bi bi-exclamation-circle-fill"></i> <?= session('errors.fullname') ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Email / Username <span style="color:var(--rose-400);">*</span></label>
                        <input type="text" name="username" class="clean-input <?= session('errors.username') ? 'border-danger' : '' ?>"
                               value="<?= old('username', esc($user['username'])) ?>" placeholder="your@email.com" required>
                        <?php if (session('errors.username')): ?>
                            <div class="mt-1 d-flex align-items-center gap-1" style="font-size:0.75rem; color:var(--rose-400);">
                                <i class="bi bi-exclamation-circle-fill"></i> <?= session('errors.username') ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Phone Number</label>
                        <div class="position-relative">
                            <span class="position-absolute" style="left:0.875rem; top:50%; transform:translateY(-50%); color:var(--text-muted); font-size:0.9rem; pointer-events:none;">
                                <i class="bi bi-telephone"></i>
                            </span>
                            <input type="tel" name="phone" class="clean-input" style="padding-left:2.4rem;"
                                   value="<?= old('phone', esc($user['phone'] ?? '')) ?>"
                                   placeholder="+63 9XX XXX XXXX">
                        </div>
                    </div>

                    <div>
                        <label class="form-label d-flex justify-content-between">
                            <span>Home Address</span>
                            <span id="addrCount" style="font-weight:400; color:var(--text-muted); font-size:0.75rem;">0 / 255</span>
                        </label>
                        <textarea name="address" id="addressField" rows="3" class="clean-input" maxlength="255"
                                  placeholder="Street, City, Province"><?= old('address', esc($user['address'] ?? '')) ?></textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- Academic + Password -->
        <div class="col-lg-6 d-flex flex-column gap-4">

            <!-- Academic Record -->
            <div class="clean-card">
                <div class="clean-card-header d-flex align-items-center gap-2">
                    <div class="stat-icon teal" style="width:30px;height:30px;font-size:0.85rem;"><i class="bi bi-mortarboard-fill"></i></div>
                    <span style="font-size:0.75rem; font-weight:700; color:var(--teal-400); text-transform:uppercase; letter-spacing:0.08em;">Academic Record</span>
                </div>
                <div class="p-4">
                    <div class="mb-4">
                        <label class="form-label">Student ID</label>
                        <input type="text" name="student_id" class="clean-input"
                               value="<?= old('student_id', esc($user['student_id'] ?? '')) ?>"
                               placeholder="e.g. 2024-00001">
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Course / Program</label>
                        <input type="text" name="course" class="clean-input"
                               value="<?= old('course', esc($user['course'] ?? '')) ?>"
                               placeholder="e.g. BS Computer Science">
                    </div>

                    <div class="row g-3">
                        <div class="col-6">
                            <label class="form-label">Year Level</label>
                            <select name="year_level" class="clean-input">
                                <option value="" style="background:#0f1a30;">— Select —</option>
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <option value="<?= $i ?>" style="background:#0f1a30;"
                                        <?= old('year_level', $user['year_level'] ?? '') == $i ? 'selected' : '' ?>>
                                        Year <?= $i ?>
                                    </option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="form-label">Section</label>
                            <input type="text" name="section" class="clean-input"
                                   value="<?= old('section', esc($user['section'] ?? '')) ?>"
                                   placeholder="e.g. A, B, C">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Change Password -->
            <div class="clean-card">
                <div class="clean-card-header d-flex align-items-center gap-2">
                    <div class="stat-icon rose" style="width:30px;height:30px;font-size:0.85rem;"><i class="bi bi-shield-lock-fill"></i></div>
                    <div>
                        <span style="font-size:0.75rem; font-weight:700; color:var(--rose-400); text-transform:uppercase; letter-spacing:0.08em;">Change Password</span>
                        <span style="font-size:0.72rem; color:var(--text-muted); margin-left:0.5rem;">— leave blank to keep current</span>
                    </div>
                </div>
                <div class="p-4">
                    <div class="mb-3">
                        <label class="form-label">New Password</label>
                        <div class="position-relative">
                            <input type="password" name="new_password" id="newPassword" class="clean-input"
                                   style="padding-right:2.8rem;" placeholder="Min. 8 characters" autocomplete="new-password">
                            <button type="button" class="toggle-pw position-absolute border-0 bg-transparent p-0"
                                    style="right:0.875rem; top:50%; transform:translateY(-50%); color:var(--text-muted); cursor:pointer;" data-target="newPassword">
                                <i class="bi bi-eye" style="font-size:0.95rem;"></i>
                            </button>
                        </div>
                    </div>
                    <div>
                        <label class="form-label">Confirm Password</label>
                        <div class="position-relative">
                            <input type="password" name="confirm_password" id="confirmPassword" class="clean-input"
                                   style="padding-right:2.8rem;" placeholder="Repeat new password" autocomplete="new-password">
                            <button type="button" class="toggle-pw position-absolute border-0 bg-transparent p-0"
                                    style="right:0.875rem; top:50%; transform:translateY(-50%); color:var(--text-muted); cursor:pointer;" data-target="confirmPassword">
                                <i class="bi bi-eye" style="font-size:0.95rem;"></i>
                            </button>
                        </div>
                        <div id="pwMismatch" class="mt-1 d-none d-flex align-items-center gap-1" style="font-size:0.75rem; color:var(--rose-400);">
                            <i class="bi bi-exclamation-circle-fill"></i> Passwords do not match
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</form>
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script>
(function () {
    // Avatar preview
    const fileInput = document.getElementById('profile_image');
    const fileInfo  = document.getElementById('fileInfo');

    fileInput.addEventListener('change', function () {
        const file = this.files[0];
        if (!file) return;
        if (file.size > 2 * 1024 * 1024) {
            alert('Image must be under 2 MB.');
            this.value = '';
            return;
        }
        fileInfo.textContent = file.name + ' (' + (file.size / 1024).toFixed(0) + ' KB)';
        fileInfo.style.display = 'block';
        const reader = new FileReader();
        reader.onload = (e) => {
            const prev = document.getElementById('preview');
            if (prev && prev.tagName === 'IMG') {
                prev.src = e.target.result;
            } else if (prev) {
                const img = document.createElement('img');
                img.id = 'preview';
                img.alt = 'Profile';
                img.src = e.target.result;
                img.style.cssText = prev.style.cssText;
                prev.parentNode.replaceChild(img, prev);
            }
        };
        reader.readAsDataURL(file);
    });

    // Camera button hover
    const camBtn = document.getElementById('cameraBtn');
    if (camBtn) {
        camBtn.addEventListener('mouseenter', () => camBtn.style.transform = 'scale(1.15)');
        camBtn.addEventListener('mouseleave', () => camBtn.style.transform = 'scale(1)');
    }

    // Address counter
    const addr      = document.getElementById('addressField');
    const addrCount = document.getElementById('addrCount');
    if (addr && addrCount) {
        const updateCount = () => addrCount.textContent = addr.value.length + ' / 255';
        addr.addEventListener('input', updateCount);
        updateCount();
    }

    // Password toggle
    document.querySelectorAll('.toggle-pw').forEach(btn => {
        btn.addEventListener('click', function () {
            const input = document.getElementById(this.dataset.target);
            const icon  = this.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.className = 'bi bi-eye-slash';
            } else {
                input.type = 'password';
                icon.className = 'bi bi-eye';
            }
        });
    });

    // Password match
    const newPw    = document.getElementById('newPassword');
    const confPw   = document.getElementById('confirmPassword');
    const mismatch = document.getElementById('pwMismatch');

    function checkPw() {
        if (confPw.value && newPw.value !== confPw.value) {
            mismatch.classList.remove('d-none');
            confPw.style.borderColor = 'var(--rose-500)';
        } else {
            mismatch.classList.add('d-none');
            confPw.style.borderColor = '';
        }
    }

    newPw.addEventListener('input', checkPw);
    confPw.addEventListener('input', checkPw);

    document.getElementById('profileForm').addEventListener('submit', function (e) {
        if (newPw.value && newPw.value !== confPw.value) {
            e.preventDefault();
            confPw.focus();
            mismatch.classList.remove('d-none');
        }
    });
})();
</script>
<?= $this->endSection() ?>
