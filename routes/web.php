<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::group(['middleware' => 'auth'], function(){
	Route::get('/burgerdepot','BurgerDepotController@GetMenu');
	Route::get('/Sales',function(){
		return view('Sales');
	});
	Route::get('/Inventory',function(){
		return view('Inventory');
	});
	//Route::get('/GetMenu','BurgerDepotController@GetMenu');
	Route::post('/burgerdepot/Addingredients','BurgerDepotController@Addingredients');
	Route::get('/burgerdepot/GetIngredients','BurgerDepotController@GetIngredients');
	Route::get('/burgerdepot/CountIngredients','BurgerDepotController@CountIngredients');
	Route::post('/burgerdepot/SaveDrinks','BurgerDepotController@SaveDrinks');
	Route::get('/burgerdepot/drinks','BurgerDepotController@drinks');
	Route::get('/burgerdepot/getCategory','BurgerDepotController@getCategory');
	Route::post('/burgerdepot/SaveCategory','BurgerDepotController@SaveCategory');
	Route::post('/burgerdepot/updateCategory','BurgerDepotController@updateCategory');
	Route::post('/burgerdepot/UpdateDrinks','BurgerDepotController@UpdateDrinks');
	Route::post('/burgerdepot/UpdateIngredients','BurgerDepotController@UpdateIngredients');
	Route::get('/burgerdepot/checkAvailableStocks','BurgerDepotController@checkAvailableStocks');
	Route::post('/burgerdepot/NewMenu','BurgerDepotController@NewMenu');
	Route::get('/burgerdepot/GetMenu','BurgerDepotController@SpotGetMenu');
	Route::get('/burgerdepot/testMenu','BurgerDepotController@testMenu');
	Route::get('/burgerdepot/GetMenuIngredients','BurgerDepotController@GetMenuIngredients');
	Route::get('/burgerdepot/UpdateMenu','BurgerDepotController@UpdateMenu');
	Route::get('/burgerdepot/GetTblItems','BurgerDepotController@GetTblItems');
	Route::post('/burgerdepot/updateStocks','BurgerDepotController@updateStocks');
	Route::get('/burgerdepot/stocklist','BurgerDepotController@stocklist');	
	Route::get('/Inventory/GetSales','BurgerDepotController@GetSales');
	Route::get('Inventory/GetIngredientsInventory','BurgerDepotController@GetIngredientsInventory');
	Route::get('burgerdepot/GetIngredientsInventory','BurgerDepotController@GetIngredientsInventory');
	Route::get('burgerdepot/GetPurchaseLogs','BurgerDepotController@GetPurchaseLogs');
	Route::get('/burgerdepot/Stockinout','BurgerDepotController@stockinout');
	Route::get('/burgerdepot/SalesInventory','BurgerDepotController@SalesInventory');	

});

Route::get('/Sales/getCategory','BurgerDepotController@getCategory');
Route::get('/Sales/SalesMenu','BurgerDepotController@SalesMenu');
Route::get('/Sales/GetMenuIngredients','BurgerDepotController@GetMenuIngredients');
Route::get('/Sales/checkStocks','BurgerDepotController@checkStocks');
Route::get('/Sales/test','BurgerDepotController@test');
Route::get('/Sales/pendinglist','BurgerDepotController@pendinglist');
Route::get('/Sales/addpendingitem','BurgerDepotController@addpendingitem');
Route::get('/Sales/PurchaseItems','BurgerDepotController@PurchaseItems');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
