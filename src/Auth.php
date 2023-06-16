<?php

class Auth
{
    public function checkLogin($username, $password)
    {
        $dbh = DB::getInstance();
        $dbc = $dbh->getConnection();

        $user = new User($dbc);
        $user->findBy('username', $username);

        if (property_exists($user, 'id')) {
            if ($user->password_hash == md5($user->salt . $password)) {
                return true;
            }
        }
        return false;
    }

    public function changeUserPassword($user, $password)
    {
        $salt = date('YmdHis');
        $password_hash = md5($salt . $password);

        $user->salt = $salt;
        $user->password_hash = $password_hash;
        return $user;
    }
}