<?php

namespace Webly\Core\Controllers\Admin;

use CodeIgniter\Files\File;
use Webly\Core\Controllers\BaseController;
use Webly\Core\Models\BlogPosts;
use Webly\Core\Models\BlogPostBlocks;

class BlogPostsController extends BaseController
{
    public function index()
    {
        $blogPosts = new BlogPosts();

        return view('Webly\Core\Views\Admin\BlogPosts\index', [
            'title' => 'BlogPosts', 
            'blogPosts' => $blogPosts->paginate(),
            'pager' => $blogPosts->pager
        ]);
    }

    public function create()
    {
        $blogPosts = new BlogPosts();
        $blogPost = $blogPosts->newEntity();
        $blogPost->visible = true;

        if ($this->request->getMethod() === 'post') {
            $data = $this->request->getPost();

            $inputs = $this->validate([
                'title' => 'required|max_length[60]|is_unique[blog_posts.title]',
                'content' => 'required',                
                'featured_image' => [
                    'label' => 'Image File',
                    'rules' => 'is_image[featured_image]'
                        . '|mime_in[featured_image,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
                        . '|max_size[featured_image,500]'
                ],
                'page_title' => 'required|max_length[60]|is_unique[blog_posts.page_title, id, {id}]',
                'meta_description' => 'required|max_length[160]',
            ]);

            if($inputs) {
                $blogPost->fill($data);

                $featuredImage = $this->request->getFile('featured_image');
                if ($featuredImage->isValid() && !$featuredImage->hasMoved()) {
                    $blogPost->featured_image = 'writable/uploads/' . $featuredImage->store();
                }
                $blogPosts->save($blogPost);

                return redirect()->to('/admin/blog-posts')->with('success', 'Saved successfully');
            } else {
                return redirect()->to('/admin/blog-posts/create')->withInput()->with('error', 'Could not be saved');
            }
                        
        }

        return view('Webly\Core\Views\Admin\BlogPosts\update', [
            'title' => 'Blog Posts', 
            'blogPost' => $blogPost
        ]);        
    }    

    public function update($id)
    {
        $blogPosts = new BlogPosts();
        $blogPost = $blogPosts->find($id);

        if ($this->request->getMethod() === 'post') {
            $data = $this->request->getPost();

            $validate = [
                'title' => 'required|max_length[60]|is_unique[blog_posts.title, id, {id}]',
                'content' => 'required',
                'featured_image' => [
                    'label' => 'Image File',
                    'rules' => 'is_image[featured_image]'
                        . '|mime_in[featured_image,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
                        . '|max_size[featured_image,1024]'
                ],
                'page_title' => 'required|max_length[60]|is_unique[blog_posts.page_title, id, {id}]',
                'meta_description' => 'required|max_length[160]',
            ];

            $inputs = $this->validate($validate);

            if($inputs) {
                $blogPost->fill($data);
                
                $featuredImage = $this->request->getFile('featured_image');
                if ($featuredImage->isValid() && !$featuredImage->hasMoved()) {
                    $blogPost->featured_image = 'writable/uploads/' . $featuredImage->store();
                }
                
                if(!empty($data['remove_featured_image']) && $data['remove_featured_image'] == 1) {
                    $blogPost->featured_image = null;
                }
                $blogPosts->save($blogPost);

                return redirect()->to('/admin/blog-posts')->with('success', 'Saved successfully');
            } else {
                return redirect()->to('/admin/blog-posts/update/'.$id)->withInput()->with('error', 'could not be saved');
            }
                        
        }

        return view('Webly\Core\Views\Admin\BlogPosts\update', [
            'title' => 'BlogPosts', 
            'blogPost' => $blogPost,
        ]);        
    }

    public function delete($id)
    {
        $blogPosts = new BlogPosts();
        $blogPosts->delete($id);
        return redirect()->to('/admin/blog-posts')->with('success', 'Successfully Deleted');
    }
}
