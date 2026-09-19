<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Web\About;
use App\Models\Web\Gallery;
use App\Models\Web\Slider;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;

class AboutController extends Controller
{
    //


    public function index()
    {
        // Courses
        $data['abouts'] = About::where('language_id', Language::version()->id)
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
        return view('web.about-us', $data);
    }


    public function show($slug)
    {
        // Courses
        $data['abouts'] = About::where('language_id', Language::version()->id)
            ->where('status', '1')
            ->orderBy('id', 'asc')
            ->get();

        $data['sliders'] = Slider::where('language_id', Language::version()->id)
            ->where('section','about')
            ->where('status', '1')
            ->orderBy('id', 'asc')
            ->get();

            // ->where('section', 'course') 
        $data['galleries'] = Gallery::where('language_id', Language::version()->id)
            ->where('section','about')
            ->where('status', '1')
            ->orderBy('id', 'desc')
            ->get();
        $data['about1'] = About::where('slug', $slug)
            ->where('status', '1')
            ->firstOrFail();
        return view('web.about_us-single', $data);
    }
    
    public function UploadImage(Request $request)
    {
        $imag = $request->file('file');
        $fileTime = time() . '.' . $imag->extension();
        $new_path = 'uploads/tinymce/' . $fileTime;
        $path = ImageManager::imagick()->read($imag)->save($new_path);

        return json_encode(['location'=>asset('uploads/tinymce/' . $fileTime)]);
    }
}



