<?php

namespace Auth\Security;

use Auth\Cookie\Cookie;

/**
 * Class Security
 * @package Auth\Security
 */
class Security
{
    /**
     * @return mixed
     */
    public function createUniqueTokenXSRF()
    {
        $cookie = new Cookie();

        if (isset($_COOKIE['token'])) {
            $token = $cookie->prolongUniqueToken($_COOKIE['token']);
        } else {
            $token = $cookie->setUniqueToken($this->generateRandomHash());
        }
        return $token;
    }

    /**
     * @return bool|string
     */
    public function checkTokenXSRF()
    {
        if (isset($_COOKIE['token']) && isset($_POST['token']) && $_COOKIE['token'] === $_POST['token']) {
            return true;
        } else {
            return 'XSRF атака';
        }
    }

    /**
     * @return string
     */
    public function generateRandomHash()
    {
        $symb = 'abdefhiknrstyzABDEFGHKNQRSTYZ123456789';
        $length = strlen($symb) - 1;
        $col = 32;
        $hash = '';
        for ($i = 0; $i < $col; $i++) {
            $hash .= substr($symb, mt_rand(0, $length), 1);
        }
        return $hash;
    }

}
