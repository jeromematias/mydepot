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
    <link rel="stylesheet" type="text/css" href="css/jquery.numpad.css">

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
                    <a class="nav-link" href="{{ url('Sales') }}">Point of Sales</a>
                </li>                
            </ul>
        </div>
    </nav>

    <div class="container" id="main">
        <div class="row" id="main-row">
            <div class="col-sm-4">
            	<div class="col-sm-12" id="pendingpanel">
					<div class="modal-content">
			            <div class="modal-header">
			                <h5 class="modal-title">Purchased Items</h5>
			            </div>
			            <div class="modal-body" id="pendinglist">
			            
			            </div>
			            <div class="modal-footer">
			            	<label class="col-sm-6" id="Total-Price">Total Price : 0</label>
			            	<label class="col-sm-6" id="Total-Change">Change : 0</label>
			            </div>
			            <div class="modal-footer">
			                <div class="col-sm-12 btn-group">		                				                    
			                    <input type="text" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" id="PaymentCash" class="col-sm-6 form-control form-control-sm" placeholder="">
			                    <button type="button" class="col-sm-3 btn bg-gold" disabled data-id="add" id="BtnPurchase">PAYMENT</button>
			                    <button type="button" class="col-sm-3 btn bg-gold" data-id="remove" id="CancelPending">CANCEL</button>		                  
			                </div>                            
			            </div>
			        </div>
	            </div>
            </div>
            <div class="col-sm-8">
            	<div class="col-sm-12" id="productpanel">
            		<div class="modal-content">
			            <div class="modal-header">
			                <h5 class="modal-title">MENU</h5>
			                <div class="btn-group" data-toggle="buttons">			                	        								                    
			                    <button class="btn btn-primary" id="listtype" data-id="list">List</button>
			                    <button class="btn" id="listtype" data-id="tile">tile</button>
			                </div>
			            </div>
			            <div class="modal-body" id="productlist">
			              
			            </div>
			            <div class="modal-footer">
			                <div class="btn-group" data-toggle="buttons" id="Category">			                	        								                    
			                    <button type="button" class="btn btn-primary" data-id="" data-id="add" id="showbycategory">Show all</button>
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
    <script type="text/javascript" src="js/jquery.numpad.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script type="text/javascript" src="js/ie10-viewport-bug-workaround.js"></script>
    <!-- CHART JS -->
    <script type="text/javascript" src="js/echarts-all-3.js"></script>
    <script type="text/javascript" src="js/jquery.scannerdetection.js"></script>
    <!-- Burger Depot Custom js -->
    <script type="text/javascript" src="js/Sales.js"></script>
</body>

</html>