<?php
namespace Webly\Core\Config;

use CodeIgniter\Events\Events;


Events::on('form_submission', static function ($data, $form) {
    if(!empty($form->email_to)) {
        $email = emailer();
        $email->setFrom(setting('Email.fromEmail'), setting('Email.fromName'));
        $email->setTo($form->email_to);
        $body = "
            <p><strong>New {$form->form} Form Submission</strong><p>
            <ul>
        ";
        foreach($data as $field => $value) {
            $body .= "<li>".humanize($field).": {$value}</li>";
        }                    
        $body .= "</ul>";

        $email->setSubject("New {$form->form} Form Submission");
        $email->setMessage(view('\Webly\Core\Views\Emails\form_response', ['body' => $body]));
        $email->send();   
    }
    
    if(isset($data['email'])) {
        $email = emailer();
        $email->setFrom(setting('Email.fromEmail'), setting('Email.fromName'));
        $email->setTo($data['email'], $data['name'] ?? '');              
        
        $subject = $form->response_email_subject;                
        $body = $form->response_email_body;

        foreach($data as $field => $value) {
            $subject = str_replace("{{$field}}", $value, $subject);
            $body = str_replace("{{$field}}", $value, $body);
        }

        $email->setSubject($subject);
        $email->setMessage(view('\Webly\Core\Views\Emails\form_response', ['body' => $body]));
        $email->send();   
    }
}, EVENT_PRIORITY_LOW);