<?php

namespace App\Http\Controllers;

use App\Models\General;
use App\Models\Kategori;
use App\Models\Mail;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function kategori(Request $request){
        $search = $request->input('search');

        $kategori = Kategori::query()
            ->when($search, function ($query, $search) {
                return $query->where('kategori', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        $general = General::first();
        $unreadCount = Mail::where('is_read', false)->count();
        return view('dashboard.kategori',compact('kategori','general','unreadCount','search'));
    }

    public function tambah(){
        $unreadCount = Mail::where('is_read', false)->count();
        $general = General::first(); 
        return view('dashboard.tambah-kategori',compact('unreadCount','general'));
    }

    public function insert(Request $request){
        $kategori =  Kategori::create($request->all());
        return redirect()->route('kategori')->with('insert-kategori','Add Data Success');
    }

    public function edit($id){
        $unreadCount = Mail::where('is_read', false)->count();
        $general = General::first(); 
        $kategori = Kategori::find($id);
        return view('dashboard.edit-kategori',compact('unreadCount','general','kategori'));
    }

    public function update(Request $request,$id){
        $kategori = Kategori::find($id);
        $kategori->kategori = $request['kategori'];
        $kategori->slug = $request['slug'];

        $kategori->save();

        return redirect()->route('kategori')->with('update-kategori','Update Data Success');
    }

    public function delete($id){
        $kategori = Kategori::find($id);
        $kategori->delete();
        return redirect()->route('kategori')->with('delete-kategori','Delete Data Success');

    }

    public function checkSlug(Request $request){
        $slug = SlugService::createSlug(Kategori::class, 'slug', $request->kategori);
        return response()->json(['slug' => $slug]);
    }
}
