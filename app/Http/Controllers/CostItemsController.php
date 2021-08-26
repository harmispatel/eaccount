<?php

namespace App\Http\Controllers;


use App\Cost_item;
use App\Activity;
use App\Tasks;
use App\Projects;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\RoleManageController;

class CostItemsController extends Controller
{

//    Important properties
    public $parentModel = Cost_item::class;
    public $parentRoute = 'cost_item';
    public $parentView = "admin.cost_item";


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $projectId = $request->projectId; 
        $activityId = $request->activityId; 
        $project = Projects::find($projectId);
        $activitySelect = Activity::find($activityId);
        $tasks = Tasks::with('hasManyTasksStatus')->where('id',1)->first();
        $activity = $this->parentModel::where('main_activity_id',$activityId)->orderBy('created_at')->paginate(60);
        return view($this->parentView . '.index',['items'=> $activity,'activity'=>$activitySelect,'projectId'=>$projectId,'project'=>$project,'tasks'=>$tasks]);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {  
        $activitys = Activity::all();
        $activityId = $request->activityId ?  $request->activityId : 0;
        $selectedActivity = Activity::find($activityId);
        return view($this->parentView . '.create',['activitys'=>$activitys,'selectedActivity'=>$selectedActivity]);
        // return view($this->parentView . '.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            // 'description' => 'required|string|max:255',           
            
        ]);
        
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
        Session::flash('success', "Successfully  Create");
        $redirect = $this->redirectButton($request,$costItem);
        return $redirect;

    }
    public function redirectButton($request,$object) {
        if($request->submitType == "saveAndClose"){
            return redirect()->route($this->parentRoute,['activityId'=>$request->selectedActivityId,'projectId'=>$request->selectedProjectId]);
        }
        elseif($request->submitType == "saveAndNew"){
            return redirect()->route($this->parentRoute.'.create',['activityId'=>$request->selectedActivityId,'projectId'=>$request->selectedProjectId]);
        }
        elseif($request->submitType == "saveAndCopy"){
            $costItemNew = new Cost_item;
            $costItemNew->main_activity_id = $request->main_activity_id;
            $costItemNew->sub_activity_id= $request->sub_activity_id;
            $costItemNew->title = $request->title;
            $costItemNew->description = $request->description;
            $costItemNew->single_unit = 1;
            if(($request->cost != "" || $request->cost != 0) && ($request->unit != "" || $request->unit != 0)){
                $costItemNew->single_cost = $request->cost / $request->unit;
            }
            $costItemNew->unit = $request->unit;
            $costItemNew->cost = $request->cost;
            $costItemNew->frequency = $request->frequency;
            // $costItemNew->status = $request->status;
            $costItemNew->status = 1;
            $costItemNew->save();
            // return redirect()->route($this->parentRoute);
            return redirect()->route($this->parentRoute,['activityId'=>$request->selectedActivityId,'projectId'=>$request->selectedProjectId]);
        }
        elseif($request->submitType == "save"){
            return redirect()->route($this->parentRoute.'.edit',['id'=>$object->id,'activityId'=>$request->selectedActivityId,'projectId'=>$request->selectedProjectId]);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {

        $item = $this->parentModel::withTrashed()->find($request->id);
        if (empty($item)) {
            Session::flash('error', "Item not found");
            return redirect()->route('role-manage');
        }
        $content = json_decode($item['content']);
        $item['content'] = $content;
        return view($this->parentView . '.show')->with('items', $item);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $items = $this->parentModel::find($id);        
        
        $activitys = Activity::all();
        // echo "<pre>"; print_r ($Activity); exit;

        return view($this->parentView . '.edit')->with('item', $items)->with('activitys', $activitys);
    }

    public function get_sub_activity(Request $request)
    {
        $main_act_id = $request->main_act_id;
        $activitys = Activity::where('parent_id', $main_act_id)->get();
        $html = "";
        if($main_act_id != "0" || $main_act_id != 0){
            foreach($activitys as $activity){
                $html .= "<option value='".$activity->id."' >".$activity->title."</option>";
            } 
        }
        return response()->json(['success'=>'Got Simple Ajax Request.', 'result'=> $html]);
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // echo "<pre>"; print_r($request->all()); die;
        $request->validate([
            'title' => 'required|string|max:255',
            // 'description' => 'required|string|max:255',
            
        ]);
        $costItem = Cost_item::find($id);
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
        $costItem->save();
        Session::flash('success', "Update Successfully");
        // return redirect()->route($this->parentRoute);
        $redirect = $this->redirectButton($request,$costItem);
        return $redirect;

    }

    public function update_status($id,$status)
    {
        $costItem = Cost_item::find($id);
        $costItem->status = $status;
        $costItem->save();
        Session::flash('success', "Update Successfully");
        return redirect()->route($this->parentRoute);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {

        $user = Cost_item::find($id);
        $user->delete();
        Session::flash('success', "Successfully Trashed");
        return redirect()->route($this->parentRoute,['activityId'=>$request->activityId,'projectId'=>$request->projectId]);
    }


    public function trashed()
    {

        $items = $this->parentModel::onlyTrashed()->paginate(60);
        // echo "<pre>"; print_r($items); die;
        return view($this->parentView . '.trashed')->with("items", $items);
    }

    public function trashedShow()
    {

        $id = $_POST["id"];
        $trashedItem = $this->parentModel::onlyTrashed()->where('id', $id)->first();
        return response()->json($trashedItem);
    }

    public function restore($id)
    {
        $user = $this->parentModel::onlyTrashed()->where('id', $id)->first();

        $user->restore();
        Session::flash('success', 'Successfully Restore');
        // return redirect()->back();
        return redirect()->route($this->parentRoute);
    }

    public function kill($id)
    {
        $user = $this->parentModel::onlyTrashed()->where('id', $id)->first();
        $user->forceDelete();

// //        For Profile
//         $profile = Activity::all()->where('user_id', $id)->first();
//         $profile->delete();

        Session::flash('success', 'Permanently Delete');
        // return redirect()->back();
        return redirect()->route($this->parentRoute);
    }

    public function activeSearch(Request $request)
    {

        $request->validate([
            'search' => 'min:1'
        ]);

        $search = $request["search"];
        $items = $this->parentModel::where('name', 'like', '%' . $search . '%')
            ->paginate(60);

        return view($this->parentView . '.index')
            ->with('items', $items);

    }

    public function trashedSearch(Request $request)
    {

        $request->validate([
            'search' => 'min:1'
        ]);


        $search = $request["search"];
        $items = $this->parentModel::where('name', 'like', '%' . $search . '%')
            ->onlyTrashed()
            ->paginate(60);

        return view($this->parentView . '.trashed')
            ->with('items', $items);

    }


//    Fixed Method for all
    public function activeAction(Request $request)
    {

        $request->validate([
            'items' => 'required'
        ]);

        if ($request->apply_comand_top == 3 || $request->apply_comand_bottom == 3) {
            foreach ($request->items["id"] as $id) {
                $this->destroy($id);
            }

            return redirect()->back();

        } else {
            Session::flash('error', "Something is wrong.Try again");
            return redirect()->back();
        }

    }

    public function trashedAction(Request $request)
    {

        $request->validate([
            'items' => 'required'
        ]);

        if ($request->apply_comand_top == 1 || $request->apply_comand_bottom == 1) {

            foreach ($request->items["id"] as $id) {
                $this->restore($id);
            }

        } elseif ($request->apply_comand_top == 2 || $request->apply_comand_bottom == 2) {

            foreach ($request->items["id"] as $id) {

                $this->kill($id);
            }
            return redirect()->back();

        } else {
            Session::flash('error', "Something is wrong.Try again");
            return redirect()->back();
        }
        return redirect()->back();
    }



}
