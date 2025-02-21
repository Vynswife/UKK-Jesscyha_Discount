<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Surat Undangan - PDF View</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .header, .footer {
            text-align: center;
        }
        .content {
            margin-top: 30px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .table th, .table td {
            padding: 8px;
            border: 1px solid #000;
        }
        .footer p {
            font-size: 12px;
        }
        /* Align signature section to the right */
        .signature {
            text-align: right;
            margin-top: 50px;
        }
    </style>
</head>
<body>

    <!-- Surat Header -->
    <div class="header">
        <h2>Sekolah Permata Harapan Batu Batam</h2>
        <p>Jl. Kaliurang KM 5, Kepulauan Riau</p>
        <hr style="border: 1px solid black;">
    </div>

    <!-- Surat Body -->
    <div class="content">
        <table>
            <tr>
                <td>No:</td>
                <td><?= htmlspecialchars($surat->nomor_surat, ENT_QUOTES, 'UTF-8') ?></td>
            </tr>
            <tr>
                <td>Perihal:</td>
                <td><?= htmlspecialchars($surat->perihal, ENT_QUOTES, 'UTF-8') ?></td>
            </tr>
        </table>

        <p>Yth.<br>
           <?= htmlspecialchars($surat->penerima, ENT_QUOTES, 'UTF-8') ?></p>
        
        <p>Dengan hormat,<br>
        <?= nl2br(htmlspecialchars($surat->isi_surat, ENT_QUOTES, 'UTF-8')) ?></p>
        
        <p>Demikian surat pemberitahuan ini kami sampaikan, atas segala perhatian dan kerjasamanya kami ucapkan terima kasih.</p>
    </div>

    <!-- Surat Footer -->
    <div class="footer">
        
    </div>
    
    <!-- Signature Section aligned to the right -->
    <div class="signature">
        <p>Batam, <?= date('d-m-Y', strtotime($surat->tanggal_surat)) ?></p>
        <p>Mengetahui,</p>
        <p>Kepala Sekolah</p>
        <br><br><br>
        <p style="text-decoration: underline;"><?= htmlspecialchars($surat->pengirim, ENT_QUOTES, 'UTF-8') ?></p>

    </div>

</body>
</html>
