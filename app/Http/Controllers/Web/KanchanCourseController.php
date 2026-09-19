<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Web\Gallery;
use App\Models\Web\KanchanCourse;
use App\Models\Web\Slider;
use Illuminate\Http\Request;

class KanchanCourseController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Courses
        $data['courses'] = KanchanCourse::where('language_id', Language::version()->id)
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
            ->where('section', 'course')
            ->where('status', '1')
            ->orderBy('id', 'desc')
            ->limit(3)
            ->get();

        return view('web.course', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {


        // Courses
        $data['courses'] = KanchanCourse::where('language_id', Language::version()->id)
            ->where('status', '1')
            ->orderBy('id', 'asc')
            ->get();

        $data['sliders'] = Slider::where('language_id', Language::version()->id)
            ->where('section','Kanchan Kumari Karmveer Shiv Dayal Roy College')
            ->where('status', '1')
            ->orderBy('id', 'asc')
            ->get();
        $data['galleries'] = Gallery::where('language_id', Language::version()->id)
            ->where('section', 'Kanchan Kumari Karmveer Shiv Dayal Roy College')
            ->where('status', '1')
            ->orderBy('id', 'desc')
            ->get();
        $data['course1'] = KanchanCourse::where('slug', $slug)
            ->where('status', '1')
            ->firstOrFail();
        return view('web.kanchan-single', $data);
    }
}
