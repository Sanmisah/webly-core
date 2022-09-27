<?php
namespace Webly\Core\Validation;

class WeblyRules
{
    public function valid_mobile(?string $mobile, ?string &$error = null): bool
    {        
        $error = "This field must contain a 10 digit valid mobile no.";
        return preg_match('/^[6-9]\d{9}$/', $mobile);
    }
}
