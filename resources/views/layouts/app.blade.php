<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gudang Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #f8f9fa;">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="#">Gudang Sparepart</a>
            <form class="d-flex ms-auto" role="search">
                <input class="form-control me-2" type="search" placeholder="Cari Barang" aria-label="Search">
                <button class="btn btn-outline-light" type="submit">Cari</button>
            </form>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>

</body>
</html>
