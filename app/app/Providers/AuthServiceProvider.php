<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Modules\Api\Services\FirebaseAuthService;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // config add firebase authenticate by token
        Auth::viaRequest('firebase-jwt', function (\Illuminate\Http\Request $request) {
            $firebaseAuthService = app()->make(FirebaseAuthService::class);
            $idTokenString = $request->bearerToken();

            return $firebaseAuthService->signInByAccessToken($idTokenString);
        });
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {

    }

}
