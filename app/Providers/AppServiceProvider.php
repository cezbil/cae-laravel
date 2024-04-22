<?php

namespace App\Providers;

use App\Domain\Bus\Command\CommandBus;
use App\Domain\Bus\Interfaces\CommandBus as CB;
use App\Domain\Bus\Interfaces\QueryBus as QB;
use App\Domain\Bus\Query\QueryBus;
use App\Domain\Event\Command\CreateEvent\CreateEvent;
use App\Domain\Event\Command\CreateEvent\CreateEventHandler;
use App\Domain\Event\Command\CreateEventsFromHtml\CreateEventsFromHtml;
use App\Domain\Event\Command\CreateEventsFromHtml\CreateEventsFromHtmlHandler;
use App\Domain\Event\Command\User\CreateUser;
use App\Domain\Event\Command\User\CreateUserHandler;
use App\Domain\Event\Command\User\LoginUser;
use App\Domain\Event\Command\User\LoginUserHandler;
use App\Domain\Event\Query\FindEventsByDateRange\FindEventsByDateRange;
use App\Domain\Event\Query\FindEventsByDateRange\FindEventsByDateRangeHandler;
use App\Domain\Event\Query\FindFlightsForNextWeek\FindFlightsForNextWeek;
use App\Domain\Event\Query\FindFlightsForNextWeek\FindFlightsForNextWeekHandler;
use App\Domain\Event\Services\Command\Interfaces\HtmlEventParserInterface;
use App\Infrastructure\Command\Parsing\CrewConnexHtmlEventParser;
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
            QB::class => QueryBus::class,
        ];
        foreach ($singletons as $abstract => $concrete) {
            $this->app->singleton(
                $abstract,
                $concrete,
            );
        }
        $this->app->bind(
            HtmlEventParserInterface::class,
            function ($app) {
                return new CrewConnexHtmlEventParser();
            }
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $commandBus = app(CB::class);

        $commandBus->register([
            CreateEvent::class => CreateEventHandler::class,
            CreateUser::class => CreateUserHandler::class,
            LoginUser::class => LoginUserHandler::class,
            CreateEventsFromHtml::class => CreateEventsFromHtmlHandler::class,
        ]);

        $queryBus = app(QB::class);

        $queryBus->register([
            FindEventsByDateRange::class => FindEventsByDateRangeHandler::class,
            FindFlightsForNextWeek::class => FindFlightsForNextWeekHandler::class
        ]);
    }
}
