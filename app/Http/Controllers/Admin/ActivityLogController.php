<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\ActivityLogRepository;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    protected $activityLogRepository;

    public function __construct(
        ActivityLogRepository $activityLogRepository
    ){
        $this->activityLogRepository = $activityLogRepository;
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
            $data['activities'] = $this->activityLogRepository->getRecentActivities(MAX_RECENT_ACTIVITIES);
            return view('admin.activity_log.index', $data);
        }
        catch(\Exception $e){
            throw $e;
        }
    }
}

