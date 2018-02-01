<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Escpos;
use WindowsPrintConnector;

class escposController extends Controller
{
    public function PrintReciept(Request $r){      
      $printer = new Escpos();
      $printer -> text("Hello World!\n");
      $printer -> cut();
      $printer -> close();
    }
}
