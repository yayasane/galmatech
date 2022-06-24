<?php

namespace App\Providers;

use App\Filament\Pages\Profile;
use App\Filament\Resources\AppResource;
use App\Filament\Resources\CustomerResource;
use App\Filament\Resources\GroupResource;
use App\Filament\Resources\MemberResource;
use App\Filament\Resources\PartnerResource;
use App\Filament\Resources\ServiceResource;
use App\Filament\Resources\UserResource;
use Filament\Facades\Filament;
use Filament\Navigation\NavigationBuilder;
use Filament\Pages\Dashboard;
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
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Filament::navigation(function (NavigationBuilder $builder): NavigationBuilder {
            $builder
                ->items(Dashboard::getNavigationItems())
                ->group('Contents', [
                    // An array of `NavigationItem` objects.
                    ...AppResource::getNavigationItems(),
                    ...ServiceResource::getNavigationItems(),
                    ...MemberResource::getNavigationItems(),
                    ...CustomerResource::getNavigationItems(),
                    ...PartnerResource::getNavigationItems(),
                ]);
            if (auth()->user()->group->slug == 'super-admin') {
                $builder->group('Settings', [
                    // An array of `NavigationItem` objects.
                    ...GroupResource::getNavigationItems(),
                    ...UserResource::getNavigationItems()
                ]);
            }
            return $builder->group('Account', [
                // An array of `NavigationItem` objects.
                ...Profile::getNavigationItems()
            ]);
        });
    }
}
