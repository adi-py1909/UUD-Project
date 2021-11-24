@extends('layouts.main')
@section('container')
@if (session()->has('statusSuccess'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('statusSuccess') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>  
@elseif (session()->has('statusError'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('statusError') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>  
    
@endif
<div class="container">
    <div class="row justify-content-left">
        @foreach($ayat as $data)
        <div class="col-md-3">
            <div class="card mb-4">
              <div class="card-body">
                <h5 class="card-title">Pasal : {{$data->pasal}}</h5>
                <p class="card-title">Ayat : {{ $data->ayat }}</p>
                <p class="card-title">Bunyi : {{ Str::limit($data->bunyi, 50) }}</p>
                <div class="d-grid gap-2 mx-auto">
                  
                <a href="{{ url('detailAyat') }}/{{ $data->id }}" class="btn btn-primary">Lihat Detail</a>
                @if ( Session::get('access_token') != null)
                  <a class="btn btn-primary" href="{{ url('editAyat') }}/{{ $data->id }}" class="btn btn-primary">Edit Ayat</a>
              @else
                  <a class="btn btn-primary" href="/login" >Edit Ayat</a>
              @endif
                </div>
                @if (Session::get('access_token') != null)
                <form method="POST" class="justify-content-md-end mt-2" action="/deleteAyat/{{ $data->id }}">
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
<div class="container mt-4 mb-4 d-flex justify-content-end">
    {{ $ayat->links() }}
  </div>
@endsection