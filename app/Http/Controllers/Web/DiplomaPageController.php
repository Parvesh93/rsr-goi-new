<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Web\Gallery;
use App\Models\Web\NursingCourse;
use App\Models\Web\Page;
use App\Models\Web\RbsCourse;
use App\Models\Web\Slider;
use Illuminate\Http\Request;

class DiplomaPageController extends Controller
{
    public function show($slug)
    {

        if ($slug == 'ram-sharan-roy-college-nursing-jandaha') {
            $data['pages'] = NursingCourse::where('language_id', Language::version()->id)
                ->where('status', '1')
                ->orderBy('id', 'asc')
                ->get();
        } else {
            $data['pages'] = RbsCourse::where('language_id', Language::version()->id)
                ->where('status', '1')
                ->orderBy('id', 'asc')
                ->get();
        }



        if ($slug == 'ram-sharan-roy-college-nursing-jandaha') {
            $data['sliders'] = Slider::where('language_id', Language::version()->id)
                ->where('section', 'Ram Sharan Roy College (Nursing)')
                ->where('status', '1')
                ->orderBy('id', 'asc')
                ->get();
        } else {
            $data['sliders'] = Slider::where('language_id', Language::version()->id)
                ->where('section', 'R.B.S.R.D.R. College (Nursing)')
                ->where('status', '1')
                ->orderBy('id', 'asc')
                ->get();
        }

        if ($slug == 'ram-sharan-roy-college-nursing-jandaha') {
            $data['galleries'] = Gallery::where('language_id', Language::version()->id)
                ->where('section', 'Ram Sharan Roy College (Nursing)')
                ->where('status', '1')
                ->orderBy('id', 'desc')
                ->get();
        } else {
            $data['galleries'] = Gallery::where('language_id', Language::version()->id)
                ->where('section', 'R.B.S.R.D.R. College (Nursing)')
                ->where('status', '1')
                ->orderBy('id', 'desc')
                ->get();
        }


        $data['page1'] = Page::where('slug', $slug)
            ->where('section', 'Nursing')
            ->where('status', '1')
            ->firstOrFail();

        return view('web.nursing-page', $data);
    }
}
