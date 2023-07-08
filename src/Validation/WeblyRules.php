<?php
namespace Webly\Core\Validation;

class WeblyRules
{
    public function valid_mobile(?string $mobile, ?string &$error = null): bool
    {        
        $error = "This field must contain a 10 digit valid mobile no.";
        return preg_match('/^[6-9]\d{9}$/', $mobile);
    }

    public function valid_pan(?string $pan, ?string &$error = null): bool
    {        
        $error = "This field must contain valid PAN no.";
        return preg_match('/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/', $pan);
    }   
    
    public function valid_aadhar(?string $aadhar, ?string &$error = null): bool
    {        
        $error = "This field must contain valid Aadhar no.";
        return preg_match('/^[2-9]{1}[0-9]{3}\\s[0-9]{4}\\s[0-9]{4}$/', $aadhar);
    }      
}
