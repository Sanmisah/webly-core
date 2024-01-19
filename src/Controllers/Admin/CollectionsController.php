<?php

namespace Webly\Core\Controllers\Admin;

use Webly\Core\Controllers\BaseController;
use Webly\Core\Models\Collections;

class CollectionsController extends BaseController
{
    public function index()
    {
        $Collections = new Collections();

        return view('Webly\Core\Views\Admin\Collections\index', [
            'title' => 'Collections', 
            'collections' => $Collections->paginate(),
            'pager' => $Collections->pager
        ]);
    }

    public function create()
    {
        $Collections = new Collections();
        $collection = $Collections->newEntity();

        if ($this->request->getMethod() === 'post') {
            $data = $this->request->getPost();

            $inputs = $this->validate([
                'collection' => 'required|max_length[250]',
            ]);

            if($inputs) {
                $collection->fill($data);
                $Collections->save($collection);

                return redirect()->to('/admin/collections')->with('success', 'Saved successfully');
            } else {
                return redirect()->to('/admin/collections/create')->withInput()->with('error', 'Could not be saved');
            }
                        
        }

        return view('Webly\Core\Views\Admin\Collections\update', [
            'title' => 'Collections', 
            'collection' => $collection
        ]);        
    }    

    public function update($id)
    {
        $Collections = new Collections();
        $collection = $Collections->find($id);

        if ($this->request->getMethod() === 'post') {
            $data = $this->request->getPost();

            $inputs = $this->validate([
                'collection' => 'required|max_length[250]',
            ]);

            if($inputs) {
                unset($data['csrf_test_name']);
                $collection->fill($data);
                $Collections->save($collection);

                return redirect()->to('/admin/collections')->with('success', 'Saved successfully');
            } else {
                return redirect()->to('/admin/collections/update/'.$id)->withInput()->with('error', 'Could not be saved');
            }
                        
        }

        return view('Webly\Core\Views\Admin\Collections\update', [
            'title' => 'Collections', 
            'collection' => $collection
        ]);        
    }

    public function delete($id)
    {
        $Collections = new Collections();
        $Collections->delete($id);
        return redirect()->to('/admin/collections')->with('success', 'Successfully Deleted');
    }
}
