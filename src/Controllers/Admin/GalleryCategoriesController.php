<?php

namespace Webly\Core\Controllers\Admin;

use Webly\Core\Controllers\BaseController;
use Webly\Core\Models\GalleryCategories;

class GalleryCategoriesController extends BaseController
{
    public function index()
    {
        $GalleryCategories = new GalleryCategories();

        return view('Webly\Core\Views\Admin\GalleryCategories\index', [
            'title' => 'GalleryCategories', 
            'galleryCategories' => $GalleryCategories->orderBy('sort_order', 'asc')->findAll(),
        ]);
    }

    public function sort()
    {
        $GalleryCategories = new GalleryCategories();

        if ($this->request->getMethod() === 'post') {
            $data = $this->request->getPost();
            foreach($data['sorted'] as $sorOrder => $id) {
                $data = [
                    'sort_order' => $sorOrder
                ];
                $GalleryCategories->update((int)$id, $data);
            }
        }  
    }        

    public function create()
    {
        $GalleryCategories = new GalleryCategories();
        $galleryCategory = $GalleryCategories->newEntity();

        if ($this->request->getMethod() === 'post') {
            $data = $this->request->getPost();

            $inputs = $this->validate([
                'category' => 'required|max_length[60]|is_unique[gallery_categories.category]',               
                'category_image' => [
                    'label' => 'Category Image',
                    'rules' => 'uploaded[category_image]|is_image[category_image]'
                        . '|mime_in[category_image,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
                        . '|max_size[category_image,512]'
                ],                
            ]);

            if($inputs) {
                $galleryCategory->fill($data);
                
                $galleryCategoryImage = $this->request->getFile('category_image');
                if ($galleryCategoryImage->isValid() && !$galleryCategoryImage->hasMoved()) {
                    $newName = $galleryCategoryImage->getRandomName();
                    $path = 'uploads/'.date('dmY').'/';
                    $galleryCategoryImage->move($path, $newName);                    
                    $galleryCategory->category_image = $path . $newName;
                }

                $GalleryCategories->save($galleryCategory);

                return redirect()->to('/admin/gallery-categories')->with('success', 'Saved successfully');
            } else {
                return redirect()->to('/admin/gallery-categories/create')->withInput()->with('error', 'could not be saved');
            }
                        
        }

        return view('Webly\Core\Views\Admin\GalleryCategories\update', [
            'title' => 'GalleryCategories', 
            'galleryCategory' => $galleryCategory
        ]);        
    }    

    public function update($id)
    {
        $GalleryCategories = new GalleryCategories();
        $galleryCategory = $GalleryCategories->find($id);

        if ($this->request->getMethod() === 'post') {
            $data = $this->request->getPost();

            $inputs = $this->validate([
                'category' => 'required|max_length[60]|is_unique[gallery_categories.category, id, {id}]',               
                'category_image' => [
                    'label' => 'Category Image',
                    'rules' => 'is_image[category_image]'
                        . '|mime_in[category_image,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
                        . '|max_size[category_image,512]'
                ],                
            ]);

            if($inputs) {
                $galleryCategory->fill($data);

                $galleryCategoryImage = $this->request->getFile('category_image');
                if ($galleryCategoryImage->isValid() && !$galleryCategoryImage->hasMoved()) {
                    $newName = $galleryCategoryImage->getRandomName();
                    $path = 'uploads/'.date('dmY').'/';
                    $galleryCategoryImage->move($path, $newName);                    
                    $galleryCategory->category_image = $path . $newName;
                }                

                $GalleryCategories->save($galleryCategory);

                return redirect()->to('/admin/gallery-categories')->with('success', 'Saved successfully');
            } else {
                return redirect()->to('/admin/gallery-categories/update/'.$id)->withInput()->with('error', 'Could not be saved');
            }
                        
        }

        return view('Webly\Core\Views\Admin\GalleryCategories\update', [
            'title' => 'GalleryCategories', 
            'galleryCategory' => $galleryCategory
        ]);        
    }

    public function delete($id)
    {
        $GalleryCategories = new GalleryCategories();
        $GalleryCategories->delete($id);
        return redirect()->to('/admin/gallery-categories')->with('success', 'Successfully Deleted');
    }
}
