<?php

require_once '../lib/Model.php';

/**
 * Das UserModel ist zuständig für alle Zugriffe auf die Tabelle "user".
 *
 * Die Ausführliche Dokumentation zu den Model findest du in der Model Klasse.
 */
class UserModel extends Model
{
    /**
     * Diese Variable wird von der Klasse Model verwendet, um generische
     * Funktionen zur Verfügung zu stellen.
     */
    protected $tableName = 'user';

    public $column_email = 'email';
    public $column_password = 'password';
    /**
     * Erstellt einen neuen benutzer mit den gegebenen Werten.
     *
     * Das Passwort wird vor dem ausführen des Queries noch mit dem SHA1
     *  Algorythmus gehashed.
     *
     * @param $firstName Wert für die Spalte firstName
     * @param $lastName Wert für die Spalte lastName
     * @param $email Wert für die Spalte email
     * @param $password Wert für die Spalte password
     *
     * @throws Exception falls das Ausführen des Statements fehlschlägt
     *
     *@since 17.03.2017
     */
    public function create($email, $password)
    {
        $password = sha1($password);

        $query = "INSERT INTO $this->tableName ($this->column_email, $this->column_password) VALUES (?, ?)";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('ss', $email, $password);

        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }

        return $statement->insert_id;
    }

    /**
    *Überprüft, ob es einen User mit $username als Benutzername und $password as Passwort gibt.
    *
    *@param $email    eingegeben Benutzername im Login Formular.
    *@param $password      eingegebenes Password im Login formular
    *
    *@return True, wenn ein Benutzer mit  diesem Username und Passwort in der DB Besteht.
    *
    *@since 17.03.2017
    */
    function is_auth($email, $password) {
        $query = "SELECT $this->tableName.$this->column_password FROM $this->tableName WHERE $this->tableName.$this->column_email = ? LIMIT 1;";
        
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('s', $email);

        if($statement->execute()) {
            $result = $statement->get_result();
            if (!$result) {
                throw new Exception($statement->error);
            }

            $row = $result->fetch_assoc();
            $result->close();

            if (strcmp(sha1($password),$row[$this->column_password]) ==  0) {
                return true;
            }
        }
        return false;
    }

    /**
    *Überprüft, ob es einen User mit $username als Benutzername und $password as Passwort gibt.
    *
    *@param $username eingegeben Benutzername im Login Formular.
    *
    *@return True, wenn ein Benutzer mit  diesem Username und Passwort in der DB Besteht.
    *
    *@since 29.03.2017
    */
    function does_user_exist($email) {
        $query = "SELECT $this->tableName.$this->column_email FROM $this->tableName WHERE $this->tableName.$this->column_email = ? LIMIT 1;";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('s', $email);

        if($statement->execute()) {
            $result = $statement->get_result();
            if (!$result) {
                throw new Exception($statement->error);
            }

            $row = $result->fetch_assoc();
            $result->close();
            if (isset($row[$this->column_email])) {
                return true;
            }
        }
        return false;
    }
}