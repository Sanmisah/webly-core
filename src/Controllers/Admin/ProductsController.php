<?php

namespace Webly\Core\Controllers\Admin;

use CodeIgniter\Files\File;
use Webly\Core\Controllers\BaseController;
use Webly\Core\Models\Products;
use Webly\Core\Models\ProductBlocks;

class ProductsController extends BaseController
{
    public function index()
    {
        $Products = new Products();

        return view('Webly\Core\Views\Admin\Products\index', [
            'title' => 'Products', 
            'products' => $Products->paginate(),
            'pager' => $Products->pager
        ]);
    }

    public function create()
    {
        $Products = new Products();
        $product = $Products->newEntity();
        $product->visible = true;

        if ($this->request->getMethod() === 'post') {
            $data = $this->request->getPost();

            $inputs = $this->validate([
                'product' => 'required|max_length[60]|is_unique[products.product]',
                'content' => 'required',                
                'featured_image' => [
                    'label' => 'Image File',
                    'rules' => 'is_image[featured_image]'
                        . '|mime_in[featured_image,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
                        . '|max_size[featured_image,500]'
                ],
                'page_title' => 'required|max_length[60]|is_unique[products.page_title, id, {id}]',
                'meta_description' => 'required|max_length[160]',
            ]);

            if($inputs) {
                $product->fill($data);

                $featuredImage = $this->request->getFile('featured_image');
                if ($featuredImage->isValid() && !$featuredImage->hasMoved()) {
                    $newName = $featuredImage->getRandomName();
                    $featuredImage->move("uploads/", $newName);                    
                    $product->featured_image = 'uploads/' . $newName;
                }
                $Products->save($product);

                return redirect()->to('/admin/products/update/'.$Products->insertID())->with('success', 'Saved successfully');
            } else {
                return redirect()->to('/admin/products/create')->withInput()->with('error', 'Could not be saved');
            }
                        
        }

        return view('Webly\Core\Views\Admin\Products\create', [
            'title' => 'Products', 
            'product' => $product
        ]);        
    }    

    public function update($id)
    {
        $Products = new Products();
        $product = $Products->find($id);

        $ProductBlocks = new ProductBlocks();
        $productBlocks = $ProductBlocks->where('product_id', $id)->findAll();

        if ($this->request->getMethod() === 'post') {
            $data = $this->request->getPost();

            $validate = [
                'id'    => 'is_natural_no_zero',
                'product' => 'required|max_length[100]|is_unique[products.product, id, {id}]',
                'content' => 'required',
                'featured_image' => [
                    'label' => 'Image File',
                    'rules' => 'is_image[featured_image]'
                        . '|mime_in[featured_image,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
                        . '|max_size[featured_image,1024]'
                ],
                'page_title' => 'required|max_length[100]|is_unique[products.page_title, id, {id}]',
                'meta_description' => 'required|max_length[160]',
            ];

            $pgIds = preg_grep('/pg_\d+_id/', array_keys($data));
            $pgBlocks = preg_grep('/pg_\d+_block/', array_keys($data));
            $pgContents = preg_grep('/pg_\d+_content/', array_keys($data));

            foreach($pgBlocks as $block) {
                if(!empty($data[$block])) {
                    $validate[$block] = 'required|alpha_dash|max_length[30]';
                }
            }

            $inputs = $this->validate($validate);

            if($inputs) {
                $pageData = $data;
                foreach($pgIds as $pgId) {
                    unset($pageData[$pgId]);
                }

                foreach($pgBlocks as $pgBlock) {
                    unset($pageData[$pgBlock]);
                }

                foreach($pgContents as $pgContent) {
                    unset($pageData[$pgContent]);
                }                
                unset($pageData['csrf_test_name']);

                $product->fill($pageData);
                
                $featuredImage = $this->request->getFile('featured_image');
                if ($featuredImage->isValid() && !$featuredImage->hasMoved()) {
                    $newName = $featuredImage->getRandomName();
                    $path = 'uploads/'.date('dmY').'/';
                    $featuredImage->move($path, $newName);                    
                    $product->featured_image = $path . $newName;
                }
                
                if(!empty($data['remove_featured_image']) && $data['remove_featured_image'] == 1) {
                    $product->featured_image = null;
                }
                $Products->save($product);

                for($i=0; $i<=count($pgIds); $i++) {
                    if(!empty($data['pg_' . $i . '_block'])) {
                        $productBlock = [
                            'id' => $data['pg_' . $i . '_id'],
                            'product_id' => $data['id'],
                            'block' => $data['pg_' . $i . '_block'],
                            'content' => $data['pg_' . $i . '_content'],
                        ];
                        $ProductBlocks->save($productBlock);
                    }
                }

                return redirect()->to('/admin/products')->with('success', 'Saved successfully');
            } else {
                return redirect()->to('/admin/products/update/'.$id)->withInput()->with('error', 'Could not be saved');
            }
                        
        }

        return view('Webly\Core\Views\Admin\Products\update', [
            'title' => 'Products', 
            'product' => $product,
            'productBlocks' => $productBlocks
        ]);        
    }

    public function delete($id)
    {
        $Products = new Products();
        $Products->delete($id);
        return redirect()->to('/admin/products')->with('success', 'Successfully Deleted');
    }
}
