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
    <!-- <link href="css/style.css" rel="stylesheet"> -->
    <link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap4.min.css">
    <link href="css/bootstrap-multiselect.css" rel="stylesheet">
    <link href="css/font-awesome.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="css/BurgerDepot.css">
</head>

<body class="bg-light">
    <div class='progress' id="progress_div">
      <div class='bar' id='bar1'></div>
      <div class='percent' id='percent1'></div>
    </div>
    <input type="hidden" id="progress_width" value="0">
    <nav class="navbar navbar-expand-lg navbar-light bg-gold fixed-top">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample10" aria-controls="navbarsExample10" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExample10">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href=""><i class="fa fa-database" id="swtich-fluid" aria-hidden="true"></i> BURGER DEPOT <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{ url('') }}">Burger menu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('Sales') }}">Point of Sales</a>
                </li>
                <!--<li class="nav-item">
                    <a class="nav-link" href="{{ url('Inventory') }}">Inventory</a>
                </li>-->
                <li class="nav-item">
                    <a class="nav-link" id="ShowStocksModal">Stocks</a>
                </li>
                <!--
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown10" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown10">
                        <a class="dropdown-item" href="#">Update item</a>
                        <a class="dropdown-item" href="#">Delete item</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
                -->
            </ul>
        </div>
    </nav>

    <div class="container-fluid" id="main">
        <div class="row" id="main-row">
            <div class="col-sm-12 card" id="main-card">
                <div class="col-sm-12" id="Burger-Panel">
                    <div class="card-body">
                        {!!csrf_field()!!}
                        <div class="row" id="rowpanel">
                            <div class="col-sm-5" id="mainpanel">
                                <div class="form-group">
                                    @include('BurgerForm')
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-md bg-gold text-dark" id="SubmitMenu">Save Menu</button>
                                                <button type="button" class="btn btn-md btn-default text-dark" id="CancelNemu">Cancel</button>
                                                <button type="button" class="btn btn-md btn-default text-dark" id="ScrollUp">Back to Top</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-7" id="MenuSection">
                                <div class="table-responsive">
                                    @include('menu')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('modal')
    @include('stockmodal')
    <script type="text/javascript" src="js/jquery-slim.min.js"></script>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/bootbox.min.js"></script>
    <script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="js/bootstrap-multiselect.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script type="text/javascript" src="js/ie10-viewport-bug-workaround.js"></script>
    <!-- CHART JS -->
    <script type="text/javascript" src="js/echarts-all-3.js"></script>
    <script type="text/javascript" src="js/jquery.scannerdetection.js"></script>
    <script type="text/javascript" src="js/jQuery.print.js"></script>
    <!-- Burger Depot Custom js -->
    <script type="text/javascript" src="js/BurgerDepot.js"></script>
    <script type="text/javascript" src="js/stocks.js"></script>
</body>

</html>