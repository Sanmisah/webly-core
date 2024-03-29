<?php

namespace Webly\Core\Controllers\Admin;

use Webly\Core\Controllers\BaseController;
use Webly\Core\Models\Banners;

class BannersController extends BaseController
{
    public function index()
    {
        $Banners = new Banners();

        return view('Webly\Core\Views\Admin\Banners\index', [
            'title' => 'Banners', 
            'banners' => $Banners->orderBy('sort_order', 'asc')->findAll(),
            'pager' => $Banners->pager
        ]);
    }

    public function sort()
    {
        $Banners = new Banners();

        if ($this->request->getMethod() === 'post') {
            $data = $this->request->getPost();
            foreach($data['sorted'] as $sortOrder => $id) {
                $order = [
                    'sort_order' => $sortOrder
                ];
                $Banners->update((int)$id, $order);
            }
        }  
    }        

    public function create()
    {
        $Banners = new Banners();
        $banner = $Banners->newEntity();

        if ($this->request->getMethod() === 'post') {
            $data = $this->request->getPost();

            $inputs = $this->validate([
                'banner_image' => [
                    'label' => 'Banner Image',
                    'rules' => 'uploaded[banner_image]|is_image[banner_image]'
                        . '|mime_in[banner_image,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
                        . '|max_size[banner_image,512]'
                ],                
            ]);

            if($inputs) {
                $banner->fill($data);
                
                $bannerImage = $this->request->getFile('banner_image');
                if ($bannerImage->isValid() && !$bannerImage->hasMoved()) {
                    $newName = $bannerImage->getRandomName();
                    $path = 'uploads/'.date('dmY').'/';
                    $bannerImage->move($path, $newName);                                                        
                    $banner->banner_image = $path . $newName;
                }

                $Banners->save($banner);

                return redirect()->to('/admin/banners')->with('success', 'Saved successfully');
            } else {
                return redirect()->to('/admin/banners/create')->withInput()->with('error', 'Could not be saved');
            }
                        
        }

        return view('Webly\Core\Views\Admin\Banners\update', [
            'title' => 'Banners', 
            'banner' => $banner
        ]);        
    }    

    public function update($id)
    {
        $Banners = new Banners();
        $banner = $Banners->find($id);

        if ($this->request->getMethod() === 'post') {
            $data = $this->request->getPost();

            $inputs = $this->validate([
                'banner_image' => [
                    'label' => 'Banner Image',
                    'rules' => 'is_image[banner_image]'
                        . '|mime_in[banner_image,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
                        . '|max_size[banner_image,512]'
                ],  
            ]);

            if($inputs) {
                unset($data['csrf_test_name']);
                $banner->fill($data);

                $bannerImage = $this->request->getFile('banner_image');
                if ($bannerImage->isValid() && !$bannerImage->hasMoved()) {
                    $newName = $bannerImage->getRandomName();
                    $path = 'uploads/'.date('dmY').'/';
                    $bannerImage->move($path, $newName);                                        
                    $banner->banner_image = $path . $newName;
                }                

                $Banners->save($banner);

                return redirect()->to('/admin/banners')->with('success', 'Saved successfully');
            } else {
                return redirect()->to('/admin/banners/update/'.$id)->withInput()->with('error', 'Could not be saved');
            }
                        
        }

        return view('Webly\Core\Views\Admin\Banners\update', [
            'title' => 'Banners', 
            'banner' => $banner
        ]);        
    }

    public function delete($id)
    {
        $Banners = new Banners();
        $Banners->delete($id);
        return redirect()->to('/admin/banners')->with('success', 'Successfully Deleted');
    }
}
