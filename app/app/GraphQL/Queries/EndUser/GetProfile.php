<?php declare(strict_types=1);

namespace App\GraphQL\Queries\EndUser;

use Illuminate\Support\Facades\Auth;

final class GetProfile
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     * @return \App\Models\EndUser
     */
    public function __invoke($_, array $args): \App\Models\EndUser
    {
        return Auth::user();
    }
}
