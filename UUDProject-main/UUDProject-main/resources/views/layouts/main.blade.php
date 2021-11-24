
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">
    <script src="https://cdn.ckeditor.com/ckeditor5/31.0.0/classic/ckeditor.js"></script>
    <script src="/resources/views/ckeditor/ckeditor.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <title>Home | {{ $halaman }}</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
          <a class="navbar-brand" href="/" >Project UUD</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link {{ ($halaman === "pasal") ? 'active' : '' }}" aria-current="page" href="/">Daftar Pasal</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ ($halaman === "ayat") ? 'active' : '' }}" aria-current="page" href="/ayat">Daftar ayat</a>
              </li>
              <li class="nav-item">
                
                @if ( Session::get('access_token') != null)
                  @if ($halaman === 'ayat')
                  <a class="nav-link active" href="/addayatPage" >Tambah Ayat</a>
                  @elseif($halaman === 'pasal') 
                  <a class="nav-link active" href="/addpasalPage" >Tambah Pasal</a>    
                  @endif
                  
                @else 
                  <a class="nav-link active" href="/login" >Tambah Pasal</a>
                @endif
              </li>
            </ul>
            @if ($halaman === 'pasal')
            <form class="d-flex ms-auto" action="/">
              <input class="form-control me-2" type="search" name="search" placeholder="pasal, bab, judul bab" aria-label="Search" value="{{ request('search') }}">
              <button class="btn btn-outline-primary me-5" type="submit">Search</button>
            </form>
            @elseif($halaman === 'ayat')
            <form class="d-flex ms-auto" action="/ayat">
              <input class="form-control me-2" type="search" name="search" placeholder="pasal, ayat, bunyi" aria-label="Search" value="{{ request('search') }}">
              <button class="btn btn-outline-primary me-5" type="submit">Search</button>
            </form>
            @endif
            @if ( Session::get('access_token') != null)
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="/logout" class="nav-link" ><i class="bi bi-box-arrow-right me-1"></i>Logout</a>
                </li>
            </ul>
            @else
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="/login" class="nav-link" ><i class="bi bi-box-arrow-in-right me-1"></i>Login</a>
                </li>
            </ul>
                
            @endif
            
          </div>
        </div>
      </nav>
      <main class="container mt-4 mb-4">
          @yield('container')
      </main>
      
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>