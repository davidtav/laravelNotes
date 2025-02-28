<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class MainController extends Controller
{
 public function index()
 {
   //carregar as notas do usuario
    $id = session('user.id');
    $notes = User::find($id)->notes()->get()->toArray();

  


   //show home view
   return view('home',['notes'=>$notes]);
   
 }
 public function newNote()
 {
    echo "I'm creating a new note";
 }
}
