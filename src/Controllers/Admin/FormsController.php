<?php

namespace Webly\Core\Controllers\Admin;

use CodeIgniter\Files\File;
use Webly\Core\Controllers\BaseController;
use Webly\Core\Models\Forms;
use Webly\Core\Models\FormData;

class FormsController extends BaseController
{
    public function index()
    {
        $Forms = new Forms();

        return view('Webly\Core\Views\Admin\Forms\index', [
            'title' => 'Forms', 
            'forms' => $Forms->paginate(),
            'pager' => $Forms->pager
        ]);
    }

    public function create()
    {
        $Forms = new Forms();
        $form = $Forms->newEntity();

        if ($this->request->getMethod() === 'post') {
            $data = $this->request->getPost();

            $inputs = $this->validate([
                'form' => 'required|alpha_dash|max_length[60]|is_unique[forms.form]',
            ]);


            if($inputs) {
                $form->fill($data);
                $Forms->save($form);

                return redirect()->to('/admin/forms/update/' . $Forms->insertID())->with('success', 'Saved successfully');
            } else {
                return redirect()->to('/admin/forms/create')->withInput()->with('error', 'Could not be saved');
            }
        }

        return view('Webly\Core\Views\Admin\Forms\create', [
            'title' => 'Forms', 
            'form' => $form
        ]);        
    }    

    public function update($id)
    {
        $Forms = new Forms();
        $form = $Forms->find($id);

        if ($this->request->getMethod() === 'post') {
            $data = $this->request->getPost();
            $inputs = $this->validate([
                'id'    => 'is_natural_no_zero',
                'form' => 'required|alpha_dash|max_length[60]|is_unique[forms.form, id, {id}]',
                'form_fields' => 'required',
                'email_to' => 'permit_empty|max_length[200]|valid_emails'
            ]);

            if($inputs) {
                unset($data['csrf_test_name']);
                $form->fill($data);
                $Forms->save($form);                

                return redirect()->to('/admin/forms')->with('success', 'Saved successfully');
            } else {
                return redirect()->to('/admin/forms/update/'.$id)->withInput()->with('error', 'Could not be saved');
            }       
        }

        return view('Webly\Core\Views\Admin\Forms\update', [
            'title' => 'Forms', 
            'form' => $form,
        ]);        
    }

    public function delete($id)
    {
        $Forms = new Forms();
        $Forms->delete($id);
        return redirect()->to('/admin/forms')->with('success', 'Successfully Deleted');
    }

    public function showData($id)
    {
        $Forms = new Forms();
        $FormData = new FormData();

        $form = $Forms->find($id);
        $data = $FormData->where('form_id', $id)->orderBy('created_at', 'DESC')->paginate();
        
        return view('Webly\Core\Views\Admin\Forms\show_data', [
            'title' => 'Forms', 
            'form' => $form,
            'data' => $data,
            'pager' => $FormData->pager
        ]);        
    }

    public function exportData($id) 
    {
        $Forms = new Forms();
        $FormData = new FormData();

        $form = $Forms->find($id);
        $data = $FormData->where('form_id', $id)->orderBy('created_at', 'DESC')->findAll();

        header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename='.$form->form.'-' . date("Y-m-d-h-i-s") . '.csv');
		$output = fopen('php://output', 'w');

        $header = ['#', 'Submitted On'];
        foreach($form->form_fields as $field) {
            $header[] = humanize($field->field);
        }
        fputcsv($output, $header);

        foreach($data as $row) {
            $record = null;
            $record[] = "'".str_pad($row->id, 5, "0", STR_PAD_LEFT);
            $record[] = $row->created_at->format('d/m/Y h:i A');
            foreach($form->form_fields as $field) {
                $record[] = $row->form_data->{$field->field} ?? '';
            }

            fputcsv($output, $record);
        }
    }
}
