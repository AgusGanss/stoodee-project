@extends('layouts.template')
@section('content')

<div class="container-fluid">
  <div class="form-container">
    <form class="elegant-form" action="{{ route('content.update', $content->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      <h2>Edit Content</h2>
      <div class="form-group">
        <label for="title">Title</label>
        <input type="text" id="title" name="title_content" value="{{ $content->title_content }}"  required>
      </div>
      <div class="form-group">
        <label for="title">Logo 1</label>
        <input type="file" id="logo1" name="logo1" class="@error('logo1') is-invalid @enderror ">
                  <div class="image-preview" id="imagePreview">
                    <img src="{{ asset('foto/' .$content->logo1) }}" alt="Image Preview" id="previewImage" >
                  </div>
        @error('logo1')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="form-group">
        <label for="title">Logo 2</label>
        <input type="file" id="logo2" name="logo2" class="@error('logo2') is-invalid @enderror ">
                  <div class="image-preview" id="Preview">
                    <img src="{{ asset('foto/' .$content->logo2) }}" alt="Image Preview" id="preview" >
                  </div>
        @error('logo2')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="form-group">
        <label for="description">Description</label>
        <textarea cols="80" id="ckeditor" name="deskripsi"  class= "deskripsi @error('deskripsi') is-invalid @enderror" rows="10">{{ $content->deskripsi }}</textarea>
        @error('deskripsi')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
       @enderror
      </div>
      <button type="submit" class="submit-btn">Submit</button>
    </form>
  </div>
</div>



<script>
  document.getElementById('logo1').addEventListener('change', function(event) {
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
  document.getElementById('logo2').addEventListener('change', function(event) {
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
@endsection