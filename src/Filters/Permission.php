<?php
namespace Webly\Core\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

use Shield\Exceptions\PermissionException;

class Permission implements FilterInterface
{
    public function before(RequestInterface $request, $params = null)
    {
        if (empty($params)) {
	        return;
        }
        
        if (!function_exists('auth')) {
	        helper('auth');
        }
        
        if (!auth()->loggedIn()) {
	        return redirect()->route('login')->with('error', 'You do not have access permission.');
        }
        
        $result = true;
        
        foreach ($params as $permission) {
	        $result = $result && auth()->user()->can($permission);
        }
        
        if (!$result) {
	        throw new PermissionException(lang('Auth.notEnoughPrivilege'));
        }
    }
    
    // ------------------------------------------------------------------------
    
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
    }
}