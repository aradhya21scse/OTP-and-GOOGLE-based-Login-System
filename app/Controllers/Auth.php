<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;
use League\OAuth2\Client\Provider\Google;
use Config\Constants;


class Auth extends Controller
{
    protected $provider;
    protected $sid;
    protected $authToken;


    public function __construct()
    {
        $this->provider = new Google([
            'clientId'     => getenv('GOOGLE_CLIENT_ID'), 
            'clientSecret' => getenv('GOOGLE_CLIENT_SECRET'),
            'redirectUri' => base_url('auth/oauthgmaillogin'),
        ]);

   
        
      
    }
    public function loginGoogle()
    {
        $authorizationUrl = $this->provider->getAuthorizationUrl();
        session()->set('oauth2state', $this->provider->getState());
        return redirect()->to($authorizationUrl);
    }
  
    public function oauthgmaillogin()
    {
        
        if (empty($_GET['state']) || ($_GET['state'] !== session()->get('oauth2state'))) {
            session()->remove('oauth2state');
            return redirect()->to('/login')->with('error', 'Invalid state');
        }

        try {
            
            $token = $this->provider->getAccessToken('authorization_code', [
                'code' => $_GET['code'],
            ]);
            $user = $this->provider->getResourceOwner($token);
            $email = $user->getEmail();
            $name = $user->getName();
            $model = new UserModel();
            $existingUser = $model->getUserByField('email',$email);

            $lo = '<script type="text/javascript">
                window.opener.postMessage("UserLoginSuccess", window.location.origin);
                window.close();
                </script>';

            if ($existingUser) {
                session()->set('isLoggedIn', true);
                session()->set('userName', $existingUser['name']);
                session()->set('userEmail', $existingUser['email']);
                session()->set('userPhone', $existingUser['phone']);


                echo $lo;
              

            } else {
             
                $newUser = [
                    'name'  => $name,
                    'email' => $email,
                ];
    
                $model->InsertGoogleData($newUser);
                session()->set('isLoggedIn', true);
                session()->set('userName', $newUser['name']);
                session()->set('userEmail', $newUser['email']);
                

                echo $lo;
      
            }
        }catch (\Exception $e) {
            return redirect()->to('/login')->with('error', 'Failed to get user details.');
        }
    }
    public function index()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to('dashboard');
        }
       
        return view('register');
    }
    public function register()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to('dashboard');
        }
        $model = new UserModel();
        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $phone = $this->request->getPost('phone');

        $validation = new Validation();
        $validationErrors = $validation->validateRegistration($name, $email, $phone);

        if (!empty($validationErrors)) {
            return redirect()->back()->withInput()->with('errors', $validationErrors);
        }

        $data = [
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
        ];

        $model->InsertData($data);

        session()->setFlashdata('success', 'Registration successful!');
        return redirect()->to('/login');
    }
    public function login()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to('dashboard');
        }
        
        session()->destroy();
        return view('login');
    }
    

  
    public function generateOTP()
    {

        $phone = $this->request->getPost('phone');
        $validation = new Validation();
        $model = new UserModel();
        $user = $model->getUserByField('phone', $phone);
    
        if ($user) {
            
            // $otpLength = Constants::OTP_LENGTH;
            $otpLength = Constants::OTP_LENGTH;
            $otp = random_int(pow(10, $otpLength - 1), pow(10, $otpLength) - 1);
            $model->setOTP($otp, $phone);

            return $this->response->setJSON(['success' => true]);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Phone number invalid']);
        }
    }
    public function verifyOtp()
    {
        $otp = $this->request->getPost('otp');
        $phone = $this->request->getPost('phone');

        $model = new UserModel();
        $user = $model->getUserByField('phone', $phone);

        if ($user && $user['otp'] == $otp) {
            session()->set('isLoggedIn', true);
            session()->set('userPhone', $phone);
            session()->set('userName', $user['name']); 
            session()->remove('otp');

            $model->setOTP(null, $phone);

            session()->remove('otpRetryCount');
            return $this->response->setJSON(['success' => true]);
        } else {
            $retryCount = session()->get('otpRetryCount') ?? 0;
            $retryCount++;
            session()->set('otpRetryCount', $retryCount);
    
            if ($retryCount >= 3) {
                session()->remove('otpRetryCount');
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'You have exceeded the maximum number of OTP retries.'
                ]);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Invalid OTP. Attempts left: ' . (3 - $retryCount) . ' attempt(s) left.'
                ]);
            }
        }
    }


    public function dashboard()
    {
        $session = session(); 
        $userName = $session->get('userName');
        

        return view('dashboard', [
            'name' => $userName,
            'session' => $session 
        ]);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }


}
