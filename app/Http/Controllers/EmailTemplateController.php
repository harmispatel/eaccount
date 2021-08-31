<?php

namespace App\Http\Controllers;

use App\EmailTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\RoleManageController;

class EmailTemplateController extends Controller
{

//    Important properties
    public $parentModel = EmailTemplate::class;
    public $parentRoute = 'emailTemplate';
    public $parentView = "admin.emailTemplate";

    public function index()
    {
        
        $items = $this->parentModel::orderBy('created_at', 'desc')->paginate(60);
        return view($this->parentView . '.index')->with('items', $items);
    }

    public function create()
    {
        return view($this->parentView . '.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'type' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'body' => 'required|string'
        ]);
        $emailTemplate = new EmailTemplate;
        $emailTemplate->type = $request->type;
        $emailTemplate->description = $request->description;
        $emailTemplate->subject = $request->subject;
        $emailTemplate->body = $request->body;
        $emailTemplate->save();
        Session::flash('success', "Successfully  Create");
        $redirect = $this->redirectButton($request,$emailTemplate);
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
            return redirect()->route($this->parentRoute);
        }
        elseif($request->submitType == "save"){
            return redirect()->route($this->parentRoute.'.edit',['id'=>$object->id]);
        }
    }

    
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

    public function edit($id)
    {
        $items = $this->parentModel::find($id);
        return view($this->parentView . '.edit',['item'=>$items]);
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'type' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'body' => 'required|string'
        ]);
        
        $emailTemplate = EmailTemplate::find($id);
        $emailTemplate->type = $request->type;
        $emailTemplate->description = $request->description;
        $emailTemplate->subject = $request->subject;
        $emailTemplate->body = $request->body;
        $emailTemplate->save();
        Session::flash('success', "Update Successfully");
        $redirect = $this->redirectButton($request,$emailTemplate);
        return $redirect;

    }

    public function destroy($id)
    {
        if(Auth::id()==$id){
            Session::flash('error', "You Can Not Delete Yourself!");
            return redirect()->back();
        }
        $emailTemplate = EmailTemplate::find($id);
        $emailTemplate->delete();
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
        $emailTemplate = $this->parentModel::onlyTrashed()->where('id', $id)->first();

        $emailTemplate->restore();
        Session::flash('success', 'Successfully Restore');
        return redirect()->back();
    }

    public function kill($id)
    {
        $emailTemplate = $this->parentModel::onlyTrashed()->where('id', $id)->first();
        $emailTemplate->forceDelete();

        Session::flash('success', 'Permanently Delete');
        return redirect()->back();
    }

    public function activeSearch(Request $request)
    {

        $request->validate([
            'search' => 'min:1'
        ]);

        $search = $request["search"];
        $items = $this->parentModel::where('type', 'like', '%' . $search . '%')
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
        $items = $this->parentModel::where('tpye', 'like', '%' . $search . '%')
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
