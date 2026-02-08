<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Banner;
use App\Models\Staff;
use App\Models\News;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Str;

class FrontendDummySeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('role', 'admin')->first();

        // 1. DUMMY BANNERS (High Quality & Aesthetic)
        Banner::truncate();
        Banner::create([
            'title' => 'Eksotika Alam Desa Sajira',
            'description' => 'Keindahan alam yang asri, udara yang sejuk, dan keramahan warga yang selalu menyambut Anda.',
            'image' => 'https://images.unsplash.com/photo-1500382017468-9049fed747ef?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80',
            'is_active' => true,
            'order' => 1
        ]);

        Banner::create([
            'title' => 'Transformasi Desa Digital',
            'description' => 'Membangun ekosistem pelayanan publik yang transparan, efektif, dan efisien berbasis teknologi.',
            'image' => 'https://images.unsplash.com/photo-1497215728101-856f4ea42174?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80',
            'is_active' => true,
            'order' => 2
        ]);

        Banner::create([
            'title' => 'Pilar Ketahanan Pangan',
            'description' => 'Tanah yang subur adalah warisan terbaik kami untuk kemakmuran seluruh masyarakat desa.',
            'image' => 'https://images.unsplash.com/photo-1464226184884-fa280b87c399?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80',
            'is_active' => true,
            'order' => 3
        ]);

        Banner::create([
            'title' => 'Masyarakat Sehat & Kuat',
            'description' => 'Kami berkomitmen menghadirkan layanan kesehatan dasar yang merata dan berkualitas.',
            'image' => 'https://images.unsplash.com/photo-1576091160550-2173dba999ef?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80',
            'is_active' => true,
            'order' => 4
        ]);

        // 2. DUMMY STAFF (3D Avatars)
        Staff::truncate();
        Staff::create([
            'name' => 'Muhammad Chandra',
            'position' => 'Kepala Desa',
            'image' => 'https://img.freepik.com/free-psd/3d-illustration-person-with-sunglasses_23-2149436188.jpg',
            'is_active' => true,
            'order' => 1
        ]);

        Staff::create([
            'name' => 'Siti Aminah, S.E.',
            'position' => 'Sekretaris Desa',
            'image' => 'https://img.freepik.com/free-psd/3d-illustration-person-with-glasses_23-2149436185.jpg',
            'is_active' => true,
            'order' => 2
        ]);

        Staff::create([
            'name' => 'Ahmad Fauzi',
            'position' => 'Kaur Keuangan',
            'image' => 'https://img.freepik.com/free-psd/3d-render-avatar-character_23-2150611734.jpg',
            'is_active' => true,
            'order' => 3
        ]);

        // 3. DUMMY NEWS (Contextual Images)
        News::truncate();
        News::create([
            'title' => 'Inovasi Pertanian Organik di Desa Sajira',
            'slug' => 'inovasi-pertanian-organik-' . time(),
            'content' => 'Kelompok tani desa mulai beralih ke pupuk organik untuk menjaga kesuburan tanah jangka panjang dan meningkatkan nilai jual hasil panen.',
            'image' => 'https://images.unsplash.com/photo-1523348837708-15d4a09cfac2?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
            'user_id' => $admin->id,
            'is_published' => true
        ]);

        News::create([
            'title' => 'Pesta Rakyat & Bazar UMKM 2026',
            'slug' => 'pesta-rakyat-bazar-umkm-' . time(),
            'content' => 'Kemeriahan HUT Desa yang ke-75 diramaikan dengan berbagai perlombaan tradisional dan pameran produk unggulan lokal.',
            'image' => 'https://images.unsplash.com/photo-1533174072545-7a4b6ad7a6c3?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
            'user_id' => $admin->id,
            'is_published' => true
        ]);

        News::create([
            'title' => 'Pembangunan Jalan Lingkungan Dusun II Selesai',
            'slug' => 'pembangunan-jalan-dusun-selesai-' . time(),
            'content' => 'Akses jalan di Dusun II kini jauh lebih baik setelah pengaspalan selesai dilakukan. Hal ini diharapkan dapat memperlancar mobilitas ekonomi warga.',
            'image' => 'https://images.unsplash.com/photo-1545143184-6f1fe5c8a2ef?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
            'user_id' => $admin->id,
            'is_published' => true
        ]);

        News::create([
            'title' => 'Sosialisasi Pencegahan Stunting bagi Ibu Hamil',
            'slug' => 'sosialisasi-pencegahan-stunting-' . time(),
            'content' => 'Puskesmas bekerjasama dengan Kader Posyandu Desa Sajira mengadakan sosialisasi pentingnya gizi seimbang bagi ibu hamil dan balita.',
            'image' => 'https://images.unsplash.com/photo-1584515933487-759f397f2751?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
            'user_id' => $admin->id,
            'is_published' => true
        ]);

        News::create([
            'title' => 'Pelatihan Pemasaran Digital bagi Pelaku UMKM',
            'slug' => 'pelatihan-pemasaran-digital-umkm-' . time(),
            'content' => 'Guna meningkatkan daya saing, para pelaku UMKM Desa Sajira dibekali keterampilan cara berjualan online melalui media sosial dan marketplace.',
            'image' => 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
            'user_id' => $admin->id,
            'is_published' => true
        ]);

        News::create([
            'title' => 'Penghargaan Desa Terbersih Se-Kecamatan',
            'slug' => 'penghargaan-desa-terbersih-' . time(),
            'content' => 'Berkat kerjasama seluruh warga dalam menjaga kebersihan, Desa Sajira berhasil meraih predikat juara pertama lomba kebersihan tingkat kecamatan.',
            'image' => 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
            'user_id' => $admin->id,
            'is_published' => true
        ]);

        // 4. DUMMY UMKM (Crisp Product Photos)
        Product::truncate();
        Product::create([
            'name' => 'Madu Hutan Tropis',
            'slug' => 'madu-hutan-' . time(),
            'description' => 'Madu murni dari hutan liar Sajira. Tanpa pemanis buatan dan kaya akan nutrisi alami.',
            'price' => 125000,
            'owner_name' => 'Pak Jaka',
            'whatsapp_number' => '6285213869298',
            'image' => 'https://images.unsplash.com/photo-1587049352846-4a222e784d38?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80',
            'is_active' => true
        ]);

        Product::create([
            'name' => 'Kopi Robusta Sajira',
            'slug' => 'kopi-robusta-' . time(),
            'description' => 'Biji kopi pilihan yang disangrai dengan teknik tradisional untuk aroma yang sangat kuat.',
            'price' => 45000,
            'owner_name' => 'Ibu Maria',
            'whatsapp_number' => '6285213869298',
            'image' => 'https://images.unsplash.com/photo-1559056199-641a0ac8b55e?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80',
            'is_active' => true
        ]);

        Product::create([
            'name' => 'Kerajinan Tas Anyaman',
            'slug' => 'tas-anyaman-' . time(),
            'description' => 'Tas tangan etnik yang dibuat dari serat alam pilihan, kuat, awet, dan ramah lingkungan.',
            'price' => 75000,
            'owner_name' => 'Teh Ningsih',
            'whatsapp_number' => '6285213869298',
            'image' => 'https://images.unsplash.com/photo-1598114853012-b9123883bc27?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80',
            'is_active' => true
        ]);

        Product::create([
            'name' => 'Kripik Pisang Tanduk',
            'slug' => 'kripik-pisang-' . time(),
            'description' => 'Camilan renyah khas desa dengan rasa manis alami tanpa pemanis buatan.',
            'price' => 15000,
            'owner_name' => 'Ibu Ratna',
            'whatsapp_number' => '6285213869298',
            'image' => 'https://images.unsplash.com/photo-1613274554329-70f997f5789f?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80',
            'is_active' => true
        ]);

        Product::create([
            'name' => 'Gula Semut Aren',
            'slug' => 'gula-aren-' . time(),
            'description' => 'Gula semut murni dari nira pohon aren pilihan, lebih sehat dan praktis digunakan.',
            'price' => 25000,
            'owner_name' => 'Pak Haji Komar',
            'whatsapp_number' => '6285213869298',
            'image' => 'https://images.unsplash.com/photo-1608408843596-b3119736057c?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80',
            'is_active' => true
        ]);

        Product::create([
            'name' => 'Beras Organik Cianjur',
            'slug' => 'beras-organik-' . time(),
            'description' => 'Beras sehat hasil tani desa tanpa pestisida kimia, nasi lebih pulen dan bergizi.',
            'price' => 18000,
            'owner_name' => 'Kelompok Tani Berkah',
            'whatsapp_number' => '6285213869298',
            'image' => 'https://images.unsplash.com/photo-1586201375761-83865001e31c?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80',
            'is_active' => true
        ]);
    }
}
