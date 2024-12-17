<?php

namespace App\Helpers;

use App\Models\Product;
use App\Models\Carts;
use App\Models\ProductDetail;

class CartManagement 
{
    // Add items to cart
    static public function addItemsToCart($id_user, $id_product, $quantity = 1)
    {
        $cartItem = Carts::where('id_user', $id_user)
                        ->where('id_product', $id_product)
                        ->first();

        if ($cartItem) 
		{
            $cartItem->quantity = $quantity;
            $cartItem->save();
        } 
		else
		{
            $product = Product::find($id_product)->where('status', 'aktif')
                        ->whereHas('productDetail', function($query) {
                            $query->where('stock', '>', 0)
                                  ->where('exp_date', '>', now())
                                  ->orderBy('exp_date');
                        })->first();

            if ($product) 
			{
                Carts::create([
                    'id_cart' => (string) \Illuminate\Support\Str::uuid(),
                    'id_user' => $id_user,
                    'id_product' => $id_product,
                    'quantity' => $quantity,
                ]);
            }
        }

        return Carts::where('id_user', $id_user)->count();
    }

	static function increaseQuantity($id_user, $id_product)
	{
        $productDetail = ProductDetail::where('id_product', $id_product)
            ->where('stock', '>', 0)
            ->where('exp_date', '>', now())
            ->orderBy('exp_date')->first();

		$cartItem = Carts::where('id_user', $id_user)
			->where('id_product', $id_product)
			->first();
            
        if ($productDetail->stock >= $cartItem->quantity + 1)
        {
            ++$cartItem->quantity;
            $cartItem->save();
        }

		return CartManagement::getCartItems($id_user);
	}

	static function decreaseQuantity($id_user, $id_product)
	{
		$cartItems = Carts::where('id_user', $id_user)
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

		return CartManagement::getCartItems($id_user);
	}

    // Remove items from cart
    static public function removeItemsFromCart($id_user, $id_product)
    {

        Carts::where('id_user', $id_user)
            ->where('id_product', $id_product)
            ->delete();

        return CartManagement::getCartItems($id_user);
    }

    // Clear all cart items
    static public function clearCartItems($id_user)
    {
        Carts::where('id_user', $id_user)->delete();

        return CartManagement::getCartItems($id_user);
    }

    // Get all cart items
    static public function getCartItems($id_user)
    {
        return Carts::where('id_user', $id_user)->get();
        
    }
	
	// Calculate Total Price All Items From Cart
	static public function calcTotalPriceAllCartItems($cartItems)
	{
		return collect($cartItems)->sum(function($cartItem) {
            return $cartItem->quantity * $cartItem->product->product_sell_price;
        });
	}
}
