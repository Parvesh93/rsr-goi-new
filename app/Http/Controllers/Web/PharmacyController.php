<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Web\Gallery;
use App\Models\Web\Page;
use App\Models\Web\PharmacyCourse;
use App\Models\Web\Slider;
use Illuminate\Http\Request;

class PharmacyController extends Controller
{
    
    public function show($slug)
    {
        // $data['pages'] = Page::where('language_id', Language::version()->id)
        //     ->where('college', '1')
        //     ->where('section', 'Intermediate')
        //     ->where('status', '1')
        //     ->orderBy('id', 'asc')
        //     ->get();

        // dd('success');
        $data['courses'] = PharmacyCourse::where('language_id', Language::version()->id)
            ->where('status', '1')
            ->orderBy('id', 'asc')
            ->get();
        $data['sliders'] = Slider::where('language_id', Language::version()->id)
            ->where('section','Ram Sharan Roy College of Pharmacy')
            ->where('status', '1')
            ->orderBy('id', 'asc')
            ->get();
        $data['galleries'] = Gallery::where('language_id', Language::version()->id)
            ->where('section', 'Ram Sharan Roy College of Pharmacy')
            ->where('status', '1')
            ->orderBy('id', 'desc')
            ->get();

        $data['course1'] = Page::where('slug', $slug)
            ->where('section', 'Pharmacy')
            ->where('status', '1')
            ->firstOrFail();

        return view('web.pharmacy-single', $data);
    }
}
