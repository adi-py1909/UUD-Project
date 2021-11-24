@extends('layouts.main')
@section('container')
<div>
  @php
  $halaman = "Detail Ayat";
@endphp
    <div class="card mb-3" style="max-height: 100%;">
        <div class="row g-0">
          <div class="col-md-8">
            <div class="card-body">
              <h2 class="card-title">Pasal {{ $data->pasal }}</h2>
        
              <p>Ayat : {{ $data->ayat }}</p>
              <span> Bunyi : </span>
              <p class="card-title"> @php
                  echo $data->bunyi
              @endphp  </p>
              <p class="card-text"><small class="text-muted">Last updated at {{ $data->updated_at }}</small></p>
              <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                @if ( Session::get('access_token') != null)
                  <a class="btn btn-primary" href="{{ url('editAyat') }}/{{ $data->id }}" class="btn btn-primary">Edit Ayat</a>
              @else
                  <a class="btn btn-primary" href="/login" >Edit Ayat</a>
              @endif
                @if (Session::get('access_token') != null)
                <form method="POST" class="justify-content-md-end" action="/deleteAyat/{{ $data->id }}">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger"onclick="return confirm('yakin?');">Delete</button>
                </form>
                @else
                    <a class="btn btn-danger" href="/login" >Delete</a>
                @endif
            </div>
            </div>
            
          </div>
        
        </div>
      </div>
      <div class="container">
        <div class="row justify-content-left">
          <h5>Daftar Pasal : </h5>
          @foreach($pasal as $data)
        <div class="col-md-3">
            <div class="card mb-4">
              <div class="card-body">
                <h5 class="card-title">Pasal : {{$data->pasal}}</h5>
                <p class="card-title">Bab : {{ $data->bab }}</p>
                <p class="card-title">Judul Bab : {{ $data->judul_bab }}</p>
                <div class="d-grid gap-2 mx-auto">
                  
               <a href="{{ url('detailPasal') }}/{{ $data->id }}" class="btn btn-primary">Lihat Detail</a> 
                @if ( Session::get('access_token') != null)
                  <a class="btn btn-primary" href="{{ url('editPasal') }}/{{ $data->id }}" class="btn btn-primary">Edit Pasal</a>
              @else
                  <a class="btn btn-primary" href="/login" >Edit Pasal</a>
              @endif
                </div>
                @if (Session::get('access_token') != null)
                <form method="POST" class="justify-content-md-end mt-2" action="/deletePasal/{{ $data->id }}">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger"onclick="return confirm('yakin?');">Delete</button>
                </form>
                @else
                    <a class="btn btn-danger mt-2" href="/login" >Delete</a>
                @endif
              </div>
            </div>
            </div>
        @endforeach
        </div>
        </div>
</div>
@endsection
