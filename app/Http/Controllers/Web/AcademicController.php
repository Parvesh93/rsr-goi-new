<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Web\Academic;
use App\Models\Web\Gallery;
use App\Models\Web\Slider;
use Illuminate\Http\Request;

class AcademicController extends Controller
{


    public function index()
    {
        // Courses
        $data['academics'] = Academic::where('language_id', Language::version()->id)
            ->where('status', '1')
            ->orderBy('id', 'asc')
            ->get();
        // Sliders
        $data['sliders'] = Slider::where('language_id', Language::version()->id)
            ->where('status', '1')
            ->orderBy('id', 'asc')
            ->limit(1)
            ->get();
        $data['galleries'] = Gallery::where('language_id', Language::version()->id)
            ->where('section', 'academic')
            ->where('status', '1')
            ->orderBy('id', 'desc')
            ->get();
        return view('web.academic', $data);
    }


    public function show($slug)
    {
        // Courses
        $data['academics'] = Academic::where('language_id', Language::version()->id)
            ->where('status', '1')
            ->orderBy('id', 'asc')
            ->get();
        $data['sliders'] = Slider::where('language_id', Language::version()->id)
            ->where('section', 'academic')
            ->where('status', '1')
            ->orderBy('id', 'asc')
            ->get();
        $data['galleries'] = Gallery::where('language_id', Language::version()->id)
            ->where('section', 'academic')
            ->where('status', '1')
            ->orderBy('id', 'desc')
            ->get();
        $data['academic1'] = Academic::where('slug', $slug)
            ->where('status', '1')
            ->firstOrFail();
        return view('web.academic-single', $data);
    }
}
