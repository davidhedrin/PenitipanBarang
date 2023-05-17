<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\CommonFunction;
use Livewire\WithPagination;
use Exception;

use App\Models\User;

class UsersComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $id_user, $name, $flag_active;
    
    public function resetFromAdd()
    {
        $this->id_uesr = null;
        $this->name = null;
        $this->flag_active = null;
    }

    public function ActiveInactiveUserModel(int $id){
        try{
            $user = User::find($id);
            $this->id_user = $user->id;
            $this->flag_active = $user->flag_active;
            $this->name = $user->name;
        }catch(Exception $ex){
            $error_msg = $ex->getMessage();
            $stackTrace = CommonFunction::getTraceException($ex);
            CommonFunction::insertLogError(Auth::user()->email, "ActiveInactiveUserModel", "Get", $error_msg." | ".$stackTrace);
            session()->flash('msgExcError', 'Telah terjadi kesalahan pada sistem. Mohon tunggu atau hubungi Admin, dan Coba beberapa saat lagi. Terimakasih!');
        }
    }
    public function activeInactiveUser(int $id, string $status = null){
        try{
            $user = User::find($id);
            if(strtolower($status) == "y"){
                $user->flag_active = "N";
            }else if(strtolower($status) == "n"){
                $user->flag_active = "Y";
            }else if(empty($status)){
                $user->flag_active = "Y";
            }
            $user->save();
            session()->flash('activeInactiveFlag', 'Status user berhasil diupdate!');
        }catch(Exception $ex){
            $error_msg = $ex->getMessage();
            $stackTrace = CommonFunction::getTraceException($ex);
            CommonFunction::insertLogError(Auth::user()->email, "UpdateActiveInactiveUser", "Update", $error_msg." | ".$stackTrace);
            session()->flash('msgExcError', 'Telah terjadi kesalahan pada sistem. Mohon tunggu atau hubungi Admin, dan Coba beberapa saat lagi. Terimakasih!');
        }
        $this->resetFromAdd();
        $this->dispatchBrowserEvent('close-form-modal');
    }

    public function modelDelteUser(int $id){
        try{
            $user = User::find($id);
            $this->id_user = $user->id;
            $this->flag_active = $user->flag_active;
            $this->name = $user->name;
        }catch(Exception $ex){
            $error_msg = $ex->getMessage();
            $stackTrace = CommonFunction::getTraceException($ex);
            CommonFunction::insertLogError(Auth::user()->email, "modelDelteUser", "Get", $error_msg." | ".$stackTrace);
            session()->flash('msgExcError', 'Telah terjadi kesalahan pada sistem. Mohon tunggu atau hubungi Admin, dan Coba beberapa saat lagi. Terimakasih!');
        }
    }
    public function deleteDataUserFromDb(int $id){
        try{
            $nameUser;
            $user = User::find($id);
            $nameUser = $user->name;
            $user->delete();

            session()->flash('msgAddToDb', 'User '.$nameUser.' telah berhasil dihapus!');
        }catch(Exception $ex){
            $error_msg = $ex->getMessage();
            $stackTrace = CommonFunction::getTraceException($ex);
            CommonFunction::insertLogError(Auth::user()->email, "deleteDataUserFromDb", "Delete", $error_msg." | ".$stackTrace);
            session()->flash('msgExcError', 'Telah terjadi kesalahan pada sistem. Mohon tunggu atau hubungi Admin, dan Coba beberapa saat lagi. Terimakasih!');
        }
        $this->resetFromAdd();
        $this->dispatchBrowserEvent('close-form-modal');
    }

    public function updateDataUserModel(int $id){
        $this->id_user = $id;
        $user = User::find($id);
        
    }

    public function loadAllData()
    {
        $result = [];

        try{
            $users = User::paginate(10);
            $usrCard = User::paginate(8);
            $result = [
                'users' => $users,
                'usrCard' => $usrCard
            ];
        }catch(Exception $e){
            $error_msg = $e->getMessage();
            $stackTrace = CommonFunction::getTraceException($e);
            CommonFunction::insertLogError(Auth::user()->email, "loadAllDataUserComponent", "GET", $error_msg." | ".$stackTrace);
            session()->flash('msgExcError', 'Telah terjadi kesalahan pada sistem. Mohon tunggu atau hubungi Admin, dan Coba beberapa saat lagi. Terimakasih!');
        }

        return $result;
    }
    public function render()
    {
        return view('livewire.admin.users-component', $this->loadAllData())->layout('layouts.base');
    }
}
