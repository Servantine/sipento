<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Selamat datang SIPENTO</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.2/font/bootstrap-icons.min.css">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://cdn.jsdelivr.net/npm/html5shiv@3.7.3/dist/html5shiv.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/respond.js@1.4.2/dest/respond.min.js"></script>
    <![endif]-->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
            <a class="nav-link active" aria-current="page" href="/dashboard"><i class="bi bi-house-add-fill"></i> Beranda</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/barang"><i class="bi bi-bag-heart-fill"></i> Barang</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/pembeli"><i class="bi bi-person-fill"></i> Pembeli</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/bond"><i class="bi bi-piggy-bank-fill"></i> Bond</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/pembelian"><i class="bi bi-basket-fill"></i> Pembelian</a>
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
<div class="card">
  <div class="card-header">
    Pendapatan Bulan ini
  </div>
  <div class="card-body">
  <canvas id="julyPurchasesChart" width="400" height="200"></canvas>
  </div>
</div>
<br>
<div class="card">
  <div class="card-header">
    Daftar Bond
  </div>
  <div class="card-body">
  <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">No </th>
            <th scope="col">Nama Pembeli </th>
            <th scope="col">Nama Barang </th>
            <th scope="col">Jumlah barang </th>
            <th scope="col">Bond </th>
            <th scope="col">Status </th>
            
          </tr>
        </thead>
        <tbody>
          @foreach ($bond as $no => $u)
          <tr>
            <th scope="row">{{ $bond->firstitem() + $no }}</th>
            <td>{{ $u->namapembeli }}</td>
            <td>{{ $u->namabarang }}</td>
            <td>{{ $u->jumlahbarang }}</td>
            <td>{{ $u->bond }}</td>
            <td>{{ $u->status }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
  </div>
</div>
<br>
<div class="card">
  <div class="card-header">
    Daftar Barang Habis
  </div>
  <div class="card-body">
  <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">No </th>
            <th scope="col">Nama Barang </th>
            <th scope="col">Stok </th>
            <th scope="col">Harga </th>
          </tr>
        </thead>
        <tbody>
          @foreach ($barang as $no => $u)
          <tr>
            <th scope="row">{{ $barang->firstitem() + $no }}</th>
            <td>{{ $u->namabarang }}</td>
            <td>{{ $u->stok }}</td>
            <td>{{ $u->harga }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
  </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch("{{ route('july.purchases') }}")
                .then(response => response.json())
                .then(data => {
                    const labels = data.map(item => item.date);
                    const totals = data.map(item => item.total);

                    const ctx = document.getElementById('julyPurchasesChart').getContext('2d');
                    new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Pendapatan bulan Juli',
                                data: totals,
                                borderColor: 'rgba(75, 192, 192, 1)',
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                });
        });
    </script>
</body>

</html>