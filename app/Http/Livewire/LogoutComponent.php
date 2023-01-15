<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\CommonFunction;
use Exception;

class LogoutComponent extends Component
{
    public function hitLogout()
    {
        Auth::logout();
        session()->flush();
    }
    public function logout()
    {
        try{
            $this->hitLogout();
        }catch(Exception $e){
            $this->hitLogout();
            $username = Auth::user()->username;
            $error_msg = $e->getMessage();
            $stackTrace = CommonFunction::getTraceException($e);
            CommonFunction::insertLogError($username, "LogoutFunctionHit", "POST", $error_msg." | ".$stackTrace);
            session()->flash('msgExcLogin', 'Telah terjadi kesalahan pada sistem. Mohon tunggu atau hubungi Admin, dan Coba beberapa saat lagi. Terimakasih!');
        }
        return redirect()->route('home');
    }
    public function render()
    {
        $this->logout();
        return view('livewire.logout-component');
    }
}
