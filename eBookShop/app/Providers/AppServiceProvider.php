<?php

namespace App\Providers;


use App\Contracts\AdminContract;
use App\Contracts\BookContract;

use App\Contracts\HomeContract;
use App\Contracts\PermissionContract;
use App\Contracts\PublisherContract;
use App\Contracts\ReviewContract;
use App\Contracts\RoleContract;
use App\Contracts\UserContract;
use App\Models\Category;

use App\Services\AdminService;
use App\Services\BookService;

use App\Services\HomeService;
use App\Services\PermissionService;
use App\Services\PublisherService;
use App\Services\ReviewService;
use App\Services\RoleService;
use App\Services\CategoryService;
use App\Services\UserService;
use App\Services\AuthorService;
use Illuminate\Support\ServiceProvider;
use App\Contracts\OrderContract;
use App\Services\OrderBookService;
use App\Contracts\CategoryContract;
use App\Contracts\AuthorContract;




class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(OrderContract::class, OrderBookService::class);
        $this->app->bind(UserContract::class,UserService::class);
        $this->app->bind(CategoryContract::class, CategoryService::class);
        $this->app->bind(RoleContract::class,RoleService::class);
        $this->app->bind(PermissionContract::class,PermissionService::class);
        $this->app->bind(AuthorContract::class,AuthorService::class);
        $this->app->bind(BookContract::class,BookService::class);
        $this->app->bind(PublisherContract::class,PublisherService::class);
        $this->app->bind(AdminContract::class,AdminService::class);
        $this->app->bind(HomeContract::class,HomeService::class);
        $this->app->bind(ReviewContract::class,ReviewService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
