<?php 


class User {
    public $id;
    public $image;
    public $name;
    public $username;
    public $email;
    public $password;
    public $no_tlp;
    public $role;
    public $alamat;
    public $created_at;
    public $updated_at;

    public function __construct($id, $image, $name, $username, $email, $password, $no_tlp, $role, $alamat, $created_at, $updated_at) {
        $this->id = $id;
        $this->image = $image;
        $this->name = $name;
        $this->username = $username;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        $this->no_tlp = $no_tlp;
        $this->role = $role;
        $this->alamat = $alamat;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
        $this->addUser();
    }

    public function addUser(){
        $db = new Database();
        $sql = "INSERT INTO user (image, name, username, email, password, no_tlp, role, alamat, created_at, updated_at) VALUES ('$this->image', '$this->name', '$this->username', '$this->email', '$this->password', '$this->no_tlp', '$this->role', '$this->alamat', '$this->created_at', '$this->updated_at')";
        $db->query($sql);
        $db->execute();
    }

    public function all() {
        $list = [];
        $db = new Database();
        $query = "SELECT * FROM user";
        $db->query($query);
        $result = $db->execute();
        while ($row = $result->fetch_assoc()) {
            $user = new User($row['id'], $row['image'], $row['name'], $row['username'], $row['email'], $row['password'], $row['no_tlp'], $row['role'], $row['alamat'], $row['created_at'], $row['updated_at']);
            array_push($list, $user);
        }
        return $list;
    }
}