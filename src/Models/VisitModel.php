<?php

namespace Webly\Core\Models;

use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\I18n\Time;
use CodeIgniter\Model;
use Faker\Generator;
use Webly\Core\Entities\Visit;

class VisitModel extends Tatter\Visits\Models\VisitModel
{
    protected $returnType    = Visit::class;
    
   protected function initialize()
   {
        $this->allowedFields[] = [
            'browser',
            'mobile',
            'platform'
        ];
   }    
}
