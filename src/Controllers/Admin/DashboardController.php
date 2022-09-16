<?php

namespace Webly\Core\Controllers\Admin;

use Webly\Core\Controllers\BaseController;

class DashboardController extends BaseController
{
    public function index()
    {
        return view('Webly\Core\Views\Admin\Dashboard\index', [
            'title' => 'Dashbaord',
        ]);
    }
}
