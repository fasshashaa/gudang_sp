<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Data Barang')</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        nav {
            background-color: #007BFF;
            padding: 1em;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        nav h1 {
            margin: 0;
            font-size: 1.5em;
        }
        nav form {
            margin: 0;
        }
        nav input[type="text"] {
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
        }
        nav button {
            padding: 5px 10px;
            margin-left: 5px;
            border: none;
            border-radius: 4px;
            background-color: #0056b3;
            color: white;
            cursor: pointer;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            margin: 20px 0;
        }
        table th, table td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }
        table th {
            background-color: #e9ecef;
        }
        .container {
            padding: 20px;
        }
    </style>
</head>
<body>
    <nav>
        <h1>Gudang Sparepart</h1>
        <form action="#" method="GET">
            <input type="text" name="search" placeholder="Cari barang...">
            
        </form>
    </nav>

    <div class="container">
        @yield('content')
    </div>
</body>
</html>
