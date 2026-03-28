<?php

namespace App\Providers;

use App\Repository\BookRepository;
use App\Repository\Contracts\BookRepositoryInterface;
use App\Repository\Contracts\UserRepositoryInterface;
use App\Repository\UserRepository;
use App\Services\BookService;
use App\Services\Contracts\BookServiceInterface;
use App\Services\Contracts\UserServiceInterface;
use App\Services\UserService;
use Dedoc\Scramble\Scramble;
use Dedoc\Scramble\Support\Generator\OpenApi;
use Dedoc\Scramble\Support\Generator\SecurityScheme;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;

class AppServiceProvider extends ServiceProvider
{
    // SendReservationCreatedNotification
    // ReservationCreated
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(BookRepositoryInterface::class, BookRepository::class);

        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(BookServiceInterface::class, BookService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);

        Scramble::configure()
            ->withDocumentTransformers(function (OpenApi $openApi) {
                $openApi->secure(
                    SecurityScheme::http('bearer')
                );
            })
        ;
    }
}
