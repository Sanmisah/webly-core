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
                if(!empty($field->validations)) {
                    $validate[$field->field] = $field->validations;
                }
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

                return redirect()->back()->with('success', $form->success_message);
            } else {
                return redirect()->back()->withInput()->with('error', $form->error_message);
            }
        }
    }
}
