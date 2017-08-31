<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        // 全局共享数据
        view()->share('site_name', 'esporthr');
        view()->share('site_desc', '做专业的竞技游戏职业招聘网站');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        //
    }
}
