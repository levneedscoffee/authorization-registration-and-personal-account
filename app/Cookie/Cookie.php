<?php

namespace Auth\Cookie;


use Auth\Security\Security;

class Cookie
{

    public function setUniqueToken($token)
    {

        setcookie("token", $token, time() + 86400, '/', '', false, true);
        return $token;
    }

    public function prolongUniqueToken($token)
    {
        setcookie("token", $token, time() + 86400, '/', '', false, true);
        return $token;
    }

    public function setUserCookie($email)
    {
        $time = mktime(0, 0, 0, 1, 1, 2028);
        setcookie("userEmail", $email, $time, '/', '', false, true);
    }

    public function deleteCookie()
    {
        setcookie('userEmail', '', time() - 3600, '/');
    }
}