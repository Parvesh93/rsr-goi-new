<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Web\Gallery;
use App\Models\Web\Page;
use App\Models\Web\RsrCourse;
use App\Models\Web\Slider;
use Illuminate\Http\Request;

class EngineeringController extends Controller
{
    
    public function show($slug)
    {
        // $data['pages'] = Page::where('language_id', Language::version()->id)
        //     ->where('college', '1')
        //     ->where('section', 'Intermediate')
        //     ->where('status', '1')
        //     ->orderBy('id', 'asc')
        //     ->get();
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

        $data['page1'] = Page::where('slug', $slug)
            ->where('section', 'Engineering')
            ->where('status', '1')
            ->firstOrFail();

        return view('web.engineering-page', $data);
    }
    
}
