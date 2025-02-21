<style>
    .btn-sm-rounded {
        border-radius: 50%;
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
        line-height: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #007BFF;
        color: white;
        border: none;
    }
    .btn-sm-rounded:hover {
        background-color: #0056b3;
        color: white;
    }

    .btn-outline-custom {
        border-radius: 4px;
            
        border: 1px solid #007BFF;
        color: #007BFF;
        background-color: transparent;
        transition: all 0.3s;
    }
    .btn-outline-custom:hover {
        background-color: #007BFF;
        color: white;
    }

    .badge-level {
        display: inline-flex;
        align-items: center;
        padding: 6px 10px;
        font-size: 0.9rem;
        border-radius: 10px;
        white-space: nowrap;
    }
    .badge-level i {
        margin-right: 6px;
    }

    .btn-action {
        background-color: #17a2b8;
        color: white;
        border: none;
        padding: 6px 10px;
        border-radius: 50%;
    }
    .btn-action:hover {
        background-color: #138496;
        color: white;
    }

    .btn-delete {
        background-color: #dc3545;
        color: white;
        border: none;
        padding: 6px 10px;
        border-radius: 50%;
    }
    .btn-delete:hover {
        background-color: #c82333;
        color: white;
    }
</style>


    </style>
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

    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">List Account Registered</h1>

        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">All accounts registered on our website!</h6>
                

                <button class="btn-outline-custom" data-toggle="modal" data-target="#addUserModal">
                    <i class="fa fa-plus"></i> Add New
                </button>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Username</th>
                                <th>Full Name</th>
                                <th>Level</th>

                                <th>Gmail</th>
                                <th>Foto</th>

                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; foreach ($jel as $kin) { ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $kin['username'] ?></td>
                                    <td><?= $kin['nama_asli'] ?></td>
                                    <td>
    <?php 
    switch ($kin['level']) {
        case 1:
            echo '<span class="badge bg-info text-dark badge-level">
                    <i class="fas fa-users"></i> Visitor    
                  </span>';
            break;
        case 2:
            echo '<span class="badge bg-primary text-white badge-level">
                    <i class="fas fa-user-shield"></i> Admin
                  </span>';
            break;
        case 3:
            echo '<span class="badge bg-warning text-dark badge-level">
                    <i class="fas fa-users"></i> Osis
                  </span>';
            break;
        case 4:
            echo '<span class="badge bg-success text-white badge-level">
                    <i class="fas fa-chalkboard-teacher"></i> Super Admin
                  </span>';
            break;
        default:
            echo '<span class="badge bg-secondary text-white badge-level">Unknown</span>';
    }
?>
</td>



                                    <td><?= $kin['email'] ?></td>
                                     <td>
        <img src="<?= base_url('img/' . $kin['foto']) ?>" alt="Profile Photo" style="max-width: 110px; max-height: 80px;" ></td>
                                    <td>
                                        <button class="btn btn-warning btn-sm rounded-circle edit-user" 
    data-id="<?= $kin['id_user'] ?>" 
    data-nama_asli="<?= $kin['nama_asli'] ?>" 
    data-username="<?= $kin['username'] ?>" 
    data-email="<?= $kin['email'] ?>" 
    data-foto="<?= $kin['foto'] ?>" 
    data-toggle="modal" data-target="#editUserModal">
    <i class="fa fa-edit"></i>
</button>


                                    <!-- Tombol Tambah -->

                                        </button>
                                        <a href="<?= base_url('home/aksi_reset/' . $kin['id_user']) ?>" class="btn btn-warning btn-sm rounded-circle">
                                            <i class="fa fa-redo"></i>
                                        </a>
                                        <a href="<?= base_url('home/h_user/' . $kin['id_user']) ?>" 
   class="btn btn-warning btn-sm rounded-circle delete-btn" 
   data-username="<?= $kin['username'] ?>" 
   data-id="<?= $kin['id_user'] ?>">
   <i class="fa fa-trash"></i>
</a>



                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Adding User -->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content shadow-lg rounded-lg">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title font-weight-bold" id="addUserModalLabel">Add New User</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('home/aksi_t_user') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_asli">Full Name</label>
                        <input type="text" name="name" id="nama_asli" class="form-control" placeholder="Enter full name" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="nama" id="username" class="form-control" placeholder="Enter username" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Enter email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="pw" id="password" class="form-control" placeholder="Enter password" required>
                    </div>
                    <div class="form-group">
                        <label for="foto">Photo</label>
                        <div class="custom-file">
                            <input type="file" name="foto" id="foto" class="custom-file-input" onchange="document.getElementById('fotoLabel').innerText = this.files[0].name">
                            <label class="custom-file-label" for="foto" id="fotoLabel">Choose file or drag here</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="level">Level</label>
                        <select class="form-control" name="level" id="level" required>
                            <option value="1">Visitor</option>
                            <option value="2">Admin</option>
                            <option value="4">Super Admin</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal for Editing User -->
<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content shadow-lg rounded-lg">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title font-weight-bold" id="editUserModalLabel">Edit User</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('home/aksi_e_user') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="id_user" id="edit_id_user">
                    <div class="form-group">
                        <label for="edit_nama_asli">Full Name</label>
                        <input type="text" name="nama_asli" id="edit_nama_asli" class="form-control" placeholder="Enter full name" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_username">Username</label>
                        <input type="text" name="username" id="edit_username" class="form-control" placeholder="Enter username" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_email">Email</label>
                        <input type="email" name="email" id="edit_email" class="form-control" placeholder="Enter email" required>
                    </div>

                    <div class="form-group">
                        <label for="edit_foto">Photo</label>
                        <div class="custom-file">
                            <input type="file" name="foto" id="edit_foto" class="custom-file-input" 
                                   onchange="document.getElementById('fotoLabelEdit').innerText = this.files[0].name">
                            <label class="custom-file-label" for="edit_foto" id="fotoLabelEdit">Choose file or drag here</label>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>






    


<script>
    $(document).ready(function () {
        // Tangkap klik tombol edit-user
        $('.edit-user').on('click', function () {
            // Ambil data dari atribut data-*
            const id = $(this).data('id');
            const namaAsli = $(this).data('nama_asli');
            const username = $(this).data('username');
            const email = $(this).data('email');
            const foto = $(this).data('foto'); // Nama file foto

            // Isi form modal dengan data yang diambil
            $('#edit_id_user').val(id);
            $('#edit_nama_asli').val(namaAsli);
            $('#edit_username').val(username);
            $('#edit_email').val(email);

            // Tampilkan nama file di label
            if (foto) {
                $('#fotoLabelEdit').text(foto);
                $('#previewFoto img').attr('src', '<?= base_url("uploads/") ?>' + foto); // Ganti path sesuai folder uploads
                $('#previewFoto').show();
            } else {
                $('#fotoLabelEdit').text('Choose file or drag here');
                $('#previewFoto').hide();
            }

            // Tampilkan modal
            $('#editUserModal').modal('show');
        });
    });

    // Hapus overlay saat modal ditutup
    $('.modal').on('hidden.bs.modal', function () {
        $('.modal-backdrop').remove();
    });
</script>






    <!-- Scripts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">



<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">




</body>
</html>
