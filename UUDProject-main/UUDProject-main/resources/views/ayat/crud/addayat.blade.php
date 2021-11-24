@extends('layouts.main')
@section('container')

<h1>Tambah Ayat</h1>
<form action="/storeAyat" method="POST">
  @csrf
    <div class="form-floating mb-3">
      <input type="text" name="pasal" class="form-control" id="pasal" placeholder="pasal" required  @error('pasal') is-invalid @enderror>
      <label for="pasal">Pasal</label>
    </div>
    @error('pasal')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
  
    <div class="form-floating mb-3">
        <input type="text" name="ayat" class="form-control" id="ayat" placeholder="ayat" required  @error('ayat') is-invalid @enderror>
        <label for="ayat">Ayat</label>
      </div>
      @error('ayat')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror
      
      <div class="form-floating mb-3">
        <input type="text" name="bunyi" class="form-control" id="bunyi" placeholder="bunyi" required  @error('bunyi') is-invalid @enderror>
        <label for="bunyi">Bunyi</label>
      </div>
      @error('bunyi')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror
      <div class="col-auto mb-5">
        <button type="submit" class="btn btn-primary">Tambah Ayat</button>
      </div>
    
</form>
@endsection