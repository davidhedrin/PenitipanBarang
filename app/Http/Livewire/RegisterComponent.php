<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\CommonFunction;
use Exception;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;

class RegisterComponent extends Component
{
    public $name, $email, $password, $ko_password, $no_phone, $gander, $acc_term;

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required',
            'email' => 'required|email',
            'no_phone' => 'required|numeric|digits_between:11,12',
            'password' => 'required|min:6|required_with:ko_password',
            'ko_password' => 'required|min:6|required_with:password|same:password',
            'gander' => 'required',
            'acc_term' => 'required'
        ]);
    }

    public function addDataToDb()
    {
        $throttleKey = request()->ip();
        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'no_phone' => 'required|numeric|digits_between:11,12',
            'password' => 'required|min:6|required_with:ko_password',
            'ko_password' => 'required|min:6|required_with:password|same:password',
            'gander' => 'required',
            'acc_term' => 'required'
        ]);

        try
        {
            if(RateLimiter::tooManyAttempts($throttleKey, 3)){
                $seconds  = RateLimiter::availableIn($throttleKey);
                session()->flash('msgLimitRequest', 'Maaf, percobaan login telah melewati batas! Coba lagi dalam waktu ');
                session()->flash('msgLimitSecRequest', $seconds);
                return false;
            }

            $passHash = Hash::make($this->password);
            $customer = new User;
            $customer->name = $this->name;
            $customer->email = $this->email;
            $customer->password = $passHash;
            $customer->no_phone = $this->no_phone;
            $customer->gander = $this->gander;
            $customer->save();

            session()->flash('msgSuccessRegis', 'Perndaftaran telah berhasil, hubungi admin untuk menyetujui. Terimakasih');
            return redirect()->route('login');
        }
        catch(Exception $e)
        {
            RateLimiter::hit($throttleKey);
            $error_msg = $e->getMessage();
            $stackTrace = CommonFunction::getTraceException($e);
            CommonFunction::insertLogError("Registere's", "addDataToDbRegister", "POST", $error_msg." | ".$stackTrace);
            session()->flash('msgExcLogin', 'Telah terjadi kesalahan pada sistem. Mohon tunggu atau hubungi Admin, dan Coba beberapa saat lagi. Terimakasih!');
        }
    }

    public function render()
    {
        return view('livewire.register-component')->layout('layouts.login');
    }
}
