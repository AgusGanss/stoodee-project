@extends('layouts.template')
@section('content')

<div class="container-fluid">
  <div class="form-container">
    <form class="elegant-form" action="{{ route('blog.insert') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <h2>Add Blog</h2>
      <div class="form-group image-input-group">
        <label for="gambar_program">Gambar Blog</label>
        <input type="file" id="gambar_program" name="gambar_blog" required>
        <div class="image-preview" id="imagePreview">
          <img src="#" alt="Image Preview" id="previewImage" style="display: none; " >
        </div>
    </div>
      <div class="form-group">
        <label for="title">Judul Blog</label>
        <input type="text" id="judul_blog" name="judul_blog" required  value="{{ old('judul_blog') }}">
      </div>
      <div class="form-group">
        <label for="judul_program"></label>
        <input type="hidden" class="judul" id="slug" name="slug" disabled readonly>
    </div>
      <div class="form-group">
        <label for="tanggal">Tanggal Blog</label>
        <input type="date" id="" name="tanggal"  value="{{ old('tanggal') }}" required>
      </div>
      <div class="form-group">
        <label for="description">Content Blog</label>
        <textarea cols="80" id="ckeditor" name="content_blog"  class="@error('content_blog') is-invalid @enderror" rows="10" value="{{ old('content_blog') }}"></textarea>
        @error('content_blog')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
          @enderror
      </div>
      <label for="">Kategori</label>
      <select class="form-select mb-3" name="kategori_id" aria-label="Default select example">
        <option selected>Select Kategori</option>
        @foreach ( $kategori as $kategoris )
        <option value="{{ $kategoris->id }}">{{ $kategoris->kategori }}</option>
        @endforeach
      </select>
      <button type="submit" class="submit-btn">Submit</button>
    </form>
  </div>
</div>

<script>
  const judul_blog = document.querySelector('#judul_blog');
  const slug = document.querySelector('#slug');

  judul_blog.addEventListener('change', function(){
      fetch('/backoffice/blog/checkSlug?judul_blog=' + judul_blog.value)
      .then(response => response.json())
      .then(data =>  slug.value = data.slug)
  });
</script>

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