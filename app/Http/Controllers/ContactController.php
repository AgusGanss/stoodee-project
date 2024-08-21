<?php

namespace App\Http\Controllers;

use App\Models\Mail;
use App\Models\Contact;
use App\Models\General;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function contact(Request $request){

        $search = $request->input('search');

    $contact = Contact::query()
        ->when($search, function ($query, $search) {
            return $query->where('contact', 'like', "%{$search}%");
        })
        ->orderBy('created_at', 'desc')
        ->paginate(5);
        $unreadCount = Mail::where('is_read', false)->count();
        $general = General::first();
        return view('dashboard.contact', compact('contact','search','unreadCount','general'));
    }

    public function tambah(){
        $unreadCount = Mail::where('is_read', false)->count();
        $general = General::first();
        return view('dashboard.tambah-contact',compact('unreadCount','general'));
    }

    public function insert(Request $request){

        
        $request->validate([
            'contact' => 'required',
            // tambahkan validasi lain jika diperlukan
        ], [
            'contact.required' => 'The description field is required.',
            // tambahkan pesan kustom lain jika diperlukan
        ]);
        $contact = Contact::create($request->all());
        
        
        if($request->hasFile('icon')){
            $request->file('icon')->move('foto/', $request->file('icon')->getClientOriginalName());
            $contact->icon = $request->file('icon')->getClientOriginalName();
            $contact->save();
        }

        return redirect()->route('contact')->with('insert-contact', 'Add Data Success');
    }

    public function edit($id){
        $contact = Contact::find($id);
        $unreadCount = Mail::where('is_read', false)->count();
        $general = General::first();
        return view('dashboard.edit-contact',compact('contact','unreadCount','general'));
    }

    public function update(Request $request, $id){
        $contact = Contact::findOrFail($id);
        $validatedData = $request->validate([
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'contact' => 'required',
        ]);
        $contact->contact = $validatedData['contact'];
    
        if ($request->hasFile('icon')) {
            // Jika ada file gambar baru diupload
            $image = $request->file('icon');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move('foto/', $imageName);
    
            // Hapus gambar lama jika ada
            if ($contact->icon && file_exists(public_path('foto/' . $contact->icon))) {
                unlink(public_path('foto/' . $contact->icon));
            }
    
            $contact->icon = $imageName;
        }
        // Jika tidak ada file baru, gunakan gambar yang sudah ada
        // Tidak perlu melakukan apa-apa karena kita tidak mengubah $program->profil
    
        $contact->save();
    
        return redirect()->route('contact')->with('update-contact', 'Update Data Suceess');
    }
    public function delete($id){
        $contact = Contact::find($id);
        $contact->delete();
        return redirect()->route('contact')->with('contact-delete', 'Delete Data Suceess');
    }
}
