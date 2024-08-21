<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Mail;
use App\Models\General;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class BlogController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function blog(Request $request){
        $search = $request->input('search');

        $blog = Blog::query()
            ->when($search, function ($query, $search) {
                return $query->where('judul_blog', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        $unreadCount = Mail::where('is_read', false)->count();
        $general = General::first();
        return view('dashboard.blog', compact('blog','search','unreadCount','general'));
    }

    public function tambah(){
        $unreadCount = Mail::where('is_read', false)->count();
        $general = General::first();
        return view('dashboard.tambah-blog',compact('unreadCount','general'));
    }

    public function insert(Request $request){
        $request->validate([
            'content_blog' => 'required',
            // tambahkan validasi lain jika diperlukan
        ], [
            'content_blog.required' => 'The description field is required.',
            // tambahkan pesan kustom lain jika diperlukan
        ]);
        $blog = Blog::create($request->all());
        
        
        if($request->hasFile('gambar_blog')){
            $request->file('gambar_blog')->move('foto/', $request->file('gambar_blog')->getClientOriginalName());
            $blog->gambar_blog = $request->file('gambar_blog')->getClientOriginalName();
            $blog->save();
        }

        return redirect()->route('blog')->with('insert-blog', 'Add Data Success');
    }

    public function edit($id){
        $blog = Blog::find($id);
        $unreadCount = Mail::where('is_read', false)->count();
        $general = General::first();
        return view('dashboard.edit-blog', compact('blog','unreadCount','general'));
    }

    public function update(Request $request, $id){
        $blog = Blog::findOrFail($id);
        $validatedData = $request->validate([
            'judul_blog' => 'required|string|max:255',
            'content_blog' => 'required|string | max:5000',
            'gambar_blog' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tanggal' => 'required',
        ]);
        $blog->judul_blog = $validatedData['judul_blog'];
        $blog->tanggal = $validatedData['tanggal'];
        $blog->content_blog = $validatedData['content_blog'];
        $blog->slug = $request->slug;
    
        if ($request->hasFile('gambar_blog')) {
            // Jika ada file gambar baru diupload
            $image = $request->file('gambar_blog');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move('foto/', $imageName);
    
            // Hapus gambar lama jika ada
            if ($blog->gambar_blog && file_exists(public_path('foto/' . $blog->gambar_blog))) {
                unlink(public_path('foto/' . $blog->gambar_blog));
            }
    
            $blog->gambar_blog = $imageName;
        }
        // Jika tidak ada file baru, gunakan gambar yang sudah ada
        // Tidak perlu melakukan apa-apa karena kita tidak mengubah $program->profil
    
        $blog->save();
    
        return redirect()->route('blog')->with('update-blog', 'Update Data Suceess');
    }
    public function delete($id){
        $blog = Blog::find($id);
        $blog->delete();
        return redirect()->route('blog')->with('blog-delete', 'Delete Data Suceess');
    }

    public function checkSlug(Request $request){
        $slug = SlugService::createSlug(Blog::class, 'slug', $request->judul_blog);
        return response()->json(['slug' => $slug]);
    }
}
