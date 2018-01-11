<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookCustomController extends Controller
{
	public function index(){
		$books = Book::all();
		return view('book-custom.index')->with(['books'=>$books]);
	}
	
	public function form($id=null){
		if ($id!=null){
			$book = Book::find($id);
			return view('book-custom.form')->with(['model'=>$book]);
		}
		return view('book-custom.form');
	}
	
	public function save(Request $request){
		$input = $request->input;
		if ($request->has('id')){
			$book = Book::find($request->id);
		} else {
			$book = new Book();
		}
		$book->fill($input);
		$book->save();
		return redirect('/book-custom');
	}
	
	public function delete($id){
		Book::where('id',$id)->delete();
		return redirect('/book-custom');
	}
}