<?php
namespace App\Providers;


use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class MailConfigServiceProvider extends ServiceProvider
{

public function boot(): void
{
    // Prevent running this logic during Artisan commands like migrate
    if (App::runningInConsole()) {
        return;
    }

    // Delay execution until AFTER application is fully booted
    app()->booted(function () {
        // Check mail_settings table existence only once
        $tableExists = Cache::rememberForever('mail_settings_table_exists', function () {
            return Schema::hasTable('mail_settings');
        });
        
        Cache::forget("mail_settings_table_exists"); 
        
        if (!$tableExists) {
            return;
        }

        // Fetch mail config from cache
        $mail = Cache::rememberForever('mail_settings', function () {
            return DB::table('mail_settings')->where('status', 1)->first();
        });
        
        // Cache::forget("mail_settings"); 
         
        if (!empty($mail) && $mail->status == 1) {
            Config::set('mail.mailers.smtp', [
                'transport' => 'smtp',
                'host' => $mail->host,
                'port' => $mail->port,
                'encryption' => $mail->encryption ?? null,
                'username' => $mail->username,
                'password' => $mail->password,
            ]);

            Config::set('mail.from', [
                'address' => $mail->sender_email,
                'name' => $mail->sender_name,
            ]);
        }
    });
}
}