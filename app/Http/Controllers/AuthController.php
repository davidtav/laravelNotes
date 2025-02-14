<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function loginSubmit(Request $request)
    {
        //form validation
        $request->validate(
 [
            'text_username' => 'required|email',
            'text_password' => 'required|min:6|max:16'
        ],
        //error messages
[
            'text_username.required' => 'O username é obrigatório',
            'text_username.email' => 'O username deve ser um email válido',
            'text_password.required' => 'A senha  é obrigatória',
            'text_password.min' => 'A senha deve ter pelo menos :min caracteres',
            'text_password.max' => 'A senha deve ter no máximo :max caracteres'
        ]
    );

        //get user input
        $username = $request->input('text_username');
        $password = $request->input('text_password');

        //test database connection
        // try {
        //     DB::connection()->getPdo();
        //     echo "conexão bem sucedida <br/>";
        // } catch (\PDOException $e) {
        //     echo "conexão falhou". $e->getMessage();
        // }
        // echo"fim!";

        //get all the users from the database
        //$users = User::all()->toArray();

        // as an object instanceof the model's class
        $userModel = new User();
        $users = $userModel->all()->toArray();
        echo '<pre>';
        print_r($users);
    }

    public function logout()
    {
        echo"logout";
    }
}
