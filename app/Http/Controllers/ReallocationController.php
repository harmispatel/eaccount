<?php

namespace App\Http\Controllers;


use App\Cost_item;
use App\Reallocation;
use App\Activity;
use App\Approval;

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
        $activityId = $request->activityId ?  $request->activityId : 0;
        $projectId = $request->projectId ?  $request->projectId : 0;
        $costItemId = $request->id ?  $request->id : 0;
        $costItems = Cost_item::where('is_reallocation',0)->where(function ($query) use ($activityId) {$query->where('sub_activity_id',$activityId)->orwhere('main_activity_id',$activityId);})->get();
        $activitys = Activity::where('project_id',$projectId)->get();
        $selectedActivity = Activity::find($activityId);
        return view($this->parentView . '.create',['activitys'=>$activitys,'selectedActivity'=>$selectedActivity,'costItems'=>$costItems]);
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'comment' => 'required|string|max:255',
        ]);
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
            $costItem->is_reallocation = 1;
            $costItem->save();
            $costItemId = $costItem->id;
        }
        else if($request->showBudgetItem == 2){
            $costItem = Cost_item::find($request->cost_item_id);
            $newCostItem = new Cost_item;
            $newCostItem->main_activity_id = $costItem->main_activity_id ? $costItem->main_activity_id : '';
            $newCostItem->sub_activity_id= $costItem->sub_activity_id ? $costItem->sub_activity_id : '';
            $newCostItem->title = $costItem->title ? $costItem->title : '';
            $newCostItem->description = $costItem->description ? $costItem->description : '';
            $newCostItem->single_unit = 1;
            $newCostItem->single_cost = $costItem->single_cost ? $costItem->single_cost : '';
            $newCostItem->unit = $costItem->unit ? $costItem->unit : '';
            $newCostItem->cost = $costItem->cost ? $costItem->cost : '';
            $newCostItem->frequency = $costItem->frequency ? $costItem->frequency : '';
            $newCostItem->status = 1;
            $newCostItem->is_reallocation = 1;
            $newCostItem->save();
            $costItemId = $request->cost_item_id;
        }
        $approval = new Approval;
        $approval->cost_item_id = $costItemId;
        $approval->created_user_id = Auth::user()->id;
        $approval->comment = $request->comment;
        $approval->status = 1;
        $approval->save();
        Session::flash('success', "Successfully  Create");
        return redirect()->route('cost_item',['activityId'=>$request->selectedActivityId,'projectId'=>$request->selectedProjectId]);
    }
}
