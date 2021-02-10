<?php
include_once ("DBConnect.php");
include_once dirname(__DIR__, 2).("/pub.php");

class MemberModel extends DBConnect
{
    public function addUser($name, $email, $pw)
    {
        $sth = $this->dbConnect->prepare("INSERT  member (name, email, password, created_at, updated_at) 
        VALUES (:name, :email, :password, :created_at, :updated_at)");
        $field = [
        ':name' => $name, 
        ':email' => $email, 
        ':password' => md5($pw), 
        ':created_at' => date('Y-m-d H:i:s') , 
        ':updated_at' => date('Y-m-d H:i:s') 
        ];

        return($sth->execute($field));   
    }

    public function checkEmail($email)
    {
        $sth = $this->dbConnect->prepare("SELECT * FROM member WHERE email = '{$email}'");
        $sth->execute();
        return($result = $sth->fetch());
    }

    public function checkLogin($email , $password)
    {
        $sth = $this->dbConnect->prepare("SELECT * FROM member WHERE email = ? AND password = ? ");
        $field = [
            $email, md5($password)
        ];
        $sth->execute($field);
        $result = $sth->fetch();
        return ($result);
    }
}