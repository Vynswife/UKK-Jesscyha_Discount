<style>
    /* Make the buttons smaller */
.btn-sm {
    padding: 0.25rem 0.5rem; /* Smaller padding */
    font-size: 0.75rem; /* Reduce font size */
    line-height: 1.5; /* Adjust line height for smaller buttons */
}

/* Optional: Styling specifically for the 'Download' button */
.btn-danger.btn-sm {
    font-size: 0.75rem; /* Smaller font size */
    padding: 0.25rem 0.5rem; /* Smaller padding */
}

/* Optional: Styling specifically for the 'Ajukan' button */
.btn-info.btn-sm {
    font-size: 0.75rem; /* Smaller font size */
    padding: 0.25rem 0.5rem; /* Smaller padding */
}
.small-text {
    font-size: 0.85rem;  /* Adjust the font size as needed */
}

</style>

<!-- Main Content Area (Table) -->
<div class="col-md-12">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Berkas Dokumen</h6>
        </div>
        <div class="card-body">
            <!-- Sub-Category Filter Dropdown -->
            <div class="row mb-3">
                <div class="col-md-8">
                    <select id="subKategoriFilter" class="form-control">
                        <option value="">All Sub-Categories</option>
                        <option value="Jadwal Sekolah">Jadwal Sekolah</option>
                        <option value="Pengambilan Raport">Pengambilan Raport</option>
                        <option value="Pengambilan Ijazah">Pengambilan Ijazah</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <button id="filterButton" class="btn btn-primary btn-block">Filter</button>
                </div>
            </div>

            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Pengirim</th>
                            <th>Perihal</th>
                            <th>Tanggal Surat</th>
                            <th>File Photo</th>
                            <th>Kategori</th>
                            <th>Sub-Kategori</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($jel)) { ?>
                            <?php foreach($jel as $surat): ?>
                                <tr class="surat-row" data-sub_kategori="<?= $surat->sub_kategori ?>">
                                    <td class="small-text"><?= $surat->pengirim ?></td>
                                    <td class="small-text"><?= $surat->perihal ?></td>
                                    <td class="small-text"><?= $surat->tanggal_surat ?></td>
                                    <td>
                                        <img src="<?= base_url('img/'.$surat->file) ?>" width="80px" class="img-thumbnail" 
                                             data-toggle="modal" data-target="#imageModal" 
                                             data-file="<?= base_url('img/'.$surat->file) ?>" alt="Surat Image">
                                    </td>
                                    <td class="small-text"><?= $surat->kategori ?></td>
                                    <td class="small-text"><?= $surat->sub_kategori ?></td>
                                    <td>
                                        <a href="<?= base_url('img/'.$surat->file) ?>" download class="btn btn-danger btn-sm"><i class="fas fa-file-pdf"></i> Download</a>
                                        <button class="btn btn-info btn-sm" data-toggle="modal" 
                                                data-id_surat="<?= $surat->id_surat ?>"
                                                data-status="<?= $surat->status ?>"
                                                data-status1="<?= $surat->status_menunggu ?>"
                                                data-prioritas="<?= $surat->prioritas ?>"
                                                data-pengirim="<?= $surat->pengirim ?>"
                                                data-no_surat="<?= $surat->nomor_surat ?>"
                                                data-instansi="<?= $surat->instansi ?>"
                                                data-perihal="<?= htmlspecialchars($surat->perihal, ENT_QUOTES, 'UTF-8') ?>"
                                                data-tanggal_surat="<?= $surat->tanggal_surat ?>"
                                                data-lampiran="<?= $surat->lampiran ?>"
                                                data-target="#ajukanModal">
                                            <i class="fas fa-paper-plane"></i> Detail
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data surat masuk</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- Modal for Tulis Surat Masuk -->
<div class="modal fade" id="tulisSuratMasukModal" tabindex="-1" aria-labelledby="tulisSuratMasukLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"> <!-- Set modal-lg for wider view -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tulisSuratMasukLabel"><i class="fas fa-file-alt mr-2" id="file_icon"></i>Tambah Surat Masuk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('home/t_suratm') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <!-- General Information Section -->
                    <h6 class="font-weight-bold">Informasi Umum</h6>
                    <p class="text-muted">Lengkapi informasi pada surat masuk.</p>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nomor_surat">No. Surat</label>
                            <input type="text" class="form-control" id="nomor_surat" name="nomor_surat" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="tgl_surat">Tgl. Surat</label>
                            <input type="date" class="form-control" id="tgl_surat" name="tgl_surat" required>
                        </div>
                    </div>
                        <div class="form-group">
                            <label for="instansi_pengirim">Instansi Pengirim</label>
                            <input type="text" class="form-control" id="instansi_pengirim" name="pengirim" required>
                        </div>
                    
                    <div class="form-group">
                        <label for="perihal">Perihal Surat</label>
                        <input type="text" class="form-control" id="perihal" name="perihal" required>
                    </div>

                    <!-- Additional Information Section -->
                    <h6 class="font-weight-bold mt-4">Informasi Tambahan</h6>
                    <p class="text-muted">Silahkan lengkapi jumlah lampiran, status, dan sifat tindakan surat!</p>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="lampiran">Lampiran</label>
                            <select class="form-control" id="lampiran" name="lampiran" required>
                                 <option value="Lampiran 1">Lampiran 1</option>
                                 <option value="Lampiran 2">Lampiran 2</option>
                                 <option value="Lampiran 3">Lampiran 3</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="Asli">Asli</option>
                                <option value="Tembusan">Tembusan</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="prioritas">Prioritas</label>
                            <select class="form-control" id="prioritas" name="prioritas" required>
                                <option value="Biasa">Biasa</option>
                                <option value="Segera">Segera</option>
                                <option value="Sangat Segera">Sangat Segera</option>
                            </select>
                        </div>
                    </div>

                    <!-- Kategori and Sub-Kategori Section -->
                    <h6 class="font-weight-bold mt-4">Kategori dan Sub-Kategori</h6>
                    <p class="text-muted">Pilih kategori dan sub-kategori yang sesuai.</p>
                    <div class="form-row">
                        <!-- Kategori Dropdown -->
                        <div class="form-group col-md-6">
                            <label for="kategori">Kategori</label>
                            <select class="form-control" id="kategori" name="kategori" required onchange="updateSubKategori()">
                                <option value="">Pilih Kategori</option>
                                <option value="HRD">HRD</option>
                                <option value="Administrasi">Administrasi</option>
                                <option value="Kesiswaan">Kesiswaan</option>
                            </select>
                        </div>
                        <!-- Sub-Kategori Dropdown -->
                        <div class="form-group col-md-6">
                            <label for="sub_kategori">Sub-Kategori</label>
                            <select class="form-control" id="sub_kategori" name="sub_kategori" required>
                                <!-- Default Option -->
                                <option value="">Pilih Sub-Kategori</option>
                                <option class="kesiswaan-option" value="Jadwal Sekolah">Jadwal Sekolah</option>
                                <option class="kesiswaan-option" value="Pengambilan Raport">Pengambilan Raport</option>
                                <option class="kesiswaan-option" value="Pengambilan Ijazah">Pengambilan Ijazah</option>
                                <option class="admin-option" value="Pembayaran">Pembayaran</option>
                                <option class="hrd-option" value="Pengajuan Cuti">Pengajuan Cuti</option>
                                <option class="hrd-option" value="Izin Terlambat">Izin Terlambat</option>
                                <option class="hrd-option" value="Lamaran Kerja Karyawan">Lamaran Kerja Karyawan</option>
                            </select>
                        </div>

                    </div>

                    <!-- File Upload Section -->
                    <div class="form-group">
                        <label for="upload_file_keluar">Upload File</label>
                        <div class="custom-file-upload">
                            <input type="file" class="form-control-file d-none" id="upload_file_keluar" name="foto" accept=".pdf,.doc,.docx,.jpg,.png" onchange="updateFileName(this)">
                            <button type="button" class="btn btn-outline-primary" onclick="document.getElementById('upload_file_keluar').click()">Choose File</button>
                            <span id="file_name" class="ml-2 text-muted">No file chosen</span>
                        </div>
                        <small class="form-text text-muted">* Semua file type diizinkan</small>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal for Tulis Surat Keluar -->
<div class="modal fade" id="tulisSuratKeluarModal" tabindex="-1" aria-labelledby="tulisSuratKeluarLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tulisSuratKeluarLabel"><i class="fas fa-file-alt mr-2" id="file_icon"></i>Tambah Surat Keluar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('home/t_suratk') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <!-- General Information Section -->
                    <h6 class="font-weight-bold">Informasi Umum</h6>
                    <p class="text-muted">Lengkapi informasi pada surat keluar.</p>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nomor_surat_keluar">No. Surat</label>
                            <input type="text" class="form-control" id="nomor_surat_keluar" name="nomor_surat" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="tgl_surat_keluar">Tgl. Surat</label>
                            <input type="date" class="form-control" id="tgl_surat_keluar" name="tgl_surat" required>
                        </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="penerima_keluar">Penerima</label>
                        <input type="text" class="form-control" id="penerima_keluar" name="penerima" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="pengirim_keluar">Pengirim</label>
                        <input type="text" class="form-control" id="pengirim_keluar" name="pengirim" required>
                    </div>
                </div>
                    <div class="form-group">
                        <label for="perihal_keluar">Perihal Surat</label>
                        <input type="text" class="form-control" id="perihal_keluar" name="perihal" required>
                    </div>
                    <div class="form-group">
                        <label for="isi_surat_keluar">Isi Surat</label>
                        <textarea class="form-control" id="isi_surat_keluar" name="isi_surat" rows="3" required></textarea>
                    </div>

                    <!-- Additional Information Section -->
                    <h6 class="font-weight-bold mt-4">Informasi Tambahan</h6>
                    <p class="text-muted">Pilih sifat prioritas surat.</p>
                    <div class="form-group">
                        <label for="prioritas_keluar">Prioritas</label>
                        <select class="form-control" id="prioritas_keluar" name="prioritas" required>
                            <option value="Biasa">Biasa</option>
                            <option value="Segera">Segera</option>
                            <option value="Sangat Segera">Sangat Segera</option>
                        </select>
                    </div>

                    
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>


<style>
    .custom-file-upload {
        display: flex;
        align-items: center;
        border: 1px solid #ced4da;
        border-radius: .25rem;
        padding: 8px;
        background-color: #f8f9fa;
    }
    .upload-btn {
        border: 1px solid #ced4da;
        border-radius: .25rem;
        padding: 6px 12px;
        background-color: #ffffff;
        cursor: pointer;
    }
    .upload-btn:hover {
        background-color: #e9ecef;
    }
    #file_name {
        flex-grow: 1;
        color: #6c757d;
        font-size: 14px;
    }
</style>


<!-- Modal for Image Preview -->
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Gambar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img id="modal_image" src="" alt="Gambar Surat" class="modal-image img-fluid">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>


<!-- Enhanced Modal Structure -->
<div class="modal fade" id="ajukanModal" tabindex="-1" aria-labelledby="ajukanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="<?= base_url('home/e_ajuansuratm'); ?>" method="post"> <!-- Update 'controller_name' with your actual controller name -->
                <div class="modal-header">
                    <h5 class="modal-title" id="ajukanModalLabel">Detail Surat Masuk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- Modal Body -->
<div class="modal-body">
    <!-- Nomor Agenda and Status Surat Sections Side by Side -->
    <div class="row">
        <div class="col-md-6">
            <div class="card p-3">
                <h6>Pengirim Surat: <span id="modalPengirim">N/A</span></h6>
                <p><strong>Berkas:</strong> <span id="modalStatus">N/A</span></p>
                <p><strong>Prioritas:</strong> <span id="modalPrioritas">N/A</span></p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card p-3">
                <h6>Status Surat</h6>
                <p><strong>Status:</strong> <span id="modalStatus1">N/A</span></p>
            </div>
        </div>
    </div>

    <!-- Informasi Detail Surat Section -->
    <div class="card mt-3 p-3">
        <h6>Informasi Detail Surat</h6>
        <table class="table table-borderless">
            <tr>
                <td><strong>No. Surat</strong></td>
                <td><span id="modalNoSurat">N/A</span></td>
            </tr>
            <tr>
                <td><strong>Perihal</strong></td>
                <td><span id="modalPerihal">N/A</span></td>
            </tr>
            <tr>
                <td><strong>Tanggal Surat</strong></td>
                <td><span id="modalTanggalSurat">N/A</span></td>
            </tr>
            <tr>
                <td><strong>Lampiran</strong></td>
                <td><span id="modalLampiran">N/A</span></td>
            </tr>
        </table>
    </div>

    
</div>

<!-- Hidden input for Surat ID -->
<input type="hidden" name="id_surat" id="id_surat" value="<?= $surat->id_surat ?>">

<!-- Modal Footer -->
<div class="modal-footer">

    <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
</div>


<!-- Include this CSS for custom styling -->
<style>
    /* Apply Roboto Font to Modal */
    /* Apply Roboto Font to Modal */
.modal-content, .modal-header, .modal-body, .modal-footer {
    font-family: 'Roboto', sans-serif;
}

/* Modal Header */
.modal-header {
    background-color: #007bff; /* Adjust as needed */
    color: #fff;
    border-bottom: none;
}
.modal-title {
    font-weight: 700;
    font-size: 1.25rem;
}
.modal-header .close span {
    color: #fff;
}

/* Body Styling */
.modal-body {
    background-color: #f9f9f9;
}
.card {
    border: 1px solid #e0e0e0;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}
.card h6 {
    font-weight: 500;
    color: #333;
}
.table-borderless td {
    padding: 0.5rem 0.75rem;
    font-size: 0.9rem;
}

/* Button Styling */
.btn-primary {
    background-color: #007bff;
    border-color: #007bff;
    font-weight: 500;
    padding: 0.375rem 0.75rem; /* Adjust padding for smaller buttons */
    font-size: 0.875rem; /* Reduce font size */
}
.btn-secondary {
    background-color: #6c757d;
    border-color: #6c757d;
    font-weight: 500;
    padding: 0.375rem 0.75rem; /* Adjust padding for smaller buttons */
    font-size: 0.875rem; /* Reduce font size */
}
.btn-primary:hover, .btn-secondary:hover {
    opacity: 0.85;
}

/* Footer buttons */
.modal-footer .btn {
    width: auto; /* Allow buttons to fit their content size */
    padding: 0.375rem 0.75rem; /* Adjust padding for smaller buttons */
    font-size: 0.875rem; /* Reduce font size */
    border-radius: 4px; /* Optional: Add border-radius for rounded corners */
}

</style>




<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

<!-- Bootstrap and jQuery JS (required for Bootstrap 4 modals) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>
    function updateFileName(input) {
        const fileName = input.files[0] ? input.files[0].name : "No file chosen";
        document.getElementById('file_name').textContent = fileName;
    }
</script>
<script>
    function updateFileName(input) {
        const fileName = input.files[0] ? input.files[0].name : "No file chosen";
        document.getElementById('file_name1').textContent = fileName;
    }

    $('#imageModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // The button that triggered the modal (the image thumbnail)
        var fileUrl = button.data('file'); // Extract the file URL from the data-file attribute

        var modal = $(this);
        modal.find('.modal-body img').attr('src', fileUrl); // Set the src of the modal image
    });

</script>


<script>
    $('#ajukanModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        
        // Extract data from data-* attributes
        var idSurat = button.data('id_surat');
        var status = button.data('status');
        var status1 = button.data('status1');
        var prioritas = button.data('prioritas');
        var tanggal = button.data('tanggal');
        var noSurat = button.data('no_surat');
        var instansi = button.data('instansi');
        var perihal = button.data('perihal');
        var tanggalSurat = button.data('tanggal_surat');
        var lampiran = button.data('lampiran');
        var pengirim = button.data('pengirim');
        
        // Update modal content
        var modal = $(this);
        modal.find('#modalStatus').text(status || 'N/A');
        modal.find('#modalStatus1').text(status1 || 'N/A');
        modal.find('#modalPrioritas').text(prioritas || 'N/A');
        modal.find('#modalTanggal').text(tanggal || 'N/A');
        modal.find('#modalNoSurat').text(noSurat || 'N/A');
        modal.find('#modalInstansi').text(instansi || 'N/A');
        modal.find('#modalPerihal').text(perihal || 'N/A');
        modal.find('#modalTanggalSurat').text(tanggalSurat || 'N/A');
        modal.find('#modalLampiran').text(lampiran || 'N/A');
        modal.find('#modalPengirim').text(pengirim || 'N/A');
        
        // Set the id_surat value in the hidden input
        modal.find('#id_surat').val(idSurat);
        
        // Check the status and enable/disable the 'Update Data' button accordingly
        if (status1 === "Diajukan") {
            // If status is "Diajukan", disable the "Update Data" button
            modal.find('#updateButton').prop('disabled', true);
        } else {
            // If status is not "Diajukan", enable the "Update Data" button
            modal.find('#updateButton').prop('disabled', false);
        }
    });
</script>


<script>
    // JavaScript to filter table rows based on selected sub_kategori
    $(document).ready(function() {
        $('#filterButton').click(function() {
            var selectedSubKategori = $('#subKategoriFilter').val();
            $('.surat-row').each(function() {
                var rowSubKategori = $(this).data('sub_kategori');
                if (selectedSubKategori === "" || rowSubKategori === selectedSubKategori) {
                    $(this).show(); // Show the row if it matches the selected sub-kategori or if "All Sub-Categories" is selected
                } else {
                    $(this).hide(); // Hide the row if it doesn't match
                }
            });
        });
    });
</script>
