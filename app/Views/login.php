<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>

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
        }

        .login-container {
            display: flex;
            max-width: 900px;
            width: 100%;
            background: #ffffff;
            border-radius: 12px;
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
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-section h1 {
            font-size: 28px;
            color: #333;
            margin-bottom: 24px;
            text-align: center;
        }

        .form-group label {
            font-weight: 600;
            color: #495057;
        }

        .form-control {
            border-radius: 8px;
            padding: 12px;
        }

        .btn-primary {
            border-radius: 8px;
            padding: 12px;
            background: #007bff;
            border: none;
            font-weight: bold;
        }

        .btn-primary:hover {
            background: #0056b3;
        }

        .captcha-container {
            margin-top: 1rem;
        }

        /* Tambahkan lebar penuh untuk captcha */
        .g-recaptcha {
            width: 100% !important;
        }

        .captcha-container iframe {
            width: 100% !important;
            min-height: 80px;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <!-- Image Section -->
        <div class="image-section"></div>

        <!-- Form Section -->
        <div class="form-section">
            <h1>Welcome Back!</h1>
            <form id="myForm" novalidate action="<?= base_url('home/aksi_login') ?>" method="post">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" placeholder="Enter your username" name="username" required>
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <div class="input-group">
                        <input type="password" class="form-control" placeholder="Enter your password" name="pw" id="password" required>
                        <div class="input-group-append">
                            <span class="input-group-text" onclick="togglePasswordVisibility()" style="cursor: pointer;">
                                <i id="toggleEye" class="fa fa-eye"></i>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="captcha-container">
                    <div id="recaptcha-container" class="g-recaptcha" data-sitekey="6Lc4hyAqAAAAAII6iyuoLStoTtQFhP4_FKGMl_R_"></div>
                </div>

                <div id="offline-captcha" class="form-group" style="display:none;">
                    <label for="captcha">Solve this: <span id="captcha-equation"></span></label>
                    <input type="text" class="form-control" id="captchaAnswer" placeholder="Enter your answer" required>
                </div>
<!-- Offline CAPTCHA -->
                                        
                <button class="btn btn-primary w-100 login-form__btn submit mt-3">Log In</button>
            </form>

            <div class="text-center mt-4">
                <a href="<?= base_url('home/register') ?>">Create an Account!</a>
            </div>
        </div>

    </div>

    <!-- Bootstrap & Font Awesome JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <script>
        document.getElementById('myForm').addEventListener('submit', function (event) {
            var recaptchaContainer = document.getElementById('recaptcha-container');
            var offlineCaptchaContainer = document.getElementById('offline-captcha');

            if (recaptchaContainer.style.display !== 'none') {
                // Online reCAPTCHA check
                var response = grecaptcha.getResponse();
                if (response.length === 0) {
                    alert("Please complete the reCAPTCHA.");
                    event.preventDefault();
                }
            } else {
                // Offline CAPTCHA check
                var answer = parseInt(document.getElementById('captchaAnswer').value);
                if (isNaN(answer) || answer !== window.captchaResult) {
                    alert("Incorrect answer to the math problem.");
                    event.preventDefault();
                }
            }
        });

        function togglePasswordVisibility() {
            var passwordInput = document.getElementById('password');
            var toggleEye = document.getElementById('toggleEye');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleEye.classList.remove('fa-eye');
                toggleEye.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleEye.classList.remove('fa-eye-slash');
                toggleEye.classList.add('fa-eye');
            }
        }

        function setupOfflineCaptcha() {
            var num1 = Math.floor(Math.random() * 10);
            var num2 = Math.floor(Math.random() * 10);
            window.captchaResult = num1 + num2;
            document.getElementById('captcha-equation').innerText = num1 + " + " + num2 + " = ?";
        }

        window.onload = function () {
    var recaptchaContainer = document.getElementById('recaptcha-container');
    var offlineCaptchaContainer = document.getElementById('offline-captcha');

    // Check if Google reCAPTCHA has been loaded after a short delay
    setTimeout(function () {
        // If Google reCAPTCHA has not been initialized or there's no internet
        if (typeof grecaptcha === 'undefined' || !navigator.onLine) {
            // Hide reCAPTCHA and show offline CAPTCHA
            recaptchaContainer.style.display = 'none';
            offlineCaptchaContainer.style.display = 'block';
            setupOfflineCaptcha();
        } else {
            // reCAPTCHA is available
            recaptchaContainer.style.display = 'block';
            offlineCaptchaContainer.style.display = 'none';
        }
    }, 3000); // Wait 3 seconds to ensure reCAPTCHA loads
};

    </script>
</body>

</html>
