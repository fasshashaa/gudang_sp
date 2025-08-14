<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Menggunakan Font Awesome 5.15.4 sesuai dengan yang Anda berikan -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Link to Poppins font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #eef4ff; /* Warna background fallback */
            background-image: url('{{ asset('images/gal.png') }}'); /* Gambar latar belakang baru */
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        .login-card {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 20px;
            /* Menggunakan multi-shadow untuk efek floating yang lebih modern */
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15), 
                        0 8px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            overflow: hidden;
            display: flex;
            width: 100%;
            max-width: 800px;
            min-height: 500px;
        }
        /* Efek hover untuk membuat card "mengambang" */
        .login-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2), 
                        0 10px 15px rgba(0, 0, 0, 0.15);
        }
        .left-side {
            background-color: #6c88bdd4;
            color: white;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            position: relative;
            flex: 1;
        }
        .left-side .logo-container img {
            width: 120px;
            height: 120px;
        }
        .left-side h3 {
            font-size: 1.5rem;
            font-weight: bold;
            margin-top: 15px;
        }
        .right-side {
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            flex: 1;
        }
        .right-side h2 {
            font-weight: bold;
            font-size: 2.5rem;
            color: #333;
        }
        .right-side p {
            color: #777;
            margin-bottom: 30px;
        }
        .form-control {
            border-radius: 50px;
            padding: 12px 20px;
            border: 1px solid #ddd;
        }
        /* Tambahan CSS untuk input password dengan icon */
        .input-group {
            position: relative;
        }
        .input-group .form-control {
            padding-right: 50px;
        }
        .input-group .toggle-password {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #999;
            transition: color 0.2s ease;
            z-index: 10;
        }
        .input-group .toggle-password:hover {
            color: #6C89BD;
        }
        .btn-custom {
            background-color: #6C89BD;
            color: white;
            border-radius: 50px;
            padding: 10px 30px;
            font-weight: bold;
            transition: background-color 0.3s ease;
            width: 100%;
        }
        .btn-custom:hover {
            background-color: #7d8fb1;
        }
        .forgot-link, .register-link {
            font-size: 0.9rem;
            color: #777;
            text-decoration: none;
        }
        .forgot-link:hover, .register-link:hover {
            text-decoration: underline;
        }
        .d-grid {
            display: grid;
            gap: 1rem;
        }
        .invalid-feedback {
            color: #e3342f;
        }
        @media (max-width: 768px) {
            .login-card {
                flex-direction: column;
                min-height: auto;
            }
        }
    </style>
</head>
<body>
    <div class="d-flex align-items-center justify-content-center" style="min-height: 100vh;">
        <div class="login-card">
            <div class="left-side">
                <div class="logo-container">
                    <img src="{{ asset('images/nunggal.png') }}" alt="Gudang Sparepart Logo">
                    <h3 class="mt-3">Gudang Sparepart</h3>
                </div>
            </div>

            <div class="right-side">
                <div class="text-center">
                    <h2 class="mb-2">welcome</h2>
                    <p class="mb-4">Login to your account to continue</p>
                </div>
                
                <form method="POST" action="{{ route('login') }}" style="width: 100%;">
                    @csrf
                    
                    <div class="mb-3">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3 input-group">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                        <!-- Ikon mata untuk tombol show/hide password -->
                        <i class="far fa-eye toggle-password" data-target="password"></i>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <br>
                   <!-- <div class="text-end mb-4">
                        <a href="{{ route('password.request') }}" class="forgot-link">Forgot your password?</a>
                    </div>-->
                    
                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-custom">LOG IN</button>
                    </div>

                    <div class="text-center">
                        <span class="register-link">Don't have an account? <a href="{{ route('register') }}">Sign up</a></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // JavaScript untuk fungsionalitas show/hide password
        document.addEventListener('DOMContentLoaded', () => {
            const togglePasswordIcon = document.querySelector('.toggle-password');
            
            togglePasswordIcon.addEventListener('click', () => {
                const targetId = togglePasswordIcon.getAttribute('data-target');
                const passwordInput = document.getElementById(targetId);
                
                // Toggle the type attribute
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                
                // Toggle the eye icon class
                togglePasswordIcon.classList.toggle('fa-eye-slash');
            });
        });
    </script>
</body>
</html>
