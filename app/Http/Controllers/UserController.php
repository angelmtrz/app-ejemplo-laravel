<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    //constructor
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('log')->only('index');
        $this->middleware('subscribed')->except('store');
    }
    //show
    //retorna una vista 'user.profile' y
    //devuelve todo el registro del usuario con el id especificado
    public function show($id) {
        return view('user.profile',[
            'user' => User::findOrFail($id)
        ]);
    }
}
