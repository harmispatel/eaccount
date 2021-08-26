<?php

namespace App\Http\Controllers;


use App\Cost_item;
use App\Reallocation;
use App\Activity;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\RoleManageController;

class ReallocationController extends Controller
{

//    Important properties
    public $parentModel = Reallocation::class;
    public $parentRoute = 'reallocation';
    public $parentView = "admin.reallocation";


    
    public function create(Request $request)
    {  
        $costItemId = $request->id ?  $request->id : 0;
        $costItems = Cost_item::where('is_reallocation',0)->get();
        $activitys = Activity::all();
        $activityId = $request->activityId ?  $request->activityId : 0;
        $selectedActivity = Activity::find($activityId);
        return view($this->parentView . '.create',['activitys'=>$activitys,'selectedActivity'=>$selectedActivity,'costItems'=>$costItems]);
    }

    
    public function store(Request $request)
    {
        echo "<pre>";
        print_r($request->all());
        exit;
        $costItemId = 0;
        if($request->showBudgetItem == 1){
            $costItem = new Cost_item;
            $costItem->main_activity_id = $request->main_activity_id;
            $costItem->sub_activity_id= $request->sub_activity_id;
            $costItem->title = $request->title;
            $costItem->description = $request->description;
            $costItem->single_unit = 1;
            if(($request->cost != "" || $request->cost != 0) && ($request->unit != "" || $request->unit != 0)){
                $costItem->single_cost = $request->cost / $request->unit;
            }
            $costItem->unit = $request->unit;
            $costItem->cost = $request->cost;
            $costItem->frequency = $request->frequency;
            // $costItem->status = $request->status;
            $costItem->status = 1;
            $costItem->save();
            $costItemId = $costItem->id;
        }
        else if($request->showBudgetItem == 2){
            $costItemId = $request->cost_item_id;
        }
        

        Session::flash('success', "Successfully  Create");
        return redirect()->route($this->parentRoute,['activityId'=>$request->selectedActivityId,'projectId'=>$request->selectedProjectId]);
    }
}
