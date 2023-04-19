<?php

namespace Webly\Core\Controllers\Admin;

use Webly\Core\Controllers\BaseController;
use Webly\Core\Models\Blocks;

class BlocksController extends BaseController
{
    public function index()
    {
        $Blocks = new Blocks();

        return view('Webly\Core\Views\Admin\Blocks\index', [
            'title' => 'Blocks', 
            'blocks' => $Blocks->paginate(),
            'pager' => $Blocks->pager
        ]);
    }

    public function create()
    {
        $Blocks = new Blocks();
        $block = $Blocks->newEntity();

        if ($this->request->getMethod() === 'post') {
            $data = $this->request->getPost();

            $inputs = $this->validate([
                'block' => 'required|max_length[30]|is_unique[blocks.block]',
                'description' => 'required',
            ]);

            if($inputs) {
                $block->fill($data);
                $Blocks->save($block);

                return redirect()->to('/admin/blocks')->with('success', 'Saved successfully');
            } else {
                return redirect()->to('/admin/blocks/create')->withInput()->with('error', 'Could not be saved');
            }
                        
        }

        return view('Webly\Core\Views\Admin\Blocks\update', [
            'title' => 'Blocks', 
            'block' => $block
        ]);        
    }    

    public function update($id)
    {
        $Blocks = new Blocks();
        $block = $Blocks->find($id);

        if ($this->request->getMethod() === 'post') {
            $data = $this->request->getPost();

            $inputs = $this->validate([
                'block' => 'required|max_length[30]|is_unique[blocks.block, id, {id}]',
                'description' => 'required',
            ]);

            if($inputs) {
                $block->fill($data);
                $Blocks->save($block);

                return redirect()->to('/admin/blocks')->with('success', 'Saved successfully');
            } else {
                return redirect()->to('/admin/blocks/update/'.$id)->withInput()->with('error', 'Could not be saved');
            }
                        
        }

        return view('Webly\Core\Views\Admin\Blocks\update', [
            'title' => 'Blocks', 
            'block' => $block
        ]);        
    }

    public function delete($id)
    {
        $Blocks = new Blocks();
        $Blocks->delete($id);
        return redirect()->to('/admin/blocks')->with('success', 'Successfully Deleted');
    }
}
