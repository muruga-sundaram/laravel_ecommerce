<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class LoginController extends Controller {
    public function showLoginForm(){ return view('auth.login'); }
    public function login(Request $request){ $request->validate(['email'=>'required|email','password'=>'required']); if(Auth::attempt($request->only('email','password'))){ $request->session()->regenerate(); return redirect()->intended('/'); } return back()->withErrors(['email'=>'Invalid credentials']); }
    public function showRegisterForm(){ return view('auth.register'); }
    public function register(Request $request){ $request->validate(['name'=>'required','email'=>'required|email|unique:users,email','password'=>'required|confirmed']); $user = User::create(['name'=>$request->name,'email'=>$request->email,'password'=>Hash::make($request->password)]); Auth::login($user); return redirect('/'); }
    public function logout(Request $request){ Auth::logout(); $request->session()->invalidate(); $request->session()->regenerateToken(); return redirect('/'); }
}
