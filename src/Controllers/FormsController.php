<?php

namespace Webly\Core\Controllers;

use CodeIgniter\Events\Events;
use CodeIgniter\Files\File;
use Webly\Core\Controllers\BaseController;
use Webly\Core\Models\Forms;
use Webly\Core\Models\FormData;

class FormsController extends BaseController
{
    public function form($form)
    {
        if ($this->request->getMethod() === 'post') {
            $Forms = new Forms();
            $form = $Forms->where('form', $form)->first();
            
            $formFields = $form->form_fields;

            $validate = [];
            foreach($formFields as $field) {
                $validate[$field->field] = $field->validations;
            }

            $inputs = $this->validate($validate);
            
            if($inputs) {
                $data = $this->request->getPost();
                unset($data['csrf_test_name']);

                $FormData = new FormData();
                $formData = $FormData->newEntity();

                $formData->form_id = $form->id;
                $formData->form_data = $data;

                $FormData->save($formData);  

                Events::trigger('form_submission', $data, $form);

                // if(!empty($form->email_to)) {
                //     $email = emailer();
                //     $email->setFrom(setting('Email.fromEmail'), setting('Email.fromName'));
                //     $email->setTo($form->email_to);
                //     $body = "
                //         <p><strong>New {$form->form} Form Submission</strong><p>
                //         <ul>
                //     ";
                //     foreach($data as $field => $value) {
                //         $body .= "<li>".humanize($field).": {$value}</li>";
                //     }                    
                //     $body .= "</ul>";

                //     $email->setSubject("New {$form->form} Form Submission");
                //     $email->setMessage(view('\Webly\Core\Views\Emails\form_response', ['body' => $body]));
                //     $email->send();   
                // }
                
                // if(isset($data['email'])) {
                //     $email = emailer();
                //     $email->setFrom(setting('Email.fromEmail'), setting('Email.fromName'));
                //     $email->setTo($data['email'], $data['name'] ?? '');              
                    
                //     $subject = $form->response_email_subject;                
                //     $body = $form->response_email_body;

                //     foreach($data as $field => $value) {
                //         $subject = str_replace("{{$field}}", $value, $subject);
                //         $body = str_replace("{{$field}}", $value, $body);
                //     }

                //     $email->setSubject($subject);
                //     $email->setMessage(view('\Webly\Core\Views\Emails\form_response', ['body' => $body]));
                //     $email->send();   
                // }

                return redirect()->back()->with('success', $form->success_message);
            } else {
                return redirect()->back()->withInput()->with('error', $form->error_message);
            }
        }
    }
}
