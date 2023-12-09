<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\EndUser;
use App\Modules\Api\Services\FirebaseAuthService;
use Nuwave\Lighthouse\Execution\HttpGraphQLContext;

final class SignInByAccessToken
{
    public function __construct(private FirebaseAuthService $firebaseAuthService)
    {}

    /**
     * @param  null  $_
     * @param  array{}  $args
     * @param  HttpGraphQLContext  $context
     */
    public function __invoke($_, array $arg, HttpGraphQLContext $context): EndUser
    {
        $idTokenString = $context->request->bearerToken();

        return $this->firebaseAuthService->signInByAccessToken($idTokenString);
    }
}
