@extends('layouts.landing')

@section('content')

<!-- Hero Section (Banners) -->
@if($banners->count() > 0)
<header id="heroCarousel" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        @foreach($banners as $index => $banner)
        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
            <div class="hero-section" style="background: linear-gradient(135deg, rgba(0,0,0,0.6), rgba(0,0,0,0.4)), url('{{ str_starts_with($banner->image, 'http') ? $banner->image : asset('storage/' . $banner->image) }}'); background-size: cover; background-position: center;">
                <div class="container text-center hero-content" data-aos="fade-up">
                    <h1 class="font-weight-bold mb-3">{{ $banner->title }}</h1>
                    <p class="mx-auto" style="max-width: 700px;">
                        {{ $banner->description }}
                    </p>
                    <div class="mt-4">
                        <a href="#profil" class="btn btn-success btn-modern shadow-lg mr-2">Jelajahi Profil</a>
                        <a href="{{ route('warga.login') }}" class="btn btn-outline-light btn-modern">Layanan Online</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @if($banners->count() > 1)
    <a class="carousel-control-prev" href="#heroCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#heroCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
    @endif
</header>
@else
<header class="hero-section">
    <div class="container text-center hero-content" data-aos="fade-up">
        <h1 class="font-weight-bold mb-3">Selamat Datang di Desa Sajira</h1>
        <p class="mx-auto" style="max-width: 700px;">
            Menuju desa digital yang transparan dan melayani dengan hati. Temukan informasi terkini dan layanan publik desa kami di sini.
        </p>
        <div class="mt-4">
            <a href="#profil" class="btn btn-success btn-modern shadow-lg mr-2">Jelajahi Profil</a>
            <a href="{{ route('warga.login') }}" class="btn btn-outline-light btn-modern">Layanan Online</a>
        </div>
    </div>
</header>
@endif

<!-- Statistik Section (Floating Cards) -->
<section class="py-5" style="margin-top: -80px; position: relative; z-index: 10;" id="statistik">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card hover-card shadow h-100 py-4 text-center border-0">
                    <div class="card-body">
                        <div class="icon-circle bg-light text-primary mx-auto mb-3" style="width: 70px; height: 70px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 30px;">
                            <i class="fas fa-users"></i>
                        </div>
                        <h2 class="font-weight-bold text-gray-800">{{ number_format($totalResidents) }}</h2>
                        <p class="text-muted font-weight-bold text-uppercase">Total Penduduk</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card hover-card shadow h-100 py-4 text-center border-0">
                    <div class="card-body">
                        <div class="icon-circle bg-light text-success mx-auto mb-3" style="width: 70px; height: 70px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 30px;">
                            <i class="fas fa-male"></i>
                        </div>
                        <h2 class="font-weight-bold text-gray-800">{{ number_format($totalMale) }}</h2>
                        <p class="text-muted font-weight-bold text-uppercase">Laki-laki</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="300">
                <div class="card hover-card shadow h-100 py-4 text-center border-0">
                    <div class="card-body">
                        <div class="icon-circle bg-light text-warning mx-auto mb-3" style="width: 70px; height: 70px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 30px;">
                            <i class="fas fa-female"></i>
                        </div>
                        <h2 class="font-weight-bold text-gray-800">{{ number_format($totalFemale) }}</h2>
                        <p class="text-muted font-weight-bold text-uppercase">Perempuan</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Profil Section -->
<section class="py-5 bg-white" id="profil">
    <div class="container py-5">
        <div class="row align-items-center mb-5">
            <div class="col-lg-6 order-lg-2" data-aos="fade-left">
                <img class="img-fluid rounded-lg shadow-lg" src="https://images.unsplash.com/photo-1556761175-5973dc0f32e7?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Kantor Desa">
            </div>
            <div class="col-lg-6 order-lg-1" data-aos="fade-right">
                <h5 class="text-success font-weight-bold text-uppercase">Tentang Desa Kami</h5>
                <h2 class="font-weight-bold mb-4 text-gray-900">Membangun Desa Sajira yang Bermartabat</h2>
                <p class="text-muted lead mb-4">
                    Desa Sajira adalah desa yang menjunjung tinggi nilai gotong royong dan kearifan lokal, dipadukan dengan inovasi teknologi untuk pelayanan publik yang lebih baik.
                </p>
                <ul class="list-unstyled text-muted">
                    <li class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i> Pelayanan Administrasi Cepat & Online</li>
                    <li class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i> Transparansi Anggaran Desa</li>
                    <li class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i> Pemberdayaan Ekonomi Masyarakat</li>
                </ul>
                <a href="{{ route('profil') }}" class="btn btn-outline-success btn-modern mt-3">Baca Selengkapnya</a>
            </div>
        </div>
    </div>
</section>

<!-- Aparatur Desa Section -->
@if($staffs->count() > 0)
<section class="py-5 bg-white" id="aparatur">
    <div class="container py-5">
        <div class="text-center mb-5" data-aos="fade-up">
            <h5 class="text-success font-weight-bold text-uppercase">Pelayan Masyarakat</h5>
            <h2 class="font-weight-bold section-title text-gray-900">Aparatur Desa Sajira</h2>
            <p class="text-muted">Siap melayani kebutuhan administrasi dan pembangunan masyarakat.</p>
        </div>
        
        <div class="row justify-content-center">
            @foreach($staffs as $staff)
            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card hover-card text-center h-100 border-0 shadow-sm">
                    <div class="p-4">
                        <div class="mx-auto mb-3 overflow-hidden rounded-circle shadow" style="width: 150px; height: 150px;">
                            @if($staff->image)
                                <img src="{{ str_starts_with($staff->image, 'http') ? $staff->image : asset('storage/' . $staff->image) }}" class="w-100 h-100" style="object-fit: cover;">
                            @else
                                <div class="w-100 h-100 bg-light d-flex align-items-center justify-content-center">
                                    <i class="fas fa-user fa-4x text-gray-300"></i>
                                </div>
                            @endif
                        </div>
                        <h5 class="font-weight-bold text-gray-900 mb-1">{{ $staff->name }}</h5>
                        <p class="text-success small font-weight-bold text-uppercase">{{ $staff->position }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- UMKM Section -->
@if($products->count() > 0)
<section class="py-5 bg-light" id="umkm">
    <div class="container py-5">
        <div class="text-center mb-5" data-aos="fade-up">
            <h5 class="text-success font-weight-bold text-uppercase">Produk Lokal</h5>
            <h2 class="font-weight-bold section-title text-gray-900">UMKM Desa Sajira</h2>
            <p class="text-muted">Dukung ekonomi lokal dengan membeli produk unggulan dari warga desa kami.</p>
        </div>
        
        <div class="row">
            @foreach($products as $product)
            <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card hover-card h-100 shadow-sm border-0">
                    <div style="height: 250px; overflow: hidden; position: relative;">
                        @if($product->image)
                            <img class="card-img-top w-100 h-100" src="{{ str_starts_with($product->image, 'http') ? $product->image : asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="object-fit: cover;">
                        @else
                            <div class="w-100 h-100 bg-secondary d-flex align-items-center justify-content-center text-white">
                                <i class="fas fa-box fa-4x"></i>
                            </div>
                        @endif
                        <div class="bg-success text-white position-absolute px-3 py-1 rounded-pill shadow-sm" style="top: 15px; right: 15px; font-weight: bold; font-size: 0.9rem;">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold text-gray-900 mb-1">{{ $product->name }}</h5>
                        <p class="text-muted small mb-3"><i class="fas fa-store mr-1"></i> {{ $product->owner_name }}</p>
                        <p class="card-text text-muted small">{{ Str::limit($product->description, 100) }}</p>
                    </div>
                    <div class="card-footer bg-white border-0 pb-4">
                        <a href="https://wa.me/{{ $product->whatsapp_number }}?text=Halo%20{{ $product->owner_name }},%20saya%20tertarik%20dengan%20produk%20{{ $product->name }}" target="_blank" class="btn btn-success btn-block btn-modern">
                            <i class="fab fa-whatsapp mr-1"></i> Hubungi Penjual
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Berita Section -->
<section class="py-5 bg-light" id="berita">
    <div class="container py-5">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="font-weight-bold section-title text-gray-900">Kabar Desa Terkini</h2>
            <p class="text-muted">Ikuti perkembangan terbaru dan kegiatan masyarakat di Desa Sajira.</p>
        </div>
        
        <div class="row">
            @forelse($latestNews as $news)
            <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card hover-card h-100 shadow-sm border-0">
                    <div style="height: 200px; overflow: hidden;">
                        @if($news->image)
                            <img class="card-img-top w-100 h-100" src="{{ str_starts_with($news->image, 'http') ? $news->image : asset('storage/' . $news->image) }}" alt="{{ $news->title }}" style="object-fit: cover; transition: transform 0.5s;">
                        @else
                            <img class="card-img-top w-100 h-100" src="https://images.unsplash.com/photo-1556761175-5973dc0f32e7?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=300" alt="Default Image" style="object-fit: cover; transition: transform 0.5s;">
                        @endif
                    </div>
                    <div class="card-body">
                        <small class="text-success font-weight-bold text-uppercase mb-2 d-block">
                            <i class="far fa-calendar-alt mr-1"></i> {{ $news->created_at->format('d M Y') }}
                        </small>
                        <h5 class="card-title font-weight-bold">
                            <a href="{{ route('news.show', $news->slug) }}" class="text-dark text-decoration-none">{{ Str::limit($news->title, 50) }}</a>
                        </h5>
                        <p class="card-text text-muted small">{{ Str::limit(strip_tags($news->content), 90) }}</p>
                    </div>
                    <div class="card-footer bg-white border-0 pb-4">
                        <a href="{{ route('news.show', $news->slug) }}" class="btn btn-link text-success font-weight-bold p-0">Baca Selengkapnya <i class="fas fa-arrow-right ml-1"></i></a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <div class="alert alert-light shadow-sm d-inline-block px-5">
                    <i class="fas fa-newspaper text-muted mb-3" style="font-size: 2rem;"></i>
                    <p class="mb-0 text-muted">Belum ada berita yang dipublikasikan saat ini.</p>
                </div>
            </div>
            @endforelse
        </div>
        
        <div class="text-center mt-4">
            <a href="#" class="btn btn-success btn-modern shadow">Lihat Semua Berita</a>
        </div>
    </div>
</section>

<!-- Kotak Aspirasi Section -->
<section class="py-5 bg-white" id="aspirasi">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-6 mb-4 mb-lg-0" data-aos="fade-right">
                <h5 class="text-success font-weight-bold text-uppercase">Suara Anda</h5>
                <h2 class="font-weight-bold mb-4 text-gray-900">Kotak Aspirasi Masyarakat</h2>
                <p class="text-muted mb-4">
                    Punya saran, kritik, atau pertanyaan untuk kemajuan desa? Sampaikan langsung kepada kami melalui formulir ini. Partisipasi Anda sangat berarti bagi pembangunan Desa Sajira.
                </p>
                <div class="d-flex align-items-center mb-3">
                    <div class="icon-circle bg-light text-primary mr-3" style="width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <span class="text-muted">admin@desasajira.id</span>
                </div>
                <div class="d-flex align-items-center">
                    <div class="icon-circle bg-light text-success mr-3" style="width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <i class="fab fa-whatsapp"></i>
                    </div>
                    <span class="text-muted">+62 812-3456-7890</span>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <div class="card shadow border-0">
                    <div class="card-body p-4">
                        <form action="{{ route('messages.store') }}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="small font-weight-bold">Nama Lengkap</label>
                                    <input type="text" name="name" class="form-control bg-light border-0" placeholder="Nama Anda" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="small font-weight-bold">Kontak (HP/Email)</label>
                                    <input type="text" name="contact" class="form-control bg-light border-0" placeholder="No. HP / Email" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="small font-weight-bold">Subjek</label>
                                <input type="text" name="subject" class="form-control bg-light border-0" placeholder="Topik pesan..." required>
                            </div>
                            <div class="form-group">
                                <label class="small font-weight-bold">Isi Pesan</label>
                                <textarea name="content" class="form-control bg-light border-0" rows="4" placeholder="Tuliskan aspirasi Anda di sini..." required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block btn-modern shadow">Kirim Pesan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Location Section -->
<section class="py-5 bg-light" id="lokasi">
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-lg-5 mb-4 mb-lg-0" data-aos="fade-right">
                <h5 class="text-success font-weight-bold text-uppercase">Lokasi Kami</h5>
                <h2 class="font-weight-bold mb-4 text-gray-900">Kunjungi Balai Desa Sajira</h2>
                <p class="text-muted mb-4">
                    Kantor Desa Sajira terletak di pusat kecamatan, memudahkan akses bagi seluruh warga untuk mendapatkan pelayanan publik dan informasi pembangunan.
                </p>
                <div class="d-flex mb-3">
                    <div class="icon-circle bg-light text-success mr-3" style="width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div>
                        <h6 class="font-weight-bold mb-0">Alamat Kantor</h6>
                        <p class="text-muted small">Jl. Raya Sajira No. 1, Desa Sajira, Kec. Sajira, Kab. Lebak, Banten 42371</p>
                    </div>
                </div>
                <div class="d-flex mb-3">
                    <div class="icon-circle bg-light text-success mr-3" style="width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div>
                        <h6 class="font-weight-bold mb-0">Jam Operasional</h6>
                        <p class="text-muted small">Senin - Jumat: 08:00 - 15:30 WIB</p>
                    </div>
                </div>
                <a href="https://goo.gl/maps/YourGoogleMapsLinkHere" target="_blank" class="btn btn-success btn-modern mt-2">Buka di Google Maps</a>
            </div>
            <div class="col-lg-7" data-aos="fade-left">
                <div class="rounded-lg shadow overflow-hidden" style="height: 400px; border: 5px solid white;">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15858.055848243162!2d106.33234555!3d-6.3921359!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e420de94b9845d3%3A0xe542617f1a3556e8!2sSajira%2C%20Kec.%20Sajira%2C%20Kabupaten%20Lebak%2C%20Banten!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-5 bg-theme text-white text-center">
    <div class="container py-4" data-aos="zoom-in">
        <h2 class="font-weight-bold mb-3">Butuh Layanan Administrasi?</h2>
        <p class="lead mb-4 opacity-75">Ajukan surat keterangan domisili, usaha, dan lainnya langsung dari rumah.</p>
        <a href="{{ route('warga.login') }}" class="btn btn-light btn-lg btn-modern shadow" style="color: var(--primary) !important;">Masuk ke Layanan Mandiri</a>
    </div>
</section>

@endsection