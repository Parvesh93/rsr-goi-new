<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Web\Campus;
use App\Models\Web\Gallery;
use App\Models\Web\Slider;
use Illuminate\Http\Request;

class CampusController extends Controller
{

    public function index()
    {
        // Courses
        $data['campuses'] = Campus::where('language_id', Language::version()->id)
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
            ->where('section', 'campus')
            ->where('status', '1')
            ->orderBy('id', 'desc')
            ->get();
        return view('web.campus_facilities', $data);
    }


    public function show($slug)
    {
        // Courses
        $data['campuses'] = Campus::where('language_id', Language::version()->id)
            ->where('status', '1')
            ->orderBy('id', 'asc')
            ->get();
        $data['sliders'] = Slider::where('language_id', Language::version()->id)
            ->where('section','campus')
            ->where('status', '1')
            ->orderBy('id', 'asc')
            ->get();
        $data['galleries'] = Gallery::where('language_id', Language::version()->id)
            ->where('section', 'campus')
            ->where('status', '1')
            ->orderBy('id', 'desc')
            ->get();
        $data['campus1'] = Campus::where('slug', $slug)
            ->where('status', '1')
            ->firstOrFail();
        return view('web.campus-single', $data);
        
    }
}
