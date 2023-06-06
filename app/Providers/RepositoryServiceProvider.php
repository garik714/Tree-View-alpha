<?php

namespace App\Providers;

use App\Repositories\Read\Content\ContentReadRepository;
use App\Repositories\Read\Content\ContentReadRepositoryInterface;
use App\Repositories\Read\Icon\IconReadRepository;
use App\Repositories\Read\Icon\IconReadRepositoryInterface;
use App\Repositories\Write\Content\ContentWriteRepository;
use App\Repositories\Write\Content\ContentWriteRepositoryInterface;
use App\Repositories\Write\Icon\IconWriteRepository;
use App\Repositories\Write\Icon\IconWriteRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            ContentWriteRepositoryInterface::class,
            ContentWriteRepository::class,
        );

        $this->app->bind(
            ContentReadRepositoryInterface::class,
            ContentReadRepository::class,
        );

        $this->app->bind(
            IconWriteRepositoryInterface::class,
            IconWriteRepository::class,
        );

        $this->app->bind(
            IconReadRepositoryInterface::class,
            IconReadRepository::class,
        );
    }

    public function boot()
    {
        //
    }
}
