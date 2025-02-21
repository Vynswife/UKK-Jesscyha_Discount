<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Toko</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background: linear-gradient(135deg, #f9f9f9, #e9ecef);

            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .edit-container {
            width: 100%;
            max-width: 450px;
            padding: 25px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
        }

        h1 {
            text-align: center;
            color: #343a40;
            font-weight: 700;
            margin-bottom: 30px;
        }

        .drag-drop-area {
            border: 2px dashed #007bff;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            background-color: #f8f9fa;
            border-radius: 12px;
        }

        .drag-drop-area.dragover {
            background-color: #e0f2ff;
            border-color: #0056b3;
        }

        .preview-image {
            display: block;
            max-width: 150px;
            margin: 20px auto;
            border: 3px dashed #dee2e6;
            border-radius: 10px;
        }

        .btn-save {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: white;
            font-size: 16px;
            font-weight: 600;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-save:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <form id="settingForm" novalidate action="<?= base_url('home/aksietoko/') ?>" method="POST" enctype="multipart/form-data">
        <div class="edit-container">
            <h1> Website Settings</h1>
            <div class="form-group">
                <label for="name">Nama Website:</label>
                <input name="nama" type="text" class="form-control" id="nama" value="<?= isset($jes[0]->nama_toko) ? $jes[0]->nama_toko : '' ?>" required>
            </div>
            <div class="form-group">
                <label for="logo">Logo:</label>
                <div id="dropArea" class="drag-drop-area">
                    Drag & Drop or Click to Upload Logo
                    <input name="foto" type="file" class="form-control-file d-none" id="foto">
                </div>
                <input name="id" type="hidden" id="id" value="<?= isset($jes[0]->id_toko) ? $jes[0]->id_toko : '' ?>">
                <img id="preview" class="preview-image" src="<?= base_url('images/' . ($jes[0]->logo ?? 'default_logo.png')) ?>" alt="Preview Image">
            </div>
            <button class="btn-save" type="submit">Save Edit</button>
        </div>
    </form>

    <script>
        const dropArea = document.getElementById('dropArea');
        const fileInput = document.getElementById('foto');
        const previewImage = document.getElementById('preview');

        // Handle drag over
        dropArea.addEventListener('dragover', (event) => {
            event.preventDefault();
            dropArea.classList.add('dragover');
        });

        // Handle drag leave
        dropArea.addEventListener('dragleave', () => {
            dropArea.classList.remove('dragover');
        });

        // Handle drop
        dropArea.addEventListener('drop', (event) => {
            event.preventDefault();
            dropArea.classList.remove('dragover');
            if (event.dataTransfer.files && event.dataTransfer.files[0]) {
                fileInput.files = event.dataTransfer.files;
                previewFile(event.dataTransfer.files[0]);
            }
        });

        // Open file input when clicking drop area
        dropArea.addEventListener('click', () => fileInput.click());

        // Handle file input change
        fileInput.addEventListener('change', () => {
            if (fileInput.files && fileInput.files[0]) {
                previewFile(fileInput.files[0]);
            }
        });

        // Preview file
        function previewFile(file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                previewImage.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    </script>
</body>
</html>
