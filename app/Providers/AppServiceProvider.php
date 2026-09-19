<?php
namespace App\Providers;
use App\Models\Web\Page;
use App\Models\Web\Faq;
use App\Models\Web\About;
use App\Models\Web\Academic;
use App\Models\Web\Admission;
use App\Models\Web\Campus;
use App\Models\Web\Course;
use App\Models\Web\Lab;
use App\Models\Web\Placement;
use App\Models\Web\TopbarSetting;
use App\Models\Web\SocialSetting;
use App\Models\Setting;
use App\Models\College;
use App\Models\Program;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use App\Models\Language;


class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Schema::defaultStringLength(191);
        Paginator::useBootstrap();

        if (app()->runningInConsole()) {
            return;
        }

        app()->booted(function () {
            $locale = session('locale', 'default');

            $language = Cache::rememberForever("active_language_$locale", function () use ($locale) {
                return $locale !== 'default'
                    ? Language::where('code', $locale)->first()
                    : Language::where('default', 1)->first();
            });
            
            Cache::forget("active_language_$locale");

            $languageId = ($language && $language->id) ? $language->id : 1;

            $user_languages = Cache::rememberForever('languages', fn () => DB::table('languages')->where('status', 1)->get());
             Cache::forget("languages");
             
            $colleges = Cache::rememberForever('colleges', fn () => \App\Models\College::where('status', 1)->get());
            
             Cache::forget("colleges");
             $programs = Cache::rememberForever('programs', fn () => \App\Models\Program::where('status', 1)->orderBy('title', 'asc')->get());
            //  dd($programs);
            Cache::forget("programs");
            
            
            $setting = Cache::rememberForever('setting', fn () => \App\Models\Setting::where('status', 1)->first());
            
             Cache::forget("setting");
            
            $topbarSetting = Cache::rememberForever('topbar_setting', fn () => \App\Models\Web\TopbarSetting::where('status', 1)->first());
            
             Cache::forget("topbar_setting");
            
            $socialSetting = Cache::rememberForever('social_setting', fn () => \App\Models\Web\SocialSetting::where('status', 1)->first());
             
              Cache::forget("social_setting");
            
            $schedule_setting = Cache::rememberForever('schedule_setting', fn () => \App\Models\ScheduleSetting::where('slug', 'fees-schedule')->first());
            
             Cache::forget("schedule_setting");
            
            $footer_pages = Cache::rememberForever('footer_pages', fn () =>
                \App\Models\Web\Page::where('language_id', $languageId)->where('status', 1)->orderBy('id')->get()
            );
            
             Cache::forget("footer_pages");

            $quick_pages = Cache::rememberForever('quick_pages', fn () =>
                \App\Models\Web\Page::where('language_id', $languageId)->where('section', 'Quick')->where('status', 1)->orderBy('id')->get()
            );
            
             Cache::forget("quick_pages");

            $collegesInfo = Cache::rememberForever('collegesInfo', fn () =>
                \App\Models\Web\Faq::where('section', 'Information')->where('status', 1)->orderBy('id', 'desc')->get()
            );
            
             Cache::forget("collegesInfo");

            $abouts = Cache::rememberForever('abouts', fn () =>
                \App\Models\Web\About::where('language_id', $languageId)->where('status', 1)->orderBy('id')->get()
            );
            
             Cache::forget("abouts");

            $academics = Cache::rememberForever('academics', fn () =>
                \App\Models\Web\Academic::where('language_id', $languageId)->where('status', 1)->orderBy('id')->get()
            );
            
             Cache::forget("academics");

            $admissions = Cache::rememberForever('admissions', fn () =>
                \App\Models\Web\Admission::where('language_id', $languageId)->where('status', 1)->orderBy('id')->get()
            );
            
             Cache::forget("admissions");

            $campuses = Cache::rememberForever('campuses', fn () =>
                \App\Models\Web\Campus::where('language_id', $languageId)->where('status', 1)->orderBy('id')->get()
            );
            
             Cache::forget("campuses");

            $courses = Cache::rememberForever('courses', fn () =>
                \App\Models\Web\Course::where('language_id', $languageId)->where('status', 1)->orderBy('id')->get()
            );
            
             Cache::forget("courses");

            $labs = Cache::rememberForever('labs', fn () =>
                \App\Models\Web\Lab::where('language_id', $languageId)->where('status', 1)->orderBy('id')->get()
            );
            
             Cache::forget("labs");

            $placements = Cache::rememberForever('placements', fn () =>
                \App\Models\Web\Placement::where('language_id', $languageId)->where('status', 1)->orderBy('id')->get()
            );
            
             Cache::forget("placements");

            $sectionPages = [];
            // $pageSections = ['Intermediate', 'Nursing', 'Degree', 'Education', 'BED', 'Pharmacy', 'Engineering'];
            // foreach ($pageSections as $section) {
            //     $key = strtolower($section) . '_pages';
            //     $sectionPages[$key] = Cache::rememberForever($key, fn () =>
            //         \App\Models\Web\Page::where('language_id', $languageId)
            //             ->where('college', 1)
            //             ->where('section', $section)
            //             ->where('status', 1)
            //             ->orderBy('id')
            //             ->get()
            //     );
            // }
            $course_pages = Cache::rememberForever('course_pages', fn () =>
                \App\Models\Web\Page::where('language_id', $languageId)->where('section', 'Intermediate')->where('status', 1)->orderBy('id')->get()
            );
            
             Cache::forget("course_pages");
             
            $course_diplomas = Cache::rememberForever('course_diplomas', fn () =>
                \App\Models\Web\Page::where('language_id', $languageId)->where('section', 'Nursing')->where('status', 1)->orderBy('id')->get()
            );
            
             Cache::forget("course_diplomas");
             
            $degrees = Cache::rememberForever('degrees', fn () =>
                \App\Models\Web\Page::where('language_id', $languageId)->where('section', 'Degree')->where('status', 1)->orderBy('id')->get()
            );
            
             Cache::forget("degrees");
             
            $bad = Cache::rememberForever('bad', fn () =>
                \App\Models\Web\Page::where('language_id', $languageId)->where('section', 'Education')->where('status', 1)->orderBy('id')->get()
            );
            
             Cache::forget("bad");
            // dd($bad);
            
            $test = Cache::rememberForever('test', fn () =>
                \App\Models\Web\Page::where('language_id', $languageId)->where('section', 'BED')->where('status', 1)->orderBy('id')->get()
            );
            
             Cache::forget("test");
            
            $pharmacies = Cache::rememberForever('pharmacies', fn () =>
                \App\Models\Web\Page::where('language_id', $languageId)->where('section', 'Pharmacy')->where('status', 1)->orderBy('id')->get()
            );
            
             Cache::forget("pharmacies");
            
            $engineering = Cache::rememberForever('engineering', fn () =>
                \App\Models\Web\Page::where('language_id', $languageId)->where('section', 'Engineering')->where('status', 1)->orderBy('id')->get()
            );
            
             Cache::forget("engineering");
            // Set timezone
            Config::set('app.timezone', $setting->time_zone ?? 'Asia/Kolkata');

            // Share all variables with all views
            View::share(array_merge([
                'setting' => $setting,
                'user_languages' => $user_languages,
                'colleges' => $colleges,
                'schedule_setting' => $schedule_setting,
                'topbarSetting' => $topbarSetting,
                'socialSetting' => $socialSetting,
                'footer_pages' => $footer_pages,
                'quick_pages' => $quick_pages,
                'collegesInfo' => $collegesInfo,
                'abouts' => $abouts,
                'academics' => $academics,
                'admissions' => $admissions,
                'campuses' => $campuses,
                'courses' => $courses,
                'course_pages'=>$course_pages,
                'course_diplomas' => $course_diplomas,
                'degrees' => $degrees,
                'educations' => $bad,
                'beds' => $test,
                'pharmacies' => $pharmacies,
                'engineering' => $engineering,
                'labs' => $labs,
                'placements' => $placements,
                'programs'=>$programs,
            ], $sectionPages));
        });
    }
}