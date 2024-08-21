<?php

namespace App\Http\Controllers;

use App\Models\Mail;
use App\Models\General;
use App\Models\Program;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;


class ProgramController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function program(Request $request){

        $search = $request->input('search');

        $program = Program::query()
            ->when($search, function ($query, $search) {
                return $query->where('judul_program', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        $general = General::first();
        $unreadCount = Mail::where('is_read', false)->count();
        return view('dashboard.program', compact('program','search','unreadCount','general'));
    }

    public function tambah(){
        $unreadCount = Mail::where('is_read', false)->count();
        $general = General::first();
        return view('dashboard.tambah-program', compact('unreadCount','general'));
    }

    public function insert(Request $request){

        $request->validate([
            'deskripsi_program' => 'required',
            // tambahkan validasi lain jika diperlukan
        ], [
            'deskripsi_program.required' => 'The description field is required.',
            // tambahkan pesan kustom lain jika diperlukan
        ]);

        $program = Program::create($request->all());
        
        
        if($request->hasFile('gambar_program')){
            $request->file('gambar_program')->move('foto/', $request->file('gambar_program')->getClientOriginalName());
            $program->gambar_program = $request->file('gambar_program')->getClientOriginalName();
            $program->save();
        }
        return redirect()->route('program')->with('insert-program', 'Add Data Success');
    }
    public function edit($id){
        $program = Program::find($id);
        $general = General::first();
        $unreadCount = Mail::where('is_read', false)->count();
        return view('dashboard.edit-program', compact('program','unreadCount','general'));
    }
   
    public function update(Request $request, $id){
        $program = Program::findOrFail($id);
        $validatedData = $request->validate([
            'judul_program' => 'required|string|max:255',
            'deskripsi_program' => 'required|string | max:5000',
            'gambar_program' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $program->judul_program = $validatedData['judul_program'];
        $program->deskripsi_program = $validatedData['deskripsi_program'];
        $program->slug = $request['slug'];

    
        if ($request->hasFile('gambar_program')) {
            // Jika ada file gambar baru diupload
            $image = $request->file('gambar_program');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move('foto/', $imageName);
    
            // Hapus gambar lama jika ada
            if ($program->gambar_program && file_exists(public_path('foto/' . $program->gambar_program))) {
                unlink(public_path('foto/' . $program->gambar_program));
            }
    
            $program->gambar_program = $imageName;
        }
        // Jika tidak ada file baru, gunakan gambar yang sudah ada
        // Tidak perlu melakukan apa-apa karena kita tidak mengubah $program->profil
    
        $program->save();
    
        return redirect()->route('program')->with('update-program', 'Update Data Suceess');
    }
    public function delete($id){
        $program = Program::find($id);
        $program->delete();
        return redirect()->route('program')->with('program-delete', 'Delete Data Suceess');
    }

    public function checkSlug(Request $request){
        $slug = SlugService::createSlug(Program::class, 'slug', $request->judul_program);
        return response()->json(['slug' => $slug]);
    }
}
