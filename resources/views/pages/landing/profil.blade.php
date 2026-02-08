@extends('layouts.landing')

@section('content')
<!-- Header Profil -->
<header class="hero-section" style="height: 50vh; clip-path: polygon(0 0, 100% 0, 100% 90%, 0 100%);">
    <div class="container text-center hero-content" data-aos="fade-up">
        <h1 class="font-weight-bold mb-3">Profil Desa Sajira</h1>
        <p class="mx-auto" style="max-width: 700px;">
            Mengenal lebih dekat sejarah, visi, misi, dan potensi Desa Sajira.
        </p>
    </div>
</header>

<section class="py-5 bg-white">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8" data-aos="fade-right">
                <h3 class="font-weight-bold mb-4">Sejarah Desa</h3>
                <p class="text-muted mb-4 text-justify">
                    Desa Sajira memiliki sejarah panjang yang berakar pada nilai-nilai luhur budaya Banten. Sejak dahulu, masyarakat Sajira dikenal sebagai masyarakat yang religius dan memiliki semangat gotong royong yang tinggi. Nama "Sajira" sendiri memiliki makna filosofis tentang persatuan dan kebersamaan dalam membangun wilayah.
                </p>
                <p class="text-muted mb-5 text-justify">
                    Dari masa ke masa, Desa Sajira terus berkembang mengikuti dinamika zaman tanpa meninggalkan identitas budayanya. Saat ini, Desa Sajira bertransformasi menjadi desa yang modern namun tetap menjaga kelestarian lingkungan dan tradisi lokal.
                </p>

                <h3 class="font-weight-bold mb-4">Visi & Misi</h3>
                <div class="card border-0 shadow-sm bg-light mb-4 p-4 rounded-lg">
                    <h5 class="font-weight-bold text-success mb-3">Visi</h5>
                    <p class="text-dark italic">"Mewujudkan Desa Sajira yang Mandiri, Sejahtera, Transparan, dan Berdaya Saing Melalui Pelayanan Prima Berbasis Teknologi."</p>
                </div>
                
                <h5 class="font-weight-bold mb-3">Misi</h5>
                <ul class="list-unstyled text-muted mb-5">
                    <li class="mb-3 d-flex align-items-start">
                        <i class="fas fa-check-circle text-success mt-1 mr-3"></i>
                        <span>Meningkatkan profesionalisme aparatur desa dalam melayani masyarakat secara cepat, tepat, dan ramah.</span>
                    </li>
                    <li class="mb-3 d-flex align-items-start">
                        <i class="fas fa-check-circle text-success mt-1 mr-3"></i>
                        <span>Mendorong transparansi pengelolaan anggaran desa melalui sistem informasi digital yang dapat diakses publik.</span>
                    </li>
                    <li class="mb-3 d-flex align-items-start">
                        <i class="fas fa-check-circle text-success mt-1 mr-3"></i>
                        <span>Mengembangkan potensi ekonomi lokal melalui pemberdayaan UMKM dan pengelolaan sumber daya alam yang berkelanjutan.</span>
                    </li>
                    <li class="mb-3 d-flex align-items-start">
                        <i class="fas fa-check-circle text-success mt-1 mr-3"></i>
                        <span>Meningkatkan infrastruktur desa yang merata untuk mendukung aktivitas sosial dan ekonomi warga.</span>
                    </li>
                </ul>
            </div>
            
            <div class="col-lg-4" data-aos="fade-left">
                <div class="card border-0 shadow rounded-lg sticky-top" style="top: 100px;">
                    <div class="card-body p-4">
                        <h5 class="font-weight-bold mb-4">Struktur Organisasi</h5>
                        <div class="mb-3 pb-3 border-bottom">
                            <small class="text-success font-weight-bold d-block mb-1">Kepala Desa</small>
                            <p class="font-weight-bold mb-0">Muhammad Chandra</p>
                        </div>
                        <div class="mb-3 pb-3 border-bottom">
                            <small class="text-success font-weight-bold d-block mb-1">Sekretaris Desa</small>
                            <p class="font-weight-bold mb-0">Siti Aminah, S.E.</p>
                        </div>
                        <div class="mb-3">
                            <small class="text-success font-weight-bold d-block mb-1">BPD</small>
                            <p class="font-weight-bold mb-0">H. Abdullah Saleh</p>
                        </div>
                        <a href="{{ route('home') }}#aparatur" class="btn btn-success btn-block btn-modern mt-4">Lihat Tim Lengkap</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
