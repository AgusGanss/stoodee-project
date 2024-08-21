@extends('layouts.template')
@section('content')

<div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">MAIL</h1>
    @if($unreadCount > 0)
        <div class="badge badge-pill badge-danger">{{ $unreadCount }} new</div>
    @endif
</div>
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Program</th>
            <th>Pesan</th>
            <th>Status</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
  
        @php
          $no = 1;
        @endphp
  
        @forelse ($mail as $index => $mails)
        <tbody style="">
          <tr>
            <tr class="{{ $mails->is_read ? '' : 'table-warning' }}">
            <td data-label="No">{{ $mail->firstItem() + $index}}</td>
            <td data-label="">{{ $mails->name }}</td>
            <td data-label="">{{ $mails->email }}</td>
            <td data-label="">{{ $mails->phone }}</td>
            <td data-label="">{{ $mails->program->judul_program }}</td>
            <td data-label="">{{ $mails->pesan }}</td>
            <td>{{ $mails->is_read ? 'Read' : 'Unread' }}</td>
            <td>
              @if(!$mails->is_read)
                  <a href="{{ route('mail.markAsRead', $mails->id) }}" class="btn btn-sm btn-primary">Mark as Read</a>
              @endif
          </td>
          <td>
            <a href="#"onclick="comfirmDelete('{{ route('mail.delete', $mails->id) }}')" class="btn btn-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
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

      {{ $mail->links() }}
      Showing
      {{ $mail->firstItem() }}
      to
      {{ $mail->lastItem() }}
      of
      {{ $mail->total() }}
      entries
 
    </div>
  </div>
@endsection