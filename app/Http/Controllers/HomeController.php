<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Carousel;
use App\Models\Benefit;
use App\Models\BenefitImage;
use App\Models\CuriculumSection;
use App\Models\CuriculumItem;
use App\Models\ExtracurricularCategory;
use App\Models\Extracurricular;
use App\Models\CharacterSection;
use App\Models\CharacterCarousel;
use App\Models\Stat;
use App\Models\Berita;



class HomeController extends Controller
{
    public function index()
    {
        $carousels = Carousel::where('is_active', true)
            ->orderBy('order', 'asc')
            ->get();

        $benefits = Benefit::orderBy('order')->get();

        $images = BenefitImage::all()->keyBy('position');

        $curiculumSection = CuriculumSection::first();

        $curiculumItems = CuriculumItem::where('is_active', true)
            ->orderBy('order', 'asc')
            ->get();

        $ekskulCategories = ExtracurricularCategory::with(['extracurriculars' => function ($query) {
            $query->where('is_active', true)
                ->with('galleries')
                ->orderBy('order');
        }])
        ->orderBy('order')
        ->get();

        $section = CharacterSection::first();
        $characterCarousels = CharacterCarousel::where('is_active', true)
            ->orderBy('order')
            ->get();

        $stats = Stat::where('is_active', true)
            ->ordered()
            ->get();

        $beritaTerbaru = Berita::terbit()
            ->latest('tanggal_publish')
            ->take(3)
            ->get();

        return view('frontend.home', compact(
            'carousels',
            'benefits',
            'images',
            'curiculumSection',
            'curiculumItems',
            'ekskulCategories',
            'section',
            'characterCarousels',
            'stats',
            'beritaTerbaru'
        ));
    }
}
