<?php

namespace App\Providers;

use App\Domain\Bus\Command\CommandBus;
use App\Domain\Bus\Interfaces\CommandBus as CB;
use App\Domain\Bus\Interfaces\QueryBus as QB;
use App\Domain\Event\Command\CreateEvent\CreateEventsFromHtml;
use App\Domain\Event\Command\CreateEvent\CreateEventsFromHtmlHandler;
use App\Domain\Event\Command\User\CreateUser;
use App\Domain\Event\Command\User\CreateUserHandler;
use App\Domain\Event\Command\User\LoginUser;
use App\Domain\Event\Command\User\LoginUserHandler;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $singletons = [
            CB::class => CommandBus::class,
        ];
        foreach ($singletons as $abstract => $concrete) {
            $this->app->singleton(
                $abstract,
                $concrete,
            );
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $commandBus = app(CB::class);

        $commandBus->register([
            CreateEventsFromHtml::class => CreateEventsFromHtmlHandler::class,
            CreateUser::class           => CreateUserHandler::class,
            LoginUser::class            => LoginUserHandler::class,
        ]);

//        $queryBus = app(QB::class);
//
//        $queryBus->register([]);
    }
}
