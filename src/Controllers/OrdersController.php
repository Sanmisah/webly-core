<?php

namespace Webly\Core\Controllers;

use CodeIgniter\Files\File;
use Webly\Core\Controllers\BaseController;
use Webly\Core\Models\Products;
use Webly\Core\Models\Orders;
use Webly\Core\Models\OrderDetails;

class OrdersController extends BaseController
{
    public function create()
    {
        $Orders = new Orders();
        $order = $Orders->newEntity();

        if ($this->request->getMethod() === 'post') {
            $data = $this->request->getPost();

            $inputs = $this->validate([
                'first_name' => 'required|alpha',
                // 'last_name' => 'required|alpha',
                // 'email' => 'required|valid_email',
                // 'mobile' => 'required|valid_mobile',
                // 'address_line_1' => 'required',
                // 'city' => 'required',
                // 'state' => 'required',
                // 'pincode' => 'required|is_natural|max_length[6]'
            ]);

            if($inputs) {
                $session = session();
                $cart = $session->get('cart');
                
                $amounts = dot_array_search("*.amount", $cart);
                
                $order->fill($data);

                $order->gross_amount = array_sum($amounts);
                $order->net_amount = array_sum($amounts);

                $Orders->save($order);

                $order_id = $Orders->insertID();

                $OrderDetails = new OrderDetails();

                foreach($cart as $product) {
                    $detail = [
                        'order_id' => $order_id,
                        'product_id' => $product['product_id'],
                        'qty' => $product['qty'],
                        'rate' => $product['rate'],
                        'amount' => $product['amount'],
                    ];
                    $OrderDetails->save($detail);                    
                }

                $session->remove('cart');
                $session->remove('cart_count');                

                return redirect()->to('/orders/payment/'.$Orders->insertID())->with('success', 'Saved successfully');
            } else {
                return redirect()->to('/shop/cart')->withInput()->with('error', 'Could not be saved');
            }                        
        }       
    }
    
    public function payment()
    {
        $layout = service('settings')->get('App.template') . 'shop' . DIRECTORY_SEPARATOR . 'payment';

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
