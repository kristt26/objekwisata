<?php

class Mylib
{
    public function randomchar()
    {
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $input_length = strlen($permitted_chars);
        $random_string = '';
        for($i = 0; $i < 15; $i++) {
            $random_character = $permitted_chars[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }
        return $random_string;
    }

    function btngoogle()
    {
        include_once APPPATH . 'libraries/vendor/autoload.php';
        $google_client = new Google_Client();
        $google_client->setClientId('981383344271-44t68jekt07rb2noc7l698egdem74gvv.apps.googleusercontent.com');
        $google_client->setClientSecret('4SXgqoWow6Et9tQ7deEi2Ia1');
        $google_client->setRedirectUri('http://localhost/objekwisata/google_login/login');
        $google_client->addScope('email');
        $google_client->addScope('profile');
        $login_button = '<a href="'.$google_client->createAuthUrl().'" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>';
        $data['login_button'] = $login_button;
        return $data['login_button'];
    }
}
