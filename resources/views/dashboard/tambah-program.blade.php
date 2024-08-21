@extends('layouts.template')
@section('content')

<div class="container-fluid">
  <div class="form-container">
      <form class="elegant-form" action="{{ route('program.insert') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <h2>Add Program</h2>
          <div class="form-row">
              <div class="form-group image-input-group">
                  <label for="gambar_program">Gambar Program</label>
                  <input type="file" id="gambar_program" name="gambar_program" required>
                  <div class="image-preview" id="imagePreview">
                    <img src="#" alt="Image Preview" id="previewImage" style="display: none; " >
                  </div>
              </div>
              <div class="form-group">
                  <label for="judul_program">Judul</label>
                  <input type="text" class="judul" id="judul_program" name="judul_program" required value="{{ old('judul_program') }}">
              </div>
              <div class="form-group">
                <label for="judul_program"></label>
                <input type="hidden" class="judul" id="slug" name="slug" disabled readonly>
            </div>
          </div>
          <div class="form-group">
              <label for="deskripsi">Description</label>
              <textarea cols="80" id="ckeditor" name="deskripsi_program" class="deskripsi @error('deskripsi_program') is-invalid @enderror" rows="10" value="{{ old('deskripsi_program') }}"></textarea>
                    @error('deskripsi_program')
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
    const judul_program = document.querySelector('#judul_program');
    const slug = document.querySelector('#slug');

    judul_program.addEventListener('change', function(){
        fetch('/backoffice/program/checkSlug?judul_program=' + judul_program.value)
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