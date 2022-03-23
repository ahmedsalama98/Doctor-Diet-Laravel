<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Valuestore\Valuestore;


class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:settings-read'])->only(['index']);
        $this->middleware(['permission:settings-update'])->only(['update']);

    }
    public function index()
    {
        $general_settings = Setting::whereSection('general')->get();
        $social_accounts = Setting::whereSection('social_accounts')->get();
        return view('admin.pages.setting.index' , compact('social_accounts','general_settings'));

    }




    public function update(Request $request)
    {


    // return $request->all();

      Validator::make($request->all(),[
           'settings'=>['required', 'array']
       ])->validate();




       $settings = Valuestore::make(config_path('Settings.json'));
       foreach ( $request->settings as $key => $value){

            if( isset($value)){

                $item = Setting::where('key'  ,$key)->get()->first();

                if(isset($item)){
                    $item->update([
                        'value'=>$value
                    ]);
                    $settings->put($key , $value);

                }

            }



       }

       return redirect()->route('admin.settings.index')->with('success',__('site.settings_updated_successfully'));

    }
    //end update
}
