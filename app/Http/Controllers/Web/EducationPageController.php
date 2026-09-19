<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Web\BedCourse;
use App\Models\Web\Gallery;
use App\Models\Web\Page;
use App\Models\Web\Slider;
use Illuminate\Http\Request;

class EducationPageController extends Controller
{
    

    public function show($slug)
    {
      
        $data['courses'] = BedCourse::where('language_id', Language::version()->id)
            ->where('status', '1')
            ->orderBy('id', 'asc')
            ->get();
        $data['sliders'] = Slider::where('language_id', Language::version()->id)
            ->where('section','Ram Sharan Roy College (B.Ed.)')
            ->where('status', '1')
            ->orderBy('id', 'asc')
            ->get();
        $data['galleries'] = Gallery::where('language_id', Language::version()->id)
            ->where('section', 'Ram Sharan Roy College (B.Ed.)')
            ->where('status', '1')
            ->orderBy('id', 'desc')
            ->get();

        $data['course1'] = Page::where('slug', $slug)
            ->where('section','Education')
            ->where('status', '1')
            ->firstOrFail();

        return view('web.education-single', $data);
    }
}
