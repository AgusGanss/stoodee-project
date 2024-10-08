<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Program</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        header {
            background-color: #E16026;
            color: #fff;
            text-align: center;
            padding: 1rem;
            margin-bottom: 2rem;
        }

        h1, h2 {
            color: #2c3e50;
        }

        .program-details {
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
            align-items: flex-start;
        }

        .program-image {
            flex: 1;
            min-width: 300px;
            max-width: 100%;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .program-image img {
            width: 100%;
            height: auto;
            transition: transform 0.3s ease-in-out;
        }

        .program-image:hover img {
            transform: scale(1.05);
        }

        .program-info {
            flex: 2;
            min-width: 300px;
        }

        .form-container {
            background-color: #fff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-top: 2rem;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        .form-group button {
            background-color: #E16026;
            color: #fff;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
            transition: background-color 0.3s ease;
        }

        .form-group button:hover {
            background-color: #c74e1a;
        }

        .floating-contact-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
        }

        .contact-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 60px;
            height: 60px;
            background-color: #25D366;
            color: #fff;
            border-radius: 50%;
            font-size: 30px;
            text-decoration: none;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease;
        }

        .contact-icon:hover {
            transform: scale(1.1);
        }

/* Container utama */
.container1 {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

/* Pengaturan grid untuk wrapper iklan */
.iklan-wrapper {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
    margin: 20px 0;
}

/* Item iklan */
.iklan-item {
    padding: 0px;
    border-radius: 10px;
    transition: transform 0.3s ease-in-out;
    position: relative;
}

.iklan-item:hover {
    transform: scale(1.05);
}

/* Video Container */
.video-container {
    position: relative;
    width: 100%;
    height: auto; /* Tinggi mengikuti rasio video */
    overflow: hidden;
    border-radius: 10px;
}

.video-container video {
    width: 100%;
    height: auto; /* Sesuaikan tinggi sesuai rasio video */
    object-fit: contain; /* Jaga proporsi video */
}

/* Foto Container */
.foto-container {
    position: relative;
    width: 100%;
    height: auto;
    overflow: hidden;
    border-radius: 10px;
}

.foto-container img {
    width: 100%;
    height: auto;
    max-height: 400px; /* Sesuaikan sesuai kebutuhan */
    object-fit: cover; /* Pastikan gambar tetap memenuhi kontainer */
    border-radius: 10px;
}


        @media screen and (max-width: 768px) {
            .program-details {
                flex-direction: column;
            }

            .program-image, .program-info {
                width: 100%;
            }

            .form-container {
                padding: 1rem;
            }
            .iklan-item {
                grid-column: span 1;
            }

            .video-container {
                padding-bottom: 75%; /* For better aspect ratio on smaller screens */
            }
        }

        @media screen and (max-width: 450px) {
            .container {
                padding: 10px;
            }

            header {
                padding: 0.5rem;
                margin-bottom: 1rem;
            }

            h1 {
                font-size: 1.8rem;
            }

            h2 {
                font-size: 1.5rem;
            }

            .form-group input,
            .form-group select,
            .form-group textarea {
                font-size: 14px;
                padding: 8px;
            }

            .form-group button {
                font-size: 16px;
                padding: 10px 20px;
            }

            .container1 {
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="floating-contact-button">
        <a href="https://api.whatsapp.com/send?phone=6285737816000" target="_blank" class="contact-icon">
            <i class="fab fa-whatsapp"></i>
        </a>
    </div>
    <header>
        <a href="{{ route('home') }}"><img src="{{ asset('foto/' .$general->logo1) }}" alt="logo" height="40px"></a>
    </header>
    <div class="container">
        <div class="program-details">
            <div class="program-image">
                <img src="{{ asset('foto/' .$program->gambar_program ) }}" alt="Gambar Program">
            </div>
            <div class="program-info">
                <h2>{{ $program->judul_program }}</h2>
                <p>{!! $program->deskripsi_program !!}</p>
            </div>
        </div>


          <div class="container1">
           <div class="iklan-wrapper">
    <!-- Iklan Video -->
    <div class="iklan-item video-container">
        @foreach($program->iklandalam as $iklan)
        <a href="{{ $iklan->link }}">
        @if($iklan->video)
            <video autoplay loop muted class="hidden-controls"> 
                <source src="{{ asset('video/' . $iklan->video) }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        @else
        @endif
        </a>
        @endforeach
    </div>

    <!-- Iklan Foto -->
    <div class="iklan-item foto-container">
        @foreach($program->iklandalam as $iklan)
        <a href="{{ $iklan->link2 }}">
            @if($iklan->foto)
                <img src="{{ asset('foto/' . $iklan->foto) }}" alt="">
            @else
            @endif
        </a>
        @endforeach
    </div>
</div>

        </div>

        <div class="form-container" id="contact-us">
            <h2>Hubungi Kami</h2>
            <form action="{{ route('mail.insert') }}" method="POST">
                @csrf
                <div class="form-group">
                    <input type="text" id="name" name="name" placeholder="Your name..." class="@error('name') is-invalid @enderror" value="{{ old('name') }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="email" id="email" name="email" placeholder="Your email..." class="@error('email') is-invalid @enderror" value="{{ old('email') }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="tel" id="phone" name="phone" placeholder="Your phone number..." class="@error('phone') is-invalid @enderror" value="{{ old('phone') }}">
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <select id="subject" name="program_id" class="@error('program_id') is-invalid @enderror">
                        <option value="{{ $program->id }}">{{ $program->judul_program }}</option>
                    </select>
                    @error('program_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <textarea id="message" name="pesan" placeholder="Your message..." class="@error('pesan') is-invalid @enderror">{{ old('pesan') }}</textarea>
                    @error('pesan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <button type="submit">Send</button>
                </div>
            </form>
        </div>
    </div>

    @if(session('success'))
    <script>
        Swal.fire({
            title: "",
            text: "Pesan Berhasil Terkirim",
            icon: "success"
        });
    </script>
    @endif

    <script>
        document.addEventListener('copy', function(e) {
            e.preventDefault();
            alert('Copying content is not allowed!');
        });

        document.addEventListener('cut', function(e) {
            e.preventDefault();
            alert('Cutting content is not allowed!');
        });

        document.addEventListener('contextmenu', function(e) {
            e.preventDefault();
            alert('Right-click is disabled!');
        });
    </script>
</body>
</html>