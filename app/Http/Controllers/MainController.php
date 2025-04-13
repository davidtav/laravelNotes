<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\Operations;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use PhpParser\Node\Stmt\TryCatch;

class MainController extends Controller
{
  public function index()
  {
    //carregar as notas do usuario
    $id = session('user.id');
    $notes = User::find($id)->notes()->get()->toArray();




    //show home view
    return view('home', ['notes' => $notes]);
  }
  public function newNote()
  {
    //show new note view
    return view('new_note');
  }
  public function newNoteSubmit(Request $request)
  {
    echo "I'm creating a New note!";
  }
  public function editNote($id)
  {
    $id = Operations::decryptId($id);
    echo "I'm editing a note with id: $id";
  }
    public function deleteNote($id)
    {
      $id = Operations::decryptId($id);
      echo "I'm deleting a note with id: $id";
    }
}
