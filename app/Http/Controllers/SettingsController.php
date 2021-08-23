<?php

namespace App\Http\Controllers;

use App\Setting;
use App\Orgenizationleader;
use Hamcrest\Core\Set;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\RoleManageController;
use DB;

class SettingsController extends Controller
{

    public function general_show($donorId="")
    {
        // echo "dsdsg".$donorId; 
        $general_settings_info = Setting::where('settings_name', 'General Settings')->get()->first();

        $generaldata = json_decode($general_settings_info->content, true);

        $system_settings_info = Setting::where('settings_name', 'System Settings')->get()->first();

        $systemdata = json_decode($system_settings_info->content, true);

        $quarter_settings_info = Setting::where('settings_name', 'Quarter Settings')->get()->first();

        $quarterdata = json_decode($quarter_settings_info->content, true);

        $bankAccount_settings_info = Setting::where('settings_name', 'Bank Account')->get()->first();

        $bankAccountdata = json_decode($bankAccount_settings_info->content, true);

        
        $supportdonor = DB::table('supportdonor')->get();    
        // $orgenizationleader = DB::table('orgenizationleader')->get();    

        $orgenizationleader = Orgenizationleader::get();
        // $orgenizationleader = DB::table('orgenizationleader')->get();    
        

        // echo"<pre>"; print_r($supportdonor); exit;
        
        // return view('admin.settings.general')->with('settings', $data);
        return view('admin.settings.general')->with(array('generalsettings'=>$generaldata, 'systemdata'=>$systemdata, 'quarterdata'=>$quarterdata, 'bankAccountdata'=>$bankAccountdata, 'supportdonor'=>$supportdonor, 'orgenizationleader'=>$orgenizationleader ));

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

        // echo "<pre>"; print_r($request->all()); die;
        // $request->validate([
        //     'company_name' => 'required',
        //     'company_logo' => 'image'
        // ]);

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

        $setting_general = Setting::where('settings_name', 'Bank Account')->get()->first();

        $setting_general_data = json_decode($setting_general->content, true);

    
        $data = array(
            'bankName' => $request->bankName,
            'donors' => $request->donors,
            'bankCode' => $request->bankCode,
            'bankcurrency_code' => $request->bankcurrency_code,
            'bankStatus' => $request->bankStatus,
        );

        // echo"<pre>"; print_r($data); exit;

        $json_data = json_encode($data);
        $setting_general->content = $json_data;
        $setting_general->save();

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

        DB::table('supportDonor')->insert([
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
        

       DB::table('supportDonor')->where('id',$id)->delete();


        Session::flash('success', 'Successfully Update');

        return redirect()->back();

    }

    public function supportDonor_destroy($id)
    { 

        // echo "<pre>"; print_r($request->all()); die;
        

       DB::table('supportDonor')->where('id',$id)->delete();

        Session::flash('success', 'Successfully Delete');

        // return redirect()->back();
        return redirect('settings/general#supportDonorsetting');

    }


    public function organizationLeader_show()
    {

        $orgenizationleader = DB::table('orgenizationleader')->get();

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


        DB::table('orgenizationleader')->insert([
            'name' => $request->orgenizationLeader,
            'order' => $request->order,
        ]);

    

        Session::flash('success', 'Successfully Update');

        // return redirect()->back();
        return redirect('settings/general#orgenizationLeader');

    }

    public function organizationLeader_destroy($id)
    { 

        // echo "<pre>"; print_r($request->all()); die;
        
        $setting_general = Orgenizationleader::where('id',$id)->delete();;

       // DB::table('orgenizationleader')->where('id',$id)->delete();

        Session::flash('success', 'Successfully Delete');

        // return redirect()->back();
        return redirect('settings/general#orgenizationLeader');

    }



}
