<?php

declare(strict_types=1);

namespace Webly\Core;

use Webly\Core\Models\Menus;

class Webly
{
    public function getTemplates()
    {
        $folders = directory_map(config('Paths')->viewDirectory, 1);

        $templates = [];
        foreach($folders as $folder) {
            if(!in_array($folder, ['adminlte3/'])) {
                $templates[$folder] = humanize(str_replace('/', '', $folder));
            }
        }
        return $templates;
    }

    public function getLayouts()
    {
        $path = config('Paths')->viewDirectory . '/' . service('settings')->get('App.template') . 'layouts';
        $files = get_filenames($path, false, false, false);

        $layouts = [];
        $exclude = ['404.php', 'blog.php'];
        foreach($files as $file) {
            if(!in_array($file, $exclude)) {
                $layouts[str_replace('.php', '', $file)] = str_replace('.php', '', $file);
            }
        }

        return $layouts;
    } 

    public function getMenu($menu)
    {
        $Menus = new Menus();
        return json_decode($Menus->where('menu', $menu)->first()->menu_items);
    }
}
