<?php

namespace App\Livewire;

use App\Models\LastTransaction;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TransaksiTerakhir extends Component
{
    public $tanggalTransaksi;
    public $tanggal;
    public $last;

    public function mount(){
        $this->last = DB::table('last_transaction_view')->get();
    }
    public function cari(){
        if ($this->tanggalTransaksi == "") {
            return redirect('/owner');
        }else{
            $this->tanggal = explode('-', $this->tanggalTransaksi);
            $this->last = DB::table('last_transaction_view')->whereYear('tanggal_transaksi', '=', $this->tanggal[0])
            ->whereMonth('tanggal_transaksi', '=', $this->tanggal[1])->get();
        }
    }
    public function render()
    {
        return view('livewire.transaksi-terakhir');
    }
}
