<?php

namespace App\Providers;

use App\Validators\Validator;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Illuminate\Support\ServiceProvider;

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
        FacadesValidator::resolver(
            function ($translator, $data, $rules, $messages) {
                return new Validator($translator, $data, $rules, $messages);
            }
        );
        JsonResource::wrap('resource_data');
    }
}
