<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class RegistController extends Controller
{
    public function index(Request $request)
    {
        return view('regist'); // hanya tampilkan view form register
    }

    public function store(Request $request)
    {
        $messages = [];

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'pass' => 'required|string|min:6',
            'cpass' => 'required|string|same:pass',
        ]);

        $name = filter_var($request->name, FILTER_SANITIZE_STRING);
        $email = filter_var($request->email, FILTER_SANITIZE_EMAIL);
        $password = md5(filter_var($request->pass, FILTER_SANITIZE_STRING)); // saran upgrade ke bcrypt nanti

        $user = DB::table('users')->where('email', $email)->first();

        if ($user) {
            $messages[] = 'User already exists!';
        } else {
            DB::table('users')->insert([
                'name' => $name,
                'email' => $email,
                'password' => $password,
            ]);
            $messages[] = 'Registered successfully!';
            return redirect()->route('login')->with('message', $messages);
        }

        return redirect()->back()->with('message', $messages);
    }
}
