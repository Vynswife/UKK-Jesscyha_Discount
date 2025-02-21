<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

        .card {
            border: none;
            border-radius: 9px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            color: white;
            font-weight: 600;
        }

        .btn-light {
            background-color: #fff;
            color: #6a11cb;
            font-weight: 500;
        }

        .btn-light:hover {
            background-color: #f1f1f1;
        }

        .profile-photo img {
            width: 140px;
            height: 140px;
            object-fit: cover;
            border: 5px solid white;
            margin-top: -70px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }

        table th {
            color: #6c757d;
            font-weight: 600;
        }

        table td {
            font-weight: 500;
        }

        .modal-content {
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        .btn-success {
            background-color: #28a745;
            border: none;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        .drag-drop-area {
            border: 2px dashed #6a11cb;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            background-color: #f8f9fa;
            border-radius: 10px;
            transition: background 0.3s;
        }

        .drag-drop-area.dragover {
            background-color: #e9f5ff;
            border-color: #2575fc;
        }

        .preview-image {
            display: block;
            max-width: 100px;
            margin: 10px auto;
            border: 2px dashed #6a11cb;
            border-radius: 8px;
        }
        .btn-gradient-purple {
    background: linear-gradient(135deg, #6a11cb, #2575fc);
    color: white;
    border: none;
    padding: 5px 10px; /* Tambah padding untuk ukuran lebih besar */
    font-size: 16px;    /* Perbesar ukuran font */
    border-radius: 8px; /* Biar lebih smooth di ujungnya */
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.btn-gradient-purple:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(106, 17, 203, 0.4);
    color: white;
}
    </style>
</head>

<body>
    <?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success'); ?>
    </div>
<?php elseif (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('error'); ?>
    </div>
<?php endif; ?>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card text-center">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">User Profile</h4>
                        <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#editProfileModal">Edit Profile</button>
                    </div>
                    <div class="card-body">
                        <div class="profile-photo">
                            <img src="<?= base_url('img/' . $user->foto) ?>" alt="Profile Photo" class="rounded-circle">
                        </div>
                        <table class="table table-borderless mt-4">
                            <tr>
                                <th>Name</th>
                                <td><?= $user->nama_asli ?></td>
                            </tr>
                            <tr>
                                <th>Username</th>
                                <td><?= $user->username ?></td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td><?= $user->email ?></td>
                            </tr>
                        </table>
                        <button class="btn btn-gradient-purple mt-3" data-bs-toggle="modal" data-bs-target="#changePasswordModal">Change Password</button>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('home/aksi_e_profile') ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $user->id_user ?>">
            <input type="hidden" name="old_foto" value="<?= $user->foto ?>"> <!-- INI YANG BARU -->
            
            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" class="form-control" name="nama_asli" value="<?= $user->nama_asli ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" class="form-control" name="username" value="<?= $user->username ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" value="<?= $user->email ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Upload New Photo</label>
                <div id="dropArea" class="drag-drop-area">
                    Drag & Drop or Click to Upload
                    <input type="file" name="foto" class="form-control d-none" id="foto">
                </div>
                <img id="preview" class="preview-image" src="#" alt="Preview" style="display:none;">
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-success">Save Changes</button>
            </div>
        </form>

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const dropArea = document.getElementById('dropArea');
        const fileInput = document.getElementById('foto');
        const previewImage = document.getElementById('preview');

        dropArea.addEventListener('dragover', (event) => {
            event.preventDefault();
            dropArea.classList.add('dragover');
        });

        dropArea.addEventListener('dragleave', () => {
            dropArea.classList.remove('dragover');
        });

        dropArea.addEventListener('drop', (event) => {
            event.preventDefault();
            dropArea.classList.remove('dragover');
            if (event.dataTransfer.files && event.dataTransfer.files[0]) {
                fileInput.files = event.dataTransfer.files;
                previewFile(event.dataTransfer.files[0]);
            }
        });

        dropArea.addEventListener('click', () => fileInput.click());

        fileInput.addEventListener('change', () => {
            if (fileInput.files && fileInput.files[0]) {
                previewFile(fileInput.files[0]);
            }
        });

        function previewFile(file) {
    const validImageTypes = ['image/jpeg', 'image/png', 'image/gif'];
    if (validImageTypes.includes(file.type)) {
        const reader = new FileReader();
        reader.onload = function (e) {
            previewImage.src = e.target.result;
            previewImage.style.display = 'block';
        };
        reader.readAsDataURL(file);
    } else {
        alert('Please upload a valid image file (JPEG, PNG, GIF).');
        fileInput.value = ''; // Reset input kalau bukan gambar
        previewImage.style.display = 'none';
    }
}

    </script>

    <!-- Modal Change Password -->
    <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Change Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="<?= base_url('home/aksi_changepass') ?>">
                        <div class="mb-3">
                            <label for="inputOldPassword" class="form-label">Old Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="inputOldPassword" name="old">
                                <button class="btn btn-outline-secondary" type="button" id="toggleOldPassword">
                                    <i class="fas fa-eye-slash" id="iconOldPassword"></i>
                                </button>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="inputNewPassword" class="form-label">New Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="inputNewPassword" name="new">
                                <button class="btn btn-outline-secondary" type="button" id="toggleNewPassword">
                                    <i class="fas fa-eye-slash" id="iconNewPassword"></i>
                                </button>
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-gradient-purple">Confirm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePasswordVisibility(inputId, iconId) {
            const passwordField = document.getElementById(inputId);
            const icon = document.getElementById(iconId);

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            } else {
                passwordField.type = 'password';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            }
        }

        document.getElementById('toggleOldPassword').addEventListener('click', function() {
            togglePasswordVisibility('inputOldPassword', 'iconOldPassword');
        });

        document.getElementById('toggleNewPassword').addEventListener('click', function() {
            togglePasswordVisibility('inputNewPassword', 'iconNewPassword');
        });
    </script>
</body>

</html>
