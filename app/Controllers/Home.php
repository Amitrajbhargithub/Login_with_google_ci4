<?php

namespace App\Controllers;

use App\Models\User;

class Home extends BaseController
{
    private $userModel=NULL;
	public $googleClient=NULL;
    function __construct(){

	}
    public function login()
    {
        require_once APPPATH. "libraries/vendor/autoload.php";
		$this->googleClient = new \Google_Client();
		$this->googleClient->setClientId("");
		$this->googleClient->setClientSecret("");
		$this->googleClient->setRedirectUri('http://localhost:8080/googleauth/loginWithgoogle');
		$this->googleClient->addScope("email");
		$this->googleClient->addScope("profile");

        $redirectUrl = $this->googleClient->createAuthUrl();
        return view('login-form',compact('redirectUrl'));
    }

    public function profile()
    {
        return view('profile');
    }

    public function loginWithgoogle()
    {
        require_once APPPATH. "libraries/vendor/autoload.php";
        $code = $this->request->getVar('code');
        $this->googleClient = new \Google_Client();
		$this->googleClient->setClientId("");
		$this->googleClient->setClientSecret("");
		$this->googleClient->setRedirectUri('http://localhost:8080/googleauth/loginWithgoogle');
		$this->googleClient->addScope("email");
		$this->googleClient->addScope("profile");
        $token = $this->googleClient->fetchAccessTokenWithAuthCode($code);
		if(!isset($token['error'])){
			$this->googleClient->setAccessToken($token['access_token']);
			session()->set("AccessToken", $token['access_token']);

			$googleService = new \Google_Service_Oauth2($this->googleClient);
			$data = $googleService->userinfo->get();
			$currentDateTime = date("Y-m-d H:i:s");
			echo "<pre>"; print_r($data);die;
			$userdata=array();
			if($this->userModel->isAlreadyRegister($data['id'])){
				//User ALready Login and want to Login Again
				$userdata = [
					'name'=>$data['givenName']. " ".$data['familyName'], 
					'email'=>$data['email'] , 
					'profile_img'=>$data['picture'], 
					'updated_at'=>$currentDateTime
				];
				$this->userModel->updateUserData($userdata, $data['id']);
			}else{
				//new User want to Login
				$userdata = [
					'oauth_id'=>$data['id'],
					'name'=>$data['givenName']. " ".$data['familyName'], 
					'email'=>$data['email'] , 
					'profile_img'=>$data['picture'], 
					'created_at'=>$currentDateTime
				];
				$this->userModel->insertUserData($userdata);
			}
			session()->set("LoggedUserData", $userdata);
            echo "<pre>";
            print_r(session()->get('name'));die();
            echo "<pre>";
            
            //Successfull Login
		}else{
			session()->setFlashData("Error", "Something went Wrong");
			return redirect()->to(base_url());
		}
    }
}
