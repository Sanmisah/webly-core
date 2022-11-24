<?php

namespace Webly\Core\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use CodeIgniter\Shield\Entities\User;
use CodeIgniter\Shield\Models\UserModel;

class Setup extends BaseCommand
{
    protected $group       = 'Webly';
    protected $name        = 'webly:setup';
    protected $description = 'Initial setup for Webly CMS.';
    protected $usage = 'shield:setup';
    protected $arguments = [];

    public function run(array $params)
    {
        $welcomeText = "
        _    _      _     _         _____ ___  ___ _____ 
       | |  | |    | |   | |       /  __ \|  \/  |/  ___|
       | |  | | ___| |__ | |_   _  | /  \/| .  . |\ `--. 
       | |/\| |/ _ \ '_ \| | | | | | |    | |\/| | `--. \
       \  /\  /  __/ |_) | | |_| | | \__/\| |  | |/\__/ /
        \/  \/ \___|_.__/|_|\__, |  \____/\_|  |_/\____/ 
                             __/ |                       
                            |___/                        
       ";


        CLI::write($welcomeText, 'light_cyan', 'black');
        $this->createAdmin();
        $this->addTestEmailConfig();
        $this->addInitWebsiteData();
        CLI::write('Webly Setup Completed', 'light_red', 'green');
    }

    private function createAdmin(): void
    {
        $name = CLI::prompt('Admin Name', 'Admin', 'required|max_length[100]');
        // $email = CLI::prompt('Admin Email', 'admin@webly.com', 'required|max_length[254]|valid_email|is_unique[auth_identities.secret]');
        $email = CLI::prompt('Admin Email', 'admin@webly.com', 'required|max_length[254]|valid_email');
        $password = CLI::prompt('Admin Password', 'abcd123@', 'required');

        $Users = model('Webly\Core\Models\Users');
        $user = new User([
            'name' => $name,
            'username' => null,
            'email' => $email,
            'password' => $password,
        ]);

        $Users->save($user);
        // Get the updated user so we have the ID...
        $user = $Users->findById($Users->getInsertID());
        $user->addGroup('admin');        
    }

    private function addTestEmailConfig(): void
    {
        service('settings')->set('App.website_title', 'My Website');
        service('settings')->set('App.template', 'Webly/');

        service('settings')->set('Email.fromEmail', 'noreply@sanmishatech.com');
        service('settings')->set('Email.fromName', 'Sanmisha Test');

        service('settings')->set('Email.protocol', 'smtp');

        service('settings')->set('Email.SMTPHost', 'mail.sanmishatech.com');
        service('settings')->set('Email.SMTPUser', 'noreply@sanmishatech.com');
        service('settings')->set('Email.SMTPPass', '');

        service('settings')->set('Email.SMTPPort', '587');
        service('settings')->set('Email.SMTPTimeout', '5');
        service('settings')->set('Email.SMTPCrypto', 'tls');        
    }

    private function addInitWebsiteData(): void
    {
        $seeder = \Config\Database::seeder();
        $seeder->call('Webly\Core\Database\Seeds\InitWebsiteContent');
    }
}