<?php

namespace App\Helpers;

use App\Models\Product;
use App\Models\Carts;
use App\Models\ProductDetail;
use Illuminate\Support\Facades\Auth;

class CartManagement 
{
    // Add items to cart
    static public function addItemsToCart($id_customer, $id_product, $quantity = 1)
    {
        $cartItem = Carts::where('id_customer', $id_customer)
                        ->where('id_product', $id_product)
                        ->first();

        if ($cartItem) 
		{
            $cartItem->quantity = $quantity;
            $cartItem->save();
        } 
		else
		{
            $product = Product::find($id_product);

            if ($product) 
			{
                Carts::create([
                    'id_cart' => (string) \Illuminate\Support\Str::uuid(),
                    'id_customer' => $id_customer,
                    'id_product' => $id_product,
                    'quantity' => $quantity,
                ]);
            }
        }

        return Carts::where('id_customer', $id_customer)->count();
    }

	static function increaseQuantity($id_customer, $id_product)
	{
        $productDetail = ProductDetail::where('id_product', $id_product)
            ->where('stock', '>', 0)
            ->orderBy('exp_date')->first();

		$cartItem = Carts::where('id_customer', $id_customer)
			->where('id_product', $id_product)
			->first();
            
        if ($productDetail->stock >= $cartItem->quantity + 1)
        {
            ++$cartItem->quantity;
            $cartItem->save();
        }

		return CartManagement::getCartItems($id_customer);
	}

	static function decreaseQuantity($id_customer, $id_product)
	{
		$cartItems = Carts::where('id_customer', $id_customer)
			->where('id_product', $id_product)
			->first();
		
		if($cartItems->quantity > 1)
		{
			--$cartItems->quantity;
			$cartItems->save();
		}
		else
		{
			$cartItems->delete();
		}

		return CartManagement::getCartItems($id_customer);
	}

    // Remove items from cart
    static public function removeItemsFromCart($id_customer, $id_product)
    {

        Carts::where('id_customer', $id_customer)
            ->where('id_product', $id_product)
            ->delete();

        return CartManagement::getCartItems($id_customer);
    }

    // Clear all cart items
    static public function clearCartItems($id_customer)
    {
        Carts::where('id_customer', $id_customer)->delete();

        return CartManagement::getCartItems($id_customer);
    }

    // Get all cart items
    static public function getCartItems($id_customer)
    {
        return Carts::where('id_customer', $id_customer)->get();
        
    }
	
	// Calculate Total Price All Items From Cart
	static public function calcTotalPriceAllCartItems($cartItems)
	{
		return collect($cartItems)->sum(function($cartItem) {
            return $cartItem->quantity * $cartItem->product->product_sell_price;
        });
	}
}
