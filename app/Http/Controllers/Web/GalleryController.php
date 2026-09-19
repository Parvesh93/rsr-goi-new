<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Web\Gallery;
use App\Models\Language;
use App\Models\Web\Slider;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Galleries
        $data['galleries'] = Gallery::where('language_id', Language::version()->id)
            ->where('section', 'gallery')
            ->where('status', '1')
            ->orderBy('id', 'desc')
            ->get();
          // Sliders
          $data['sliders'] = Slider::where('language_id', Language::version()->id)
          ->where('section','gallery') 
          ->where('status', '1')
          ->orderBy('id', 'asc')
          ->get();
        return view('web.gallery', $data);
    }
}
