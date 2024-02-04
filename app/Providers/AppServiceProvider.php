<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Schema;
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
        Builder::macro('whereLike', function(string $attribute, string $searchTerm) {
           return $this->orWhere($attribute, 'LIKE', "%{$searchTerm}%");
        });
        if (Schema::hasTable('pages')) {
            view()->share('share_pages',\App\Model\Page::where(['status'=>'publish'])->groupBy('slug')->get());
        }
    }
}
