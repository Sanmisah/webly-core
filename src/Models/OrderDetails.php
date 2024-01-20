<?php

namespace Webly\Core\Models;

class OrderDetails extends BaseModel
{
    protected $table            = 'order_details';
    protected $returnType       = \Webly\Core\Entities\OrderDetail::class;
    protected $allowedFields    = [
        'id', 'order_id', 'product_id', 'qty', 'rate', 'amount'
    ];
}
