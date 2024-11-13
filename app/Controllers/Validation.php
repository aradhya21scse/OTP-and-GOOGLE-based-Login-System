<?php

namespace App\Controllers;

use App\Models\UserModel;

class Validation extends BaseController
{
    public function validateRegistration($name, $email, $phone)
    {
        $errors = [];


        if (strlen($name) <3) {
            $errors[] = 'The name must be more than 3 characters.';
        }
        if (is_numeric($name)){
            $errors[] = 'The name must not be numeric.';
        }


       
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'The email must be in a valid format.';
        } elseif ($this->isEmailExists($email)) { 
            $errors[] = 'Email already exists.';
        }

      
        if (!$this->isUniquePhone($phone)) {
            $errors[] = 'The phone number is already registered.';
        } elseif (!$this->isValidPhone($phone)) {
            $errors[] = 'The phone number must be exactly 10 digits.';
        }

        return $errors;
    }
    private function isValidPhone($phone)
    {
        return is_numeric($phone) && strlen($phone) === 10;
    }

    public function isUniquePhone($phone)
    {
        $userModel = new UserModel();
        $user = $userModel->getUserByField('phone', $phone);
        return $user === null; 
    }
    public function isEmailExists($email)
    {
        $userModel = new UserModel();
        $user = $userModel->getUserByField('email', $email);
        return $user !== null; 
    }
}
