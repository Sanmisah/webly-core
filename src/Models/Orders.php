<?php

namespace Webly\Core\Models;

class Orders extends BaseModel
{
    protected $table            = 'orders';
    protected $returnType       = \Webly\Core\Entities\Order::class;
    protected $allowedFields    = [
        'id', 'order_no', 'invoice_no', 'invoice_date', 'first_name', 'last_name', 'email', 'mobile',
        'address_line_1', 'address_line_2', 'city', 'state', 'pincode', 'gross_amount', 'net_amount'
    ];
}
