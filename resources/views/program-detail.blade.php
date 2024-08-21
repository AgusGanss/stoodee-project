<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Program</title>
    <link rel="stylesheet" href="../css/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="icon" href="{{ asset('foto/' .$general->logo2) }}" type="image/x-icon"/>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        a{
    text-decoration: none;
    color: rgb(29, 182, 228);
}
a:hover{
    color: rgb(22, 146, 184);
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

        h1 {
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
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
            overflow: hidden;
            border-radius: 10px;
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

        h2 {
            font-size: 1.8rem;
            margin-bottom: 1rem;
            color: #2c3e50;
        }

        p {
            margin-bottom: 1rem;
        }

        .highlight {
            background-color: #f1c40f;
            color: #2c3e50;
            padding: 0.2rem 0.5rem;
            border-radius: 3px;
            font-weight: bold;
            display: inline-block;
            margin-bottom: 0.5rem;
        }

        @media screen and (max-width: 768px) {
            .program-details {
                flex-direction: column;
            }

            .program-image, .program-info {
                width: 100%;
            }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .fade-in {
            animation: fadeIn 1s ease-in-out;
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

    .program-details {
        gap: 1rem;
    }

    .program-image {
        min-width: 100%;
    }

    .program-info {
        min-width: 100%;
    }

    h2 {
        font-size: 1.5rem;
        margin-bottom: 0.5rem;
    }

    .form-container {
        margin-left: 15px;
        width: 350px
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
        <a href="{{ route('home') }}"><img src="{{ asset('foto/' .$general->logo1) }}" alt="" height="40px"></a>
    </header>
    <div class="container">
        <div class="program-details">
            <div class="program-image fade-in">
                <img src="{{ asset('foto/' .$program->gambar_program ) }}" alt="Gambar Program">
            </div>
            <div class="program-info fade-in">
                <h2>{{ $program->judul_program }}</h2>
                <p>{!! $program->deskripsi_program !!}</p>
            </div>
        </div>
    </div>
    <div class="form-container" id="contact-us">
        <h2>Hubungi Kami</h2>
        <form action="{{ route('mail.insert') }}" method="POST">
            @csrf
            <div class="form-group">
                <input type="text" id="name" name="name" placeholder="Your name..." class="@error('name') is-invalid @enderror" value="{{ old('name') }}" >
                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            </div>
            <div class="form-group">
                <input type="email" id="email" name="email" placeholder="Your email..." class="@error('email') is-invalid @enderror" value="{{ old('email') }}">
                @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            </div>
            <div class="form-group">
                <input type="tel" id="phone" class="@error('phone') is-invalid @enderror" name="phone" placeholder="Your phone number..." value="{{ old('phone') }}">
                @error('phone')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            </div>
            <div class="form-group">
                <select id="subject" class="@error('program_id') is-invalid @enderror" name="program_id" >
                    <option value="{{ $program->id}}"">{{ $program->judul_program }}</option>
                </select>
                @error('program_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            </div>
            <div class="form-group">
                <label for="">Pesan</label>
                <textarea id="message" name="pesan" placeholder="Your message..." class="@error('pesan') is-invalid @enderror">{{ old('pesan') }}</textarea>
                @error('pesan')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            </div>
            <div class="form-group">
                <button type="submit">Send</button>
            </div>
        </form>
    </div>
</body>
</html>


