<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Google_login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Google_login_model");
        $this->load->model('User_model');
        
    }

    public function login()
    {
        include_once APPPATH . 'libraries/vendor/autoload.php';
        $google_client = new Google_Client();
        $google_client->setClientId('981383344271-44t68jekt07rb2noc7l698egdem74gvv.apps.googleusercontent.com');
        $google_client->setClientSecret('4SXgqoWow6Et9tQ7deEi2Ia1');
        $google_client->setRedirectUri('https://waena-desa.id/objekwisata/google_login/login');
        $google_client->addScope('email');
        $google_client->addScope('profile');
        $google_client->createAuthUrl();
        if(isset($_GET["code"])){
            $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
            if(!isset($token['error'])){
                $google_client->setAccessToken($token['access_token']);
                $this->session->set_userdata('access_token', $token['access_token']);
                $google_service = new Google_Service_Oauth2($google_client);
                $data = $google_service->userinfo->get();
                $current_datetime = date('Y-m-d H:i:s');
                if($this->Google_login_model->Is_already_register($data['id'])){
                    $output = $this->Google_login_model->get($data['id']);
                    $this->session->set_userdata('user_data', $output[0]);
                }else{
                    $user_data = array(
                        'oauth_uid' => $data['id'],
                        'nama' => $data['name'],
                        'email' => $data['email'],
                        'picture' => $data['picture'],
                        'jk' => $data['gender'],
                        'created' => $current_datetime,
                    );
                    $this->User_model->register($user_data);
                    $output = $this->Google_login_model->get($data['id']);
                    $this->session->set_userdata('user_data', $output);
                }
                // $this->session->set_userdata('user_data', $user_data);
                redirect('home');
            }
            
        }
    }
    public function logout()
    {
       
        $this->session->unset_userdata('access_token');
        $this->session->unset_userdata('user_data');
        redirect('login');
        
    }

 
    public function register()
    {
        include_once APPPATH . 'libraries/vendor/autoload.php';
        $google_client = new Google_Client();
        $google_client->setClientId('996822708677-l4cf5n1m439imknnbsjrsv7ktn5h4vk0.apps.googleusercontent.com');
        $google_client->setClientSecret('UXQAVCmrvR-ePEz35fVFkJxf');
        $google_client->setRedirectUri('https://waena-desa.id/objekwisata/google_login/login');
        $google_client->addScope('email');
        $google_client->addScope('profile');
        if(isset($_GET["code"])){
            $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
            if(!isset($token['error'])){
                $google_client->setAccessToken($token['access_token']);
                $this->session->userdata('access_token', $token['access_token']);
                $google_service = new Google_Service_Oauth2($google_client);
                $data = $google_service->userinfo->get();
                $current_datetime = date('Y-m-d H:i:s');
                if($this->Google_login_model->Is_already_register($data['id'])){
                    $user_data = array(
                        'first_name' => $data['given_name'],
                        'last_name' => $data['family_name'],
                        'email' => $data['email'],
                        'picture' => $data['picture'],
                        'gender' => $data['gender'],
                        'modified' => $current_datetime,
                    );
                    $this->Google_login_model->Update_user_data($user_data, $data['id']);
                }else{
                    $user_data = array(
                        'oauth_uid' => $data['id'],
                        'first_name' => $data['given_name'],
                        'last_name' => $data['family_name'],
                        'email' => $data['email'],
                        'picture' => $data['picture'],
                        'gender' => $data['gender'],
                        'created' => $current_datetime,
                    );
                    $this->Google_login_model->Insert_user_data($user_data);
                }
                $this->session->userdata('user_data', $user_data);
            }
        }
        if(!$this->session->userdata('access_token')){
            $login_button = '<a href="'.$google_client->createAuthUrl().'"><img src ="'.base_url().'asset/sign-in-with-google.png"/></a>';
        }
        $data['login_button'] = $login_button;
        $this->load->view('register',$data);
	}
	
        
}
