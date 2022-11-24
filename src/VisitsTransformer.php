<?php

namespace Webly\Core;

use Tatter\Visits\Interfaces\Transformer;
use CodeIgniter\HTTP\IncomingRequest;
use Tatter\Visits\Entities\Visit;

class VisitsTransformer implements Transformer
{

    public static function transform(Visit $visit, IncomingRequest $request): ?Visit
    {
        $request->breadcrum = "sanjeev";
        $agent = $request->getUserAgent();

        if ($agent->isBrowser()) {
            $currentAgent = $agent->getBrowser() . ' ' . $agent->getVersion();
        } elseif ($agent->isRobot()) {
            $currentAgent = $agent->getRobot();
        } elseif ($agent->isMobile()) {
            debug($agent->getMobile());
            $currentAgent = $agent->getMobile();
        } else {
            $currentAgent = 'Unidentified User Agent';
        }

        $visit->platform = $agent->getPlatform();
        
        return $visit;
    }
}
