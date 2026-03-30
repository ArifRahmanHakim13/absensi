<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;  // jangan lupa import model User

class LoginController extends Controller
{
    public function index() : View {
      return view('pages.auth.login');
    }

    public function cekLogin(Request $request) : RedirectResponse {
      $input = $request->validate([
        'username' => ['required'],
        'password' => ['required'],
      ]);

      // Cari user berdasarkan username
      $user = User::where('username', $input['username'])->first();

      // Cek user ada dan password sama (tanpa bcrypt)
      if ($user && $user->password === $input['password']) {
          // Login manual tanpa hash
          Auth::login($user);

          return redirect(route('dashboard.index'))->withInfo('Anda berhasil masuk!');
      } else {
          return back()->withFailed('Username atau password salah!');
      }
    }
}
