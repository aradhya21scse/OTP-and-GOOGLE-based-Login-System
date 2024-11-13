<?php

namespace Config;

use CodeIgniter\Config\RouteCollection;


$routes->get('register', 'Auth::index');            
$routes->post('register', 'Auth::register');        
$routes->get('login', 'Auth::login');                
$routes->post('login', 'Auth::generateOTP');   
$routes->post('verifyotp', 'Auth::verifyOtp');             
$routes->get('dashboard', 'Auth::dashboard'); 
$routes->get('logout', 'Auth::logout'); 
$routes->get('auth/googleLogin', 'Auth::loginGoogle');
$routes->get('auth/oauthgmaillogin', 'Auth::oauthgmaillogin');






