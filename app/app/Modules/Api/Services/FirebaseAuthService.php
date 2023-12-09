<?php
namespace App\Modules\Api\Services;

use App\Exceptions\AuthenticateHttpException;
use App\Modules\Api\Repositories\EndUserRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Kreait\Firebase\Contract\Auth;
use Kreait\Firebase\Exception\Auth\FailedToVerifyToken;
use Kreait\Firebase\Exception\Auth\RevokedIdToken;
use Throwable;

class FirebaseAuthService {
    public function __construct(private Auth $auth, private EndUserRepository $endUserRepo)
    {}

    /**
     * Add user inform into database
     *
     * @param string $idTOkenString
     * @return \App\Models\EndUser
     */
    public function signInByAccessToken(string $idTokenString) {
        try {
            // get id by access_token
            $verifiedIdToken = $this->auth->verifyIdToken($idTokenString, true);

            // find user by uid
            $uid = $verifiedIdToken->claims()->get('sub');
            $user = $this->endUserRepo->getUserByUid($uid);

            // create new data if not exists
            if(!$user) {
                // start transaction
                DB::beginTransaction();

                $firebaseUser = $this->auth->getUser($uid);

                $user = $this->endUserRepo->create([
                    'uid' => $uid,
                    'calling_code' => '+84',
                    'phone_number' => $firebaseUser->phoneNumber
                ]);

                // end transaction
                DB::commit();
            }

            return $user;
        } catch (FailedToVerifyToken|RevokedIdToken $e) {
            throw new AuthenticateHttpException();
        } catch (Throwable $e) {
            // log error -> graphql auto log so skip this
            // Log::error($e);

            DB::rollBack();

            throw $e;
        }

    }
}
