<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;

class MailLogRepository extends BaseRepository {

    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return "App\\Models\\MailLog";
    }

    public function searchListMail($search, $paginate = PAGINATION){
        $query = static::query();
        if(empty($paginate)){
            return $query->get();
        }
        return $query->paginate($paginate);
    }
}