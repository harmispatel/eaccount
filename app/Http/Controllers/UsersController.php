<?php

namespace App\Http\Controllers;

use App\User;
use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\RoleManageController;

class UsersController extends Controller
{

//    Important properties
    public $parentModel = User::class;
    public $parentRoute = 'user';
    public $parentView = "admin.user";


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $items = $this->parentModel::orderBy('created_at', 'desc')->paginate(60);
        return view($this->parentView . '.index')->with('items', $items);
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

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:1|confirmed',
            'role_manage_id' => 'required|min:1',
            'department_id' => 'required'
        ]);

        $department_head = isset($request->department_head) ? 1 : 0;
        $position_id = isset($request->position_id) ? $request->position_id : 0;

        //echo '<pre>'; print_r($request->all()); die;

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role_manage_id = $request->role_manage_id;
        $user->department_id = $request->department_id;
        $user->department_head = $department_head;
        $user->position_id = $position_id;
        $user->save();

        $profile = new Profile;
        $profile->user_id = $user->id;
        if($user->role_manage_id == "2"){   
            $profile->company_name = $request->company_name;
            $profile->business_registration_no = $request->business_registration_no;
            $profile->business_license = $request->business_license;
            $profile->bank_details = $request->bank_details;
            $profile->tra_certification = $request->tra_certification;
            $profile->tin_number = $request->tin_number;
            $profile->vat_number = $request->vat_number;
            $profile->physical_verified = isset($request->physical_verified) ? 1 : 0;
            if ($request->hasFile('company_logo')) {
                $company_logo = $request->company_logo;
                $temporaryName = time() . $company_logo->getClientOriginalName();
                $company_logo->move("public/upload/company-logo/", $temporaryName);
                $profile->company_logo = 'upload/company-logo/' . $temporaryName;
            }
            if ($request->hasFile('legal_documents')) {
                $legal_documents = $request->legal_documents;
                $temporaryName = time() . $legal_documents->getClientOriginalName();
                $legal_documents->move("public/upload/legal_documents/", $temporaryName);
                $profile->legal_documents = 'upload/legal_documents/' . $temporaryName;
            }
        }
        $profile->save();

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

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'role_manage_id' => 'numeric|min:1',
            'department_id' => 'required'
        ]);
        

        $user = User::find($id);
        if ($request->password === $request->confirm_password and  !empty($request->password)) {

            $user->password = bcrypt($request->password);
            
        } elseif ($request->password !== $request->confirm_password) {
            
            Session::flash('error', "Password and Confirm Password should same");
            return redirect()->back();
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_manage_id = $request->role_manage_id;
        $user->department_id = $request->department_id;
        $user->department_head = isset($request->department_head) ? 1 : 0;
        $user->position_id = isset($request->position_id) ? $request->position_id : 0;

        //  echo '<pre>'; print_r($request->all()); die;
        if($user->role_manage_id == "2"){
            $profile = Profile::where('user_id',$id)->first();
            $profile->company_name = $request->company_name;
            $profile->business_registration_no = $request->business_registration_no;
            $profile->business_license = $request->business_license;
            $profile->bank_details = $request->bank_details;
            $profile->tra_certification = $request->tra_certification;
            $profile->tin_number = $request->tin_number;
            $profile->vat_number = $request->vat_number;
            $profile->physical_verified = isset($request->physical_verified) ? 1 : 0;
            if ($request->hasFile('company_logo')) {
                $company_logo = $request->company_logo;
                $temporaryName = time() . $company_logo->getClientOriginalName();
                $company_logo->move("public/upload/company-logo/", $temporaryName);
                $profile->company_logo = 'upload/company-logo/' . $temporaryName;
            }
            if ($request->hasFile('legal_documents')) {
                $legal_documents = $request->legal_documents;
                $temporaryName = time() . $legal_documents->getClientOriginalName();
                $legal_documents->move("public/upload/legal_documents/", $temporaryName);
                $profile->legal_documents = 'upload/legal_documents/' . $temporaryName;
            }
            $profile->save();
        }
        
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
        if(Auth::id()==$id){
            Session::flash('error', "You Can Not Delete Yourself!");
            return redirect()->back();
        }
        $user = User::find($id);
        $user->delete();
        Session::flash('success', "Successfully Trashed");
        return redirect()->back();
    }


    public function trashed()
    {

        $items = $this->parentModel::onlyTrashed()->paginate(60);
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

//        For Profile
        $profile = Profile::all()->where('user_id', $id)->first();
        $profile->delete();

        Session::flash('success', 'Permanently Delete');
        return redirect()->back();
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

    public function userType(Request $request)
    {
        //echo '<pre>'; print_r($request->all()); die;
        $request->validate([
            'userType' => 'min:1'
        ]);

        $search = $request["userType"];
        if($search != "all"){
            $items = $this->parentModel::where('role_manage_id',$search)
            ->paginate(60);
        }else{
            $items = $this->parentModel::paginate(60);
        }
        return view($this->parentView . '.index')
            ->with('items', $items);

    }



}
