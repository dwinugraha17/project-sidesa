<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Resident;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Data Statistik Ringkas
        $totalResidents = Resident::count();
        $totalMale = Resident::where('gender', 'male')->count();
        $totalFemale = Resident::where('gender', 'female')->count();

        // Banner Aktif
        $banners = \App\Models\Banner::where('is_active', true)->orderBy('order')->get();

        // Aparatur Desa Aktif
        $staffs = \App\Models\Staff::where('is_active', true)->orderBy('order')->get();

        // Produk UMKM Aktif
        $products = \App\Models\Product::where('is_active', true)->latest()->take(6)->get();

        // Galeri Foto
        $galleries = \App\Models\Gallery::latest()->take(8)->get();

        // Berita Terbaru (3 item)
        $latestNews = News::where('is_published', true)->latest()->take(3)->get();

        return view('pages.landing.home', compact(
            'totalResidents', 'totalMale', 'totalFemale', 
            'latestNews', 'banners', 'staffs', 'products', 'galleries'
        ));
    }

    public function profil()
    {
        return view('pages.landing.profil');
    }

    public function showNews($slug)
    {
        $news = News::where('slug', $slug)->where('is_published', true)->firstOrFail();
        return view('pages.landing.news_detail', compact('news'));
    }
}