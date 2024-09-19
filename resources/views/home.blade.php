<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/swiper-bundle.min.css" />
    <link rel="stylesheet" href="../css/home.css">
    <link rel="stylesheet" href="../css/bootstrap/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/dashboard/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="icon" href="{{ asset('foto/' . $general->logo2) }}" type="image/x-icon" />
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @php
        use Carbon\Carbon;
        Carbon::setLocale('id'); // Untuk Bahasa Indonesia
    @endphp
    <title>Stoodee</title>
</head>

<body>
    {{-- IKLAN --}}
    
    @if(isset($iklan) && $iklan)
    <div id="adModal" class="ad-modal">
        <div class="ad-modal-content">
            <span class="ad-close">&times;</span>
            <img src="{{ asset('foto/' . $iklan->iklan_image) }}" alt="Advertisement" class="ad-image">
            <div class="button-bottom">
                @if ($iklan->link)
                    <a href="{{ $iklan->link }}" class="ad-cta">{!! $iklan->text_iklan !!}</a>
                @endif
            </div>
        </div>
    </div>
    @endif

    {{-- HEADER --}}

    <div class="floating-contact-button">
        <a href="https://api.whatsapp.com/send?phone=6285737816000" target="_blank" class="contact-icon">
            <i class="fab fa-whatsapp"></i>
        </a>
    </div>

    <div class="navbar">
        <div class="navbar-content">
            <a href="#"><img id="navLogo" src="{{ asset('foto/' . $general->logo) }}" alt="STOODEE logos"></a>
        </div>
    </div>

    <div class="judul-header fade-in">
        <h1>{{ $general->judul }}</h1>
        <p>{{ $general->slogan }}</p>
    </div>


    <div class="img-header">
        <img src="{{ asset('foto/' . $general->banner) }}" alt="">
    </div>

    {{-- HEADER --}}

    {{-- BODY --}}
    {{-- MENGAPA MEMILIH STOODEE --}}
    <div class="judul-content-satu">
        <h1>{{ $general->judul_content }}</h1>
    </div>

    <div class="kartu" data-aos="fade-right" data-aos-duration="1000">
        <div class="content-satu">
            @foreach ($content as $contents)
                <div class="card">
                    <div class="logo">
                        <img src="{{ asset('foto/' . $contents->logo1) }}" alt="" class="default-image">
                        <img src="{{ asset('foto/' . $contents->logo2) }}" alt="" class="hover-image">
                    </div>
                    <h1>{{ $contents->title_content }}</h1>
                    <p>{!! $contents->deskripsi !!}</p>
                </div>
            @endforeach
        </div>
    </div>




    {{-- PROGRAM --}}
    <div class="judul-content-dua">
        <h1>PROGRAM</h1>
    </div>
    <div class="card" data-aos="fade-up" data-aos-duration="1000">
        <div class="content-dua">


            @foreach ($program as $programs)
                <div class="card">
                    <img src="{{ asset('foto/' . $programs->gambar_program) }}" alt="Foto">
                    <div class="content-card">
                        <h3>{{ $programs->judul_program }}</h3>
                        <p class="description">{{ strip_tags($programs->deskripsi_program) }}</p>
                        <a href="{{ route('program.show', $programs->slug) }}">Informasi</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>





    {{-- REVIEW --}}
    <div class="review">
        <h1>TESTIMONI</h1>
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">

                @foreach ($review as $reviews)
                    <div class="swiper-slide">
                        <div class="testimonialBox">
                            <img src="{{ asset('foto/' . $reviews->profil) }}" alt="Foto Profile">
                            <div class="content-testimoni">
                                <h3 class="nama-testimoni">{{ $reviews->nama }}</h3>
                                <p>{!! $reviews->review !!}</p>
                                <td data-label="Deskripsi" class="description-cell">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $reviews->rating)
                                            <i class="fas fa-star" style="color: #ffbc06"></i>
                                        @else
                                            <i class=""></i>
                                        @endif
                                    @endfor

                                </td>
                            </div>
                        </div>
                    </div>
                @endforeach





            </div>
        </div>
    </div>





    {{-- NEWS --}}
    <div class="news">

        @foreach ($blog as $blogs)
            <div class="card-news">
                <img class="img-news" src="{{ asset('foto/' . $blogs->gambar_blog) }}" alt="FOTO BERITA">
                <div class="content-news">
                    <div class="date">
                        <img src="../foto/kalender.png" alt="icon" class="icon-tanggal">
                        <p>{{ Carbon::parse($blogs->tanggal)->isoFormat('D MMMM Y') }}</p>
                    </div>
                    <div class="deskripsi">
                        <h3>{{ $blogs->judul_blog }}</h3>
                        <p>{!! Str::limit(strip_tags($blogs->content_blog), 200, '...') !!}</p>
                    </div>
                    <a href="{{ route('blog.show', $blogs->slug) }}">Baca Berita</a>
                </div>
            </div>
        @endforeach
    </div>
    <div class="read-more">
        <a href="{{ route('blog.all') }}">Berita lainnya<svg xmlns="http://www.w3.org/2000/svg" width="16"
                height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708" />
            </svg></a>
    </div>







    {{-- ALAMAT --}}
    <div class="alamat">
        <div class="content-alamat">
            <div class="form-container" id="contact-us">
                <h2>Hubungi Kami</h2>
                <form action="{{ route('mail.insert') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" id="name" name="name" placeholder="Your name..."
                            class="@error('name') is-invalid @enderror" value="{{ old('name') }}">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Your email..."
                            class="@error('email') is-invalid @enderror" value="{{ old('email') }}">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="phone">Nomor Wa</label>
                        <input type="tel" id="phone" class="@error('phone') is-invalid @enderror"
                            name="phone" placeholder="Your phone number..." value="{{ old('phone') }}">
                        @error('phone')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="subject">Program</label>
                        <select id="subject" class="@error('program_id') is-invalid @enderror" name="program_id">
                            <option value="">Pilih Program...</option>
                            @foreach ($program as $programs)
                                <option value="{{ $programs->id }}"
                                    {{ old('program_id') == $programs->id ? 'selected' : '' }}>
                                    {{ $programs->judul_program }}</option>
                            @endforeach
                        </select>
                        @error('program_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="message">Pesan</label>
                        <textarea id="message" name="pesan" placeholder="Your message..." class="@error('pesan') is-invalid  @enderror">{{ old('pesan') }}</textarea>
                        @error('pesan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button type="submit">Kirim</button>
                    </div>
                </form>
            </div>
            <div class="card-alamat">

                @foreach ($contact as $contacts)
                    <div class="deskripsi">
                        <img src="{{ asset('foto/' . $contacts->icon) }}" alt="icon">
                        <p>{!! $contacts->contact !!}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>


    {{-- BODY --}}


    {{-- FOOTER --}}
    <div class="footer">
        <div class="footer-content">
            <p>Stoodee &copy; 2024 - Created by ArthaDigiPro</p>
        </div>
    </div>















    <script>
        window.addEventListener('scroll', function() {
            var navbar = document.querySelector('.navbar');
            navbar.classList.toggle('scrolled', window.scrollY > 50);
        });
    </script>
    <script>
        window.addEventListener('scroll', function() {
            var navbar = document.querySelector('.navbar');
            var logo = document.getElementById('navLogo');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
                logo.src = "{{ asset('foto/' . $general->logo1) }}"; // Ganti dengan path gambar yang baru
            } else {
                navbar.classList.remove('scrolled');
                logo.src = "{{ asset('foto/' . $general->logo) }}"; // Kembalikan ke gambar awal
            }
        });
    </script>

    <script>
        AOS.init();
    </script>

    <script src="../js/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".mySwiper", {
            effect: "coverflow",
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: "auto",
            coverflowEffect: {
                rotate: 0,
                stretch: 0,
                depth: 100,
                modifier: 2,
                slideShadows: true,
            },
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            loop: true,
        });
    </script>

    @if (session('success'))
        <script>
            Swal.fire({
                title: "",
                text: "Pesan Berhasil Terkirim",
                icon: "success"
            });
        </script>
    @endif


    <script>
        // Function to open the modal
        function openModal() {
            const modal = document.getElementById('adModal');
            modal.classList.add('show');
        }

        // Function to close the modal
        function closeModal() {
            const modal = document.getElementById('adModal');
            modal.classList.remove('show');
        }

        // Open the modal when the page loads (you can trigger this when you want)
        window.addEventListener('load', openModal);

        // Close the modal when clicking on the close button
        document.querySelector('.ad-close').onclick = closeModal;

        // Close the modal when clicking outside of it
        window.onclick = function(event) {
            if (event.target == document.getElementById('adModal')) {
                closeModal();
            }
        }
    </script>
</body>

</html>
