<?php

namespace App\Http\Controllers;

use App\Models\Mail;
use App\Models\Review;
use App\Models\General;
use Illuminate\Http\Request;

class ReviewController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function review(Request $request){

        $search = $request->input('search');

        $review = Review::query()
            ->when($search, function ($query, $search) {
                return $query->where('nama', 'like', "%{$search}%")
                             ->orWhere('review', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        $general = General::first();
        $unreadCount = Mail::where('is_read', false)->count();
        return view('dashboard.review', compact('review','search','unreadCount','general'));
    }

    public function tambah(){
        $unreadCount = Mail::where('is_read', false)->count();
        $general = General::first();
        return view('dashboard.tambah-review',compact('unreadCount','general'));
    }

    public function insert(Request $request){
        $request->validate([
            'review' => 'required',
            // tambahkan validasi lain jika diperlukan
        ], [
            'review.required' => 'The description field is required.',
            // tambahkan pesan kustom lain jika diperlukan
        ]);
        $review = Review::create($request->all());


        if($request->hasFile('profil')){
            $request->file('profil')->move('foto/', $request->file('profil')->getClientOriginalName());
            $review->profil = $request->file('profil')->getClientOriginalName();
            $review->save();
        }

        return redirect()->route('review')->with('insert-review', 'Add Data Success');
    }

    public function edit($id){
        $review = Review::find($id);
        $general = General::first();
        $unreadCount = Mail::where('is_read', false)->count();
        return view('dashboard.edit-review', compact('review','unreadCount','general'));
    }

    public function update(Request $request, $id){
        $review = Review::findOrFail($id);

        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'review' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'profil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $review->nama = $validatedData['nama'];
        $review->review = $validatedData['review'];
        $review->rating = $validatedData['rating'];
    
        if ($request->hasFile('profil')) {
            // Jika ada file gambar baru diupload
            $image = $request->file('profil');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move('foto/', $imageName);
    
            // Hapus gambar lama jika ada
            if ($review->profil && file_exists(public_path('foto/' . $review->profil))) {
                unlink(public_path('foto/' . $review->profil));
            }
    
            $review->profil = $imageName;
        }
        // Jika tidak ada file baru, gunakan gambar yang sudah ada
        // Tidak perlu melakukan apa-apa karena kita tidak mengubah $review->profil
    
        $review->save();
    
        return redirect()->route('review')->with('update-review', 'Update Data Suceess');
    }

    public function delete($id){
        $review = Review::find($id);
        $review->delete();
        return redirect()->route('review')->with('review-delete', 'Delete Data Success');
    }
}
