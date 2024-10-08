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

    @if (isset($iklan) && $iklan)
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
    <div class="popup-container" id="popupContainer">
        <div class="popup">
            <button class="close-btn" onclick="closePopup()">&times;</button>
            <form class="elegant-form" id="reviewForm" action="{{ route('review.insert.home') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <h2>Add Review</h2>
                <div class="form-group image-input-group">
                    <label for="profil">Profil Reviewer</label>
                    <input type="file" id="profil" name="profil" accept="image/*">
                    <label for="profil">Choose Image</label>
                    <div class="image-preview" id="imagePreview">
                        <img src="#" alt="Image Preview" id="previewImage" style="display: none;">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="nama">Nama Reviewer</label>
                    <input type="text" id="nama" name="nama" required>
                </div>

                <div class="form-group">
                    <label for="review">Review</label>
                    <textarea id="review" name="review" rows="4" required></textarea>
                </div>

                <div class="form-group rating-group">
                    <label>Rating</label>
                    <div class="star-rating">
                        <input type="radio" id="star5" name="rating" value="5" required/>
                        <label for="star5" title="5 stars"><i class="fas fa-star"></i></label>
                        <input type="radio" id="star4" name="rating" value="4" />
                        <label for="star4" title="4 stars"><i class="fas fa-star"></i></label>
                        <input type="radio" id="star3" name="rating" value="3" />
                        <label for="star3" title="3 stars"><i class="fas fa-star"></i></label>
                        <input type="radio" id="star2" name="rating" value="2" />
                        <label for="star2" title="2 stars"><i class="fas fa-star"></i></label>
                        <input type="radio" id="star1" name="rating" value="1" />
                        <label for="star1" title="1 star"><i class="fas fa-star"></i></label>
                    </div>
                </div>

                <button type="submit" class="submit-btn">Submit</button>
            </form>
        </div>
    </div>

    
    <div class="review" id="review">
        <h1>TESTIMONI</h1>
        <button class="open-popup-btn" onclick="openPopup()"><i class="bi bi-chat-left-text" style="font-size: 20px"></i></button>
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

    {{-- KATEGORI --}}
    <div class="ignielHorizontal" id="scrollContainer">
        <ul id="menuList">
            @foreach ($kategori as $kategoris)
                <li><a href="{{ route('blog.fillter', $kategoris->slug) }}" class="category-item">
                        {{ $kategoris->kategori }}
                    </a></li>
            @endforeach
        </ul>
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
    document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('adModal');
    const closeButton = modal ? modal.querySelector('.ad-close') : null;

    // Function to open the modal
    function openModal() {
        if (modal) {
            modal.classList.add('show'); // Menambahkan class show untuk menampilkan modal
        }
    }

    // Function to close the modal
    function closeModal() {
        if (modal) {
            modal.classList.remove('show'); // Menghapus class show untuk menyembunyikan modal
        }
    }

    // Open the modal when the page loads
    if (modal) {
        openModal();
    }

    // Close the modal when clicking on the close button
    if (closeButton) {
        closeButton.addEventListener('click', closeModal);
    }

    // Close the modal when clicking outside of it
    window.addEventListener('click', function (event) {
        if (event.target === modal) {
            closeModal();
        }
    });

    // Optional: Close the modal when pressing the "Esc" key
    window.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            closeModal();
        }
    });
});

  </script>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const scrollContainer = document.querySelector(".ignielHorizontal");

            // Event listener untuk mendeteksi scroll
            scrollContainer.addEventListener("scroll", function() {
                const maxScrollLeft = scrollContainer.scrollWidth - scrollContainer.clientWidth;

                // Jika scroll sudah mencapai akhir, kembalikan ke awal
                if (scrollContainer.scrollLeft >= maxScrollLeft) {
                    scrollContainer.scrollLeft = 0;
                }
            });
        });
    </script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const profilInput = document.getElementById('profil');
        const previewImage = document.getElementById('previewImage');
        const reviewForm = document.getElementById('reviewForm');

        profilInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewImage.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        });
    });

    function openPopup() {
        document.getElementById('popupContainer').style.display = 'flex';
    }

    function closePopup() {
        document.getElementById('popupContainer').style.display = 'none';
    }
</script>


@if(session('insert-review-home'))
    <script>
    Swal.fire({
  position: "top-end",
  icon: "success",
  title: "Your work has been saved",
  showConfirmButton: false,
  timer: 1500
});
    </script>
@endif



</body>

</html>
