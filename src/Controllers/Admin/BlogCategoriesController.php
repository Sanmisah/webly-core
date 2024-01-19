<?php

namespace Webly\Core\Controllers\Admin;

use Webly\Core\Controllers\BaseController;
use Webly\Core\Models\BlogCategories;

class BlogCategoriesController extends BaseController
{
    public function index()
    {
        $BlogCategories = new BlogCategories();

        return view('Webly\Core\Views\Admin\BlogCategories\index', [
            'title' => 'BlogCategories', 
            'blogCategories' => $BlogCategories->paginate(),
            'pager' => $BlogCategories->pager
        ]);
    }

    public function create()
    {
        $BlogCategories = new BlogCategories();
        $blogCategory = $BlogCategories->newEntity();

        if ($this->request->getMethod() === 'post') {
            $data = $this->request->getPost();

            $inputs = $this->validate([
                'category' => 'required|max_length[60]',
            ]);

            if($inputs) {
                $blogCategory->fill($data);
                $BlogCategories->save($blogCategory);

                return redirect()->to('/admin/blog-categories')->with('success', 'Saved successfully');
            } else {
                return redirect()->to('/admin/blog-categories/create')->withInput()->with('error', 'Could not be saved');
            }
                        
        }

        return view('Webly\Core\Views\Admin\BlogCategories\update', [
            'title' => 'BlogCategories', 
            'blogCategory' => $blogCategory
        ]);        
    }    

    public function update($id)
    {
        $BlogCategories = new BlogCategories();
        $blogCategory = $BlogCategories->find($id);

        if ($this->request->getMethod() === 'post') {
            $data = $this->request->getPost();

            $inputs = $this->validate([
                'category' => 'required|max_length[60]',
            ]);

            if($inputs) {
                unset($data['csrf_test_name']);
                $blogCategory->fill($data);
                $BlogCategories->save($blogCategory);

                return redirect()->to('/admin/blog-categories')->with('success', 'Saved successfully');
            } else {
                return redirect()->to('/admin/blog-categories/update/'.$id)->withInput()->with('error', 'Could not be saved');
            }
                        
        }

        return view('Webly\Core\Views\Admin\BlogCategories\update', [
            'title' => 'BlogCategories', 
            'blogCategory' => $blogCategory
        ]);        
    }

    public function delete($id)
    {
        $BlogCategories = new BlogCategories();
        $BlogCategories->delete($id);
        return redirect()->to('/admin/blog-categories')->with('success', 'Successfully Deleted');
    }
}
