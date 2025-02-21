<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>

    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(to right, #3a7bd5, #00d2ff);
            margin: 0;
        }

        .register-container {
            display: flex;
            max-width: 800px;
            width: 90%;
            background: #ffffff;
            border-radius: 19px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .image-section {
            flex: 1;
            background: url('<?= base_url("img/math.png") ?>') no-repeat center;
            background-size: cover;
        }

        .form-section {
            flex: 1;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-section h1 {
            font-size: 24px;
            color: #333;
            margin-bottom: 16px;
            text-align: center;
        }

        .form-group label {
            font-weight: 600;
            color: #495057;
        }

        .form-control {
            border-radius: 8px;
            padding: 8px;
            font-size: 14px;
        }

        .btn-primary {
            border-radius: 8px;
            padding: 10px;
            background: #007bff;
            border: none;
            font-weight: bold;
        }

        .btn-primary:hover {
            background: #0056b3;
        }

        .drag-drop-area {
            border: 2px dashed #007bff;
            padding: 15px;
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
            max-width: 100px;
            margin: 10px auto;
            border: 2px dashed #dee2e6;
            border-radius: 8px;
        }

        .text-center a {
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="register-container">
        <!-- Image Section -->
        <div class="image-section"></div>

        <!-- Form Section -->
        <div class="form-section">
            <h1>Create Account</h1>
            <form action="<?= base_url('home/aksi_t_register') ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="yourUsername">Username</label>
                    <input type="text" class="form-control" id="yourUsername" name="nama" placeholder="Username" required>
                </div>
                <div class="form-group">
                    <label for="yourUsername">Nama Asli</label>
                    <input type="text" class="form-control" id="yourUsername" name="nama_asli" placeholder="Nama Asli" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                </div>

                <div class="form-group">
                    <label for="pass">Password</label>
                    <input type="password" class="form-control" id="pass" name="pass" placeholder="Password" required>
                </div>

                <div class="form-group">
                    <label for="foto">Photo</label>
                    <div id="dropArea" class="drag-drop-area">
                        Drag & Drop or Click to Upload
                        <input name="foto" type="file" class="form-control-file d-none" id="foto">
                    </div>
                    <img id="preview" class="preview-image" src="#" alt="Preview">
                </div>

                <button class="btn btn-primary w-100" type="submit">Register</button>
            </form>

            <div class="text-center mt-3">
                <a href="<?= base_url('home/login') ?>">Already have an account? Login</a>
            </div>
        </div>
    </div>

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
            const reader = new FileReader();
            reader.onload = function (e) {
                previewImage.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    </script>
</body>

</html>
