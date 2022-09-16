<?php

namespace Webly\Core\Controllers\Admin;

use Webly\Core\Controllers\BaseController;
use Webly\Core\Models\Menus;

class MenusController extends BaseController
{
    public function index()
    {
        $Menus = new Menus();

        return view('Webly\Core\Views\Admin\Menus\index', [
            'title' => 'Menus', 
            'menus' => $Menus->paginate(),
            'pager' => $Menus->pager
        ]);
    }

    public function create()
    {
        $Menus = new Menus();
        $menu = $Menus->newEntity();

        if ($this->request->getMethod() === 'post') {
            $data = $this->request->getPost();

            $inputs = $this->validate([
                'menu' => 'required|max_length[30]|is_unique[menus.menu]',
                'menu_items' => 'required',
            ]);

            if($inputs) {
                $menu->fill($data);
                $Menus->save($menu);

                return redirect()->to('/admin/menus')->with('success', 'Saved successfully');
            } else {
                return redirect()->to('/admin/menus/create')->withInput()->with('error', 'could not be saved');
            }
                        
        }

        return view('Webly\Core\Views\Admin\Menus\update', [
            'title' => 'Menus', 
            'menu' => $menu
        ]);        
    }    

    public function update($id)
    {
        $Menus = new Menus();
        $menu = $Menus->find($id);

        if ($this->request->getMethod() === 'post') {
            $data = $this->request->getPost();

            $inputs = $this->validate([
                'menu' => 'required|max_length[30]|is_unique[menus.menu, id, {id}]',
                'menu_items' => 'required',
            ]);

            if($inputs) {
                $menu->fill($data);
                $Menus->save($menu);

                return redirect()->to('/admin/menus')->with('success', 'Saved successfully');
            } else {
                return redirect()->to('/admin/menus/update/'.$id)->withInput()->with('error', 'Could not be saved');
            }
                        
        }

        return view('Webly\Core\Views\Admin\Menus\update', [
            'title' => 'Menus', 
            'menu' => $menu
        ]);        
    }

    public function delete($id)
    {
        $Menus = new Menus();
        $Menus->delete($id);
        return redirect()->to('/admin/menus')->with('success', 'Successfully Deleted');
    }
}
