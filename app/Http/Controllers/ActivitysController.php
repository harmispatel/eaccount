<?php

namespace App\Http\Controllers;

use App\Department;
use App\Activity;
use App\Profile;
use App\Activitytoquarter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\RoleManageController;

class ActivitysController extends Controller
{

//    Important properties
    public $parentModel = Activity::class;
    public $parentRoute = 'activity';
    public $parentView = "admin.activity";


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $Activity = $this->parentModel::orderBy('created_at')->paginate(60);
        $activitys = $this->parentModel::orderBy('created_at')->paginate(60);
        // echo "<pre>"; print_r($Activity); die;
        return view($this->parentView . '.index')->with('items', $Activity)->with('activitys', $activitys);
        // return view($this->parentView . '.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {  
        $Activity = $this->parentModel::orderBy('created_at')->paginate(60);
        return view($this->parentView . '.create')->with('items', $Activity);
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
        // echo "<pre>"; print_r($request->all()); die;

        
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',           
            
        ]);

        $user = Activity::create([
            'title' => $request->title,
            'description' => $request->description,
            'parent_id' => $request->parent_id,
            // 'status' => $request->status,
            'project_id' => $request->project_id,
            'department_id' => $request->department_id,
            'status' => 1,
        ]);

        if((isset($request->quarter)) && (count($request->quarter)>0)){
            foreach($request->quarter as $key => $quarterone){
                //echo "<pre>"; print_r($quarterone); die;
                $quarter = new Activitytoquarter;
                $quarter->activity_id = $user->id;
                $quarter->quarter_id = $quarterone;
                $quarter->save();
            }
        }

        // echo "<pre>"; print_r ($user); exit;

        Session::flash('success', "Successfully  Create");
        // return redirect()->back();
        $redirect = $this->redirectButton($request);
        echo $redirect; exit;
        // return redirect()->route($this->parentRoute);

    }

    public function redirectButton($request) {
        if($request->submitType == "saveAndClose"){
            return redirect()->route($this->parentRoute);
        }
        elseif($request->submitType == "saveAndNew"){
            return redirect()->back();
        }
        elseif($request->submitType == "saveAndCopy"){
            $user = Activity::create([
                'title' => $request->title,
                'description' => $request->description,
                'parent_id' => $request->parent_id,
                'project_id' => $request->project_id,
                'department_id' => $request->department_id,
                'status' => 1,
            ]);
    
            if((isset($request->quarter)) && (count($request->quarter)>0)){
                foreach($request->quarter as $key => $quarterone){
                    //echo "<pre>"; print_r($quarterone); die;
                    $quarter = new Activitytoquarter;
                    $quarter->activity_id = $user->id;
                    $quarter->quarter_id = $quarterone;
                    $quarter->save();
                }
            }
            return redirect()->route($this->parentRoute);
        }
        elseif($request->submitType == "save"){
            return redirect()->back()->withInput();
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
        
        $activitys = $this->parentModel::orderBy('created_at')->paginate(60);
        // echo "<pre>"; print_r ($Activity); exit;

        return view($this->parentView . '.edit')->with('item', $items)->with('activitys', $activitys);
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
        
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            
        ]);

        $user = Activity::find($id);
        $user->title = $request->title;
        $user->description = $request->description;
        $user->parent_id = $request->parent_id;
        $user->project_id = $request->project_id;
        $user->department_id = $request->department_id;

        if((isset($request->quarter)) && (count($request->quarter)>0)){
            $del = Activitytoquarter::where('activity_id',$id)->delete();
            foreach($request->quarter as $key => $quarterone){
                //echo "<pre>"; print_r($quarterone); die;
                $quarter = new Activitytoquarter;
                $quarter->activity_id = $id;
                $quarter->quarter_id = $quarterone;
                $quarter->save();
            }
        }
     
        //$user->status = $request->status;

        

        $user->save();
        Session::flash('success', "Update Successfully");

        $redirect = $this->redirectButton($request);
        return $redirect;
        // return redirect()->route($this->parentRoute);

    }

    public function update_status($id, $status)
    {
        $items = Activity::find($id);
        $items->status = $status;
        $items->save();
        Session::flash('success', "Update Successfully");
        return redirect()->route($this->parentRoute);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $user = Activity::find($id);
        $user->delete();
        Session::flash('success', "Successfully Trashed");
        // return redirect()->back();
        return redirect()->route($this->parentRoute);
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
