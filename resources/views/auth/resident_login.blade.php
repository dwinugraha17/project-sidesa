<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Layanan Mandiri Warga Desa Sajira">
    <meta name="author" content="Pemerintah Desa Sajira">

    <title>SiDesa - Login Warga</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('Lebak.png') }}?v=2">

    <!-- Custom fonts -->
    <link href="{{ asset('template/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- Custom styles -->
    <link href="{{ asset('template/css/sb-admin-2.min.css') }}" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(-45deg, #10b981, #059669, #34d399, #047857); /* Nuansa Hijau untuk Warga */
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .card-login {
            border: none;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            overflow: hidden;
            animation: slideUp 0.8s cubic-bezier(0.2, 0.8, 0.2, 1);
        }

        .bg-login-side {
            background: url('https://images.unsplash.com/photo-1592323360828-2a88a96b3e3a?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80');
            background-position: center;
            background-size: cover;
            position: relative;
        }

        .bg-login-side::after {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(16, 185, 129, 0.6); /* Overlay Hijau */
        }

        .bg-login-side-content {
            position: relative;
            z-index: 2;
            color: white;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 40px;
            text-align: center;
        }

        .form-control-user {
            border-radius: 10px;
            padding: 1.5rem 1rem;
            border: 1px solid #e2e8f0;
            font-size: 0.9rem;
            transition: all 0.3s;
        }

        .form-control-user:focus {
            border-color: #10b981;
            box-shadow: 0 0 0 0.2rem rgba(16, 185, 129, 0.25);
            transform: translateY(-2px);
        }

        .btn-login {
            border-radius: 10px;
            padding: 0.75rem;
            font-size: 1rem;
            font-weight: 600;
            background-color: #10b981;
            border: none;
            transition: all 0.3s;
        }

        .btn-login:hover {
            background-color: #059669;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(16, 185, 129, 0.4);
        }

        .logo-anim {
            animation: bounceIn 1s;
        }

        /* Animations */
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(50px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes bounceIn {
            0%, 20%, 40%, 60%, 80%, 100% {animation-timing-function: cubic-bezier(0.215, 0.610, 0.355, 1.000);}
            0% {opacity: 0; transform: scale3d(.3, .3, .3);}
            20% {transform: scale3d(1.1, 1.1, 1.1);}
            40% {transform: scale3d(.9, .9, .9);}
            60% {opacity: 1; transform: scale3d(1.03, 1.03, 1.03);}
            80% {transform: scale3d(.97, .97, .97);}
            100% {opacity: 1; transform: scale3d(1, 1, 1);}
        }

        .fade-in-element {
            opacity: 0;
            animation: fadeIn 0.8s ease-out forwards;
        }
        
        .delay-1 { animation-delay: 0.2s; }
        .delay-2 { animation-delay: 0.4s; }
        .delay-3 { animation-delay: 0.6s; }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>

<body>

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card card-login o-hidden border-0 my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-side">
                                <div class="bg-login-side-content">
                                    <h2 class="font-weight-bold mb-3">Layanan Mandiri</h2>
                                    <p class="mb-0">Ajukan surat keterangan, cek bantuan sosial, dan akses layanan publik desa lainnya langsung dari rumah Anda.</p>
                                </div>
                            </div>
                            <div class="col-lg-6 bg-white">
                                <div class="p-5">
                                    <div class="text-center mb-4">
                                        <div class="logo-anim">
                                            <img src="{{ asset('Lebak.png') }}" alt="Logo Lebak" style="width: 80px;" class="mb-3">
                                        </div>
                                        <h1 class="h4 text-gray-900 font-weight-bold fade-in-element delay-1">Login Warga</h1>
                                        <p class="text-muted small fade-in-element delay-1">Silahkan masuk menggunakan NIK Anda</p>
                                    </div>

                                    @if(session('error'))
                                        <div class="alert alert-danger fade-in-element">
                                            {{ session('error') }}
                                        </div>
                                    @endif

                                    <form class="user fade-in-element delay-2" action="{{ route('warga.login.submit') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" name="nik" class="form-control form-control-user"
                                                id="exampleInputNik" placeholder="Nomor Induk Kependudukan (NIK)" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Password" required>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-login btn-block text-white mt-4">
                                            <i class="fas fa-sign-in-alt mr-2"></i> Masuk Dashboard
                                        </button>
                                    </form>
                                    
                                    <hr class="fade-in-element delay-3">
                                    <div class="text-center fade-in-element delay-3">
                                        <a class="small text-decoration-none mr-3" href="{{ route('home') }}">
                                            <i class="fas fa-home mr-1"></i> Beranda
                                        </a>
                                        <a class="small text-decoration-none text-secondary" href="{{ route('login') }}">
                                            <i class="fas fa-user-shield mr-1"></i> Login Admin
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('template/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('template/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('template/js/sb-admin-2.min.js') }}"></script>

</body>

</html>