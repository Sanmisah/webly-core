<?php

namespace Webly\Core\Controllers\Admin;

use Webly\Core\Controllers\BaseController;
use Webly\Core\Models\Albums;
use Webly\Core\Models\AlbumImages;
use CodeIgniter\API\ResponseTrait;

class AlbumsController extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('albums');

        $albums = $builder
            ->select(['albums.*', 'gallery_categories.category'])
            ->join('gallery_categories', 'albums.gallery_category_id = gallery_categories.id', 'left')
            ->orderBy('albums.sort_order', 'asc')
            ->get()
            ->getResult();

        return view('Webly\Core\Views\Admin\Albums\index', [
            'title' => 'Albums', 
            'albums' => $albums,
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
    
    public function image_sort()
    {
        $AlbumImages = new AlbumImages();

        if ($this->request->getMethod() === 'post') {
            $data = $this->request->getPost();
            foreach($data['sorted'] as $sorOrder => $id) {
                $data = [
                    'sort_order' => $sorOrder
                ];
                $AlbumImages->update((int)$id, $data);
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
                'gallery_category_id' => 'required',
            ]);

            if($inputs) {
                $album->fill($data);

                $albumImage = $this->request->getFile('album_image');
                if ($albumImage->isValid() && !$albumImage->hasMoved()) {
                    $newName = $albumImage->getRandomName();
                    $path = 'uploads/'.date('dmY').'/';
                    $albumImage->move($path, $newName);                    
                    $album->album_image = $path . $newName;
                }

                $Albums->save($album);

                return redirect()->to('/admin/albums')->with('success', 'Saved successfully');
            } else {
                return redirect()->to('/admin/albums/create')->withInput()->with('error', 'Could not be saved');
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

        $AlbumImages = new AlbumImages();
        $images = $AlbumImages->where('album_id', $id)->find();

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
                'gallery_category_id' => 'required',                
            ]);

            if($inputs) {
                $album->fill($data);

                $albumImage = $this->request->getFile('album_image');
                if ($albumImage->isValid() && !$albumImage->hasMoved()) {
                    $newName = $albumImage->getRandomName();
                    $path = 'uploads/'.date('dmY').'/';
                    $albumImage->move($path, $newName);                    
                    $album->album_image = $path . $newName;
                }

                $Albums->save($album);

                if(!empty($data['images'])) {
                    foreach($data['images'] as $image) {
                        $AlbumImages->save($image);                    
                    }
                }

                return redirect()->to('/admin/albums')->with('success', 'Saved successfully');
            } else {
                return redirect()->to('/admin/albums/update/'.$id)->withInput()->with('error', 'Could not be saved');
            }
                        
        }

        return view('Webly\Core\Views\Admin\Albums\update', [
            'title' => 'Albums', 
            'album' => $album,
            'images' => $images
        ]);        
    }

    public function upload()
    {
        if ($this->request->getMethod() === 'post') {
            $data = $this->request->getPost();

            $inputs = $this->validate([
                'album_id' => 'required',               
                'file' => [
                    'label' => 'Image',
                    'rules' => 'uploaded[file]|is_image[file]'
                        . '|mime_in[file,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
                        . '|max_size[file,512]'
                ],                
            ]);

            if($inputs) {
                $AlbumImages = new AlbumImages();
                $image = $AlbumImages->newEntity();

                $file = $this->request->getFile('file');
                if ($file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getRandomName();
                    $path = 'uploads/'.date('dmY').'/';
                    $file->move($path, $newName);                    
                    $image->image = $path . $newName;
                }

                $image->album_id = $data['album_id'];
                $AlbumImages->save($image);

                $message = 'Uploaded Successfully!'; 
                return $this->respond($message, 200);
            } else {                
                $message = validation_show_error('file'); 
                return $this->respond($message, 400);
            }
            
        }
    }

    public function delete($id)
    {
        $Albums = new Albums();
        $Albums->delete($id);
        return redirect()->to('/admin/albums')->with('success', 'Successfully Deleted');
    }

    public function delete_image($id, $album_id)
    {
        $AlbumImages = new AlbumImages();
        $AlbumImages->delete($id);
        return redirect()->to("/admin/albums/update/{$album_id}")->with('success', 'Successfully Deleted');
    }    
}
