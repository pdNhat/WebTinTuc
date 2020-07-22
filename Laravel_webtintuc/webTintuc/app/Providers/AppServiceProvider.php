<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\theloai;
use App\slide;

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
        //
      $theloai = theloai::all();
      $slide = slide::all();
        view()->share('theloai',$theloai);
        view()->share('slide',$slide);
    }
}
