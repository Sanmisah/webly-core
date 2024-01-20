<?php

namespace Webly\Core\Controllers;

use CodeIgniter\Files\File;
use Webly\Core\Controllers\BaseController;
use Webly\Core\Models\Products;
use Webly\Core\Models\ProductBlocks;
use Webly\Core\Models\Collections;

class ShopController extends BaseController
{
    public function add_to_cart()
    {
        if ($this->request->getMethod() === 'post') {
            $data = $this->request->getPost();
            $response = [];
            
            $session = session();
            $cart = $session->get('cart');
            
            $found = false;

            $productIds = [];

            if(!empty($cart)) {
                $productIds = dot_array_search("*.product_id", $cart);
            }

            if(is_array($productIds)) {
                if(in_array($data['product_id'], $productIds)) {
                    $found = true;
                }
            } else {
                if($data['product_id'] == $productIds) {
                    $found = true;
                }
            }

            if($found) {
                $response = [
                    'status' => false,
                    'message' => 'Product is already in the Cart',
                    'cart_count' => count($cart)
                ];

                return $this->response->setJSON($response);
            }

            $Products = new Products();
            $product = $Products->find($data['product_id']);

            $data['product'] = $product->product;
            $data['rate'] = $product->rate;
            $data['amount'] = $data['qty'] * $data['rate'];
            $data['featured_image'] = $product->featured_image;
            $cart[] = $data;

            $amounts = dot_array_search("*.amount", $cart);
            $total_amount = is_array($amounts) ? array_sum($amounts) : $amounts;
            
            $session->set('cart', $cart);
            $session->set('cart_count', count($cart));
            $session->set('total_amount', $total_amount);

            $response = [
                'status' => true,
                'message' => "{$product->product} has been added to your cart.",
                'cart_count' => count($cart)
            ];            

            return $this->response->setJSON($response);
        }
    }

    public function delete_from_cart($product_id)
    {
        $session = session();
        $cart = $session->get('cart');

        foreach($cart as $i => $product) {
            if($product['product_id'] == $product_id) {
                break;
            }
        }
        unset($cart[$i]);

        $amounts = dot_array_search("*.amount", $cart);
        $total_amount = is_array($amounts) ? array_sum($amounts) : $amounts;
        
        $session->set('cart', $cart);
        $session->set('cart_count', count($cart));
        $session->set('total_amount', $total_amount);

        $response = [
            'status' => false,
            'message' => 'Product is deleted from Cart',
            'cart_count' => count($cart),
            'total_amount' => $total_amount
        ];

        return $this->response->setJSON($response);

    }    

    public function delete() {
        $session = session();        
        $session->remove('cart');
        $session->remove('cart_count');
        $session->remove('total_amount');                
        
        exit;
    }

    public function cart()
    {
        $layout = service('settings')->get('App.template') . DIRECTORY_SEPARATOR . 'shop' . DIRECTORY_SEPARATOR . 'cart';

        $url =  site_url($this->request->getUri()->getPath());

        $meta = "
            <meta name='description' content='Shopping Cart' />
            <link rel='canonical' href='{$url}' />
            <!-- Twitter Card data -->
            <meta name='twitter:card' value='Shopping Cart'>

            <!-- Open Graph data -->
            <meta property='og:title' content='Shopping Cart' />
            <meta property='og:url' content='{$url}' />
            <meta property='og:description' content='Shopping Cart' />            
        ";

        $session = session();
        $cart = $session->get('cart');        

        return view($layout, [
            'title' => 'Shopping Cart', 
            'meta' => $meta,
            'cart' => $cart
        ]);        
    }
}
