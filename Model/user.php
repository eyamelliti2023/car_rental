<?php
class user
{
    private ?int $user_id = null;
    private ?string $name = null;
    private ?string $surname = null;
    private ?string $email = null;
    private ?string $password = null;
    private ?int $type = null;

    public function __construct($name, $surname, $email, $password, $type)
    {
        $this->user_id = null;
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->password = $password;
        $this->type = $type;
    }


    public function getIduser()
    {
        return $this->user_id;
    }


    public function getn()
    {
        return $this->name;
    }


    public function setn($n)
    {
        $this->name = $n;

        return $this;
    }


    public function getsurname()
    {
        return $this->surname;
    }


    public function setsurname($sn)
    {
        $this->surname = $sn;

        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }


    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }


    public function getpassword()
    {
        return $this->password;
    }


    public function setpassword($password)
    {
        $this->password = $password;

        return $this;
    }


    public function gettype()
    {
        return $this->type;
    }


    public function settype($type)
    {
        $this->type = $type;

        return $this;
    }
}
