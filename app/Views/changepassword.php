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
    <div class="modal-dialog">
            <div class="modal-content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="text-center">
                                 <h5 class="modal-title">Change Password</h5>
                            </div>
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
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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