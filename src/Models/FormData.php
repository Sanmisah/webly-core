<?php

namespace Webly\Core\Models;

class FormData extends BaseModel
{
    protected $table            = 'form_data';
    protected $returnType       = \Webly\Core\Entities\FormData::class;
    protected $allowedFields    = [
        'id', 'form_id', 'form_data'
    ];
}
