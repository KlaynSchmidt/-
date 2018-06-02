<?php
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/ajax', function(){
	header("Access-Control-Allow-Origin: *");	$items=App\Item::where('complete', 0)->orderBy('created_at','desc')->get();
	return $items;
	
});
Route::get('/lost', function(){
	header("Access-Control-Allow-Origin: *");  $items=App\Item::where('status', 0)->where('complete', 0)->orderBy('created_at', 'desc')->get();
	return $items;
});
Route::get('/found', function(){
	header("Access-Control-Allow-Origin: *");  $items=App\Item::where('status', 1)->orderBy('created_at', 'desc')->get();
	return $items;
});
Route::get('/searching', function(Request $req)	{
	header("Access-Control-Allow-Origin: *"); 
	$items = DB::table('items')->where('complete', 0)->where('title','like','%'.$req->search.'%')->orWhere('description','like','%'.$req->search.'%')->get();
	return $items;
});
Route::get('/adding', function(Request $req){
	header("Access-Control-Allow-Origin: *"); 
 	$id = App\Item::insertGetId(['title' => $req->title, 'contact' => $req->contact, 'description' => $req->desc, 'status' => $req->status, 'complete' => 0,"created_at"=>date('Y-m-d H:i:s'), "updated_at"=>date('Y-m-d H:i:s')]);
	return $id;
});
Route::get('/myitem', function(Request $req){
	header("Access-Control-Allow-Origin: *"); 
 	$items = App\Item::where('id', $req->item_id)->where('complete',0)->get();
	return $items;
}); 
Route::get('/delete_item', function(Request $req){
	header("Access-Control-Allow-Origin: *");
	$items = App\Item::where('id', $req->delete)->update(['complete' => 1]);
	return $items;
});
