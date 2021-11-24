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
<div class="container mt-4 mb-4 d-flex justify-content-end">
    {{ $pasal->links() }}
  </div>
@endsection