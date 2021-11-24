@extends('layouts.main')
@section('container')

<h1>Edit Pasal</h1>
<form action="{{ url('/editPasal/'.$pasal->id) }}" method="POST">
  @csrf
  @method('PUT')
    <div class="form-floating mb-3">
      <input type="text" value="{{ $pasal->pasal }}" name="pasal" class="form-control" id="pasal" placeholder="pasal" required  @error('pasal') is-invalid @enderror>
      <label for="pasal">Pasal</label>
    </div>
    @error('pasal')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
  
    <div class="form-floating mb-3">
        <input type="text" value="{{ $pasal->bab }}" name="bab" class="form-control" id="bab" placeholder="bab" required  @error('bab') is-invalid @enderror>
        <label for="bab">Bab</label>
      </div>
      @error('bab')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror
      
      <div class="form-floating mb-3">
        <input type="text" value="{{ $pasal->judul_bab }}" name="judul_bab" class="form-control" id="judul_bab" placeholder="judul_bab" required  @error('judul_bab') is-invalid @enderror>
        <label for="judul_bab">Judul Bab</label>
      </div>
      @error('judul_bab')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror
      <div class="col-auto mb-5">
        <button type="submit" class="btn btn-primary">Edit Pasal</button>
      </div>
    
</form>
@endsection