<?php

namespace Webly\Core\Controllers\Admin;

use Webly\Core\Controllers\BaseController;

class SettingsController extends BaseController
{
    public function update()
    {
        if ($this->request->getMethod() === 'post') {
            $inputs = $this->validate([
                'website_title' => 'required|min_length[5]|max_length[255]',
                'from_email' => 'required|valid_email',
                'from_name' => 'required',
            ]);
           
            if($inputs) {
                service('settings')->set("App.website_title", $this->request->getVar('website_title'));
                service('settings')->set("App.template", $this->request->getVar('template'));
                service('settings')->set("App.global_metadata", $this->request->getVar('global_metadata'));

                service('settings')->set("Email.fromEmail", $this->request->getVar('from_email'));
                service('settings')->set("Email.fromName", $this->request->getVar('from_name'));

                service('settings')->set("Email.protocol", $this->request->getVar('protocol'));
                service('settings')->set("Email.mailPath", $this->request->getVar('mail_path'));

                service('settings')->set("Email.SMTPHost", $this->request->getVar('SMTP_host'));
                service('settings')->set("Email.SMTPUser", $this->request->getVar('SMTP_user'));
                service('settings')->set("Email.SMTPPass", $this->request->getVar('SMTP_pass'));

                service('settings')->set("Email.SMTPPort", $this->request->getVar('SMTP_port'));
                service('settings')->set("Email.SMTPTimeout", $this->request->getVar('SMTP_timeout'));
                service('settings')->set("Email.SMTPCrypto", $this->request->getVar('SMTP_crypto'));

                return redirect()->to('/admin/settings')->with('success', 'Settings saved successfully');
            } else {
                return redirect()->to('/admin/settings')->withInput()->with('error', 'Settings could not be saved');
            }
        }

        return view('Webly\Core\Views\Admin\Settings\update', ['title' => 'Settings']);
    } 
}
