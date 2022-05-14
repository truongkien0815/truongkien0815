<?php
class UserModel extends Db{
    public function login($username, $password)
    {
        //2. Viết câu SQL
        $sql = parent::$connection->prepare("SELECT * FROM users WHERE user_username=?");
        $sql->bind_param('s', $username);
        $user = parent::select($sql)[0];
        if (password_verify($password, $user['user_password'])) {
            return $user;
        }
        return false;
    }

    public function addUser($username, $password)
    {
        //2. Viết câu SQL
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql = parent::$connection->prepare("INSERT INTO `users`(`user_username`, `user_password`) VALUES (?,?)");
        $sql->bind_param('ss', $username, $password);
        return $sql->execute();
    }
}