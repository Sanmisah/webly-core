<?php

namespace Webly\Core\Models;

class Menus extends BaseModel
{
    protected $table            = 'menus';
    protected $returnType       = \Webly\Core\Entities\Menu::class;
    protected $allowedFields    = ['id', 'menu', 'menu_items'];
}
