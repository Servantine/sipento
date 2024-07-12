<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Buat Bond</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.2/font/bootstrap-icons.min.css">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />
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
                            <a class="nav-link active" aria-current="page" href="/pembeli"><i class="bi bi-person-fill"></i> Pembeli</a>
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
    <div class="info">
        <div class="content">
            <div class="form-control">
                <form action="/simpanbond" method="POST" id="formpembeli">
                    @csrf
                    <br>
                    <h2> Detail Bond </h2>
                    <br>
                    <b> Nama Pembeli </b>
                    <br>
                    <br>
                    <select class="form-select" id="pembeli" name ="namapembeli" aria-label="Default select example">
                        <option value="" selected></option>
                        @foreach($pembeli as $pembelis)
                        <option value="{{  $pembelis->namapembeli }}">{{ $pembelis->namapembeli }}</option>
                        @endforeach
                    </select>
                    <br>
                    <br>
                    <b> Daftar Barang </b>
                    <br>
                    <br>
                    <select class="form-select" id="barang" name="namabarang" aria-label="Default select example">
                        @foreach($barang as $barangs)
                        <option value="{{ $barangs->namabarang }}" data-harga="{{ $barangs->harga }}">{{ $barangs->namabarang }}</option>
                        @endforeach
                    </select>
                    <br>
                    <b> Jumlah Barang </b>
                    <br>
                    <br>
                    <input type="number" class="form-control" name="jumlahbarang" value="" id="jumlah" required>
                    <br>
                    <br>
                    <b> Total Harga Barang </b>
                    <input type="text" id="total_harga" name="bond" class="form-control" readonly>
                    <br>
                    <br>
                    <button class="btn btn-info" type="submit">Simpan</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
                    $('#pembeli').select2({
                        placeholder: 'Pilih Nama Pembeli',
                        allowClear: true
                    });
                });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const jumlahInput = document.getElementById('jumlah');
            const barangSelect = document.getElementById('barang');
            const totalHargaInput = document.getElementById('total_harga');

            function updateTotalHarga() {
                const selectedOption = barangSelect.options[barangSelect.selectedIndex];
                const harga = selectedOption.getAttribute('data-harga');
                const jumlah = jumlahInput.value;
                const totalHarga = harga * jumlah;
                totalHargaInput.value = totalHarga;
            }

            jumlahInput.addEventListener('input', updateTotalHarga);
            barangSelect.addEventListener('change', updateTotalHarga);
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>