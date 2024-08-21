@extends('layouts.template')
@section('content')

<div class="container-fluid">
  <div class="form-container">
      <form class="elegant-form" action="{{ route('review.insert') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <h2>Add Review</h2>
          <div class="form-row">
              <div class="form-group image-input-group">
                  <label for="gambar_program">Profil Reviewer</label>
                  <input type="file" id="gambar_program" name="profil" required>
                  <div class="image-preview" id="imagePreview">
                    <img src="#" alt="Image Preview" id="previewImage" style="display: none; " >
                  </div>
              </div>
          </div>

          
          <div class="form-group">
            <label for="judul_program">Nama Reviewer</label>
            <input type="text" id="judul_program" name="nama" value="{{ old('nama') }}" required>
        </div>

          <div class="form-group">
              <label for="deskripsi">Review</label>
              <textarea cols="80" id="ckeditor" class="@error('review') is-invalid @enderror" name="review" value="{{ old('review') }}"></textarea>
              @error('review')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
          @enderror
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
