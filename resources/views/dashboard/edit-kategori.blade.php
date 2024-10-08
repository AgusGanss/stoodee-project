@extends('layouts.template')
@section('content')

<div class="container-fluid">
  <div class="form-container">
      <form class="elegant-form" action="{{ route('kategori.update',$kategori->id) }}" method="POST" enctype="multipart/form-data">
          @csrf
          <h2>Add Kategori</h2>
              <div class="form-group">
                  <label for="kategori">Kategori</label>
                  <input type="text" class="judul" id="kategori" name="kategori" required value="{{ old('kategori', $kategori->kategori) }}">
              </div>
              <div class="form-group">
                <label for="slug"></label>
                <input type="hidden" class="judul" id="slug" name="slug" value="{{ old('slug',$kategori->slug) }}" disabled readonly>
              </div>
          <button type="submit" class="submit-btn">Submit</button>
      </form>
  </div>
</div>

<script>
    const kategori = document.querySelector('#kategori');
    const slug = document.querySelector('#slug');

    kategori.addEventListener('change', function(){
        fetch('/backoffice/kategori/checkSlug?kategori=' + kategori.value)
        .then(response => response.json())
        .then(data =>  slug.value = data.slug)
    });
</script>
@endsection