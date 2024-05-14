<?php

namespace App\Providers;

use App\Models\Currency;
use App\Models\SiteSetting;
use App\Models\WebMenu;
use App\Services\CustomValidationRules;
use Carbon\Carbon;
use GuzzleHttp\Cookie\SetCookie;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {


        Validator::extend('min_words', [CustomValidationRules::class, 'minWords']);



        // Site setting calling to cache in 5 hours refresh
        $siteSettings = Cache()->remember(
            'siteSettings',
            3600,
            fn () => SiteSetting::all()->keyBy('key')
        );
        View::share('siteSettings', $siteSettings);

        // web_menus in all pages 
        $web_menus = WebMenu::tree();
        View::share('web_menus', $web_menus);


        //start check currency 
        currency_load();

        if (session::has("system_default_currency_info")) {
            $currency_code = session('system_default_currency_info')->currency_code;

            if (!Session()->has('currency_symbol')) {
                $currency = Currency::where('currency_code', $currency_code)->first();

                session()->put('currency_code', $currency->currency_code);
                session()->put('currency_symbol', $currency->currency_symbol);
                session()->put('currency_name', $currency->currency_name);
                session()->put('currency_exchange_rate', $currency->exchange_rate);
            }
        }

        // end check currency 

        // start check   Locale langugae 
        $locale = config('locales.fallback_locale');
        App::setLocale($locale);
        Lang::setLocale($locale);
        Session::put('locale', $locale);
        Carbon::setLocale($locale);

        // end check locale langugae 


        Paginator::useBootstrap();
    }
}
