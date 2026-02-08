<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Desa Sajira - Website Resmi</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('Lebak.png') }}?v=2">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link href="{{ asset('template/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    
    <!-- Styles -->
    <link href="{{ asset('template/css/sb-admin-2.min.css') }}" rel="stylesheet">
    
    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            --primary: #0ea5e9; /* Sky Blue 500 */
            --primary-dark: #0284c7; /* Sky Blue 600 */
            --secondary: #64748b;
        }

        body { font-family: 'Poppins', sans-serif; }
        
        /* Navbar Modern */
        .navbar-custom {
            background-color: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 20px rgba(14, 165, 233, 0.1);
            transition: all 0.3s ease;
        }
        .navbar-custom .nav-link { color: #475569 !important; font-weight: 500; font-size: 0.95rem; }
        .navbar-custom .nav-link:hover { color: var(--primary) !important; }
        .navbar-brand { font-weight: 800; color: var(--primary) !important; font-size: 1.6rem; letter-spacing: -0.5px; }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, rgba(14, 165, 233, 0.8), rgba(2, 132, 199, 0.6)), url('https://images.unsplash.com/photo-1500382017468-9049fed747ef?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            height: 90vh;
            color: white;
            display: flex;
            align-items: center;
            position: relative;
            clip-path: polygon(0 0, 100% 0, 100% 85%, 0 100%);
        }
        
        .hero-content h1 { font-size: 4rem; font-weight: 800; text-shadow: 2px 2px 4px rgba(0,0,0,0.3); line-height: 1.1; }
        .hero-content p { font-size: 1.25rem; margin-bottom: 30px; opacity: 0.95; font-weight: 300; }

        /* Text & BG Utilities */
        .text-theme { color: var(--primary) !important; }
        .bg-theme { background-color: var(--primary) !important; }

        /* Cards Hover Effect */
        .hover-card {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: none;
            border-radius: 20px;
            overflow: hidden;
            background: white;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        }
        .hover-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(14, 165, 233, 0.2) !important;
        }

        /* Section Titles */
        .section-title {
            position: relative;
            margin-bottom: 3rem;
            font-weight: 800;
            color: #1e293b;
        }
        .section-title::after {
            content: '';
            display: block;
            width: 80px;
            height: 6px;
            background: var(--primary);
            margin: 15px auto 0;
            border-radius: 10px;
        }

        /* Footer */
        footer { background: #0f172a; color: #94a3b8; padding-top: 5rem; }
        footer a { color: #cbd5e1; text-decoration: none; transition: 0.3s; }
        footer a:hover { color: var(--primary); padding-left: 5px; }

        /* Button Modern */
        .btn-modern {
            border-radius: 50px;
            padding: 12px 35px;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 1.5px;
            transition: all 0.3s;
            border: none;
            background: linear-gradient(45deg, var(--primary), var(--primary-dark));
            color: white;
            box-shadow: 0 10px 20px rgba(14, 165, 233, 0.3);
        }
        .btn-modern:hover { 
            transform: translateY(-3px); 
            box-shadow: 0 15px 30px rgba(14, 165, 233, 0.4);
            color: white;
        }
        .btn-outline-modern {
            background: transparent;
            border: 2px solid white;
            color: white;
            box-shadow: none;
        }
        .btn-outline-modern:hover {
            background: white;
            color: var(--primary);
        }
    </style>
</head>
<body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top navbar-custom">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="/">
                <img src="{{ asset('Lebak.png') }}" alt="Logo Lebak" style="width: 40px;" class="mr-2">
                Desa Sajira
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('profil') }}">Profil</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#aparatur">Aparatur</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#umkm">UMKM</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#lokasi">Lokasi</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#statistik">Statistik</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#berita">Berita</a></li>
                    <li class="nav-item ml-lg-3">
                        <a class="btn btn-modern btn-sm text-white" href="{{ route('warga.login') }}">
                            <i class="fas fa-user-circle mr-1"></i> Layanan Warga
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- Footer -->
    <footer class="py-5 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5 class="text-white mb-3 font-weight-bold">Desa Sajira</h5>
                    <p class="small">Mewujudkan masyarakat desa yang mandiri, sejahtera, dan berbudaya melalui pelayanan prima dan teknologi digital.</p>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 class="text-white mb-3 font-weight-bold">Kontak Kami</h5>
                    <ul class="list-unstyled small">
                        <li class="mb-2"><i class="fas fa-map-marker-alt mr-2"></i> Jl. Raya Sajira No. 1, Lebak, Banten</li>
                        <li class="mb-2"><i class="fas fa-phone mr-2"></i> (0252) 1234567</li>
                        <li class="mb-2"><i class="fas fa-envelope mr-2"></i> info@desasajira.id</li>
                    </ul>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 class="text-white mb-3 font-weight-bold">Tautan Cepat</h5>
                    <ul class="list-unstyled small">
                        <li><a href="{{ route('profil') }}">Profil Desa</a></li>
                        <li><a href="{{ route('home') }}#aparatur">Aparatur Desa</a></li>
                        <li><a href="{{ route('home') }}#umkm">Produk UMKM</a></li>
                        <li><a href="{{ route('home') }}#berita">Berita Desa</a></li>
                        <li><a href="{{ route('login') }}">Login Perangkat Desa</a></li>
                    </ul>
                </div>
            </div>
            <hr class="border-secondary">
            <p class="m-0 text-center small">&copy; 2026 Pemerintah Desa Sajira. All Rights Reserved.</p>
        </div>
    </footer>

    <script src="{{ asset('template/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('template/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <!-- AOS Animation JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true,
            offset: 100
        });
        
        // Smooth scrolling
        $('a[href*="#"]').on('click', function(e) {
            var href = $(this).attr('href');
            
            // Jika link hanya berisi hash (misal #aparatur) atau link ke halaman yang sama dengan hash
            if (href.startsWith('#') || href.startsWith(window.location.origin + window.location.pathname + '#')) {
                var targetId = href.substring(href.indexOf('#'));
                var $target = $(targetId);
                
                if ($target.length) {
                    e.preventDefault();
                    $('html, body').animate({
                        scrollTop: $target.offset().top - 70
                    }, 500, 'linear');
                }
            }
            // Jika href berisi rute lain dengan hash, biarkan browser berpindah halaman secara normal
        });
    </script>
</body>
</html>