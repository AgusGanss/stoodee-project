<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Iklan;
use App\Models\Review;
use App\Models\Contact;
use App\Models\Content;
use App\Models\General;
use App\Models\IklanDalam;
use App\Models\Kategori;
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
        $iklan = Iklan::where('status','active')->latest()->first();
        $blog = Blog::orderBy('tanggal','desc')->get()->take(3);
        $kategori =  Kategori::all();
        return view('home',compact('general','content','program','review','blog','contact','iklan','kategori'));
    }

    public function program($slug){
        $program = Program::with(['iklandalam' => function ($query) {
            $query->where('status', 'active');
        }])->where('slug', $slug)->firstOrFail();
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

    public function blog_fillter($slug)
    {
        $kategori = Kategori::where('slug', $slug)->firstOrFail();
        $blog = $kategori->blog()->paginate(10); // Adjust the number as needed
        $general = General::first();
        $recentBlogs = Blog::latest()->take(5)->get();
        $program = Program::orderBy('created_at', 'desc')->get();
        
        return view('blog-filter', compact('kategori', 'blog', 'general', 'program', 'recentBlogs'));
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
