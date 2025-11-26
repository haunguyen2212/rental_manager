<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;

class ActivityRepository extends BaseRepository {

    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return "App\\Models\\Activity";
    }

    public function getRecentActivities($limit = null){
        $query = static::query()->orderBy('created_at', 'desc');
        if(!is_null($limit)){
           $query->limit($limit); 
        }
        return $query->get();
    }
}