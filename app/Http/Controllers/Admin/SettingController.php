<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Setting;
use Session;
use Auth;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = Setting::firstOrFail();
        return View('admin.settings.setting')->with('setting',$setting);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'company_name' => 'required',
            'company_name_kh' => 'required',
            'company_name_ch' => 'required',
            'company_logo' => 'required',
            'copyright' => 'required',
            'copyright_kh' => 'required',
            'copyright_ch' => 'required',
            'company_information' => 'required',
            'company_information_ch' => 'required',
            'company_information_kh' => 'required',
            'meta_title' => 'required',
            'meta_content' => 'required',
            'meta_description' => 'required',
            'meta_keyword' => 'required',
            'status' => 'required|numeric'
        ]);
        
        $setting = Setting::findOrFail($id);
        
        $setting->updatedBy()->associate(Auth::user());
        /*$setting->thumb_image = $request->input('image');
        $setting->thumb_image = str_replace('source','thumbs',$setting->thumb_image);*/
        
        $setting->update($request->all());
        
        Session::flash('flash_message', 'Setting successfully updated!');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
