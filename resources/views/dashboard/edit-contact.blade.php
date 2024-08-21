@extends('layouts.template')
@section('content')

<div class="container-fluid">
  <div class="form-container">
    <form class="elegant-form" action="{{ route('contact.update', $contact->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      <h2>Edit Contact</h2>
      <div class="form-group image-input-group">
        <label for="gambar_program">Icon</label>
        <input type="file" id="gambar_program" name="icon">
        <div class="image-preview" id="imagePreview">
           <img src="{{ asset('foto/' . $contact->icon) }}" alt="Image Preview" id="previewImage" >
        </div>
    </div>
      <div class="form-group">
        <label for="description">Contact</label>
        <textarea cols="80" id="ckeditor" name="contact"  class= "deskripsi @error('contact') is-invalid @enderror" rows="10">{{ $contact->contact }}</textarea>
        @error('contact')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
      </div>
      <button type="submit" class="submit-btn">Submit</button>
    </form>
  </div>
</div>

{{-- <script>
  const judul_blog = document.querySelector('#judul_blog');
  const slug = document.querySelector('#slug');

  judul_blog.addEventListener('change', function(){
      fetch('/backoffice/blog/checkSlug?judul_blog=' + judul_blog.value)
      .then(response => response.json())
      .then(data =>  slug.value = data.slug)
  });
</script> --}}

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
@endsection