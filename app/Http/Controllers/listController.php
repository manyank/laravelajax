<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;

class listController extends Controller
{
    public function index(){
    	$items = Item::all();
    	return view('list', compact('items'));
    }

    public function create(Request $request){

    	$item = new Item;
    	$item->title = $request->text;
    	$item->save();
    	return 'done';
    	
    }

    public function delete( Request $request ){
    	    Item:: where('id', $request->id)->delete();
    		return 'delete succesefully ';
    }

    public function update(Request $request){

    	$item = Item::find($request->id);
    	$item->title = $request->value;
    	$item->save();
    	return "update successfully";
    }

    public function search(Request $request){
    	$term =  $request->term;
         $items =  Item::where('title','LIKE', '%'.$term.'%')->get();
         if(count($items)==0){
         	$serarchdata[] = 'No Recode Found';
         }else{
         	foreach ($items as  $value) {
         		$serarchdata[] = $value->title;
         	}
         }
    	return $serarchdata;
    }
}
