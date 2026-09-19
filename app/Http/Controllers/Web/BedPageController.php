<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Web\Gallery;
use App\Models\Web\Page;
use App\Models\Web\Slider;
use Illuminate\Http\Request;

class BedPageController extends Controller
{
    
    public function show($slug)
    {
        $data['pages'] = Page::where('language_id', Language::version()->id)
            ->where('section', 'BED')
            ->where('status', '1')
            ->orderBy('id', 'asc')
            ->get();
        $data['sliders'] = Slider::where('language_id', Language::version()->id)
            ->where('status', '1')
            ->orderBy('id', 'asc')
            ->limit(1)
            ->get();
        $data['galleries'] = Gallery::where('language_id', Language::version()->id)
            ->where('section', 'course')
            ->where('status', '1')
            ->orderBy('id', 'desc')
            ->limit(3)
            ->get();

        $data['page1'] = Page::where('slug', $slug)
            ->where('section', 'BED')
            ->where('status', '1')
            ->firstOrFail();

        return view('web.page', $data);
    }
}
