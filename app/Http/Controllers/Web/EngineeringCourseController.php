<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Web\Gallery;
use App\Models\Web\InterCourse;
use App\Models\Web\RsrCourse;
use App\Models\Web\Slider;
use Illuminate\Http\Request;

class EngineeringCourseController extends Controller
{
    
    public function show($slug)
    {
    

        // dd('success');

        // Courses
        $data['pages'] = RsrCourse::where('language_id', Language::version()->id)
           
            ->where('status', '1')
            ->orderBy('id', 'asc')
            ->get();
            
        $data['sliders'] = Slider::where('language_id', Language::version()->id)
            ->where('section','Ram Sharan Roy College of Technology')
            ->where('status', '1')
            ->orderBy('id', 'asc')
            ->get();
        $data['galleries'] = Gallery::where('language_id', Language::version()->id)
            ->where('section', 'Ram Sharan Roy College of Technology')
            ->where('status', '1')
            ->orderBy('id', 'desc')
            ->get();
        $data['page1'] = RsrCourse::where('slug', $slug)
            
            ->where('status', '1')
            ->firstOrFail();
        return view('web.engineering-page', $data);
    }
}
