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

        // $userModel = new User();
        // $users = $userModel->all()->toArray();
        // echo '<pre>';
        // print_r($users);




        //check if user exist
        $user = User::where('username',$username)->where('deleted_at',NULL)->first();


        if(!$user){
            return redirect()->back()->withInput()->with('loginError','Usuário ou senha incoreetos');
        }
        //check password
        if(!password_verify($password,$user->password)){
            return redirect()->back()->withInput()->with('loginError','Usuário ou senha incoreetos');
        }   

        //update last_login
        $user->last_login = date('Y-m-d H:i:s');
        $user->save();

        //login user
        session([
            'user'=>[
                'id'=>$user->id,
                'username'=>$user->username              
            ]
            ]);
        //redirect to home
        return redirect()->to('/');
       
    }

    public function logout()
    {
        //logout from the aplication 
        session()->forget('user');
        return redirect()->to('/login');
    }
}
