<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
use App\Models\Web\CallToAction;
use App\Models\Web\Testimonial;
use App\Models\Web\AboutUs;
use App\Models\Web\Feature;
use App\Models\Web\Slider;
use App\Models\Language;
use App\Models\Web\Faq;
use App\Models\Web\Gallery;
use App\Models\Web\News;
use App\Models\Web\WebEvent;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $language = Language::version();
        $languageId = $language ? $language->id : 1;
        
        // Cache::forget($data);

        $data['sliders'] = Cache::rememberForever("sliders_$languageId", function () use ($languageId) {
            return Slider::where('language_id', $languageId)->where('section', 'home')->where('status', '1')->orderBy('id')->get();
        });

        Cache::forget("sliders_$languageId");

        $data['features'] = Cache::rememberForever("features_$languageId", function () use ($languageId) {
            return Feature::where('language_id', $languageId)->where('status', '1')->orderBy('id')->get();
        });
        
        Cache::forget("features_$languageId");
        $data['about'] = Cache::rememberForever("about_us_$languageId", function () use ($languageId) {
            return AboutUs::where('language_id', $languageId)->where('status', '1')->first();
        });
       
       Cache::forget("about_us_$languageId");


        $data['callToAction'] = Cache::rememberForever("call_to_action_$languageId", function () use ($languageId) {
            return CallToAction::where('language_id', $languageId)->where('status', '1')->first();
        });
        
        Cache::forget("call_to_action_$languageId");

        $data['testimonials'] = Cache::rememberForever("testimonials_$languageId", function () use ($languageId) {
            return Testimonial::where('language_id', $languageId)->where('status', '1')->orderBy('id', 'desc')->get();
        });
        
        Cache::forget("testimonials_$languageId");

        $data['events'] = Cache::rememberForever("events_$languageId", function () use ($languageId) {
            return WebEvent::where('language_id', $languageId)->where('status', '1')->orderBy('date', 'desc')->take(6)->get();
        });

         Cache::forget("events_$languageId");
         
        $data['newses'] = Cache::rememberForever("news_$languageId", function () use ($languageId) {
            return News::where('language_id', $languageId)->where('date', '<=', Carbon::today())->where('status', '1')->orderBy('date', 'desc')->take(6)->get();
        });
         
         Cache::forget("news_$languageId");

        $data['images'] = Cache::rememberForever("gallery_images_$languageId", function () use ($languageId) {
            return Gallery::where('language_id', $languageId)->where('section', 'course')->where('status', '1')->orderBy('id', 'desc')->get();
        });
        
        Cache::forget("gallery_images_$languageId");

        $data['contents'] = Cache::rememberForever("gallery_recruiters_$languageId", function () use ($languageId) {
            return Gallery::where('language_id', $languageId)->where('section', 'Recruiters')->where('status', '1')->orderBy('id', 'desc')->get();
        });

         Cache::forget("gallery_recruiters_$languageId");

        $data['reviews'] = Cache::rememberForever("gallery_reviews_$languageId", function () use ($languageId) {
            return Gallery::where('language_id', $languageId)->where('section', 'Reviews')->where('status', '1')->orderBy('id', 'desc')->get();
        });
        
        Cache::forget("gallery_reviews_$languageId");

        $data['missions'] = Cache::rememberForever("gallery_mission_$languageId", function () use ($languageId) {
            return Gallery::where('language_id', $languageId)->where('section', 'Mission')->where('status', '1')->orderBy('id', 'desc')->get();
        });
         
        Cache::forget("gallery_mission_$languageId");
        
         $data['approved'] = Cache::rememberForever("approve_$languageId", function () use ($languageId) {
            return Gallery::where('language_id', $languageId)->where('section', 'Approved')->where('status', '1')->orderBy('id', 'desc')->get();
        });
        
        
        Cache::forget("approve_$languageId");

        $data['institutes'] = Cache::rememberForever("faq_institutes", function () {
            return Faq::where('section', 'Institutions')->where('status', '1')->orderBy('id', 'desc')->get();
        });
        
        Cache::forget("faq_institutes");

        $data['notices'] = Cache::rememberForever("faq_notices", function () {
            return Faq::where('section', 'Notice')->where('status', '1')->orderBy('id', 'desc')->limit(2)->get();
        });
        
        Cache::forget("faq_notices");

        $data['approves'] = Cache::rememberForever("faq_approves", function () {
            return Faq::where('section', 'Approve')->where('status', '1')->orderBy('id', 'desc')->get();
        });
        
        Cache::forget("faq_approves");

        $data['facilities'] = Cache::rememberForever("faq_facilities", function () {
            return Faq::where('section', 'Feature')->where('status', '1')->orderBy('id', 'desc')->get();
        });
        
        Cache::forget("faq_facilities");


        return view('web.index', $data);
    }

    public function setCookie(Request $request)
    {
        $current = Cookie::get('sidebar');
        $newValue = $current !== 'navbar-collapsed' ? 'navbar-collapsed' : 'navbar-expanded';
        Cookie::queue(Cookie::make('sidebar', $newValue, 60 * 24 * 365));

        return response()->json(['data' => $newValue]);
    }
}
