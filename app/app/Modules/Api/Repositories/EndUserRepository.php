<?php
namespace App\Modules\Api\Repositories;

use App\Models\EndUser;
use Base\Repositories\Eloquent\Repository;

class EndUserRepository extends Repository {
    /**
     * Specify Model class name
     *
     * @return EndUser
     */
    public function model() {
        return EndUser::class;
    }

    /**
     * Get user data by uid
     *
     * @param string uid
     * @return EndUser|null
     */
    public function getUserByUid(string $uid): EndUser|null
    {
        $query = $this->model->select([
            'id',
            'uid',
            'phone_number',
        ])->where('uid', $uid);

        return $query->first();
    }
}
