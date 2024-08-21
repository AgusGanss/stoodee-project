@extends('layouts.template-blog-all')
@section('blog')

@php
use Carbon\Carbon;
Carbon::setLocale('id');
@endphp

<div class="container-blog">
    <div class="blog-image">
        <img src="{{ asset('foto/' . $blog->gambar_blog) }}" alt="">
    </div>

    <div class="blog-content">
        <h3 class="blog-title">{{ $blog->judul_blog }}</h3>
        <div class="date">
            <img src="../foto/kalender.png" alt="icon" class="icon-tanggal">
            <p>{{ Carbon::parse($blog->tanggal)->isoFormat('D MMMM Y') }}</p>
        </div>
    </div>

    <div class="deskripsi">
        <p>{!! $blog->content_blog !!}</p>
    </div>
</div>

@endsection