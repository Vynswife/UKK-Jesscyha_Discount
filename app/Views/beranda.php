
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        .header {
            background-color: #007bff;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        .card {
            border: none;
            border-radius: 8px;
            transition: box-shadow 0.3s ease;
            background-color: #fff;
        }

        .card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .card-title {
            font-weight: 500;
            color: #007bff;
        }

        .icon {
            font-size: 1.8rem;
            color: #007bff;
            margin-bottom: 10px;
        }

        .footer {
            background-color: #007bff;
            color: #fff;
            text-align: center;
            padding: 15px 0;
            margin-top: 40px;
        }
    </style>


<body>
    <!-- Header -->
    <div class="header">
        <h2>Selamat Datang di Website Kalkulator</h2>
        <p>Halo, <?= htmlspecialchars(session()->get('username')) ?>! Website ini terdapat berbagai macam kalkulator yang dapat membantu dalam perhitungan sehari-hari.</p>
    </div>

    <div class="container mt-4">
        <!-- Informasi Cards -->
        <div class="row mb-4">
            <div class="col-lg-6 col-md-6 mb-4">
                <div class="card text-center p-4">
                    <div class="card-body">
                        <i class="fas fa-calculator icon"></i>
                        <h5 class="card-title">Kalkulator Umum</h5>
                        <p class="card-text">Gunakan kalkulator ini untuk perhitungan sehari-hari dengan mudah.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 mb-4">
                <div class="card text-center p-4">
                    <div class="card-body">
                        <i class="fas fa-cogs icon"></i>
                        <h5 class="card-title">Kalkulator Fungsional</h5>
                        <p class="card-text">Kalkulator fungsional untuk perhitungan matematik lebih lanjut dan efisien.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<section class="container mt-4">
    <h4 class="mb-3">Riwayat Perhitungan Terbaru</h4>
    <div class="row">
        <div class="col-12">
            <?php if (!empty($recent_history)): ?>
                <?php foreach ($recent_history as $history): ?>
                    <article class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title text-primary">Waktu: <?= date('d-m-Y H:i', strtotime($history['created_at'])) ?><?= htmlspecialchars($history['kategori']) ?></h5>
                            <p class="card-text">
                                Input: <?= htmlspecialchars($history['input']) ?><br>
                                Output: <?= htmlspecialchars($history['result']) ?>
                            </p>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Belum ada riwayat perhitungan.</p>
            <?php endif; ?>
        </div>
    </div>



    <!-- Footer -->
    <div class="footer">
        <p>Website Kalkulator | Membantu dalam perhitungan matematik sehari-hari.</p>
    </div>


