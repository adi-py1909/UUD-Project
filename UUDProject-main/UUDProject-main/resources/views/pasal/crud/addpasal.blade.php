@extends('layouts.main')
@section('container')

<h1>Tambah Pasal</h1>
<form action="/storePasal"  method="POST">
  @csrf
    <div class="form-floating mb-3">
      <input type="text" name="pasal" class="form-control" id="pasal" placeholder="pasal" required  @error('pasal') is-invalid @enderror>
      <label for="pasal">Pasal</label>
    </div>
    @error('pasal')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
  
    <div class="form-floating mb-3">
        <input type="text" name="bab" class="form-control" id="bab" placeholder="bab" required  @error('bab') is-invalid @enderror>
        <label for="bab">Bab</label>
      </div>
      @error('bab')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror
      
      <div class="form-floating mb-3">
        <input type="text" name="judul_bab" class="form-control" id="judul_bab" placeholder="judul_bab" required  @error('judul_bab') is-invalid @enderror>
        <label for="judul_bab">Judul Bab</label>
      </div>
      @error('judul_bab')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror
      <div class="col-auto mb-5">
        <button type="submit" class="btn btn-primary">Tambah Pasal</button>
      </div>
    
</form>
@endsection