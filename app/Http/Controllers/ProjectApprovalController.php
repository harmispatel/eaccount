<?php

namespace App\Http\Controllers;

use App\Project_approval;
use App\Profile;
use App\Projects;
use App\Tasks;
use App\Orgenizationleader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\RoleManageController;

class ProjectApprovalController extends Controller
{

//    Important properties
    public $parentModel = Project_approval::class;
    public $parentRoute = 'project_approval';
    public $parentView = "admin.project_approval";


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //Executive Director role
        // pending =1
        $tasks = Tasks::with('hasManyTasksStatus')->where('id',2)->first();
        $projects = Projects::with('hasOneSupportDonor','hasOneUser','hasOneUserApplied')->orderBy('created_at', 'desc')->where('status',1)->paginate(60);
        $getleader = Orgenizationleader::get();
        
        $checkrole = 0;
        if(count($getleader)>0){
            foreach($getleader as $getleaderone){
                if(($getleaderone->id == Auth::user()->position_id) && ($getleaderone->budget_approval == "1")){ $checkrole = 1; }
            }
        }
        return view($this->parentView . '.index',['projects'=> $projects,'tasks'=>$tasks,'checkrole'=>$checkrole]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {  
        return view($this->parentView . '.create');
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
            'departmentName' => 'required|string|max:255',
            
            
        ]);

        $user = Department::create([
            'department_code' => $request->department_code,
            'departmentName' => $request->departmentName,
            'status' => $request->status,
            
        ]);

        Session::flash('success', "Successfully  Create");
        return redirect()->back();

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

        return view($this->parentView . '.edit')->with('item', $items);
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
            'departmentName' => 'required|string|max:255',
            
        ]);

        $user = Department::find($id);
        $user->departmentName = $request->departmentName;
        $user->department_code = $request->department_code;
        $user->status = $request->status;

        $user->save();
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

        $user = Department::find($id);
        $user->delete();
        Session::flash('success', "Successfully Trashed");
        return redirect()->back();
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
        $project = $this->parentModel::onlyTrashed()->where('id', $id)->first();

        $project->restore();
        Session::flash('success', 'Successfully Restore');
        return redirect()->back();
    }

    public function kill($id)
    {
        $project = $this->parentModel::onlyTrashed()->where('id', $id)->first();
        $project->forceDelete();

        Session::flash('success', 'Permanently Delete');
        return redirect()->back();
    }

    public function activeSearch(Request $request)
    {

        $request->validate([
            'search' => 'min:1'
        ]);

        $search = $request["search"];
       
        $tasks = Tasks::with('hasManyTasksStatus')->where('id',2)->first();
        $projects = Projects::with('hasOneSupportDonor','hasOneUser','hasOneUserApplied')->orderBy('created_at', 'desc')->where('projectName', 'like', '%' . $search . '%')->where('status',1)->paginate(60);

        return view($this->parentView . '.index',['projects'=>$projects,'tasks'=>$tasks]);

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
