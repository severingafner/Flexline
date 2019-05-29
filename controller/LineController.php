<?php

require_once '../model/UserModel.php';

/**
 * Siehe Dokumentation im DefaultController.
 */
class LineController
{
    public function index()
    {
        $model = new UserModel();

        $view = new View('user_login');
        $view->title = 'Login';
        $view->heading = 'Login';
        $view->display();
    }

    public function signup()
    {
        $view = new View('user_signup');
        $view->title = 'Registrieren';
        $view->heading = 'Registrieren';
        $view->display();
    }

    public function createAccount()
    {
        $model = new UserModel();
        if (isset($_POST['register'])) {
            $email = trim(htmlspecialchars($_POST['email']));
            $password = trim(htmlspecialchars($_POST["password"]));
            $password_repeat = trim(htmlspecialchars($_POST["password-repeat"]));
            if($password == $password_repeat) {
                if(UserController::checkPassword($password) && UserController::checkEmail($email) && !$model->does_user_exist($email)) {
                    $model->create($email, $password);
                    UserController::login($email, $password);
                }
            }
            return false;
        }
    }

    public static function checkEmail($email) {
        //http://emailregex.com/
        $regex = '/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/iD';
        return preg_match($regex, $email);
    }

    public static function checkPassword($password) {
        //http://stackoverflow.com/questions/19605150/regex-for-password-must-be-contain-at-least-8-characters-least-1-number-and-bot
        $regex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,}/';
        return (preg_match($regex, $password));
    }

    public static function login($email = null, $password = null) {
        if (isset($_POST['login'])) {
            $email = trim(htmlspecialchars($_POST['email']));
            $password = trim(htmlspecialchars($_POST["password"]));
            SessionHandler2::set('email', $email);
            SessionHandler2::set('password', $password);
            UserController::switchToPrivate();
        }
        else if ($email != null && $password != null) {
            $email = trim(htmlspecialchars($email));
            $password = trim(htmlspecialchars($password));
            SessionHandler2::set('email', $email);
            SessionHandler2::set('password', $password);
            UserController::switchToPrivate();
        }
        return false;
    }

    public static function switchToPrivate() {
        //Prüft, ob der Benutzer eingeloggt ist. Wenn nicht, wird er zur Loginseite verwiesen.
        if(UserController::isUserLoggedIn()) {
            header("LOCATION: /gallery");
        }
        else {
            header("LOCATION: /user");
        }
    }
    /**
    * Überprüft, ob der Benutzer eingeloggt ist. 
    * Hierfür werden die Session Variablen 'email' und 'password'
    * verwendet und der Funktion vom UserModel übergeben.
    *
    * @return True, der benutzer ist eingeloggt.
    *
    * @since 24.03.2017
    */
    public static function isUserLoggedIn() {
        $model = new UserModel();
        $email = SessionHandler2::get('email');
        $password = SessionHandler2::get('password');
        if(isset($email) && isset($password)) {
            $email = $email;
            $password = $password;
            return $model->is_auth($email, $password);
        }
    }
}
