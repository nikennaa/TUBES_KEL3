<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        if ($request->isMethod('post')) {
            $email = $request->input('email');
            $password = md5($request->input('pass')); // Nanti lebih bagus pakai bcrypt/argon2!

            $user = DB::table('users')
                ->where('email', $email)
                ->where('password', $password)
                ->first();

            if ($user) {
                // TANPA cek user_type lagi
                Session::put('user_name', $user->name);
                Session::put('user_email', $user->email);
                Session::put('user_id', $user->id);

                return redirect('product'); // Langsung ke home
            } else {
                return back()->withErrors(['message' => 'Email atau password salah']);
            }
        }

        return view('login'); // Hanya return view
    }
}
