<?php

declare(strict_types=1);

namespace Webly\Core;

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
        foreach($files as $file) {
            $layouts[str_replace('.php', '', $file)] = str_replace('.php', '', $file);
        }

        return $layouts;
    } 
}
