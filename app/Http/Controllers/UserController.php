<?php

namespace App\Http\Controllers;

use App\Model\Usuario;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $jwt;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(JWTAuth $jwt)
    {
        $this->jwt = $jwt;
        $this->middleware('auth:api', [
            'except' => ['login', 'add']
        ]);
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'login' => 'required|max:255',
            'senha' => 'required'
        ]);

        if (!$token = $this->jwt->claims(['login' => $request->login])->attempt(
            ['login' => $request->login, 'senha' => $request->senha]
        )) {
            return response()->json(['Usuárino  não encontrado!'], 404);
        }

        return response()->json(compact('token'));
    }

    public function index()
    {
        return response()->json(Usuario::all());
    }

    public function search($id)
    {
        $user = Usuario::find($id);

        return response()->json($user);
    }

    public function add(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|min:5|max:50',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);

        $user = new Usuario();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->active = false;
        $user->save();

        return response()->json($user);
    }

    public function update($id, Request $request)
    {
        $user = Usuario::find($id);
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->active = $request->active;
        $user->save();

        return response()->json($user);
    }

    public function delete($id)
    {
        $user = Usuario::find($id);
        $user->delete();

        return response()->json('User successful deleted!', 200);
    }

    public function info()
    {
        $user = Auth::user();

        return response()->json($user);
    }

    public function logout()
    {
        Auth::logout();

        return response()->json('Usuário deslogado com sucesso.', 200);
    }
}
