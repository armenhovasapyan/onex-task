<?php

namespace App\Providers;

use App\Repository\BookRepository;
use App\Repository\BookUserRepository;
use App\Repository\Contracts\BookRepositoryInterface;
use App\Repository\Contracts\BookUserRepositoryInterface;
use App\Repository\Contracts\UserRepositoryInterface;
use App\Repository\UserRepository;
use App\Services\BookService;
use App\Services\BookUserService;
use App\Services\Contracts\BookServiceInterface;
use App\Services\Contracts\BookUserServiceInterface;
use App\Services\Contracts\ReservationServiceInterface;
use App\Services\Contracts\UserServiceInterface;
use App\Services\ReservationService;
use App\Services\UserService;
use Dedoc\Scramble\Scramble;
use Dedoc\Scramble\Support\Generator\OpenApi;
use Dedoc\Scramble\Support\Generator\SecurityScheme;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(BookRepositoryInterface::class, BookRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(BookUserRepositoryInterface::class, BookUserRepository::class);

        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(BookServiceInterface::class, BookService::class);
        $this->app->bind(ReservationServiceInterface::class, ReservationService::class);
        $this->app->bind(BookUserServiceInterface::class, BookUserService::class);
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
