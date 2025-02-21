<div class="container mt-4">
    <!-- Heading and Info Text with Card -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="text-center">Restore Deleted Photos</h3>
                    <p class="text-center text-muted">
                        Back Up Data Restoration
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Display Photos -->
<div class="container mt-4">
    <div class="row">
        <?php if (empty($posts)): ?>
            <div class="col-12">
                <div class="alert alert-info" role="alert">
                    No deleted photos found.
                </div>
            </div>
        <?php else: ?>
            <?php foreach ($posts as $order): ?>
                <div class="col-md-6">
                    <div class="card shadow-sm border-0 rounded mb-4">
                        <!-- Foto Profile -->
                        <div class="card-header text-center bg-light">
                            <img src="<?= base_url('img/' . $order['foto']) ?>" 
                                 alt="User Photo" 
                                 class="rounded-circle shadow-sm border" 
                                 style="width: 80px; height: 80px; object-fit: cover;">
                        </div>
                        
                        <!-- Isi Post -->
                        <div class="card-body">
                            <h5 class="card-title text-primary fw-bold"><?= $order['judul']; ?></h5>
                            <p class="card-text"><?= substr($order['isi'], 0, 100); ?>...</p>
                            <small class="text-muted d-block">
                                <i class="bi bi-calendar-event me-1"></i><?= date('d M Y', strtotime($order['created_at'])); ?>
                                <span class="mx-1">|</span>
                                <i class="bi bi-person-circle me-1"></i><?= $order['username']; ?>
                            </small>
                        </div>

                        <!-- Tombol Restore dan Delete -->
                        <div class="card-footer text-end bg-light">
                            <a href="<?= base_url('home/r_post/' . $order['id_post']) ?>" class="btn btn-success btn-sm me-2">Restore</a>
                            <!-- Delete Button -->
                            <a href="<?= base_url('home/h_restore/' . $order['id_post']) ?>" class="btn btn-danger btn-sm">
                                <i class="bi bi-trash"></i> Delete
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>



<!-- Include the necessary scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
