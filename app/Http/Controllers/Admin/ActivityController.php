<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\ActivityRepository;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    protected $activityRepository;

    public function __construct(
        ActivityRepository $activityRepository
    ){
        $this->activityRepository = $activityRepository;
    }

    /**
     * Display a listing of activities.
     * 
     * @param Request $request
     * @return view
     */
    public function index(Request $request)
    {
        try{
            $data['activities'] = $this->activityRepository->getRecentActivities(MAX_RECENT_ACTIVITIES);
            return view('admin.activity.index', $data);
        }
        catch(\Exception $e){
            throw $e;
        }
    }
}

