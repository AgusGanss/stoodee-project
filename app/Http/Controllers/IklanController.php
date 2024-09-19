<?php

namespace App\Http\Controllers;

use App\Models\Mail;
use App\Models\General;
use App\Models\Iklan;
use App\Models\Program;
use Illuminate\Http\Request;

class IklanController extends Controller
{
    public function iklan(Request $request){
        $search = $request->input('search');
        $general = General::first();
        $iklan = Iklan::query()->when($search,function($query,$search){
            return $query->where('text_iklan', 'like' ,"%{$search}%");
        })->orderBy('created_at','desc')->paginate(5);
        $unreadCount = Mail::where('is_read', false)->count();
        return view('dashboard.iklan',compact('general','unreadCount','iklan','iklan'));
    }

    public function tambah(){
        $unreadCount = Mail::where('is_read', false)->count();
        $general = General::first();
        return view('dashboard.tambah-iklan',compact('unreadCount','general'));
    }

    public function insert(Request $request){
        $request->validate([
            'text_iklan' => 'required',
        ], [
            'text_iklan.required' => 'The description field is required.',
        ]);

        $status = $request->has('status') ? 'active' : 'inactive';
      $iklan = Iklan::create([
            'text_iklan' => $request->input('text_iklan'),
            'status' => $status,  // enum value
            'iklan_image' => $request->iklan_image,
            'link' => $request->link,
        ]);
        
        
        if($request->hasFile('iklan_image')){
            $request->file('iklan_image')->move('foto/', $request->file('iklan_image')->getClientOriginalName());
            $iklan->iklan_image = $request->file('iklan_image')->getClientOriginalName();
            $iklan->save();
        }
        return redirect()->route('iklan')->with('insert-iklan', 'Add Data Success');
    }

    public function edit($id){
        $iklan = Iklan::find($id);
        $unreadCount = Mail::where('is_read', false)->count();
        $general = General::first();
        return view('dashboard.edit-iklan',compact('unreadCount','general','iklan'));
    }

    public function update(Request $request,$id){
        $iklan = Iklan::findOrFail($id);
        $validatedData = $request->validate([
            'text_iklan' => 'nullable|string|max:60555',
            'link' => 'nullable|string|max:60555',
            'iklan_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        $iklan->text_iklan = $validatedData['text_iklan'];
        $status = $request->has('status') ? 'active' : 'inactive';
        $iklan->status =  $status;
        $iklan->link = $validatedData['link'];


    
        if ($request->hasFile('iklan_image')) {
            // Jika ada file gambar baru diupload
            $image = $request->file('iklan_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move('foto/', $imageName);
    
            // Hapus gambar lama jika ada
            if ($iklan->iklan_image && file_exists(public_path('foto/' . $iklan->iklan_image))) {
                unlink(public_path('foto/' . $iklan->iklan_image));
            }
    
            $iklan->iklan_image = $imageName;
        }
        // Jika tidak ada file baru, gunakan gambar yang sudah ada
        // Tidak perlu melakukan apa-apa karena kita tidak mengubah $iklan->profil
    
        $iklan->save();
    
        return redirect()->route('iklan')->with('update-iklan', 'Update Data Suceess');
    }

    public function delete($id){
        $iklan = Iklan::find($id);
        $iklan->delete();
        return redirect()->route('iklan')->with('delete-iklan','Delete Data Success');
    }
}
