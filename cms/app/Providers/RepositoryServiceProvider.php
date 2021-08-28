<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Repositories\BudgetsRepository::class, \App\Repositories\BudgetsRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ContactRepository::class, \App\Repositories\ContactRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\SubscribeRepository::class, \App\Repositories\SubscribeRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\SystemRepository::class, \App\Repositories\SystemRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\PageRepository::class, \App\Repositories\PageRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\UserRepository::class, \App\Repositories\UserRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\RoleRepository::class, \App\Repositories\RoleRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ThemeRepository::class, \App\Repositories\ThemeRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\CountryRepository::class, \App\Repositories\CountryRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\CustomerRepository::class, \App\Repositories\CustomerRepositoryEloquent::class);

        $this->app->bind(\App\Repositories\BannerRepository::class, \App\Repositories\BannerRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\GuidesRepository::class, \App\Repositories\GuidesRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\TestimonialsRepository::class, \App\Repositories\TestimonialsRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\SiborRatesRepository::class, \App\Repositories\SiborRatesRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\MortgageRepository::class, \App\Repositories\MortgageRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\DistrictRepository::class, \App\Repositories\DistrictRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\TenureRepository::class, \App\Repositories\TenureRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\TypeRepository::class, \App\Repositories\TypeRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ProjectRepository::class, \App\Repositories\ProjectRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\FloorCategoryRepository::class, \App\Repositories\FloorCategoryRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\FloorTypeRepository::class, \App\Repositories\FloorTypeRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ProjectFloorRepository::class, \App\Repositories\ProjectFloorRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\DirectionRepository::class, \App\Repositories\DirectionRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ProjectLastRepository::class, \App\Repositories\ProjectLastRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\LogoPartnerRepository::class, \App\Repositories\LogoPartnerRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\PurposeRepository::class, \App\Repositories\PurposeRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ProjectGalleryRepository::class, \App\Repositories\ProjectGalleryRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ScheduleRepository::class, \App\Repositories\ScheduleRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\LinkReportRepository::class, \App\Repositories\LinkReportRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\MenuRepository::class, \App\Repositories\MenuRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\MenuItemRepository::class, \App\Repositories\MenuItemRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\GuidesCategoryRepository::class, \App\Repositories\GuidesCategoryRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\NewsCategoryRepository::class, \App\Repositories\NewsCategoryRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\NewsRepository::class, \App\Repositories\NewsRepositoryEloquent::class);
        //:end-bindings:
    }
}
