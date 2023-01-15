<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\CommonFunction;
use Livewire\WithPagination;
use Exception;

use App\Models\Slider;

class SliderComponent extends Component
{
    use WithPagination;
    public $slider_id, $flag_active;
    public $heading1, $heading2, $btn_text, $btn_url, $description;

    public function resetFromAdd(){
        $this->heading1 = null;
        $this->heading2 = null;
        $this->btn_text = null;
        $this->btn_url = null;
        $this->descriptionp = null;
        $this->slider_id = null;
        $this->flag_active = null;
    }

    public function updated($fields){
        $this->validateOnly($fields, [
            'heading1' => 'required',
            'heading2' => 'required',
            'description' => 'required',
        ]);
    }

    public function addSliderToDb(){
        $this->validate([
            'heading1' => 'required',
            'heading2' => 'required',
            'description' => 'required',
        ]);
        try{
            $slider = new Slider;
            $slider->heading1 = $this->heading1;
            $slider->heading2 = $this->heading2;
            $slider->btn_text = $this->btn_text;
            $slider->btn_url = $this->btn_url;
            $slider->description = $this->description;
            $slider->save();

            session()->flash('msgAddToDb', 'Slider baru telah berhasil ditambahkan!');
        }catch(Exception $ex){
            $error_msg = $ex->getMessage();
            $stackTrace = CommonFunction::getTraceException($ex);
            CommonFunction::insertLogError(Auth::user()->email, "addSliderToDbSlider", "Post", $error_msg." | ".$stackTrace);
            session()->flash('msgExcError', 'Telah terjadi kesalahan pada sistem. Mohon tunggu atau hubungi Admin, dan Coba beberapa saat lagi. Terimakasih!');
        }

        $this->resetFromAdd();
        $this->dispatchBrowserEvent('close-form-modal');
    }

    
    public function ActiveInactiveSliderModel(int $id){
        $slider = Slider::find($id);
        $this->slider_id = $slider->id;
        $this->flag_active = $slider->flag_active;
        $this->heading1 = $slider->heading1;
        $this->heading2 = $slider->heading2;
    }
    public function activeInactiveSlider(int $id, string $status = null){
        try{
            $slider = Slider::find($id);
            if(strtolower($status) == "y"){
                $slider->flag_active = "N";
            }else if(strtolower($status) == "n"){
                $slider->flag_active = "Y";
            }else if(empty($status)){
                $slider->flag_active = "Y";
            }
            $slider->save();
            session()->flash('activeInactiveFlag', 'Status slider berhasil diupdate!');
        }
        catch(Exception $ex){
            $error_msg = $ex->getMessage();
            $stackTrace = CommonFunction::getTraceException($ex);
            CommonFunction::insertLogError(Auth::user()->email, "activeInactiveSlider", "Update", $error_msg." | ".$stackTrace);
            session()->flash('msgExcError', 'Telah terjadi kesalahan pada sistem. Mohon tunggu atau hubungi Admin, dan Coba beberapa saat lagi. Terimakasih!');
        }
        $this->resetFromAdd();
        $this->dispatchBrowserEvent('close-form-modal');
    }
    
    public function modalDeleteSlider(int $id){
        $this->slider_id = $id;
        $slider = Slider::find($id);
        $this->heading1 = $slider->heading1;
        $this->heading2 = $slider->heading2;
    }
    public function deleteDataSlider(int $id){
        try{
            $slider = Slider::find($id);
            $slider->delete();

            session()->flash('msgAddToDb', 'Slider telah berhasil dihapus!');
        }
        catch(Exception $ex){
            $error_msg = $ex->getMessage();
            $stackTrace = CommonFunction::getTraceException($ex);
            CommonFunction::insertLogError(Auth::user()->email, "deleteDataSlider", "Delete", $error_msg." | ".$stackTrace);
            session()->flash('msgExcError', 'Telah terjadi kesalahan pada sistem. Mohon tunggu atau hubungi Admin, dan Coba beberapa saat lagi. Terimakasih!');
        }

        $this->resetFromAdd();
        $this->dispatchBrowserEvent('close-form-modal');
    }

    
    public function EditDataSliderModel(int $id){
        try{
            $this->slider_id = $id;
            $slider = Slider::find($id);
            $this->heading1 = $slider->heading1;
            $this->heading2 = $slider->heading2;
            $this->btn_text = $slider->btn_text;
            $this->btn_url = $slider->btn_url;
            $this->description = $slider->description;
        }
        catch(Exception $ex){
            $error_msg = $ex->getMessage();
            $stackTrace = CommonFunction::getTraceException($ex);
            CommonFunction::insertLogError(Auth::user()->email, "GetDataSliderToModel", "Get", $error_msg." | ".$stackTrace);
            session()->flash('msgExcError', 'Telah terjadi kesalahan pada sistem. Mohon tunggu atau hubungi Admin, dan Coba beberapa saat lagi. Terimakasih!');
        }
    }
    public function updateDataSlider(int $id){
        $this->validate([
            'heading1' => 'required',
            'heading2' => 'required',
            'description' => 'required',
        ]);

        try{
            $slider = Slider::find($id);
            $slider->heading1 = $this->heading1;
            $slider->heading2 = $this->heading2;
            $slider->btn_text = $this->btn_text;
            $slider->btn_url = $this->btn_url;
            $slider->description = $this->description;
            $slider->save();
            
            session()->flash('msgAddToDb', 'Slider telah berhasil diperbaharui!');
        }
        catch(Exception $ex){
            $error_msg = $ex->getMessage();
            $stackTrace = CommonFunction::getTraceException($ex);
            CommonFunction::insertLogError(Auth::user()->email, "updateDataSlider", "Update", $error_msg." | ".$stackTrace);
            session()->flash('msgExcError', 'Telah terjadi kesalahan pada sistem. Mohon tunggu atau hubungi Admin, dan Coba beberapa saat lagi. Terimakasih!');
        }

        $this->resetFromAdd();
        $this->dispatchBrowserEvent('close-form-modal');
    }

    protected function loadAllData(){
        $result = [];

        try{
            $sliders = Slider::paginate(10);
            $slidersz = Slider::all();
            $result = [
                'sliders' => $sliders,
                'slidersz' => $slidersz,
            ];
        }catch(Exception $ex){
            $error_msg = $ex->getMessage();
            $stackTrace = CommonFunction::getTraceException($ex);
            CommonFunction::insertLogError(Auth::user()->email, "loadAllDataSlider", "Get", $error_msg." | ".$stackTrace);
            session()->flash('msgExcError', 'Telah terjadi kesalahan pada sistem. Mohon tunggu atau hubungi Admin, dan Coba beberapa saat lagi. Terimakasih!');
        }

        return $result;
    }

    public function render()
    {
        return view('livewire.admin.slider-component', $this->loadAllData())->layout('layouts.base');
    }
}
