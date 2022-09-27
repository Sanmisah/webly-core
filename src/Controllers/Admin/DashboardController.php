<?php

namespace Webly\Core\Controllers\Admin;

use Webly\Core\Controllers\BaseController;

class DashboardController extends BaseController
{
    public function index()
    {

        $db = \Config\Database::connect();
        $builder = $db->table('visits');

        $currentDate = new \DateTime();
        $currentDate->add(\DateInterval::createFromDateString('-30 days'));
        
        $days = [];
        $data = [];
        $maxVisist = 0;
        for($i = 0; $i <= 30; $i++) {
            $days[] = $currentDate->format('d M');

            $row = $builder
                ->select(['DATE_FORMAT(created_at, "%Y-%m-%d") AS date', 'SUM(views) AS views'])
                ->where('DATE_FORMAT(created_at, "%Y-%m-%d")', $currentDate->format('Y-m-d'))
                ->groupBy(['DATE_FORMAT(created_at, "%Y-%m-%d")'])
                ->get()
                ->getRow();

            $views = !empty($row->views) ? $row->views : 0;
            $data[] = $views;

            $maxVisist = ($maxVisist < $views) ? $views : $maxVisist;

            $currentDate->add(\DateInterval::createFromDateString('1 days'));
        }

        $topPages = $builder
            ->select(['path', 'query', 'SUM(views) AS views'])
            ->groupBy(['path', 'query'])
            ->orderBy('SUM(views)', 'DESC')
            ->limit(10)
            ->get()
            ->getResult();

        return view('Webly\Core\Views\Admin\Dashboard\index', [
            'title' => 'Dashbaord',
            'days' => $days,
            'data' => $data,
            'stepSize' => ceil($maxVisist / 5) + 5,
            'topPages' => $topPages
        ]);
    }
}
