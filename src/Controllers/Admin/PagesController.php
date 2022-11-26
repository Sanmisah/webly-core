<?php

namespace Webly\Core\Controllers\Admin;

use CodeIgniter\Files\File;
use Webly\Core\Controllers\BaseController;
use Webly\Core\Models\Pages;
use Webly\Core\Models\PageBlocks;

class PagesController extends BaseController
{
    public function index()
    {
        $Pages = new Pages();

        return view('Webly\Core\Views\Admin\Pages\index', [
            'title' => 'Pages', 
            'pages' => $Pages->paginate(),
            'pager' => $Pages->pager
        ]);
    }

    public function create()
    {
        $Pages = new Pages();
        $page = $Pages->newEntity();
        $page->visible = true;

        if ($this->request->getMethod() === 'post') {
            $data = $this->request->getPost();

            $inputs = $this->validate([
                'title' => 'required|max_length[60]|is_unique[pages.title]',
                'content' => 'required',                
                'featured_image' => [
                    'label' => 'Image File',
                    'rules' => 'is_image[featured_image]'
                        . '|mime_in[featured_image,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
                        . '|max_size[featured_image,500]'
                ],
                'page_title' => 'required|max_length[60]|is_unique[pages.page_title, id, {id}]',
                'meta_description' => 'required|max_length[160]',
            ]);

            if($inputs) {
                $page->fill($data);

                $featuredImage = $this->request->getFile('featured_image');
                if ($featuredImage->isValid() && !$featuredImage->hasMoved()) {
                    $newName = $featuredImage->getRandomName();
                    $featuredImage->move("uploads/", $newName);                    
                    $page->featured_image = 'uploads/' . $newName;
                }
                $Pages->save($page);

                return redirect()->to('/admin/pages/update/'.$Pages->insertID())->with('success', 'Saved successfully');
            } else {
                return redirect()->to('/admin/pages/create')->withInput()->with('error', 'Could not be saved');
            }
                        
        }

        return view('Webly\Core\Views\Admin\Pages\create', [
            'title' => 'Pages', 
            'page' => $page
        ]);        
    }    

    public function update($id)
    {
        $Pages = new Pages();
        $page = $Pages->find($id);

        $PageBlocks = new PageBlocks();
        $pageBlocks = $PageBlocks->where('page_id', $id)->findAll();

        if ($this->request->getMethod() === 'post') {
            $data = $this->request->getPost();

            $validate = [
                'title' => 'required|max_length[60]|is_unique[pages.title, id, {id}]',
                'content' => 'required',
                'featured_image' => [
                    'label' => 'Image File',
                    'rules' => 'is_image[featured_image]'
                        . '|mime_in[featured_image,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
                        . '|max_size[featured_image,1024]'
                ],
                'page_title' => 'required|max_length[60]|is_unique[pages.page_title, id, {id}]',
                'meta_description' => 'required|max_length[160]',
            ];

            $pgIds = preg_grep('/pg_\d+_id/', array_keys($data));

            $pgBlocks = preg_grep('/pg_\d+_block/', array_keys($data));
            foreach($pgBlocks as $block) {
                if(!empty($data[$block])) {
                    $validate[$block] = 'required|alpha_dash|max_length[30]';
                }
            }

            $inputs = $this->validate($validate);

            if($inputs) {
                $page->fill($data);
                
                $featuredImage = $this->request->getFile('featured_image');
                if ($featuredImage->isValid() && !$featuredImage->hasMoved()) {
                    $newName = $featuredImage->getRandomName();
                    $path = 'uploads/'.date('dmY').'/';
                    $featuredImage->move($path, $newName);                    
                    $page->featured_image = $path . $newName;
                }
                
                if(!empty($data['remove_featured_image']) && $data['remove_featured_image'] == 1) {
                    $page->featured_image = null;
                }
                $Pages->save($page);

                for($i=0; $i<=count($pgIds); $i++) {
                    if(!empty($data['pg_' . $i . '_block'])) {
                        $pageBlock = [
                            'id' => $data['pg_' . $i . '_id'],
                            'page_id' => $data['id'],
                            'block' => $data['pg_' . $i . '_block'],
                            'content' => $data['pg_' . $i . '_content'],
                        ];

                        $PageBlocks->save($pageBlock);
                    }
                }

                return redirect()->to('/admin/pages')->with('success', 'Saved successfully');
            } else {
                return redirect()->to('/admin/pages/update/'.$id)->withInput()->with('error', 'could not be saved');
            }
                        
        }

        return view('Webly\Core\Views\Admin\Pages\update', [
            'title' => 'Pages', 
            'page' => $page,
            'pageBlocks' => $pageBlocks
        ]);        
    }

    public function delete($id)
    {
        $Pages = new Pages();
        $Pages->delete($id);
        return redirect()->to('/admin/pages')->with('success', 'Successfully Deleted');
    }
}
