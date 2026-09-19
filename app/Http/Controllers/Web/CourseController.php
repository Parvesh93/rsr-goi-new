<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Web\Course;
use App\Models\Language;
use App\Models\Web\Gallery;
use App\Models\Web\Slider;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Courses
        $data['courses'] = Course::where('language_id', Language::version()->id)
            ->where('status', '1')
            ->orderBy('id', 'asc')
            ->get();
        // Sliders
         $data['sliders'] = Slider::where('language_id', Language::version()->id)
            ->where('section','Ram Sharan Roy College')
            ->where('status', '1')
            ->orderBy('id', 'asc')
            ->get();
        $data['galleries'] = Gallery::where('language_id', Language::version()->id)
            ->where('section','Ram Sharan Roy College')
            ->where('status', '1')
            ->orderBy('id', 'desc')
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
        $data['courses'] = Course::where('language_id', Language::version()->id)
            ->where('status', '1')
            ->orderBy('id', 'asc')
            ->get();
            
        $data['sliders'] = Slider::where('language_id', Language::version()->id)
            ->where('section','Ram Sharan Roy College')
            ->where('status', '1')
            ->orderBy('id', 'asc')
            ->get();
        $data['galleries'] = Gallery::where('language_id', Language::version()->id)
            ->where('section','Ram Sharan Roy College')
            ->where('status', '1')
            ->orderBy('id', 'desc')
            ->get();
        $data['course1'] = Course::where('slug', $slug)
            ->where('status', '1')
            ->firstOrFail();
        return view('web.course-single', $data);
    }

     
    
}
