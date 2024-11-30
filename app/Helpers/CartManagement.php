<?php

namespace App\Helpers;

use App\Models\Product;
use App\Models\Carts;
use Illuminate\Support\Facades\Auth;

class CartManagement 
{
    // Add items to cart
    static public function addItemsToCart($id_product, $quantity = 1)
    {
        // $id_user = auth()->user()->id_user;
        $id_user = '4da66a8b-aee6-11ef-b717-c01850850fc6';

        $cartItem = Carts::where('id_customer', $id_user)
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
                    'id_customer' => $id_user,
                    'id_product' => $id_product,
                    'quantity' => $quantity,
                ]);
            }
        }

        return Carts::where('id_customer', $id_user)->count();
    }

	static function increaseQuantity($id_customer, $id_product)
	{
		$cartItems = Carts::where('id_customer', $id_customer)
			->where('id_product', $id_product)
			->first();
		
		++$cartItems->quantity;
		$cartItems->save();

		return Carts::where('id_customer', $id_customer)->get();
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

		return Carts::where('id_customer', $id_customer)->get();
	}

    // Remove items from cart
    static public function removeItemsFromCart($id_customer, $id_product)
    {

        Carts::where('id_customer', $id_customer)
            ->where('id_product', $id_product)
            ->delete();

        return Carts::where('id_customer', $id_customer)->get();
    }

    // Clear all cart items
    static public function clearCartItems($id_customer)
    {
        Carts::where('id_customer', $id_customer)->delete();
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

// <?php

// namespace App\Helpers;

// use Illuminate\Support\Facades\Cookie;
// use App\Models\Product;

// class CartManagement 
// {
// 	// Add items to cart
// 	static public function addItemsToCart($id_product)
// 	{
// 		// $id_user = auth()->user()->id_user;
// 		// dd($id_user);	
// 		$cartItems = self::getCartItemsFromCookie();

// 		$existingItems = null;

// 		foreach($cartItems as $key => $item) 
// 		{
// 			if($item['id_product'] == $id_product) 
// 			{
// 				$existingItems = $key;
// 				break;
// 			}	
// 		}

// 		if($existingItems !== null)
// 		{
// 			$cartItems[$existingItems]['quantity']++;
// 			$cartItems[$existingItems]['total_price'] = $cartItems[$existingItems]['quantity'] * $cartItems[$existingItems]['product_sell_price'];
// 		}
// 		else
// 		{
// 			$product = Product::join('products_description', 'products.id_product_description', '=', 'products_description.id_product_description')
// 			    ->where('products.id_product', $id_product)
// 			    ->first(['products.id_product', 'products.product_name', 'products.product_sell_price', 'products_description.product_img']);

// 			if($product) 
// 			{
// 				$cartItems[] = [
// 					'id_product' => $id_product,
// 					'product_name' => $product->product_name,
// 					'product_sell_price' => $product->product_sell_price,
// 					'quantity' => 1,
// 					'total_price' => $product->product_sell_price,
// 					'image' => $product->product_img
// 				];
// 			}
// 		}

// 		self::addCartItemsToCookie($cartItems);

// 		return count($cartItems);
// 	}

// 	// Remove items from cart
// 	static public function removeItemsFromCart($id_product)
// 	{
// 		$cartItems = self::getCartItemsFromCookie();

// 		foreach($cartItems as $key => $item) 
// 		{
// 			if($item['id_product'] == $id_product) 
// 			{
// 				unset($cartItems[$key]);
// 				break;
// 			}
// 		}

// 		self::addCartItemsToCookie($cartItems);

// 		return count($cartItems);
// 	}

// 	// Add cart item to cookie
// 	static public function addCartItemsToCookie($cartItems)
// 	{
// 		Cookie::queue('cart_items', json_encode($cartItems), 60 * 24 * 30);
// 	}

// 	// Clear cart items from cookie
// 	static public function clearCartItemsFromCookie()
// 	{
// 		Cookie::queue(Cookie::forget('cart_items'));
// 	}

// 	// Get all cart items from cookie
// 	static public function getCartItemsFromCookie()
// 	{
// 		if(!Cookie::get('cart_items')) {
// 			return [];
// 		}

// 		return json_decode(Cookie::get('cart_items'), true);
// 	}

// 	// Increment cart item quantity
// 	static public function incrementCartItemQuantity($id_product)
// 	{
// 		$cartItems = self::getCartItemsFromCookie();

// 		foreach($cartItems as $key => $item) 
// 		{
// 			if($item['id_product'] == $id_product) 
// 			{
// 				$cartItems[$key]['quantity']++;
// 				$cartItems[$key]['total_price'] = $cartItems[$key]['quantity'] * $cartItems[$key]['product_sell_price'];
// 				break;
// 			}
// 		}

// 		self::addCartItemsToCookie($cartItems);

// 		return count($cartItems);
// 	}

// 	// Decrement cart item quantity
// 	static public function decrementCartItemQuantity($id_product)
// 	{
// 		$cartItems = self::getCartItemsFromCookie();

// 		foreach($cartItems as $key => $item)
// 		{
// 			if($item['id_product'] == $id_product)
// 			{
// 				if($item['quantity'] > 1)
// 				{
// 					$cartItems[$key]['quantity']--;
// 					$cartItems[$key]['total_price'] = $cartItems[$key]['quantity'] * $cartItems[$key]['product_sell_price'];
// 					break;
// 				}
// 				else
// 				{
// 					self::removeItemsFromCart($id_product);
// 				}
// 			}
// 		}

// 		self::addCartItemsToCookie(($cartItems));

// 		return count($cartItems);
// 	}

// 	// Calculate total price of all cart items
// 	static public function calcTotalPriceAllCartItems($items)
// 	{
// 		return array_sum(array_column($items, 'total_price'));
// 	}


// }