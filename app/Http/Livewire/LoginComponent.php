<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\CommonFunction;
use Exception;


use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use App\Providers\RouteServiceProvider;

class LoginComponent extends Component
{
    public $email, $password, $remember;
    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
    }
    
    public function checkUserLogin()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        try
        {
            $user = User::where('email', $this->email)->first();
            $throttleKey = request()->ip();
            
            if(RateLimiter::tooManyAttempts($throttleKey, 3)){
                $seconds  = RateLimiter::availableIn($throttleKey);
                session()->flash('msgLimitRequest', 'Maaf, percobaan login telah melewati batas! Coba lagi dalam waktu ');
                session()->flash('msgLimitSecRequest', $seconds);
            }

            if($user){
                if(Hash::check($this->password, $user->password)){
                    RateLimiter::hit($throttleKey);
                    if($user->flag_active === "Y"){
                        Auth::attempt($this->only(['email', 'password']), $this->remember);
                        if($user->user_type === "ADM"){
                            return redirect()->route('admin-dashboard');
                        }
                        else if($user->user_type === "USR"){
                            return redirect()->intended(RouteServiceProvider::HOME);
                        }
                    }else if($user->flag_active === "N"){
                        session()->flash('msgFlagN', 'Ops... Akun anda telah di Non-aktifkan, Hubungi admin. Terimakasih!');
                    }else if($user->flag_active === null){
                        session()->flash('msgFlagNull', 'Maaf, Akun anda belum disetujui, Hubungi admin. Terimakasih!');
                    }
                }else{
                    RateLimiter::hit($throttleKey);
                    session()->flash('msgPassWrong', 'Maaf, password yang anda masukkan tidak sesuai!');
                }
            }else{
                RateLimiter::hit($throttleKey);
                session()->flash('msgUserNotFound', 'Maaf, email atau password yang anda masukkan tidak terdaftar!');
            }
        }
        catch(Exception $e)
        {
            $error_msg = $e->getMessage();
            $stackTrace = CommonFunction::getTraceException($e);
            CommonFunction::insertLogError($this->email, "LoginButtonSubmit", "POST", $error_msg." | ".$stackTrace);
            session()->flash('msgExcLogin', 'Telah terjadi kesalahan pada sistem. Mohon tunggu atau hubungi Admin, dan Coba beberapa saat lagi. Terimakasih!');
        }
    }

    public function render()
    {
        // $passHash = Hash::make('david123');
        // $customer = new User;
        // $customer->name = 'David Simbolon';
        // $customer->email = 'david123@gmail.com';
        // $customer->password = $passHash;
        // $customer->flag_active = 'Y';
        // $customer->save();
        return view('livewire.login-component')->layout('layouts.login');
    }
}
