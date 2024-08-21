@extends('layouts.template')
@section('content')

<div class="container-fluid">
    <div class="table-responsive">
      <table class="table">
        <h1>Review</h1>
        <thead>
          <a href="{{ route('review.tambah') }}" class="btn btn-add">Add Data <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-square" viewBox="0 0 16 16">
            <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
          </svg></a>

          <div class="search">
            <div class="input-group">
              <form action="{{ route('review') }}" method="GET" class="search-form">
                <input type="search" class="form-control form-control-sm" placeholder="Search..." name="search" value="{{ $search ?? '' }}">
                <div class="input-group-append">
                    <button type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                        </svg>
                    </button>
                </div>
              </form>
            </div>
          </div>

          <tr>
            <th>No</th>
            <th>Profil</th>
            <th>Nama</th>
            <th>Review</th>
            <th>Rating</th>
            <th>Aksi</th>
          </tr>
        </thead>
  
        @php
          $no = 1;
        @endphp
  
        @forelse ($review as $index => $reviews)
        <tbody>
          <tr>
            <td data-label="No">{{  $review->firstItem() + $index }}</td>
            <td data-label="">
              <img src="{{ asset('foto/' . $reviews->profil) }}" alt="" height="100px">
            </td>
            <td data-label="Deskripsi">{!! highlightWords($reviews->nama , $search)  !!}</td>
            <td data-label="Deskripsi">{!! highlightWords(strip_tags($reviews->review), $search) !!}</td>
            <td data-label="Rating" class="description-cell">
              @for($i = 1; $i <= 5; $i++)
                  @if($i <= $reviews->rating)
                      <i class="fas fa-star text-warning"></i>
                  @else
                      <i class=""></i>
                  @endif
              @endfor

            </td>




            <td data-label="Aksi" class="action-buttons">
              <a href="{{ route('review.edit', $reviews->id) }}" class="btn btn-edit">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                </svg>
                Edit
              </a>



              <a href="#"onclick="comfirmDelete('{{ route('review.delete', $reviews->id) }}')" class="btn btn-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                  <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                </svg>
                Delete
              </a>
            </td>
          </tr>
        </tbody>
        @empty
        <tr>
          <td colspan="4">No results found.</td>
        </tr>
        @endforelse
      </table>

      
      {{ $review->links() }}
      Showing
      {{ $review->firstItem() }}
      to
      {{ $review->lastItem() }}
      of
      {{ $review->total() }}
      entries
 
    </div>
  </div>
@endsection