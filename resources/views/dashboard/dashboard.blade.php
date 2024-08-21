@extends('layouts.template')
@section('content')



<div class="container-fluid">
    <div class="container">
        <form action="{{ route('update.general') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="header">
                <div class="image-container logo-container">
                    <h3>Logo</h3>
                    @if($general->logo)
                        <img src="{{ asset('foto/' . $general->logo) }}" alt="Logo" id="logo-preview">
                    @else
                        <img src="placeholder-logo.jpg" alt="Logo" id="logo-preview">
                    @endif
                    <input type="file" id="logo-upload" name="logo" accept="image/*" >
                </div>
                <div class="image-container banner-container">
                    <h3>Banner</h3>
                    @if($general->banner)
                        <img src="{{ asset('foto/' . $general->banner) }}" alt="Banner" id="banner-preview">
                    @else
                        <img src="placeholder-banner.jpg" alt="Banner" id="banner-preview">
                    @endif
                    <input type="file" id="banner-upload" name="banner" accept="image/*" >
                </div>
            </div>

            <div class="form-group">
                <label for="judul">Logo Transisi:</label>
                <input type="file" id="gambar_program" name="logo1" >
                <div class="container" style="background-color: rgb(231, 231, 231)">
                <div class="image-preview" id="imagePreview">
                  <img src="{{ asset('foto/' . $general->logo1) }}" alt="Image Preview" id="previewImage" >
                </div>
                </div> 
            </div>
            <div class="form-group">
                <label for="judul">Icon Website:</label>
                <input type="file" id="gambar" name="logo2" >
                <div class="container" style="background-color: rgb(231, 231, 231)">
                <div class="image-preview" id="Preview">
                  <img src="{{ asset('foto/' . $general->logo2) }}" alt="Image Preview" id="preview" >
                </div>
                </div> 
            </div>
            <div class="form-group">
                <label for="judul">Judul:</label>
                <input type="text" id="judul" name="judul" value="{{ $general->judul }}" placeholder="Masukkan judul" required>
            </div>
            
            <div class="form-group">
                <label for="slogan">Slogan:</label>
                <input type="text" id="slogan" name="slogan" value="{{ $general->slogan }}" placeholder="Masukkan slogan" required>
            </div>

            <div class="form-group">
                <label for="slogan">Title Content:</label>
                <input type="text" id="judul_content" name="judul_content" value="{{ $general->judul_content }}" placeholder="Masukkan Title Content" required>
            </div>
            
            <button type="submit" class="upload-btn">Submit</button>
        </form>
    </div>
</div>


<script>
    document.getElementById('gambar_program').addEventListener('change', function(event) {
       const file = event.target.files[0];
       const imagePreview = document.getElementById('previewImage');
       
       if (file) {
           const reader = new FileReader();
           
           reader.onload = function(e) {
               imagePreview.src = e.target.result;
               imagePreview.style.display = 'block';
           }
           
           reader.readAsDataURL(file);
       } else {
           imagePreview.src = '#';
           imagePreview.style.display = 'none';
       }
   });
 </script>

<script>
    document.getElementById('gambar').addEventListener('change', function(event) {
       const file = event.target.files[0];
       const Preview = document.getElementById('preview');
       
       if (file) {
           const reader = new FileReader();
           
           reader.onload = function(e) {
               Preview.src = e.target.result;
               Preview.style.display = 'block';
           }
           
           reader.readAsDataURL(file);
       } else {
           Preview.src = '#';
           Preview.style.display = 'none';
       }
   });
 </script>

<script>
    function previewImage(input, imgId) {
        const file = input.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById(imgId).src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    }

    document.getElementById('logo-upload').addEventListener('change', function() {
        previewImage(this, 'logo-preview');
    });

    document.getElementById('banner-upload').addEventListener('change', function() {
        previewImage(this, 'banner-preview');
    });
</script>
@endsection
