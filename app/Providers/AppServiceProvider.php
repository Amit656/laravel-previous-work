<?php

namespace App\Providers;

use File;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (App::environment('local')) {
            $this->logQuery();
        }
    }

    private function logQuery()
    {
        DB::listen(function ($query) {
            $data = $sqlquery = '';
            File::append(
                storage_path('logs/query/'.date('d-m').'-query.log'),
                $query->sql."	 \t".json_encode($query->bindings)."  \t".PHP_EOL.'----------------------------------------------'.PHP_EOL.PHP_EOL
            );
        });
    }
}
