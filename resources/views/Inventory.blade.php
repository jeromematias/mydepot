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
    <link rel="stylesheet" href="css/inventory.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,200,300,600" rel="stylesheet" type="text/css">
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
                    <a class="nav-link" href="{{ url('/') }}">Burger menu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/Sales') }}">Point of Sales</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ url('/Inventory') }}">Inventory</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Nav tabs -->
                <div class="card">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#sales" role="tab" aria-controls="sales">All time Sales</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#inventory" role="tab" aria-controls="profile">Inventory</a>
                        </li>                        
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="sales" role="tabpanel">
                        	<div class="row col-sm-12" id="panel">
                        		
                        	</div>
                        </div>
                        <div class="tab-pane" id="inventory" role="tabpanel">
                        	<div class="row col-sm-12" id="panel2"></div>
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
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
    <script type="text/javascript" src="js/SalesInventory.js"></script>
</body>

</html>