<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Checkout - Poskesdes Lau Baleng')]
class CheckoutPage extends Component
{
    public $firstName;
    public $lastName;
    public $phone;
    public $paymentMethod;
    public $paymentProof;

    public function booking()
    {
        $this->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'phone' => 'required',
            'paymentMethod' => 'required',
            'paymentProof' => 'required',
        ], [
            'firstName.required' => 'Nama depan wajib diisi.',
            'lastName.required' => 'Nama belakang wajib diisi.',
            'phone.required' => 'Nomor telepon wajib diisi.',
            'paymentMethod.required' => 'Metode pembayaran wajib diisi.',
            'paymentProof.required' => 'Bukti pembayaran wajib diisi.',
        ]); 
    }

    public function render()
    {
        $cartItems = CartManagement::getCartItems(auth()->user()->customer->id_customer);
        $totalPrice = CartManagement::calcTotalPriceAllCartItems($cartItems);

        return view('livewire.checkout-page', [
            'cartItems' => $cartItems,
            'totalPrice' => $totalPrice,
        ]);
    }
}
