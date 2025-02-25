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
    $user = User::find($id)->toArray();
    $notes = User::find($id)->notes()->get()->toArray();

    echo'<pre>';
    print_r($user);
    print_r($notes);
    die();



   //show home view
   return view('home');
   
 }
 public function newNote()
 {
    echo "I'm creating a new note";
 }
}
