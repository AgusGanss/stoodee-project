<?php

namespace App\Http\Controllers;

use App\Models\General;
use App\Models\Iklan;
use App\Models\IklanDalam;
use App\Models\Mail;
use App\Models\Program;
use Illuminate\Http\Request;

class IklanDalamController extends Controller
{
    public function iklan(){
        $iklan = IklanDalam::orderBy('created_at','desc')->paginate(50);
        $general = General::first();
        $unreadCount = Mail::where('is_read', false)->count();
        return view('dashboard.iklan-dalam',compact('iklan','general','unreadCount'));
    }

    public function tambah(){
        $unreadCount = Mail::where('is_read', false)->count();
        $general = General::first();
        $program = Program::all();
        return view('dashboard.tambah-iklan-dalam',compact('unreadCount','general','program'));
    }

    public function insert(Request $request){
        $request->validate([
            'program_id' => 'required', // Validasi program_id harus ada
            'foto' => 'nullable', // Validasi program_id harus ada
            'video' => 'nullable', // Validasi program_id harus ada
        ]);
    
        // Tentukan status iklan (active atau inactive)
        $status = $request->has('status') ? 'active' : 'inactive';
    
        // Buat record iklan di database
        $iklan = IklanDalam::create([
            'foto' => $request->foto,
            'video' => $request->video,
            'program_id' => $request->program_id, // ID program yang terkait
            'status' => $status, // Enum status active/inactive
            'link' => $request->link, // Link (atau mungkin deskripsi iklan)
            'link2' => $request->link2, // Link (atau mungkin deskripsi iklan)
        ]);
    
        // Proses upload foto jika ada
        if ($request->hasFile('foto')) {
            $fotoFile = $request->file('foto');
            $fotoName = time() . '_' . $fotoFile->getClientOriginalName(); // Menggunakan timestamp untuk mencegah nama file duplikat
            $fotoFile->move('foto/', $fotoName); // Simpan ke folder 'foto/'
            $iklan->foto = $fotoName; // Simpan nama file foto ke database
        }
    
        // Proses upload video jika ada
        if ($request->hasFile('video')) {
            $videoFile = $request->file('video');
            $videoName = time() . '_' . $videoFile->getClientOriginalName(); // Menggunakan timestamp untuk mencegah nama file duplikat
            $videoFile->move('video/', $videoName); // Simpan ke folder 'video/'
            $iklan->video = $videoName; // Simpan nama file video ke database
        }
    
        
        // Simpan perubahan pada model iklan
        $iklan->save();
    
        // Redirect ke route iklan.dalam dengan pesan sukses
        return redirect()->route('iklan.dalam')->with('insert-iklandalam', 'Add Data Success');
    }

    public function edit($id){
        $general = General::first();
        $unreadCount = Mail::where('is_read', false)->count();
        $iklan = IklanDalam::find($id);
        $program = Program::all();
        return view('dashboard.edit-iklan-dalam',compact('general','unreadCount','iklan','program'));
    }

    public function update(Request $request,$id){
        $request->validate([
            'program_id' => 'required',
        ]);

        $iklan = IklanDalam::findOrFail($id);

        $status = $request->has('status') ? 'active' : 'inactive';
        $iklan->status = $status;
        $iklan->link = $request->link;
        $iklan->link2 = $request->link2;  
      

    if ($request->hasFile('foto')) {
        $fotoFile = $request->file('foto');
        $fotoName = time() . '_' . $fotoFile->getClientOriginalName();
        $fotoFile->move('foto/', $fotoName);

        // Hapus foto lama jika ada
        if ($iklan->foto && file_exists(public_path('foto/' . $iklan->foto))) {
            unlink(public_path('foto/' . $iklan->foto));
        }

        // Update nama file foto di database
        $iklan->foto = $fotoName;
    }

    // Proses upload video jika ada
    if ($request->hasFile('video')) {
        $videoFile = $request->file('video');
        $videoName = time() . '_' . $videoFile->getClientOriginalName();
        $videoFile->move('video/', $videoName);

        // Hapus video lama jika ada
        if ($iklan->video && file_exists(public_path('video/' . $iklan->video))) {
            unlink(public_path('video/' . $iklan->video));
        }

        // Update nama file video di database
        $iklan->video = $videoName;
    }

     $iklan->save();

        return redirect()->route('iklan.dalam')->with('update-iklandalam', 'Update Data Success');
    }
    
    public function delete($id){
        $iklan = IklanDalam::find($id);
        $iklan->delete();
        return back()->with('delete-iklandalam','Delete Data Success');
    }

}
