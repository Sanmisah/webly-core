<?php

namespace Webly\Core\Models;

class Forms extends BaseModel
{
    protected $table            = 'forms';
    protected $returnType       = \Webly\Core\Entities\Form::class;
    protected $allowedFields    = [
        'id', 'form', 'success_message', 'error_message', 'form_fields', 'email_to', 'response_email_subject', 'response_email_body'
    ];
}
