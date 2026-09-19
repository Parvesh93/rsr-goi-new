<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Language;
use App\Models\Web\Gallery;
use App\Models\Web\Page;
use App\Models\Web\Slider;

class PageController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        // Page                                
        
        // ->where('college', '2')

        $data['pages'] = Page::where('language_id', Language::version()->id)
            ->where('section','Quick')            
            ->where('status', '1')
            ->orderBy('id', 'asc')
            ->get();
        $data['sliders'] = Slider::where('language_id', Language::version()->id)
            ->where('section','policy')
            ->where('status', '1')
            ->orderBy('id', 'asc')
            ->get();
        $data['galleries'] = Gallery::where('language_id', Language::version()->id)
            ->where('section', 'course')
            ->where('status', '1')
            ->orderBy('id', 'desc')
            ->limit(3)
            ->get();

        $data['page1'] = Page::where('slug', $slug)
            ->where('status', '1')
            ->firstOrFail();

        return view('web.page', $data);
    }
}
