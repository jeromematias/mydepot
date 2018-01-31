<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class BurgerDepotController extends Controller
{   
    public function GetPurchaseLogs(){
        $GetPurchaseLogs = DB::table('tbl_order_num')
            ->select(DB::raw('tbl_order_num.order_id, tbl_order_num.menu_id, tbl_menu.name, tbl_order_num.TotalPrice, tbl_order_num.CustomerCash, tbl_order_num.Change, tbl_order_num.purchasedate, tbl_order_num.quantity'))
            ->join('tbl_menu', 'tbl_menu.menu_id', '=', 'tbl_order_num.menu_id')            
            ->orderBy('tbl_order_num.order_id','DESC')
            ->get();
        return response($GetPurchaseLogs);
    }
    public function GetIngredientsInventory(){
        $GetIngredientsInventory = DB::table('tbl_stocks')
            ->select(DB::raw('tbl_items.item_name, tbl_purchase_item.item_id, IFNULL(SUM(tbl_purchase_item.quantity), 0) as soldquantity, tbl_stocks.quantity as avialablestocks'))
            ->join('tbl_purchase_item', 'tbl_purchase_item.item_id', '=', 'tbl_stocks.id')
            ->join('tbl_items', 'tbl_items.id', '=', 'tbl_stocks.id')
            ->groupBy('tbl_purchase_item.item_id','tbl_items.item_name','tbl_stocks.quantity')
            ->orderBy('tbl_purchase_item.item_id','ASC')
            ->get();
        return view('GetIngredientsInventory',['GetIngredientsInventory'=>$GetIngredientsInventory]);
    }
    public function GetSales(Request $r){
        if(!$r->Date){
            $SalesInventory = DB::table('tbl_menu')
                ->select(DB::raw('tbl_menu.menu_id, tbl_category.category_name as cat_name,tbl_menu.name,tbl_menu.price,sum(tbl_order_num.TotalPrice) as TotalPrice'))
                ->join('tbl_category', 'tbl_menu.cat_id', '=', 'tbl_category.cat_id')
                ->join('tbl_drinks', 'tbl_menu.drink_id', '=', 'tbl_drinks.id')
                ->join('tbl_order_num', 'tbl_menu.menu_id', '=', 'tbl_order_num.menu_id')
                ->groupBy('tbl_menu.menu_id','tbl_category.category_name','tbl_menu.name','tbl_menu.price')
                ->get();
            $TotalSales = DB::table('tbl_order_num') 
                ->select(DB::raw('SUM(TotalPrice) as TotalPrice'))           
                ->get();
        }        
        //return response(['Sales'=>$GetMenu]);
        return view('GetSales',['SalesInventory'=>$SalesInventory,'TotalSales'=>$TotalSales]);
    }
    #purchase items
    public function PurchaseItems(Request $r){
        $menuarray = array();
        foreach ($r->pendingArray as $item) {
            $menuid = $item['id'];
            $GetMenuIngredients = DB::table('tbl_menu_ingredients')
                ->select('tbl_menu_ingredients.menu_id as menuid','tbl_menu_ingredients.item_id as itemid','tbl_menu_ingredients.quantity as qty')
                ->join('tbl_items', 'tbl_menu_ingredients.item_id', '=', 'tbl_items.id')
                ->where('tbl_menu_ingredients.menu_id','=',$item['id'])
                ->orderBy('tbl_menu_ingredients.menu_id', 'asc')
                ->get();
            foreach ($GetMenuIngredients as $subitem) {
                $qty = $item['quantity'] * $subitem->qty;
                $itemqty = DB::table('tbl_stocks')
                    ->select('quantity as qty')
                    ->where('id', '=', $subitem->itemid)                     
                    ->get();
                $menuarray[] = array('menuid'=>$subitem->menuid,'itemid'=>$subitem->itemid,'quantity'=>$qty);
                DB::table('tbl_stocks')
                    ->where('id',$subitem->itemid)
                    ->decrement('quantity',$qty);
                DB::table('tbl_purchase_item')->insert(
                    ['menu_id' => $subitem->menuid, 'item_id' => $subitem->itemid,'quantity'=>$qty,'date_purchased'=>date("Y-m-d"),'order_id'=>$this->order_number()]
                );

                DB::table('tbl_stockinout')
                ->insert([
                    'item_id'=>$subitem->itemid,
                    'quantity'=>$qty,
                    'currentstock'=>$itemqty[0]->qty,
                    'datedelivery'=>date("Y-m-d H:i:s"),
                    'statusid' => 4,
                ]);
            }
        DB::table('tbl_order_num')->insert(
        ['order_id'=>$this->order_number(),'menu_id'=>$menuid,'TotalPrice'=>$r->Price,'CustomerCash'=>$r->Cash,'Change'=>$r->Change,'purchasedate'=>date("Y-m-d H:i:s"),'quantity'=>$item['quantity']]
    );            
        }                        
        return response(['menu'=>$menuarray,'msg'=>'success']);
    }
    public function order_number(){
        $count = DB::table('tbl_order_num')->count();        
        return $count + 1;
    }
    #pendinglist
    public function addpendingitem(Request $r){
        $pendingitem = DB::table('tbl_menu')
                        ->where('tbl_menu.menu_id','=',$r->id)
                        ->get();
        return response(['pendingitem'=>$pendingitem]);
    }
    public function pendinglist(){
        return view('pendinglist');
    }
    #Sales Menu   
    public function checkStocks(Request $r){
        $menuarray = array();
        foreach ($r->menu as $item) {
            $row = DB::table('tbl_stocks')
                    ->select('tbl_stocks.quantity as qty','tbl_stocks.id as id','tbl_items.item_name as name')
                    ->where('tbl_stocks.id', '=', $item['item_id'])
                    ->join('tbl_items','tbl_stocks.id','=','tbl_items.id')                     
                    ->get();
                    $menuarray[] = $row;
        }
        return response(['data'=>$menuarray]);
    }
    public function SalesMenu(Request $r){
        if($r->cat_id == ""){
            $SalesMenu = DB::table('tbl_menu')
            //->join('tbl_items', 'tbl_menu.menu_id', '=', 'tbl_items.id')
                ->join('tbl_category', 'tbl_menu.cat_id', '=', 'tbl_category.cat_id')
                ->join('tbl_drinks', 'tbl_menu.drink_id', '=', 'tbl_drinks.id')                
                ->get();
        }else{
            $SalesMenu = DB::table('tbl_menu')
            //->join('tbl_items', 'tbl_menu.menu_id', '=', 'tbl_items.id')
                ->join('tbl_category', 'tbl_menu.cat_id', '=', 'tbl_category.cat_id')
                ->join('tbl_drinks', 'tbl_menu.drink_id', '=', 'tbl_drinks.id')
                ->where('tbl_category.cat_id','=',$r->cat_id)
                ->get();
        }
        
        return view('SalesMenuList',['menu'=>$SalesMenu,'list'=>$r->list]);
    }
    #tbl_items
    public function updateStocks(Request $r){
        if($r->action == 'increment'){
            foreach ($r->stocksArray as $stocks) {
                
                $itemqty = DB::table('tbl_stocks')
                    ->select('quantity as qty')
                    ->where('id', '=', $stocks['ingID'])                     
                    ->get();
                
                $itemtype = DB::select('CALL itemtype('. $stocks['ingID'] .')');

                if($itemtype[0]->stype == 2 || $itemtype[0]->stype == 3){
                    $stocknum = $stocks['ingqty'] * 1000;
                }else{
                    $stocknum = $stocks['ingqty'];
                }
                DB::table('tbl_stocks')
                    ->where('id',$stocks['ingID'])
                    ->increment('quantity',$stocknum);

                DB::table('tbl_stockinout')
                ->insert([
                    'item_id'=>$stocks['ingID'],
                    'quantity'=>$stocknum,
                    'currentstock'=>$itemqty[0]->qty,
                    'datedelivery'=>date("Y-m-d H:i:s"),
                    'statusid' => $r->deliverystatus,
                ]);

            }
        }else{
            foreach ($r->stocksArray as $stocks) {
                $itemqty = DB::table('tbl_stocks')
                    ->select('quantity as qty')
                    ->where('id', '=', $stocks['ingID'])                     
                    ->get();

                $itemtype = DB::select('CALL itemtype('. $stocks['ingID'] .')');

                if($itemtype[0]->stype == 2  || $itemtype[0]->stype == 3){
                    $stocknum = $stocks['ingqty'] * 1000;
                }else{
                    $stocknum = $stocks['ingqty'];
                }

                DB::table('tbl_stocks')
                    ->where('id',$stocks['ingID'])
                    ->decrement('quantity',$stocknum);

                DB::table('tbl_stockinout')
                ->insert([
                    'item_id'=>$stocks['ingID'],
                    'quantity'=>$stocks['ingqty'],
                    'currentstock'=>$itemqty[0]->qty,
                    'datedelivery'=>date("Y-m-d H:i:s"),
                    'statusid' => $r->deliverystatus,
                ]);

            }
        }            
        return response(['msg'=>'success']);
    }
    public function GetTblItems(Request $r){
        $GetTblItems = DB::table('tbl_items')
            ->join('tbl_stocks','tbl_items.id','=','tbl_stocks.id')
            ->get();
        return response(['items'=>$GetTblItems]);
    }
    #MENU
    public function GetMenuIngredients(Request $r){
        if($r->id){
            $GetMenuIngredients = DB::table('tbl_menu_ingredients')
            ->join('tbl_items', 'tbl_menu_ingredients.item_id', '=', 'tbl_items.id')
            ->where('tbl_menu_ingredients.menu_id','=',$r->id)
            ->orderBy('tbl_menu_ingredients.menu_id', 'asc')
            ->get();
        }else{
            $GetMenuIngredients = DB::table('tbl_menu_ingredients')
            ->join('tbl_items', 'tbl_menu_ingredients.item_id', '=', 'tbl_items.id')
            ->orderBy('tbl_menu_ingredients.menu_id', 'asc')
            ->get();
        }        
        return response(['MenuIngredients'=>$GetMenuIngredients]);
    }
    #MENU test
    public function testMenu(){
        $GetMenu = DB::table('tbl_menu')
        ->join('tbl_category', 'tbl_menu.cat_id', '=', 'tbl_category.cat_id')
        ->join('tbl_drinks', 'tbl_menu.drink_id', '=', 'tbl_drinks.id')
        ->orderBy('tbl_menu.menu_id', 'asc')
        ->get();
        return response(['menu'=>$GetMenu]);
    }
    #MENU
    public function UpdateMenu(Request $r){
        DB::table('tbl_menu')
            ->where('menu_id', $r->menu_id)
            ->update(['cat_id' => $r->cat_id,'name' => $r->menu_name,'price' => $r->MenuPrice,'drink_id' => $r->drink]);
            $a = array();

        DB::table('tbl_menu_ingredients')->where('menu_id', '=', $r->menu_id)->delete();
        foreach($r->ingredients as $item){
            DB::table('tbl_menu_ingredients')
                ->insert(['menu_id'=>$r->menu_id,'item_id'=>$item['id'],'quantity'=>$item['quantity']]); 
        }            
        return response(['msg'=>'Update Complete']);        
    }
    public function stocklist(){
        
        $GetTblItems = DB::select('CALL stocklist()');            
        
        return view('stocklist',['GetTblItems'=>$GetTblItems]);
    }
    public function GetMenu(){
        $GetMenu = DB::table('tbl_menu')
        //->join('tbl_items', 'tbl_menu.menu_id', '=', 'tbl_items.id')
            ->join('tbl_category', 'tbl_menu.cat_id', '=', 'tbl_category.cat_id')
            ->join('tbl_drinks', 'tbl_menu.drink_id', '=', 'tbl_drinks.id')
            ->get();
        $GetTblItems = DB::table('tbl_items')
            ->join('tbl_stocks','tbl_items.id','=','tbl_stocks.id')
            ->get();
        return view('index',['GetMenu'=>$GetMenu,'GetTblItems'=>$GetTblItems]);       
    }
    public function SpotGetMenu(){
        $GetMenu = DB::table('tbl_menu')
        //->join('tbl_items', 'tbl_menu.menu_id', '=', 'tbl_items.id')
        ->join('tbl_category', 'tbl_menu.cat_id', '=', 'tbl_category.cat_id')
        ->join('tbl_drinks', 'tbl_menu.drink_id', '=', 'tbl_drinks.id')
        ->get();
        return view('menu',['GetMenu'=>$GetMenu]);           
    }
    public function NewMenu(Request $r){                
        DB::table('tbl_menu')
            ->insert(['cat_id'=>$r->cat_id,'name'=>$r->menu_name,'price'=>$r->MenuPrice,'drink_id'=>$r->drink]);
        $a = array();
        foreach($r->ingredients as $item){
            array_push($a, $item['id']);
            DB::table('tbl_menu_ingredients')
            ->insert(['menu_id'=>$this->countMenu(),'item_id'=>$item['id'],'quantity'=>$item['quantity']]);            
        }                                                
        return response(['data'=>'Added']);       
    }
    private function countMenu(){
        $count = DB::table('tbl_menu')->count();        
        return $count;
    }
    #category
    public function SaveCategory(Request $r){
        if($r->ajax()){
            DB::table('tbl_category')->insert(['category_name'=>$r->category]);
            return response(['msg'=>'success']);
        }
    }
    public function updateCategory(Request $r){
        if($r->ajax()){
            DB::table('tbl_category')
                ->where('id',$r->id)
                ->update(['category_name'=>$r->category]);
                return response(['msg'=>$r->id]);
        }
    }
    public function getCategory(){
        $GetCategory = DB::table('tbl_category')->get();
        return response(['category'=>$GetCategory]);
    }
    #Drinks
    public function UpdateDrinks(Request $r){
        if($r->ajax()){
            DB::table('tbl_drinks')
                ->where('id',$r->id)
                ->update(['drinksname'=>$r->drinks]);
                return response(['msg'=>$r->all()]);
        }       
    }
    public function SaveDrinks(Request $r){
        if($r->ajax()){
            DB::table('tbl_drinks')->insert(['id'=>$this->CountDrinks(),'drinksname'=>$r->drinks]);
            return response(['msg'=>'success']);
        }
    }
    private function CountDrinks(){
        $count = DB::table('tbl_drinks')->count();
        $CountDrinks = $count + 1;
        return $CountDrinks;
    }
    public function drinks(){
        $GetDrinks = DB::table('tbl_drinks')->get();
        return response(['drinks'=>$GetDrinks]);
    } 
    #items
    public function checkAvailableStocks(Request $r){
        $qty = DB::table('tbl_stocks')
                    ->select('quantity as qty')
                    ->where('id', '=', $r->id)                     
                    ->get();

        return response(['quantity'=>$qty]);
    }
    public function Addingredients(Request $r){     
        if($r->ajax()){
            $id = $this->CountIngredients();            
            DB::table('tbl_items')->insert(['item_name'=>$r->ingname,'type'=>$r->type]);            
            $this->AddingredientsQty($id,$r->ingqty,$r->type);
            return response(['msg'=>'success']);
        }
    }
    public function UpdateIngredients(Request $r){
        if($r->ajax()){
            DB::table('tbl_items')
                ->where('id',$r->ingID)
                ->update(['item_name'=>$r->ingname,'type'=>$r->type]);

            if($r->type == 2 || $r->type == 3){
                $num = $r->ingqty * 1000;
            }else{
                $num = $r->ingqty;
            }
            DB::table('tbl_stocks')
                ->where('id',$r->ingID)
                ->update(['quantity'=>$num]);

            return response(['msg'=>'success']);
        }
    }
    public function AddingredientsQty($id,$qty,$type){
        if($type == 2 || $type == 3){
            $num = $qty * 1000;
        }else{
            $num = $qty;
        }        
        DB::table('tbl_stocks')->insert(['id'=>$id,'quantity'=>$num]);
    }
    public function GetIngredients(){
        $GetIngredients = DB::table('tbl_items')->get();
        return response(['ingredients'=>$GetIngredients]);
    }
    private function CountIngredients(){
        $count = DB::table('tbl_items')->count();
        $ingCount = $count + 1;
        return $ingCount;
    }
    public function stockinout(){
        $stockinout = DB::select('CALL stockinout');
        return response($stockinout);      
    }

    public function SalesInventory(Request $r){
        $SalesInventory = DB::select("CALL SalesInventory('%". $r->salesdate ."%')");
        return response($SalesInventory);      
    }
}
