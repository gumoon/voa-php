<?php

namespace voa\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'voa\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        $this->mapAdminRoutes();

        $this->mapWxRoutes();

        $this->mapCommonRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::group([
            'middleware' => 'web',
            'namespace' => $this->namespace,
        ], function ($router) {
            require base_path('routes/web.php');
        });
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::group([
            'middleware' => ['api', 'auth:api'],
            'namespace' => $this->namespace . '\Api',
            'prefix' => 'api',
        ], function ($router) {
            require base_path('routes/api.php');
        });
    }

    /** 
     * 管理后台
     * 
     * web中间件换成admin中间件吗？需求一致就没必要换
     *
     */
    protected function mapAdminRoutes()
    {
        Route::group([
            'middleware' => 'web',
            'namespace' => $this->namespace . '\Admin',
            'prefix' => 'houtai',
        ], function ($router) {
            require base_path('routes/admin.php');
        });
    }

    /** 
     * 微信小程序接口
     * 
     */
    protected function mapWxRoutes()
    {
        Route::group([
            'middleware' => 'wxminiapp',
            'namespace' => $this->namespace . '\Wx',
            'prefix' => 'wx',
        ], function ($router) {
            require base_path('routes/wxminiapp.php');
        });
    }

    /** 
     * 通用工具
     * 
     *
     */
    protected function mapCommonRoutes()
    {
        Route::group([
            'middleware' => 'web',
            'namespace' => $this->namespace . '\Common',
            'prefix' => 'tools',
        ], function ($router) {
            require base_path('routes/common.php');
        });
    }
}
