<?php

namespace App\Http\Controllers;

use App\Setting;
use App\Orgenizationleader;
use App\Bankaccount;
use App\Region;
use App\Projects;
use App\User;
use Hamcrest\Core\Set;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\RoleManageController;
use DB;

class SettingsController extends Controller
{

    public function general_show(Request $request,$allId="")
    {
        // echo "dsdsg".$allId;  die; 
       
        $general_settings_info = Setting::where('settings_name', 'General Settings')->get()->first();

        $generaldata = json_decode($general_settings_info->content, true);

        $system_settings_info = Setting::where('settings_name', 'System Settings')->get()->first();

        $systemdata = json_decode($system_settings_info->content, true);

        $quarter_settings_info = Setting::where('settings_name', 'Quarter Settings')->get()->first();

        $quarterdata = json_decode($quarter_settings_info->content, true);

        $bankAccount_settings_info = Setting::where('settings_name', 'Bank Account')->get()->first();

        $bankAccountdata = json_decode($bankAccount_settings_info->content, true);

        
        $supportdonor = DB::table('supportdonor')->get();  

        $region = Region::get();    
        // $orgenizationleader = DB::table('orgenizationleader')->get();    

        $orgenizationleader = Orgenizationleader::get();
        $currentPath= Route::getFacadeRoot()->current()->uri();
        if ((isset($currentPath)) && ($request->is('settings/organizationLeader/edit/*')) && ($allId != "")) {
            $orgenizationleaderedit = Orgenizationleader::where('id',$allId)->first();    
        }else{
            $orgenizationleader = Orgenizationleader::get();
            $orgenizationleaderedit = array();
        }

        $Bankaccounts = Bankaccount::get();
        if((isset($currentPath)) && ($request->is('settings/bankaccount/edit/*')) && ($allId != "")){
            $Bankaccountsedit = Bankaccount::where('id',$allId)->first();    
        } else {
            $Bankaccounts = Bankaccount::get();
            $Bankaccountsedit = array();
        }
        
        // $orgenizationleader = DB::table('orgenizationleader')->get();    
        

        // echo"<pre>"; print_r($Bankaccounts); exit;
        
        // return view('admin.settings.general')->with('settings', $data);
        return view('admin.settings.general')->with(array('generalsettings'=>$generaldata, 'systemdata'=>$systemdata, 'quarterdata'=>$quarterdata, 'bankAccountdata'=>$bankAccountdata, 'supportdonor'=>$supportdonor, 'orgenizationleader'=>$orgenizationleader, 'Bankaccounts'=>$Bankaccounts, 'Bankaccountsedit'=>$Bankaccountsedit,'region'=>$region,'orgenizationleaderedit'=>$orgenizationleaderedit));

    }

    public function general_update(Request $request)
    { 

        // echo "<pre>"; print_r($request->all()); die;
        $request->validate([
            'company_name' => 'required',
            'company_logo' => 'image'
        ]);

        $setting_general = Setting::where('settings_name', 'General Settings')->get()->first();

        $setting_general_data = json_decode($setting_general->content, true);

        $company_new_logo = $setting_general_data['company_logo'];
        if ($request->hasFile('company_logo')) {

            if (!empty($setting_general->company_logo) and $setting_general->company_logo != 'upload/company-logo/e.png') {
                unlink($setting_general->company_logo); // Delete previous image file
            }
            $company_logo = $request->company_logo;
            $temporaryName = time() . $company_logo->getClientOriginalName();
            $company_logo->move("public/upload/company-logo/", $temporaryName);
            $company_new_logo = 'upload/company-logo/' . $temporaryName;
            // echo $company_new_logo; die;
        }

        $data = array(
            'company_name' => $request->company_name,
            'contract_person' => $request->contract_person,
            'email' => $request->email,
            'phone' => $request->phone,
            'address_1' => $request->address_1,
            'address_2' => $request->address_2,
            'city' => $request->city,
            'state' => $request->state,
            'zip_code' => $request->zip_code,
            'Quarter1_Start' => $request->Quarter1_Start,
            'Quarter1_End' => $request->Quarter1_End,
            'Quarter2_Start' => $request->Quarter2_Start,
            'Quarter2_End' => $request->Quarter2_End,
            'Quarter3_Start' => $request->Quarter3_Start,
            'Quarter3_End' => $request->Quarter3_End,
            'Quarter4_Start' => $request->Quarter4_Start,
            'Quarter4_End' => $request->Quarter4_End,
            'company_logo' => $company_new_logo,
        );

        // echo"<pre>"; print_r($data); exit;

        $json_data = json_encode($data);
        $setting_general->content = $json_data;
        $setting_general->save();

        Session::flash('success', 'Successfully Update');

        // return redirect()->back();
        return redirect('settings/general#generalsetting');

    }


//    settings/system
    public function system_show()
    {

        $system_settings_info = Setting::where('settings_name', 'System Settings')->get()->first();

        $data = json_decode($system_settings_info->content, true);

        return view('admin.settings.system')->with('settings', $data);
    }

    public function system_update(Request $request)
    {
        
        // echo "<pre>"; print_r($request->all()); die;

        $setting_system = Setting::where('settings_name', 'System Settings')->get()->first();

        $data = array(
            'date_format' => $request->date_format,
            'timezone' => $request->timezone,
            'currency_code' => $request->currency_code,
            'currency_symbol' => $request->currency_symbol,
            'is_code' => $request->is_code,
            'currency_position' => $request->currency_position,
            'fixed_asset_schedule_starting_date' => date('Y-m-d', strtotime($request->fixed_asset_schedule_starting_date))
        );

        $json_data = json_encode($data);

        $setting_system->content = $json_data;
        $setting_system->save();

        Session::flash('success', 'Successfully Update');
        // return redirect()->back();
        return redirect('settings/general#systemsetting');

    }



    public function quarter_show()
    {

        $general_settings_info = Setting::where('settings_name', 'Quarter Settings')->get()->first();

        $generaldata = json_decode($general_settings_info->content, true);

        $system_settings_info = Setting::where('settings_name', 'System Settings')->get()->first();

        $systemdata = json_decode($system_settings_info->content, true);

        $quarter_settings_info = Setting::where('settings_name', 'Quarter Settings')->get()->first();

        $quarterdata = json_decode($quarter_settings_info->content, true);


        // echo"<pre>"; print_r($data); exit;
        // return view('admin.settings.general')->with('settings', $data);
        return view('admin.settings.general')->with(array('generalsettings'=>$generaldata, 'systemdata'=>$systemdata, 'quarterdata'=>$quarterdata));

    }

    public function quarter_update(Request $request)
    { 

        // $request->validate([
        //     'company_name' => 'required',
        //     'company_logo' => 'image'
        // ]);


        // $validator = \Validator::make($request->all(), [
        //         'Quarter1_Start.*' => 'yourRules',
        //         'Quarter1_End.*' => 'yourRules',
        //         'Quarter2_Start.*' => 'yourRules',
        //         'Quarter2_End.*' => 'yourRules',
        //         'Quarter3_Start.*' => 'yourRules'
        //         'Quarter3_End.*' => 'yourRules'
        //         'Quarter4_Start.*' => 'yourRules'
        //         'Quarter4_End.*' => 'yourRules'
        //         'Quarter3_Start.*' => 'yourRules'
        //     ]);

        //   if($validator->fails()) {
        //             return back()->withInput()->withErrors($validator->errors());
        //   }

        // if($request->Quarter1_Start == $request->Quarter1_End){
        //     return back()->withInput()->withErrors("Quartert 1 End month is same, please don't select same month");
        // } else if($request->Quarter1_Start == $request->Quarter2_Start){
        //     return back()->withInput()->withErrors("Quartert 1 End month is same, please don't select same month");
        // } else if($request->Quarter1_Start == $request->Quarter2_End) {
        //     return back()->withInput()->withErrors("Quartert 1 End month is same, please don't select same month");
        // } else if ($request->Quarter1_Start == $request->Quarter3_Start) {
        //     return back()->withInput()->withErrors("Quartert 1 End month is same, please don't select same month");
        // } else if ($request->Quarter1_Start == $request->Quarter3_End) {
        //     return back()->withInput()->withErrors("Quartert 1 End month is same, please don't select same month");
        // } else if ($request->Quarter1_Start == $request->Quarter4_Start) {
        //     return back()->withInput()->withErrors("Quartert 1 End month is same, please don't select same month");
        // } else if ($request->Quarter1_Start == $request->Quarter4_End) {
        //     return back()->withInput()->withErrors("Quartert 1 End month is same, please don't select same month");
        // }

        //  else if ($request->Quarter1_End == $request->Quarter1_Start) {
        //     return back()->withInput()->withErrors("Quartert 1 End month is same, please don't select same month");
        // } else if ($request->Quarter1_End == $request->Quarter2_Start) {
        //     return back()->withInput()->withErrors("Quartert 1 End month is same, please don't select same month");
        // } else if ($request->Quarter1_End == $request->Quarter2_End) {
        //     return back()->withInput()->withErrors("Quartert 1 End month is same, please don't select same month");
        // } else if ($request->Quarter1_End == $request->Quarter3_Start) {
        //     return back()->withInput()->withErrors("Quartert 1 End month is same, please don't select same month");
        // } else if ($request->Quarter1_End == $request->Quarter3_End) {
        //     return back()->withInput()->withErrors("Quartert 1 End month is same, please don't select same month");
        // } else if ($request->Quarter1_End == $request->Quarter4_Start) {
        //     return back()->withInput()->withErrors("Quartert 1 End month is same, please don't select same month");
        // } else if ($request->Quarter1_End == $request->Quarter4_End) {
        //     return back()->withInput()->withErrors("Quartert 1 End month is same, please don't select same month");
        // }

        // else if ($request->Quarter2_Start == $request->Quarter1_Start) {
        //     return back()->withInput()->withErrors("Quartert 1 End month is same, please don't select same month");
        // } else if ($request->Quarter2_Start == $request->Quarter1_End) {
        //     return back()->withInput()->withErrors("Quartert 1 End month is same, please don't select same month");
        // } else if ($request->Quarter2_Start == $request->Quarter2_Start) {
        //     return back()->withInput()->withErrors("Quartert 1 End month is same, please don't select same month");
        // } else if ($request->Quarter2_Start == $request->Quarter2_End) {
        //     return back()->withInput()->withErrors("Quartert 1 End month is same, please don't select same month");
        // } else if ($request->Quarter2_Start == $request->Quarter3_Start) {
        //     return back()->withInput()->withErrors("Quartert 1 End month is same, please don't select same month");
        // } else if ($request->Quarter2_Start == $request->Quarter3_end) {
        //     return back()->withInput()->withErrors("Quartert 1 End month is same, please don't select same month");
        // } else if ($request->Quarter2_Start == $request->Quarter4_Start) {
        //     return back()->withInput()->withErrors("Quartert 1 End month is same, please don't select same month");
        // } else if ($request->Quarter2_Start == $request->Quarter4_End) {
        //     return back()->withInput()->withErrors("Quartert 1 End month is same, please don't select same month");
        // } 

        // else if ($request->Quarter2_End == $request->Quarter1_Start) {
        //     return back()->withInput()->withErrors("Quartert 1 End month is same, please don't select same month");
        // } else if ($request->Quarter2_End == $request->Quarter1_End) {
        //     return back()->withInput()->withErrors("Quartert 1 End month is same, please don't select same month");
        // } else if ($request->Quarter2_End == $request->Quarter2_Start) {
        //     return back()->withInput()->withErrors("Quartert 1 End month is same, please don't select same month");
        // } else if ($request->Quarter2_End == $request->Quarter3_Start) {
        //     return back()->withInput()->withErrors("Quartert 1 End month is same, please don't select same month");
        // } else if ($request->Quarter2_End == $request->Quarter3_end) {
        //     return back()->withInput()->withErrors("Quartert 1 End month is same, please don't select same month");
        // } else if ($request->Quarter2_End == $request->Quarter4_Start) {
        //     return back()->withInput()->withErrors("Quartert 1 End month is same, please don't select same month");
        // } else if ($request->Quarter2_End == $request->Quarter4_End) {
        //     return back()->withInput()->withErrors("Quartert 1 End month is same, please don't select same month");
        // } else if ($request->Quarter2_End == $request->Quarter2_Start) {
        //     return back()->withInput()->withErrors("Quartert 1 End month is same, please don't select same month");
        // } 

        // else if ($request->Quarter2_End == $request->Quarter1_Start) {
        //     return back()->withInput()->withErrors("Quartert 1 End month is same, please don't select same month");
        // } else if ($request->Quarter2_End == $request->Quarter1_End) {
        //     return back()->withInput()->withErrors("Quartert 1 End month is same, please don't select same month");
        // } else if ($request->Quarter2_End == $request->Quarter2_Start) {
        //     return back()->withInput()->withErrors("Quartert 1 End month is same, please don't select same month");
        // } else if ($request->Quarter2_End == $request->Quarter3_Start) {
        //     return back()->withInput()->withErrors("Quartert 1 End month is same, please don't select same month");
        // } else if ($request->Quarter2_End == $request->Quarter3_end) {
        //     return back()->withInput()->withErrors("Quartert 1 End month is same, please don't select same month");
        // } else if ($request->Quarter2_End == $request->Quarter4_Start) {
        //     return back()->withInput()->withErrors("Quartert 1 End month is same, please don't select same month");
        // } else if ($request->Quarter2_End == $request->Quarter4_End) {
        //     return back()->withInput()->withErrors("Quartert 1 End month is same, please don't select same month");
        // } else if ($request->Quarter2_End == $request->Quarter2_Start) {
        //     return back()->withInput()->withErrors("Quartert 1 End month is same, please don't select same month");
        // } 




        $setting_general = Setting::where('settings_name', 'Quarter Settings')->get()->first();

        $setting_general_data = json_decode($setting_general->content, true);

        $company_new_logo = $setting_general_data['company_logo'];
    
        $data = array(
            'Quarter1_Start' => $request->Quarter1_Start,
            'Quarter1_End' => $request->Quarter1_End,
            'Quarter2_Start' => $request->Quarter2_Start,
            'Quarter2_End' => $request->Quarter2_End,
            'Quarter3_Start' => $request->Quarter3_Start,
            'Quarter3_End' => $request->Quarter3_End,
            'Quarter4_Start' => $request->Quarter4_Start,
            'Quarter4_End' => $request->Quarter4_End,
            'company_logo' => $company_new_logo,
        );

        // echo"<pre>"; print_r($data); exit;

        $json_data = json_encode($data);
        $setting_general->content = $json_data;
        $setting_general->save();

        Session::flash('success', 'Successfully Update');

        // return redirect()->back();
        return redirect('settings/general#Quatersetting');

    }


    public function smtp_show()
    {

        $general_settings_info = Setting::where('settings_name', 'Quarter Settings')->get()->first();

        $generaldata = json_decode($general_settings_info->content, true);

        $system_settings_info = Setting::where('settings_name', 'System Settings')->get()->first();

        $systemdata = json_decode($system_settings_info->content, true);

        $quarter_settings_info = Setting::where('settings_name', 'Quarter Settings')->get()->first();

        $quarterdata = json_decode($quarter_settings_info->content, true);


        // echo"<pre>"; print_r($data); exit;
        // return view('admin.settings.general')->with('settings', $data);
        return view('admin.settings.general')->with(array('generalsettings'=>$generaldata, 'systemdata'=>$systemdata, 'quarterdata'=>$quarterdata));

    }

    public function smtp_update(Request $request)
    { 

        // echo "<pre>"; print_r($request->all()); die;
        // $request->validate([
        //     'company_name' => 'required',
        //     'company_logo' => 'image'
        // ]);

        $setting_general = Setting::where('settings_name', 'SMTP Settings')->get()->first();

        $setting_general_data = json_decode($setting_general->content, true);

        $company_new_logo = $setting_general_data['company_logo'];
    
        $data = array(
            'Quarter1_Start' => $request->Quarter1_Start,
            'Quarter1_End' => $request->Quarter1_End,
            'Quarter2_Start' => $request->Quarter2_Start,
            'Quarter2_End' => $request->Quarter2_End,
            'Quarter3_Start' => $request->Quarter3_Start,
            'Quarter3_End' => $request->Quarter3_End,
            'Quarter4_Start' => $request->Quarter4_Start,
            'Quarter4_End' => $request->Quarter4_End,
            'company_logo' => $company_new_logo,
        );

        // echo"<pre>"; print_r($data); exit;

        $json_data = json_encode($data);
        $setting_general->content = $json_data;
        $setting_general->save();

        Session::flash('success', 'Successfully Update');

        // return redirect()->back();
        return redirect('settings/general#smtpsetting');

    }


    public function bankaccount_show()
    {

        $bankAccount_settings_info = Setting::where('settings_name', 'Bank Account')->get()->first();

        $bankAccountdata = json_decode($bankAccount_settings_info->content, true);

        // echo"<pre>"; print_r($bankAccountdata); exit;
        
        // return view('admin.settings.general')->with('settings', $data);
        return view('admin.settings.general')->with(array('bankAccountdata'=>$bankAccountdata ));

    }

    public function bankaccount_update(Request $request)
    { 

        // echo "<pre>"; print_r($request->all()); die;
        // $request->validate([
        //     'company_name' => 'required',
        //     'company_logo' => 'image'
        // ]);

        // $setting_general = Setting::where('settings_name', 'Bank Account')->get()->first();

        // $setting_general_data = json_decode($setting_general->content, true);

        // $setting_general = Bankaccount::where('settings_name', 'Bank Account')->get()->first();

        if ($request->bankid != "") {
            $Bankaccount = Bankaccount::find($request->bankid);
        } else {
            $Bankaccount = new Bankaccount;
        }
        
        $Bankaccount->bankName = $request->bankName;
        $Bankaccount->donors = $request->donors;
        $Bankaccount->bankCode = $request->bankCode;
        $Bankaccount->bankcurrency_code = $request->bankcurrency_code;
        $Bankaccount->bankStatus = $request->bankStatus;
        $Bankaccount->save();
        
    
        // $data = array(
        //     'bankName' => $request->bankName,
        //     'donors' => $request->donors,
        //     'bankCode' => $request->bankCode,
        //     'bankcurrency_code' => $request->bankcurrency_code,
        //     'bankStatus' => $request->bankStatus,
        // );


        // $json_data = json_encode($data);
        // $setting_general->content = $json_data;
        // $setting_general->save();

        Session::flash('success', 'Successfully Update');

        // return redirect()->back();
        return redirect('settings/general#bankaccountsetting');

    }

    public function supportDonor_show()
    {

        $supportdonor = DB::table('supportdonor')->get();

        // echo"<pre>"; print_r($bankAccountdata); exit;
        
        // return view('admin.settings.general')->with('settings', $data);
        return view('admin.settings.general')->with(array('supportdonor'=>$supportdonor ));

    }

    public function supportDonor_addnew(Request $request)
    { 

        // echo "<pre>"; print_r($request->all()); die;
        $request->validate([
            'supportDonor' => 'required',
        
        ]);

        // $setting_general = Setting::where('settings_name', 'Bank Account')->get()->first();

        // $setting_general_data = json_decode($setting_general->content, true);

    
        // $data = array(
        //     'supportDonor' => $request->supportDonor,
        // );

        DB::table('supportdonor')->insert([
            'supportDonor' => $request->supportDonor,
        ]);

        // echo"<pre>"; print_r($data); exit;

        // $json_data = json_encode($data);
        // $setting_general->content = $json_data;
        // $setting_general->save();

        Session::flash('success', 'Successfully Update');
        // return redirect()->back();
        return redirect('settings/general#supportDonorsetting');

    }


    public function supportDonor_update(Request $request)
    { 

        echo "<pre>"; print_r($request->all()); die;
        

       DB::table('supportdonor')->where('id',$id)->delete();


        Session::flash('success', 'Successfully Update');

        return redirect()->back();

    }

    public function supportDonor_destroy($id)
    { 

        $getDonor = DB::table('bankaccount')->where('donors',$id)->first();
        
        if(isset($getDonor->id)){
            Session::flash('error', 'This Donor also used in Bank Account ');
        }
        else{
            // echo "null";
            DB::table('supportdonor')->where('id',$id)->delete();
            Session::flash('success', 'Successfully Delete');
        }
        
        // echo "<pre>"; print_r($getDonor); die;
        return redirect('settings/general#supportDonorsetting');



        // return redirect()->back();

    }

    public function region_show()
    {
        $region = Region::get();
        return view('admin.settings.general')->with(array('region'=>$region ));
    }

    public function region_addnew(Request $request)
    { 
        //echo "<pre>"; print_r($request->all()); die;
        $request->validate([
            'region' => 'required',
        ]);

        $reg = new Region;
        $reg->name = $request->region;
        $reg->save();
        
        Session::flash('success', 'Successfully Update');
        return redirect('settings/general#region');

    }

    public function region_update(Request $request)
    { 
        //echo "<pre>"; print_r($request->all()); die;
        $reg = Region::find($request->id);
        $reg->name = $request->supportDonor;
        $reg->save();

        Session::flash('success', 'Successfully Update');
        return redirect()->back();
    }

    public function region_destroy($id)
    { 
        $getProject = Projects::where('region',$id)->first();
        if(isset($getProject->id)){
            Session::flash('error', 'This Region also used in Project');
        }
        else{
            $del = Region::where('id',$id)->delete();
            Session::flash('success', 'Successfully Delete');
        }
        return redirect('settings/general#region');
    }


    public function organizationLeader_show()
    {

        $orgenizationleader = Orgenizationleader::get();

        // echo"<pre>"; print_r($bankAccountdata); exit;
        
        // return view('admin.settings.general')->with('settings', $data);
        return view('admin.settings.general')->with(array('orgenizationleader'=>$orgenizationleader ));

    }

    public function organizationLeader_update(Request $request)
    { 
        // echo "<pre>"; print_r($request->all()); die;
        $request->validate([
            'orgenizationLeader' => 'required',
            'order' => 'required',
        ]);
        
        if ($request->orgid != "") {
            $create = Orgenizationleader::find($request->orgid);
        } else {
            $create = new Orgenizationleader;
        }
        $create->name = $request->orgenizationLeader;
        $create->order = $request->order;
        $create->budget_approval = isset($request->budget_approval) ? 1 : 0;
        $create->save();

        Session::flash('success', 'Successfully Update');
        return redirect('settings/general#orgenizationLeader');
    }

    public function organizationLeader_destroy($id)
    { 
        $getUser = User::where('position_id',$id)->first();
        if(isset($getUser->id)){
            Session::flash('error', 'This Postion also used in User');
        }
        else{
            $del = Orgenizationleader::where('id',$id)->delete();
            Session::flash('success', 'Successfully Delete');
        }
        return redirect('settings/general#orgenizationLeader');
    }

    public function bankaccount_destroy($id)
    { 
        // echo "<pre>"; print_r($id); die;
        Bankaccount::where('id',$id)->delete();
        Session::flash('success', 'Successfully Delete');
        return redirect('settings/general#bankaccountsetting');
    }
}
