<?php

namespace App\Http\Controllers\Admin;
use App\Models\Setting;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index(){

    
        $setting = Setting::where('id','1')->first();
        return view('admin.settings.index', compact('setting'));
    }

    public function savedata(Request $request){
        $validator  = Validator::make($request->all(),[
            'website_name'=> 'required|max:255',
            'website_logo'=> 'nullable',
            'website_favicon'=> 'nullable',
            'description'=> 'required',
            'meta_title'=> 'required|max:255',
            'meta_keyword'=> 'nullable',
            'meta_description'=> 'nullable',
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }

        $setting = Setting::where('id','1')->first();
        if($setting){
            $setting->website_name = $request->website_name;

            $destination = 'uploads/settings/'.$setting->logo;
            if(File::exists($destination)){
                File::delete($destination);
            }

            if($request->hasFile('website_logo')){
                $file = $request->file('website_logo');
                $filename = time() . '.'.$file->getClientOriginalExtension();
                $file->move('uploads/settings',$filename);
                $setting->logo = $filename;

            }

            if($request->hasFile('website_favicon')){

                $destination = 'uploads/settings/'.$setting->favicon;
                if(File::exists($destination)){
                    File::delete($destination);
                }
                $file = $request->file('website_favicon');
                $filename = time() . '.'. $file->getClientOriginalExtension();
                $file->move('uploads/settings',$filename);
                $setting->favicon = $filename;
            }

            $setting->description = $request->description;
            $setting->meta_title = $request->meta_title;
            $setting->meta_keyword = $request->meta_keyword;
            $setting->meta_description = $request->meta_description;
            $setting->update();

            return redirect('admin/settings')->with('message','Setting Updated Successfully!!');
        }else{

            $setting = new Setting;
            $setting->website_name = $request->website_name;
            if($request->hasFile('website_logo')){
                $file = $request->file('website_logo');
                $filename = time().'.'.$file->getClientOriginalExtension();
                $file->move('uploads/settings',$filename);
                $setting->logo = $filename;
            }
            if($request->hasFile('website_favicon')){
                $file = $request->file('website_favicon');
                $filename = time().'.'.$file->getClientOriginalExtension();
                $file->move('uploads/settings',$filename);
                $setting->favicon = $filename;
            }
            $setting->description = $request->description;
            $setting->meta_title = $request->meta_title;
            $setting->meta_keyword = $request->meta_keyword;
            $setting->meta_description = $request->meta_description;
            $setting->save();

            return redirect('admin/settings')->with('message','Setting Added Successfully!!');

        }
    }
}
