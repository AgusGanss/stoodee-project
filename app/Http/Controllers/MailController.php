<?php

namespace App\Http\Controllers;

use App\Models\Mail;
use App\Models\General;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MailController extends Controller
{

    public function mail(){
        $mail = Mail::with('program')->orderBy('created_at', 'desc')->paginate(10);
        $program = Program::all();
        $general = General::first();
        $unreadCount = Mail::where('is_read', false)->count();
        return view('dashboard.mail',compact('mail','program','unreadCount','general'));
    }

    public function markAsRead($id)
{
    $mail = Mail::findOrFail($id);
    $mail->is_read = true;
    $mail->save();
    return redirect()->back();
}
public function insert(Request $request){
    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'email' => 'required|email:dns',
        'phone' => 'required',
        'program_id' => 'required',
        'pesan' => 'required',
    ]);

    if ($validator->fails()) {
        return redirect()->back()
                         ->withErrors($validator)
                         ->withInput()
                         ->withFragment('contact-us');
    }

    Mail::create($request->all());

    $referer = $request->headers->get('referer');
    $successMessage = 'Pesan Anda berhasil dikirim!';

    if ($referer) {
        return redirect($referer)
               ->with('success', $successMessage)
               ->withFragment('contact-us');
    } else {
        return redirect()->route('home')
               ->with('success', $successMessage)
               ->withFragment('contact-us');
    }
}
    public function delete($id){
        $contact = Mail::find($id);
        $contact->delete();
        return redirect()->route('mail')->with('mail-delete', 'Delete Message Success');
    }
}
