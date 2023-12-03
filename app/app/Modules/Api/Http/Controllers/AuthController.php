<?php
namespace App\Modules\Api\Http\Controllers;

use App\Modules\Api\Services\FirebaseAuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController {
    public function __construct(private FirebaseAuthService $firebaseAuthService)
    {

    }

    /**
     * Add a user inform into database
     *
     * @param $request
     * @return void
     */
    public function signInByAccessToken(Request $request)
    {
        $idTokenString = $request->bearerToken();
        $user = $this->firebaseAuthService->signInByAccessToken($idTokenString);

        return response()->json([
            'user' => $user
        ]);
    }

    public function profile() {
        dd(Auth::user()->id);
    }
}
