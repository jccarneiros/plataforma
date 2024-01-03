<?php

namespace App\Providers;

use App\Models\Configuration;
use Illuminate\Support\Facades;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class ConfigurationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        // Verifica se existe a tabela permissions
        $siteInfo = Schema::hasTable('configurations');

        if ($siteInfo) {
            $siteInfo = Configuration::first();
        } else {
            $siteInfo = [];
        }

        if ($siteInfo == true) {
            Config::set([
                'app.name' => $siteInfo->app_name,
                'app.url' => $siteInfo->app_url,
            ]);

            // Config::set();
            Config::set('app.debug', $siteInfo->app_debug);
            Config::set('app.env', $siteInfo->app_env);

            Config::set('session.lifetime', $siteInfo->session_lifetime);
            Config::set('session.expire_on_close', $siteInfo->session_expire_on_close);
            Config::set('session.encrypt', $siteInfo->session_encrypt);

        } else {
            return null;
        }
        Facades\View::composer('dashboard', function ($view) {
            $siteInfo = Configuration::first();
            $view->with('siteInfo', $siteInfo);
        });
        Facades\View::composer('dashboard.students.gerar-qrcode', function ($view) {
            $siteInfo = Configuration::first();
            $view->with('siteInfo', $siteInfo);
        });
        Facades\View::composer('dashboard.relatorios.pdf-gerar-qrcode-aluno', function ($view) {
            $siteInfo = Configuration::first();
            $view->with('siteInfo', $siteInfo);
        });
        Facades\View::composer('dashboard.relatorios.pdf-gerar-qrcode-room-students', function ($view) {
            $siteInfo = Configuration::first();
            $view->with('siteInfo', $siteInfo);
        });
        Facades\View::composer('dashboard.rooms.pdf-gerar-qrcode-room-students', function ($view) {
            $siteInfo = Configuration::first();
            $view->with('siteInfo', $siteInfo);
        });

        view()->composer('welcome', function ($view) {
            $siteInfo = Configuration::first();
            $view->with('siteInfo', $siteInfo);
        });
        view()->composer('layouts.app', function ($view) {
            $siteInfo = Configuration::first();
            $view->with('siteInfo', $siteInfo);
        });
        view()->composer('layouts.master', function ($view) {
            $siteInfo = Configuration::first();
            $view->with('siteInfo', $siteInfo);
        });
        view()->composer('auth.login', function ($view) {
            $siteInfo = Configuration::first();
            $view->with('siteInfo', $siteInfo);
        });
        view()->composer('auth.passwords.email', function ($view) {
            $siteInfo = Configuration::first();
            $view->with('siteInfo', $siteInfo);
        });
        view()->composer('auth.passwords.reset', function ($view) {
            $siteInfo = Configuration::first();
            $view->with('siteInfo', $siteInfo);
        });
    }
}
