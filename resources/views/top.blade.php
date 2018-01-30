<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Burger Depot</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap4.min.css">
    <link href="css/bootstrap-multiselect.css" rel="stylesheet">
    <link href="css/font-awesome.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="css/BurgerDepot.css">
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-light bg-gold fixed-top">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample10" aria-controls="navbarsExample10" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExample10">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href=""><i class="fa fa-database" id="swtich-fluid" aria-hidden="true"></i> BURGER DEPOT <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="http://localhost/BurgerDepot/public/">Burger menu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="http://localhost/BurgerDepot/public/Sales">Point of Sales</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="http://localhost/BurgerDepot/public/Inventory">Inventory</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="ShowStocksModal">Stocks</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown10" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown10">
                        <a class="dropdown-item" href="#">Update item</a>
                        <a class="dropdown-item" href="#">Delete item</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container" id="main">
        <div class="row" id="main-row">
            