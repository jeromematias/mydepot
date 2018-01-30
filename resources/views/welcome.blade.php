<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../favicon.ico">

    <title>Spot Dashboard</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-multiselect.css" rel="stylesheet">
    <link href="css/font-awesome.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->    
    <!--<link href="https://fonts.googleapis.com/css?family=Raleway:100,200,300,600" rel="stylesheet" type="text/css">-->
    <style>
      body{
        font-family: 'Raleway', sans-serif;
        font-weight: 300;
      }
      nav{
        border-bottom: 1px solid #eee
      }
      nav select{
        cursor: pointer;
      }
      nav select, nav select option{
        font-weight: 300;
      }
      .container{
        font-size: 14px;
        padding : 15px;
      }
      .nav-item{
        padding: 0 5px 0 5px;
      }
      .nav-item select{
        text-align: center;
      }      
      #section1{
        padding: 0 10px 15px 10px;
        min-height: 350px;
      }
      .card{
        border: 1px solid #eee;
      }
      #section1 #wrap{
        padding: 15px;  
      }
      #section1 #wrap .card-body{
        height: 90%
      }
      #section2 .row{
        padding: 0 10px 15px 10px;
      }
      #section2 .card{
        height: 300px;
        padding: 15px;
      }
      #section2 .card .card-body{
        height: 95%
      }
      #switch{

      }
      #switch i{
        color : green;
        font-size: 38px;
        vertical-align: middle;
      }
      #main #section1 div, #section2 .row div{
        -webkit-transition: all 0.5s ease;
           -moz-transition: all 0.5s ease;
             -o-transition: all 0.5s ease;
                transition: all 0.5s ease;
      }
      #swtich-fluid{
        cursor: pointer;
      }
    </style>
  </head>

  <body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-light bg-white">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample08" aria-controls="navbarsExample08" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse justify-content-md-center" id="navbarsExample08">
        <ul class="navbar-nav">
          <li class="nav-item">
            <select id="unittype" name="unittype" class="form-control input-sm">
              <option value="1">Period</option>
              <option value="1">000</option>
              <option value="2">TRP</option>
              <option value="3">Share</option>
              <option value="4">Reach000</option>
              <option value="5">Reach%</option>
            </select>
          </li>
          <li class="nav-item">
            <select id="unittype" name="unittype" class="form-control input-sm">
              <option value="1">View</option>
              <option value="1">000</option>
              <option value="2">TRP</option>
              <option value="3">Share</option>
              <option value="4">Reach000</option>
              <option value="5">Reach%</option>
            </select>
          </li>
          <li class="nav-item">
            <select id="unittype" name="unittype" class="form-control input-sm">
              <option value="1">Filter</option>
              <option value="1">000</option>
              <option value="2">TRP</option>
              <option value="3">Share</option>
              <option value="4">Reach000</option>
              <option value="5">Reach%</option>
            </select>
          </li>
          <li class="nav-item">
            <select id="unittype" name="unittype" class="form-control input-sm"">
              <option value="1">Unit</option>
              <option value="1">000</option>
              <option value="2">TRP</option>
              <option value="3">Share</option>
              <option value="4">Reach000</option>
              <option value="5">Reach%</option>
            </select>
          </li>
          <li class="nav-item">
            <select id="unittype" name="unittype" class="form-control input-sm">
              <option value="1">data-target</option>
              <option value="1">000</option>
              <option value="2">TRP</option>
              <option value="3">Share</option>
              <option value="4">Reach000</option>
              <option value="5">Reach%</option>
            </select>
          </li>
          <li class="nav-item" id="switch">
            <i class="fa fa-toggle-off" id="swtich-fluid" aria-hidden="true"></i> fluid Off
          </li>             
        </ul>
      </div>
    </nav>

    <div class="container" id="main">
      <div class="row" id="section1">
        <div class="col-sm-12 bg-white card" id="wrap">
          <div class="card-title">flight Chart</div>
          <div class="card-body" id="initchart"></div>                  
        </div>          
      </div>
      <div class="row" id="section2">
        <div class="col-sm-3">
          <div class="col-sm-12 bg-white card">
            <div class="card-title">Distribution  [default is split by week]</div>
            <div class="card-body" id="init_GRP"></div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="row">
            <div class="col-sm-12 bg-white card">
              <div class="card-title">Benchmark</div>
              <div class="card-body" id="init_NegBar"></div>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="row">
            <div class="col-sm-12 bg-white card">
              <div class="card-title">Share</div>
              <div class="card-body" id="init_PIE"></div>
            </div>
          </div>
        </div>
      </div>  
    </div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery-slim.min.js"></script>
    <script src="js/jquery.min.js"></script>      
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-multiselect.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
    <script src="js/echarts-all-3.js"></script>
    <script src="js/spotdash.js"></script>
  </body>
</html>
