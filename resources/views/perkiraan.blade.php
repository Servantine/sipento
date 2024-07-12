<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Perkiraan</title>
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
                            <a class="nav-link active" aria-current="page" href="/perkiraan"><i class="bi bi-postcard-heart-fill"></i> Perkiraan</a>
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
            <div class="form-control">
                <form action="/simpanpembeli" method="POST" id="formpembeli">
                    @csrf
                    <br>
                    <h2> Perkiraan Penjualan </h2>
                    <br>
                    <b> Nama Barang </b>
                    <br>
                    <br>
                    <input type="text" class="form-control" name="namabarang" value="" required>
                    <br>
                    <b> Harga Beli Produk </b>
                    <br>
                    <br>
                    <input type="number" class="form-control" name="modal" value="" id="modal" required>
                    <br>
                    <b> Jumlah Produk </b>
                    <br>
                    <br>
                    <input type="number" class="form-control" name="isiproduk" value="" id="isiproduk" required>
                    <br>
                    <b> Harga Per Satuan Produk </b>
                    <br>
                    <br>
                    <input type="number" class="form-control" name="hargasatuanmodal" value="" id="hargasatuanmodal" readonly>
                    <br>
                    <br>
                    <b> Harga Jual Per Satuan Produk </b>
                    <br>
                    <br>
                    <input type="number" class="form-control" name="hargajual" value="" id="hargajual" required>
                    <br>
                    <br>
                    <b> Hasil Keuntungan </b>
                    <br>
                    <br>
                    <input type="number" class="form-control" name="hasilkeuntungan" value="" id="hasilkeuntungan" required>
                    <br>
                    <br>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('isiproduk').addEventListener('input', function() {
            var modal = parseFloat(document.getElementById('modal').value) || 0;
            var isiproduk = parseFloat(this.value) || 0;

            if (isiproduk > 0) {
                var hargasatuanmodal = modal / isiproduk;
                document.getElementById('hargasatuanmodal').value = hargasatuanmodal;
            } else {
                document.getElementById('hargasatuanmodal').value = 0;
            }
        });
    </script>
    <script>
        document.getElementById('hargajual').addEventListener('input', function() {
            var isiproduk = parseFloat(document.getElementById('isiproduk').value) || 0;
            var modal = parseFloat(document.getElementById('modal').value) || 0;
            var hargajual = parseFloat(document.getElementById('hargajual').value) || 0;

            if (hargajual > 0) {
                var mencarihargakeuntangkotor = isiproduk * hargajual;
                var mencarikeuntunganbersih = mencarihargakeuntangkotor - modal;
                document.getElementById('hasilkeuntungan').value = mencarikeuntunganbersih;
            } else {
                document.getElementById('hasilkeuntungan').value = 0;
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>