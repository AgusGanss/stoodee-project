<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/blog.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="icon" href="{{ asset('foto/' .$general->logo2) }}" type="image/x-icon"/>

    <title>Blog</title>
    @php
    use Carbon\Carbon;
    Carbon::setLocale('id');
    @endphp
</head>
<body>
   
    <div class="navbar">
        <div class="navbar-content">
            <a href="{{ route('home') }}"><img src="{{ asset('foto/' .$general->logo1) }}" alt="STOODEE logos"></a>
        </div>
    </div>
   

    <div class="content-container">
       @yield('blog')

        <div class="sidebar">
            <div class="search-container">
                <form action="{{ route('blog.all') }}" method="get" class="search-form">
                    <input type="search" placeholder="Cari berita..." name="search" class="search-input" value="{{ $search ?? '' }}">
                    <button type="submit" class="search-button">
                        <i class="fa fa-search"></i>
                    </button>
                </form>
            </div>
            
            <div class="recent-news">
                <h3>Berita Terbaru</h3>
                @foreach ($recentBlogs as $recentBlog)
                <a href=" {{ route('blog.show', $recentBlog->slug) }}" style="text-decoration: none; color:black">
                <div class="recent-news-item">
                    <img src="{{ asset('foto/' . $recentBlog->gambar_blog) }}" alt="Gambar berita terbaru">
                        <h4>{{ Str::limit($recentBlog->judul_blog, 50) }}</h4>
                   
                </div>
            </a>
                @endforeach
            </div>
            <div class="recent-news">
                <h3>Program</h3>
                @foreach ($program as $programs)
                <a href=" {{ route('program.show', $programs->slug) }}" style="text-decoration: none; color:black">
                <div class="recent-news-item">
                    <img src="{{ asset('foto/' . $programs->gambar_program) }}" alt="Gambar berita terbaru">
                        <h4>{{ Str::limit($programs->judul_program   , 50) }}</h4>
                   
                </div>
            </a>
                @endforeach
            </div>
        </div>
    </div>

   

        
   
</body>
</html>