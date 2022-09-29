<?php

namespace Webly\Core\Controllers\Admin;

use Webly\Core\Controllers\BaseController;
use Webly\Core\Models\Albums;

class AlbumsController extends BaseController
{
    public function index()
    {
        $Albums = new Albums();

        $db = \Config\Database::connect();
        $builder = $db->table('albums');

        $albums = $builder
            ->select(['albums.*', 'gallery_categories.category'])
            ->join('gallery_categories', 'albums.gallery_category_id = gallery_categories.id', 'inner')
            ->orderBy('albums.sort_order', 'asc')
            ->get()
            ->getResult();

        return view('Webly\Core\Views\Admin\Albums\index', [
            'title' => 'Albums', 
            'albums' => $albums,
            'pager' => $Albums->pager
        ]);
    }

    public function sort()
    {
        $Albums = new Albums();

        if ($this->request->getMethod() === 'post') {
            $data = $this->request->getPost();
            foreach($data['sorted'] as $sorOrder => $id) {
                $data = [
                    'sort_order' => $sorOrder
                ];
                $Albums->update((int)$id, $data);
            }
        }  
    }         

    public function create()
    {
        $Albums = new Albums();
        $album = $Albums->newEntity();

        if ($this->request->getMethod() === 'post') {
            $data = $this->request->getPost();

            $inputs = $this->validate([
                'album' => 'required|max_length[60]|is_unique[albums.album]',               
                'album_image' => [
                    'label' => 'Album Image',
                    'rules' => 'uploaded[album_image]|is_image[album_image]'
                        . '|mime_in[album_image,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
                        . '|max_size[album_image,512]'
                ],                
            ]);

            if($inputs) {
                $album->fill($data);

                $albumImage = $this->request->getFile('album_image');
                if ($albumImage->isValid() && !$albumImage->hasMoved()) {
                    $album->album_image = 'writable/uploads/' . $albumImage->store();
                }

                $Albums->save($album);

                return redirect()->to('/admin/albums')->with('success', 'Saved successfully');
            } else {
                return redirect()->to('/admin/albums/create')->withInput()->with('error', 'could not be saved');
            }
                        
        }

        return view('Webly\Core\Views\Admin\Albums\create', [
            'title' => 'Albums', 
            'album' => $album
        ]);        
    }    

    public function update($id)
    {
        $Albums = new Albums();
        $album = $Albums->find($id);

        if ($this->request->getMethod() === 'post') {
            $data = $this->request->getPost();

            $inputs = $this->validate([
                'album' => 'required|max_length[60]|is_unique[albums.album, id, {id}]',               
                'album_image' => [
                    'label' => 'Album Image',
                    'rules' => 'is_image[album_image]'
                        . '|mime_in[album_image,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
                        . '|max_size[album_image,512]'
                ],                
            ]);

            if($inputs) {
                $album->fill($data);

                $albumImage = $this->request->getFile('album_image');
                if ($albumImage->isValid() && !$albumImage->hasMoved()) {
                    $album->album_image = 'writable/uploads/' . $albumImage->store();
                }

                $Albums->save($album);

                return redirect()->to('/admin/albums')->with('success', 'Saved successfully');
            } else {
                return redirect()->to('/admin/albums/update/'.$id)->withInput()->with('error', 'Could not be saved');
            }
                        
        }

        return view('Webly\Core\Views\Admin\Albums\update', [
            'title' => 'Albums', 
            'album' => $album
        ]);        
    }

    public function delete($id)
    {
        $Albums = new Albums();
        $Albums->delete($id);
        return redirect()->to('/admin/albums')->with('success', 'Successfully Deleted');
    }
}
