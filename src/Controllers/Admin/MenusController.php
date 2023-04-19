<?php

namespace Webly\Core\Controllers\Admin;

use Webly\Core\Controllers\BaseController;
use Webly\Core\Models\Menus;

class MenusController extends BaseController
{
    protected $menuItems;

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
                return redirect()->to('/admin/menus/create')->withInput()->with('error', 'Could not be saved');
            }
                        
        }

        return view('Webly\Core\Views\Admin\Menus\update', [
            'title' => 'Menus', 
            'menu' => $menu
        ]);        
    }    


    function getChildren(&$menu) {
        if(!empty($menu->children)) {
            foreach($menu->children as $i => $item) {
                $menu->children[$i]->slug = $menu->slug . '/' . url_title($item->value, '-', true);
                $this->menuItems[url_title($item->value, '-', true)] = $item->value;
                $this->getChildren($item);
            }
        } else {
            return false;
        }
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
                $menuItems = json_decode($menu->menu_items);

                foreach($menuItems as $i=>$item) {
                    if($item->route == "\\Webly\\Core\\Controllers\\PagesController::display/1") {
                        $menuItems[$i]->slug = '/';
                        $this->menuItems['/'] = $item->value;
                    } elseif($item->route == '#') {
                        $menuItems[$i]->slug = "#";
                    } else {
                        $menuItems[$i]->slug = url_title($menuItems[$i]->value, '-', true);
                        $this->menuItems[$menuItems[$i]->slug] = $item->value;
                    }
                    $this->getChildren($menuItems[$i]);
                }

                // debug($this->menuItems);
                // debug($menuItems); exit;
                $menu->menu_items = json_encode($menuItems);

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
