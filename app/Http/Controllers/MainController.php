<?php

namespace App\Http\Controllers;

use App\Models\Note;
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
    // validate request
    $request->validate(
      [
        'text_title' => 'required|min:3|max:200',
        'text_note' => 'required|min:3|max:3000'
      ],
      //error messages
      [
        'text_title.required' => 'O titulo é obrigatório',
        'text_title.min' => 'O titulo deve ter pelo menos :min caracteres',
        'text_title.max' => 'O titulo deve ter no máximo :max caracteres',

        'text_note.required' => 'A nota  é obrigatória',
        'text_note.min' => 'A nota deve ter pelo menos :min caracteres',
        'text_note.max' => 'A nota deve ter no máximo :max caracteres'
      ]
    );
    echo "ok";

    // get user id
    $id = session('user.id');
    // create new note
    $note  = new Note();
    $note->user_id = $id;
    $note->title = $request->text_title;
    $note->text = $request->text_note;
    $note->save();
    // redirect to home
    return redirect()->route('home');
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
