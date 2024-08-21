@extends('layouts.template')
@section('content')

<div class="container-fluid">
  <div class="form-container">
      <form class="elegant-form" action="{{ route('review.update', $review->id) }}" method="POST" enctype="multipart/form-data">
          @csrf
          <h2>Edit Review</h2>
          <div class="form-row">
            <div class="form-group image-input-group">
                <label for="gambar_program">Profil Reviewer</label>
                <input type="file" id="gambar_program" name="profil">
                <div class="image-preview" id="imagePreview"  >
                  <img src="{{ asset('foto/' . $review->profil) }}" alt="Image Preview" id="previewImage" >
                </div>
            </div>
          </div>

          
          <div class="form-group">
            <label for="judul_program">Nama Reviewer</label>
            <input type="text" id="judul_program" name="nama" value="{{ $review->nama }}" required>
        </div>

          <div class="form-group">
              <label for="deskripsi">Review</label>
              <textarea cols="80" id="ckeditor" name="review"  class="@error('review') is-invalid @enderror" rows="10">{{ $review->review }}</textarea>
              @error('review')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
          @enderror
            </div>

          <div class="form-group rating-group">
            <label>Rating</label>
            <div class="star-rating">
                @for ($i = 5; $i >= 1; $i--)
            <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" 
                {{ (old('rating', $review->rating) == $i) ? 'checked' : '' }} required/>
            <label for="star{{ $i }}" title="{{ $i }} stars"><i class="fas fa-star"></i></label>
        @endfor
            </div>
        </div>


          <button type="submit" class="submit-btn">Submit</button>
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
@endsection
