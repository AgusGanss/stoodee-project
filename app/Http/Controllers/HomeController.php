<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Contact;
use App\Models\Review;
use App\Models\Content;
use App\Models\General;
use App\Models\Program;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){
        $general = General::first();
        $content = Content::all();
        $program = Program::all();
        $review = Review::all();
        $contact = Contact::all();
        $blog = Blog::orderBy('tanggal','desc')->get()->take(3);
        return view('home',compact('general','content','program','review','blog','contact'));
    }

    public function program($slug){
        $program = Program::where('slug', $slug)->firstOrFail();
        $general = General::first();
        return view('program-detail', compact('program','general'));
    }

    public function blog($slug){
        $blog = Blog::where('slug', $slug)->firstOrFail();
        $general = General::first();
        $recentBlogs = Blog::latest()->take(5)->get();
        $program = Program::orderBy('created_at', 'desc')->get();
        return view('blog-detail', compact('blog','general','recentBlogs','program'));
    }

    public function blog_all(Request $request){
        $search = $request->input('search');

        $blog = Blog::query()
            ->when($search, function ($query, $search) {
                return $query->where('judul_blog', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(5);
    
        $recentBlogs = Blog::latest()->take(5)->get();
        $general = General::first();
        $program = Program::orderBy('created_at', 'desc')->get();
    
        return view('blog-all', compact('blog', 'general', 'recentBlogs', 'search','program'));
    }       
}
