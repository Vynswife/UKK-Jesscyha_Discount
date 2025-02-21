<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap Icons CSS (added to ensure icons show up) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<!-- Bootstrap JS (including modal) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Custom Styling -->
<style>
    /* Smaller button styles */
    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
        line-height: 1.5;
    }

    /* Custom Close Button Style */
    .custom-close-btn {
        color: #fff;
        background-color: #007bff;
        border: none;
        padding: 0.5rem 1rem;
        font-size: 1rem;
        font-weight: bold;
        border-radius: 0.25rem;
        transition: background-color 0.3s ease;
    }

    .custom-close-btn:hover {
        background-color: #0056b3;
    }

    /* Modal content styles */
    .modal-header {
        background-color: #007bff;
        color: white;
    }

    .modal-body {
        background-color: #f9f9f9;
    }

    .modal-footer {
        background-color: #f1f1f1;
    }

    /* Additional Styling for Cards */
    .card-body {
        padding: 1.25rem;
    }

    .card-title {
        font-size: 1.25rem;
        font-weight: bold;
    }

    .card-text {
        font-size: 0.9rem;
        color: #555;
    }

    .card-img-top {
        object-fit: cover;
        height: 200px;
    }

    .photo-card {
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Modal Photo Gallery */
    .modal-dialog.modal-lg {
        max-width: 80%;
    }

    .comment-section {
        margin-top: 15px;
        border-top: 1px solid #ddd;
        padding-top: 10px;
    }

    .comment-form textarea {
        margin-bottom: 10px;
    }

    /* Responsive Layout */
    @media (max-width: 768px) {
        .photo-card {
            margin-bottom: 1.5rem;
        }

        .modal-dialog.modal-lg {
            max-width: 90%;
        }
    }
    /* Custom modal size */
.custom-modal-size {
    max-width: 70%; /* You can adjust this percentage to make the modal smaller or larger */
}

</style>

<!-- Album List -->
<div class="container">
    <h2 class="my-4">Photo Albums Showcases</h2>
    <div class="row">
        <?php if (!empty($albums)): ?>
            <?php foreach ($albums as $album): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm photo-card">
                        <img src="<?= base_url('img/' . $album->foto_album) ?>" class="card-img-top img-fluid" alt="<?= $album->nama_album ?>" style="object-fit: cover; height: 200px;">
                        <div class="card-body text-center">
                            <h5 class="card-title"><?= $album->nama_album ?></h5>
                            <p class="card-text"><?= $album->deskripsi ?></p>
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#photoModal<?= $album->id_album ?>">
                                View Album
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Modal for Album -->
                <!-- Modal for Album -->
<div class="modal fade" id="photoModal<?= $album->id_album ?>" tabindex="-1" aria-labelledby="photoModalLabel<?= $album->id_album ?>" aria-hidden="true">
    <div class="modal-dialog custom-modal-size"> <!-- Add custom class here -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="photoModalLabel<?= $album->id_album ?>">Album: <?= $album->nama_album ?></h5>
                <button type="button" class="btn custom-close-btn" data-bs-dismiss="modal" aria-label="Close">
                    Close
                </button>
            </div>
            <div class="modal-body">
                <h6>Photos:</h6>
                <?php if (!empty($album->photos)): ?>
                    <div class="row">
                        <?php foreach ($album->photos as $photo): ?>
                            <div class="col-md-6 mb-4">
                                <div class="card photo-card">
                                    <img src="<?= base_url('img/' . $photo->lokasi) ?>" alt="<?= $photo->judul ?>" class="card-img-top img-fluid" style="object-fit: cover; height: 300px;">
                                    <div class="card-body">
                                        <h6><?= $photo->judul ?></h6>
                                        <p><?= $photo->deskripsi ?></p>
                                        <p><strong>Tanggal Upload:</strong> <?= $photo->tanggal_buat ?></p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <p><strong>Likes:</strong> <?= $photo->like_count ?> <i class="bi bi-heart-fill text-danger"></i></p>
                                            <div class="btn-group" role="group" aria-label="Action buttons">
                                                <!-- Like Button -->
                                                <?php if ($photo->isLiked): ?>
    <button class="btn btn-secondary btn-sm d-flex align-items-center me-2" disabled>
        <i class="bi bi-heart-fill fs-5 me-1"></i> <span>Liked</span>
    </button>
<?php else: ?>
    <form action="<?= base_url('home/like') ?>" method="POST" class="d-inline-block">
        <input type="hidden" name="id_foto" value="<?= $photo->id_foto ?>">
        <button type="submit" class="btn btn-outline-danger btn-sm d-flex align-items-center me-2">
            <i class="bi bi-heart fs-5 me-1"></i> <span>Like</span>
        </button>
    </form>
<?php endif; ?>


                                                <!-- Comment Button -->
                                                <button class="btn btn-outline-info btn-sm me-2" data-bs-toggle="collapse" data-bs-target="#commentsSection<?= $photo->id_foto ?>" aria-expanded="false" aria-controls="commentsSection<?= $photo->id_foto ?>">
                                                    <i class="bi bi-chat-left-text fs-5"></i> Comment
                                                </button>

                                                <!-- Order Button -->
                                                <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#orderModal<?= $photo->id_foto ?>">
                                                    <i class="bi bi-cart fs-5"></i> Order
                                                </button>
                                            </div>
                                        </div>
                                        <div class="collapse comment-section" id="commentsSection<?= $photo->id_foto ?>">
                                            <h6>Comments:</h6>
                                            <?php if (!empty($photo->comments)): ?>
                                                <?php foreach ($photo->comments as $comment): ?>
                                                    <div class="mb-2">
                                                        <p><strong><?= $comment->username ?>:</strong> <?= $comment->isi_komen ?></p>
                                                    </div>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <p>No comments yet.</p>
                                            <?php endif; ?>
                                            <form action="<?= base_url('home/comment') ?>" method="POST" class="comment-form">
                                                <input type="hidden" name="id_foto" value="<?= $photo->id_foto ?>">
                                                <textarea name="comment_text" class="form-control" rows="3" placeholder="Write a comment..."></textarea>
                                                <button type="submit" class="btn btn-primary mt-2">Post Comment</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p>No photos available for this album.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <p class="text-center">No albums available.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Order Modal -->
<?php foreach ($albums as $album): ?>
    <?php foreach ($album->photos as $photo): ?>
        <div class="modal fade" id="orderModal<?= $photo->id_foto ?>" tabindex="-1" aria-labelledby="orderModalLabel<?= $photo->id_foto ?>" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form action="<?= base_url('home/t_order') ?>" method="POST">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="orderModalLabel<?= $photo->id_foto ?>">Order Design for Photo ID <?= $photo->id_foto ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id_foto" value="<?= $photo->id_foto ?>">
                            <div class="form-group">
                                <label for="preferensi<?= $photo->id_foto ?>">Preferences</label>
                                <textarea name="preferensi" id="preferensi<?= $photo->id_foto ?>" rows="4" class="form-control" placeholder="Describe your preferences..."></textarea>
                            </div>
                            <div class="form-group mt-3">
                                <label for="kategori_design<?= $photo->id_foto ?>">Design Category</label>
                                <select name="kategori_design" id="kategori_design<?= $photo->id_foto ?>" class="form-select">
                                    <option value="brochure">Brochure</option>
                                    <option value="posters">Posters</option>
                                    <option value="logo">Logo</option>
                                    <option value="others">Others (to be confirmed)</option>
                                </select>
                            </div>
                            <div class="form-group mt-3">
                                <label for="metode<?= $photo->id_foto ?>">Payment Method</label>
                                <select name="metode" id="metode<?= $photo->id_foto ?>" class="form-select">
                                    <option value="BCA">BCA</option>
                                    <option value="Dana">Dana</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Submit Order</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    <?php endforeach; ?>
<?php endforeach; ?>

<!-- JavaScript for handling likes and comments -->
<script>
    // Ensure that the backdrop is removed when a modal is closed
    $('#orderModal').on('hidden.bs.modal', function () {
        $('.modal-backdrop').remove(); // Remove backdrop
        $('body').removeClass('modal-open'); // Remove modal-open class
    });
</script>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

<!-- Bootstrap and jQuery JS (required for Bootstrap 4 modals) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>