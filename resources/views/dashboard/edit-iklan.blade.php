@extends('layouts.template')
@section('content')

<style>
  .container-fluid {
      background-color: #f5f5f5;
      padding: 20px 10px;
  }
  
  /* ... (other existing styles) ... */
  
  /* New styles for the status switch */
  .status-switch {
      margin-top: 20px;
      display: flex;
      align-items: center;
      justify-content: flex-start;
  }
  
  .status-switch input[type="checkbox"] {
      display: none;
  }
  
  .switch-label {
      position: relative;
      display: inline-block;
      width: 100px;
      height: 34px;
      background-color: #ccc;
      border-radius: 34px;
      transition: background-color 0.3s;
      cursor: pointer;
  }
  
  .switch-inner {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      border-radius: 34px;
      transition: all 0.3s;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 5px;
      box-sizing: border-box;
  }
  
  .switch-active,
  .switch-inactive {
      color: white;
      font-size: 12px;
      font-weight: bold;
      text-transform: uppercase;
  }
  
  .switch-active {
      padding-left: 5px;
      display: none;
  }
  
  .switch-inactive {
      margin-left: 30px;
  }
  
  .switch-handle {
      position: absolute;
      top: 2px;
      left: 2px;
      width: 30px;
      height: 30px;
      background-color: white;
      border-radius: 50%;
      transition: all 0.3s;
  }
  
  .status-switch input[type="checkbox"]:checked + .switch-label {
      background-color: #4CAF50;
  }
  
  .status-switch input[type="checkbox"]:checked + .switch-label .switch-inner .switch-active {
      display: block;
  }
  
  .status-switch input[type="checkbox"]:checked + .switch-label .switch-inner .switch-inactive {
      display: none;
  }
  
  .status-switch input[type="checkbox"]:checked + .switch-label .switch-handle {
      left: calc(100% - 32px);
  }
  
  .status-label {
      margin-left: 10px;
      font-weight: bold;
      color: #333;
  }
  </style>
<div class="container-fluid">
  <div class="form-container">
    <form class="elegant-form" action="{{ route('iklan.update', $iklan->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      <h2>Edit Iklan Depan</h2>
          <div class="form-row">
              <div class="form-group image-input-group">
                  <label for="gambar_program">Image Iklan</label>
                  <input type="file" id="gambar_program" name="iklan_image">
                  <div class="image-preview" id="imagePreview"  >
                    <img src="{{ asset('foto/' . $iklan->iklan_image) }}" alt="Image Preview" id="previewImage" >
                  </div>
                  IMAGE: 600x360
              </div>
              <div class="form-group">
                <label for="deskripsi">Text Iklan</label>
                <textarea cols="80" id="ckeditor" name="text_iklan" class="deskripsi @error('text_iklan') is-invalid @enderror" rows="10" value="{{ old('text_iklan') }}" required>{{ $iklan->text_iklan }}</textarea>
                      @error('text_iklan')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
              @enderror
            </div>
  
            <div class="form-group">
              <label for="deskripsi">Link</label>
              <input type="text" name="link" class="deskripsi @error('link') is-invalid @enderror" value="{{ old('link',$iklan->link) }}">
                    @error('link')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
          </div>

          <div class="status-switch">
            <input type="checkbox" id="statusSwitch" name="status" {{ old('status',isset($iklan) ? $iklan->status : '') == 'active' ? 'checked' : '' }}>
            <label for="statusSwitch" class="switch-label">
                <span class="switch-inner">
                    <span class="switch-active">Active</span>
                    <span class="switch-inactive">Inactive</span>
                </span>
                <span class="switch-handle"></span>
            </label>
            <span class="status-label">Status</span>
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