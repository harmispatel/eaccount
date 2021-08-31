<?php

namespace App\Http\Controllers;

use App\Projects;
use App\Profile;
use App\SupportDonor;
use App\Projecttodonor;
use App\Projecttoregion;
use App\Notification;
use App\Region;
use App\User;
use App\Tasks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\RoleManageController;

class ProjectsController extends Controller
{

//    Important properties
    public $parentModel = Projects::class;
    public $parentRoute = 'project';
    public $parentView = "admin.projects";


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Tasks::with('hasManyTasksStatus')->where('id',2)->first();
        $projects = $this->parentModel::with('hasOneSupportDonor','hasOneUser')->orderBy('created_at', 'desc')->paginate(60);
        return view($this->parentView . '.index',['tasks'=>$tasks,'projects'=> $projects]);
        // return view($this->parentView . '.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {  
        $supportDonors = SupportDonor::get();
        $region = Region::get();
        $users = User::get();
        return view($this->parentView . '.create',['supportDonors'=>$supportDonors,'users'=>$users,'region'=>$region]);
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
            'projectName' => 'required|string|max:255',
            'coordinator' => 'required'
        ]);

        $projects = Projects::create([
            'user_id' => Auth()->user()->id,
            'projectName' => $request->projectName,
            'coordinator' => $request->coordinator,
            'over_budget' => $request->over_budget,
            'total_budget' => $request->total_budget,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        if((isset($request->donor)) && (count($request->donor)>0)){
            $del = Projecttodonor::where('project_id',$projects->id)->delete();
            foreach($request->donor as $key => $donorone){
                $donr = new Projecttodonor;
                $donr->project_id = $projects->id;
                $donr->donor_id = $donorone;
                $donr->save();
            }
        }

        if((isset($request->region)) && (count($request->region)>0)){
            $del = Projecttoregion::where('project_id',$projects->id)->delete();
            foreach($request->region as $key => $regionone){
                $reg = new Projecttoregion;
                $reg->project_id = $projects->id;
                $reg->region_id = $regionone;
                $reg->save();
            }
        }

        Session::flash('success', "Successfully  Create");
        $redirect = $this->redirectButton($request,$projects);
        return $redirect;
        // return redirect()->back();
        // return redirect()->route($this->parentRoute);

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
        $supportDonors = SupportDonor::get();
        $region = Region::get();
        $users = User::get();
        return view($this->parentView . '.edit',['item'=> $items,'supportDonors'=>$supportDonors,'users' =>$users,'region'=>$region]);
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
            'projectName' => 'required|string|max:255',
            'region' => 'required',
            'donor' => 'required',
            'coordinator' => 'required'
           
        ]);

        $user = Projects::find($id);
        $user->projectName = $request->projectName;
        $user->coordinator = $request->coordinator;
        $user->over_budget = $request->over_budget;
        $user->total_budget = $request->total_budget;
        $user->start_date = $request->start_date;
        $user->end_date = $request->end_date;

        $user->save();

        if((isset($request->donor)) && (count($request->donor)>0)){
            $del = Projecttodonor::where('project_id',$user->id)->delete();
            foreach($request->donor as $key => $donorone){
                $donr = new Projecttodonor;
                $donr->project_id = $user->id;
                $donr->donor_id = $donorone;
                $donr->save();
            }
        }

        if((isset($request->region)) && (count($request->region)>0)){
            $del = Projecttoregion::where('project_id',$user->id)->delete();
            foreach($request->region as $key => $regionone){
                $reg = new Projecttoregion;
                $reg->project_id = $user->id;
                $reg->region_id = $regionone;
                $reg->save();
            }
        }

        Session::flash('success', "Update Successfully");
        $redirect = $this->redirectButton($request,$user);
        return $redirect;
    }
    public function redirectButton($request,$object) {
        if($request->submitType == "saveAndClose"){
            return redirect()->route($this->parentRoute);
        }
        elseif($request->submitType == "saveAndNew"){
            return redirect()->route($this->parentRoute.'.create');
        }
        elseif($request->submitType == "saveAndCopy"){
            $projects = new Projects;
            $projects->user_id = Auth()->user()->id;
            $projects->projectName  = $request->projectName;
            $projects->coordinator  = $request->coordinator;
            $projects->over_budget = $request->over_budget;
            $projects->total_budget = $request->total_budget; 
            $projects->start_date = $request->start_date;
            $projects->end_date = $request->end_date;

            $projects->save();

            if((isset($request->donor)) && (count($request->donor)>0)){
                $del = Projecttodonor::where('project_id',$projects->id)->delete();
                foreach($request->donor as $key => $donorone){
                    $donr = new Projecttodonor;
                    $donr->project_id = $projects->id;
                    $donr->donor_id = $donorone;
                    $donr->save();
                }
            }

            if((isset($request->region)) && (count($request->region)>0)){
                $del = Projecttoregion::where('project_id',$projects->id)->delete();
                foreach($request->region as $key => $regionone){
                    $reg = new Projecttoregion;
                    $reg->project_id = $projects->id;
                    $reg->region_id = $regionone;
                    $reg->save();
                }
            }

            return redirect()->route($this->parentRoute);
        }
        elseif($request->submitType == "save"){
            return redirect()->route($this->parentRoute.'.edit',['id'=>$object->id]);
        }
    }
    public function update_status(Request $request,$id,$status,$type="")
    {
        //echo '<pre>'; print_r($type); die;
        $projects = Projects::find(decrypt($id));
        $projects->status = $status;
        $projects->save();

        //echo '<pre>'; print_r($projects->user_id); die;

        if($type == "approve"){
            $getData = User::where('id',$projects->user_id)->get();
            $message = "Executive Approved project";
        }elseif($type == "reject"){
            $getData = User::where('id',$projects->user_id)->get();
            $message = "Executive rejected project";
        }else{
            $getData = User::where('position_id',11)->get();
            $message = "user submitted project";
        }
        if(count($getData)>0){
            foreach($getData as $key => $one){
                $newnotification = new Notification;
                $newnotification->title = $message;
                $newnotification->sender_id = Auth()->user()->id;
                $newnotification->receiver_id = $one->id;
                $newnotification->type_id = 1;
                $newnotification->save();
            }
        }

        Session::flash('success', "Update Successfully");
        return redirect()->back();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $projects = Projects::with('hasManyActivity')->find($id);
        $activity = $projects->hasManyActivity ? $projects->hasManyActivity : [];
        if(count($activity)){
            Session::flash('error', "This project used in Activities");
            return redirect()->route($this->parentRoute);    
        }
        $projects->delete();
        Session::flash('success', "Successfully Trashed");
        return redirect()->back();
    }


    public function trashed()
    {

        $items = $this->parentModel::onlyTrashed()->paginate(60);
        // echo "<pre>"; print_r($items); die;
        return view($this->parentView . '.trashed')->with("projects", $items);
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

//        For Profile
        // $profile = Profile::all()->where('user_id', $id)->first();
        // $profile->delete();

        Session::flash('success', 'Permanently Delete');
        return redirect()->back();
    }

    public function activeSearch(Request $request)
    {

        $request->validate([
            'search' => 'min:1'
        ]);

        $search = $request["search"];
        $items = $this->parentModel::where('projectName', 'like', '%' . $search . '%')
            ->paginate(60);

        return view($this->parentView . '.index')
            ->with('projects', $items);

    }

    public function trashedSearch(Request $request)
    {

        $request->validate([
            'search' => 'min:1'
        ]);


        $search = $request["search"];
        $items = $this->parentModel::where('projectName', 'like', '%' . $search . '%')
            ->onlyTrashed()
            ->paginate(60);

        return view($this->parentView . '.trashed')
            ->with('projects', $items);

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
