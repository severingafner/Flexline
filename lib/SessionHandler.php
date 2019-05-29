<?php

/**
*
* @since 29.03.2017
*/
class SessionHandler2 {

    /**
    *
    * @since 29.03.2017
    */
    public static function start() {
        if(session_id() == '' || !isset($_SESSION)) {
            session_start();
        }
    }

    /**
    *
    * @since 29.03.2017
    */
    public static function set($key, $value) {
        if(session_id() != '' || isset($_SESSION)) {
            return $_SESSION[$key] = $value;
        }
        return null;
    }

    /**
    *
    * @since 29.03.2017
    */
    public static function get($key) {
        if(isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
        return null;
    }

    /**
    *
    * @since 29.03.2017
    */
    public static function remove($key) {
        if(isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }
    
    /**
    *
    * @since 29.03.2017
    */
    public static function close() {
        if(session_id() != '' || isset($_SESSION)) {
            session_destroy();
        }
    }
}

?>