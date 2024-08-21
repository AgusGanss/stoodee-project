<?php

namespace App\Http\Controllers;

use Generator;
use App\Models\Mail;
use App\Models\Content;
use App\Models\General;
use Illuminate\Http\Request;

class ContentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function content(Request $request){
        $search = $request->input('search');

    $content = Content::query()
        ->when($search, function ($query, $search) {
            return $query->where('title_content', 'like', "%{$search}%")
                         ->orWhere('deskripsi', 'like', "%{$search}%");
        })
        ->orderBy('created_at', 'desc')
        ->paginate(5);
        $unreadCount = Mail::where('is_read', false)->count();
        $general = General::first();
        return view('dashboard.content', compact('content','search','unreadCount','general'));
    }
  
   
    public function tambah(){
        $general = General::first();
        $unreadCount = Mail::where('is_read', false)->count();
        return view('dashboard.tambah-content', compact('general','unreadCount'));
    }

    public function insert(Request $request){
        // dd($request->all());
        $request->validate([
            'deskripsi' => 'required',
            // tambahkan validasi lain jika diperlukan
        ], [
            'deskripsi.required' => 'The description field is required.',
            // tambahkan pesan kustom lain jika diperlukan
        ]);
        $content = Content::create($request->all());
        
        if($request->hasFile('logo1')){
            $request->file('logo1')->move('foto/', $request->file('logo1')->getClientOriginalName());
            $content->logo1 = $request->file('logo1')->getClientOriginalName();
            $content->save();
        }
        if($request->hasFile('logo2')){
            $request->file('logo2')->move('foto/', $request->file('logo2')->getClientOriginalName());
            $content->logo2 = $request->file('logo2')->getClientOriginalName();
            $content->save();
        }
        

        return redirect()->route('content.general')->with('berhasil-insert', 'Add Data Success');
    }

    public function delete($id){
        $content = Content::find($id);
        $content->delete();
        return redirect()->route('content.general')->with('content-delete', 'Delete Data Success');
    }

    public function edit($id){
        $content = Content::find($id);
        $general = General::first();
        $unreadCount = Mail::where('is_read', false)->count();
        return view('dashboard.edit-content', compact('content','unreadCount','general'));
    }
    public function update(Request $request, $id){
        $content = Content::find($id);
        $validatedData = $request->validate([
            'title_content' => 'required|string|max:255',
            'logo1' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'logo2' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'deskripsi' => 'required',
        ]);

        $content->title_content = $validatedData['title_content'];
        $content->deskripsi = $validatedData['deskripsi'];
        if ($request->hasFile('logo1')) {
            // Jika ada file gambar baru diupload
            $image = $request->file('logo1');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move('foto/', $imageName);
    
            // Hapus gambar lama jika ada
            if ($content->logo1 && file_exists(public_path('foto/' . $content->logo1))) {
                unlink(public_path('foto/' . $content->logo1));
            }
    
            $content->logo1 = $imageName;
        }
        if ($request->hasFile('logo2')) {
            // Jika ada file gambar baru diupload
            $image = $request->file('logo2');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move('foto/', $imageName);
    
            // Hapus gambar lama jika ada
            if ($content->logo2 && file_exists(public_path('foto/' . $content->logo2))) {
                unlink(public_path('foto/' . $content->logo2));
            }
    
            $content->logo2 = $imageName;
        }

        $content->save();
        return redirect()->route('content.general')->with('berhasil-update', 'Update Data Success');
    }
}
