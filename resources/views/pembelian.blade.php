<!DOCTYPE html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Daftar Pembelian</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.2/font/bootstrap-icons.min.css">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
      <script src="https://cdn.jsdelivr.net/npm/html5shiv@3.7.3/dist/html5shiv.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/respond.js@1.4.2/dest/respond.min.js"></script>
    <![endif]-->
</head>

<body>
  <nav class="navbar navbar-light bg-light fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"><b> Sipento </h1></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasLightNavbar" aria-controls="offcanvasLightNavbar" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="offcanvas offcanvas-end text-bg-Light" tabindex="-1" id="offcanvasLightNavbar" aria-labelledby="offcanvasLightNavbarLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasLightNavbarLabel">Daftar Menu</h5>
          <button type="button" class="btn-close btn-close-black" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
            <li class="nav-item">
              <a class="nav-link" href="/dashboard"><i class="bi bi-house-add-fill"></i> Beranda</a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="/barang"><i class="bi bi-bag-heart-fill"></i> Barang</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/pembeli"><i class="bi bi-person-fill"></i> Pembeli</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/bond"><i class="bi bi-piggy-bank-fill"></i> Bond</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="/pembelian"><i class="bi bi-basket-fill"></i> Pembelian</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/perkiraan"><i class="bi bi-postcard-heart-fill"></i> Perkiraan</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/logout"><i class="bi bi-door-closed-fill"></i> Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
  <br>
  <br>
  <br>
  <div class="info">
    <div class="content">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
      <a href="/buatpembelian"> <button class="btn btn-info"> Buat Baru</button> </a>
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">No </th>
            <th scope="col">Nama Barang </th>
            <th scope="col">Jumlah Barang </th>
            <th scope="col">Total </th>
          </tr>
        </thead>
        <tbody>
          @foreach ($pembelian as $no => $u)
          <tr>
            <th scope="row">{{ $pembelian->firstitem() + $no }}</th>
            <td>{{ $u->namabarang }}</td>
            <td>{{ $u->jumlahbarang }}</td>
            <td>{{ $u->total }}</td>
            <td>
              <form action="{{ route('pembelian.destroy', $u->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Hapus</button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>