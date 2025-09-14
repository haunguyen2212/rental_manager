<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;

class UserRepository extends BaseRepository {

    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return "App\\Models\\User";
    }

    public function searchListUser($paginate = PAGINATION){
        $query = $this->with(['role']);
        if(empty($paginate)){
            return $query->get();
        }
        return $query->paginate($paginate);
    }
}