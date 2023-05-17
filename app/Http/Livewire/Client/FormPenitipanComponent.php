<?php

namespace App\Http\Livewire\Client;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\CommonFunction;
use Exception;

use App\Models\Barang;

class FormPenitipanComponent extends Component
{
    public $barangArry;
    public $nama_barang;

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'barangArry.*.nama_barang' => 'required',
            'barangArry.*.jenis_barang' => 'required',
        ]);
    }

    public function mount()
    {
        $this->barangArry = Barang::all();
        $this->barangArry->push(new Barang());
    }

    public function addBarangRow()
    {
        $this->barangArry->push(new Barang());
    }

    public function deleteRowBarang(int $idx)
    {
        $barang = $this->barangArry[$idx];
        $this->barangArry->forget($idx);

        $barang->delete();
    }

    public function addDataToDb()
    {
        $this->validate([
            'barangArry.*.nama_barang' => 'required',
            'barangArry.*.jenis_barang' => 'required',
        ]);

        foreach($this->barangArry as $barang){
            $barang->save();
        }
    }

    public function render()
    {
        return view('livewire.client.form-penitipan-component')->layout('layouts.client');
    }
}
