<?php

namespace App\Http\Controllers;

use App\Models\Mail;
use App\Models\Content;
use App\Models\General;
use Illuminate\Http\Request;

class GeneralController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function backoffice(){
        $general = General::first();
        $unreadCount = Mail::where('is_read', false)->count();
        return view('dashboard.dashboard', compact('general','unreadCount'));
    }

    // public function tambah(){
    //     return view('dashboard.tambah');
    // }
    public function update(Request $request){

        $general = General::firstOrFail();
        $general->judul = $request->judul;
        $general->judul_content = $request->judul_content;
        $general->slogan = $request->slogan;

        if($request->hasFile('logo')){
            if($general->logo && file_exists(public_path('foto/' . $general->logo))){
                unlink(public_path('foto/' . $general->logo));
            }

            $logoFile = $request->file('logo');
            $logoFileName = time() . '_logo.' . $logoFile->getClientOriginalExtension();
            $logoFile->move('foto/', $logoFileName);
            $general->logo = $logoFileName;
        }

        if($request->hasFile('logo1')){
            if($general->logo1 && file_exists(public_path('foto/' . $general->logo1))){
                unlink(public_path('foto/' . $general->logo1));
            }

            $logo1File = $request->file('logo1');
            $logo1FileName = time() . '_logo1.' . $logo1File->getClientOriginalExtension();
            $logo1File->move('foto/', $logo1FileName);
            $general->logo1 = $logo1FileName;
        }

        if($request->hasFile('logo2')){
            if($general->logo2 && file_exists(public_path('foto/' . $general->logo2))){
                unlink(public_path('foto/' . $general->logo2));
            }

            $logo2File = $request->file('logo2');
            $logo2FileName = time() . '_logo2.' . $logo2File->getClientOriginalExtension();
            $logo2File->move('foto/', $logo2FileName);
            $general->logo2 = $logo2FileName;
        }
        

        if($request->hasFile('banner')){
            if($general->banner && file_exists(public_path('foto/' . $general->banner))){
                unlink(public_path('foto/' . $general->banner));
            }

            $bannerFile = $request->file('banner');
            $bannerFileName = time() . '_banner.' . $bannerFile->getClientOriginalExtension();
            $bannerFile->move('foto/', $bannerFileName);
            $general->banner = $bannerFileName;
        }

        $general->save();

        return redirect()->route('backoffice')->with('update-general', 'Update Data Success');
    }
}
