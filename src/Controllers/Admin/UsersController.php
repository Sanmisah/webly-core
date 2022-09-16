<?php

namespace Webly\Core\Controllers\Admin;

use Webly\Core\Controllers\BaseController;
// use CodeIgniter\Shield\Models\UserModel;
use CodeIgniter\Shield\Entities\User;

class UsersController extends BaseController
{
    public function index()
    {
        $Users = model('\Webly\Core\Models\Users');

        return view('Webly\Core\Views\Admin\Users\index', [
            'title' => 'Users', 
            'users' => $Users->paginate(),
            'pager' => $Users->pager
        ]);
    }

    public function create()
    {
        $Users = model('\Webly\Core\Models\Users');

        if ($this->request->getMethod() === 'post') {
            $data = $this->request->getPost();

            $validation = config('Validation')->createUser;
            $inputs = $this->validate($validation);

            if($inputs) {
                $data['username'] = null;
                $user = new User($data);
                $Users->save($user);

                $user = $Users->findById($Users->getInsertID());
                $user->syncGroups(...$data['group']);
                return redirect()->to('/admin/users')->with('success', 'Saved successfully');
            } else {
                return redirect()->to('/admin/users/create')->withInput()->with('error', 'could not be saved');
            }
                        
        }

        return view('Webly\Core\Views\Admin\Users\create', [
            'title' => 'Users', 
        ]);        
    }    

    public function update($id)
    {
        $Users = model('\Webly\Core\Models\Users');
        $user = $Users->find($id);

        if ($this->request->getMethod() === 'post') {
            $data = $this->request->getPost();
            $validation = config('Validation')->updateUser;

            if(empty($data['password'])) {
                unset($validation['password']);
            }
            $inputs = $this->validate($validation);

            if($inputs) {
                $user->fill($data);
                $Users->save($user);
                $user->syncGroups(...$data['group']);
                return redirect()->to('/admin/users')->with('success', 'Saved successfully');
            } else {
                return redirect()->to('/admin/users/update/'.$id)->withInput()->with('error', 'could not be saved');
            }
                        
        }

        return view('Webly\Core\Views\Admin\Users\update', [
            'title' => 'Users', 
            'user' => $user
        ]);        
    }

    public function delete($id)
    {
        $Users = model('\Webly\Core\Models\Users');
        $Users->delete($id, true);
        return redirect()->to('/admin/users')->with('success', 'Successfully Deleted');
    }
}
