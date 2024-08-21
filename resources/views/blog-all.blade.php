@extends('layouts.template-blog-all')
@section('blog')


@php
use Carbon\Carbon;
Carbon::setLocale('id');
@endphp

<div class="main-content">
    @forelse ( $blog as $blogs )
    <div class="card-news" style="margin-top: 20px">
        <img class="img-news" src="{{ asset('foto/' . $blogs->gambar_blog) }}" alt="FOTO BERITA" class="header" height="500px">
        <div class="content-news">
            <div class="date">
                <img src="../foto/kalender.png" alt="icon" class="icon-tanggal" class="icon">
                <p>{{ Carbon::parse($blogs->tanggal)->isoFormat('D MMMM Y') }}</p>
            </div>
            <div class="deskripsi">
                <h3>{!! highlightWords($blogs->judul_blog, $search) !!}</h3>
                <p>{!! Str::limit(strip_tags($blogs->content_blog), 200, '...') !!}</p>
            </div>
            <a href="{{ route('blog.show', $blogs->slug) }}">LIHAT NEWS</a>
        </div>
    </div>
    @empty
    <tr>
      <td colspan="4">No results found.</td>
    </tr>

   
    @endforelse

    <div class="pagination-wrapper">
        {{ $blog->links() }}
    </div>
    
</div>
@endsection



