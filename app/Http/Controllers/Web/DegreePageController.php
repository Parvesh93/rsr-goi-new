<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Web\BilashCourse;
use App\Models\Web\Course;
use App\Models\Web\Gallery;
use App\Models\Web\KanchanCourse;
use App\Models\Web\Page;
use App\Models\Web\Slider;
use Illuminate\Http\Request;

class DegreePageController extends Controller
{

    public function show($slug)
    {

        if ($slug == 'ram-sharan-roy-college-jandaha') {
            $data['pages'] = Course::where('language_id', Language::version()->id)
                ->where('status', '1')
                ->orderBy('id', 'asc')
                ->get();
        } elseif ($slug == 'ram-bilash-singh-ram-dayal-boy-college-hajipur') {
            $data['pages'] = BilashCourse::where('language_id', Language::version()->id)
                ->where('status', '1')
                ->orderBy('id', 'asc')
                ->get();
        } else {
            $data['pages'] = KanchanCourse::where('language_id', Language::version()->id)
                ->where('status', '1')
                ->orderBy('id', 'asc')
                ->get();
        }


        if ($slug == 'ram-sharan-roy-college-jandaha') {
            $data['sliders'] = Slider::where('language_id', Language::version()->id)
                ->where('section', 'Ram Sharan Roy College')
                ->where('status', '1')
                ->orderBy('id', 'asc')
                ->get();
        } elseif ($slug == 'ram-bilash-singh-ram-dayal-boy-college-hajipur') {
            $data['sliders'] = Slider::where('language_id', Language::version()->id)
                ->where('section', 'Ram Bilash Singh Ram Dayal Boy College')
                ->where('status', '1')
                ->orderBy('id', 'asc')
                ->get();
        } else {
            $data['sliders'] = Slider::where('language_id', Language::version()->id)
                ->where('section', 'Kanchan Kumari Karmveer Shiv Dayal Roy College')
                ->where('status', '1')
                ->orderBy('id', 'asc')
                ->get();
        }


        if ($slug == 'ram-sharan-roy-college-jandaha') {
            $data['galleries'] = Gallery::where('language_id', Language::version()->id)
                ->where('section', 'Ram Sharan Roy College')
                ->where('status', '1')
                ->orderBy('id', 'desc')
                ->get();
        } elseif ($slug == 'ram-bilash-singh-ram-dayal-boy-college-hajipur') {
            $data['galleries'] = Gallery::where('language_id', Language::version()->id)
                ->where('section', 'Ram Bilash Singh Ram Dayal Boy College')
                ->where('status', '1')
                ->orderBy('id', 'desc')
                ->get();
        } else {
            $data['galleries'] = Gallery::where('language_id', Language::version()->id)
                ->where('section', 'Kanchan Kumari Karmveer Shiv Dayal Roy College')
                ->where('status', '1')
                ->orderBy('id', 'desc')
                ->get();
        }


        $data['page1'] = Page::where('slug', $slug)
            ->where('section', 'Degree')
            ->where('status', '1')
            ->firstOrFail();

        return view('web.degree-page', $data);
    }
}
