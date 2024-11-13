<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'email', 'phone', 'otp'];


    public function InsertData($data){
        $sql="Insert into users  (name,email,phone) values (?,?,?)";
        return $this->db->query($sql,[$data['name'],$data['email'],$data['phone']]);
    }
    public function InsertGoogleData($data){
        $sql="Insert into users  (name,email) values (?,?)";
        return $this->db->query($sql,[$data['name'],$data['email']]);


    }
    public function setOTP($otp, $phone)
    {
        $sql = "UPDATE users SET otp = ? WHERE phone = ?";
        return $this->db->query($sql, [$otp, $phone]);
    }

    public function GetData(){
        $sql="Select * from users ";
        return $this->db->query($sql)->getResult();

    }
    public function getUserByField($field, $value)
    {
        $query = $this->db->query("SELECT * FROM users WHERE {$field} = ?", [$value]);
        $result = $query->getRowArray(); 
        return $result; 
    }

    
   
}
