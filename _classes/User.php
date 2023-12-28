<?php
class User
{
    public $id;
    public $email;
    public $username;
    private $password;

    public function __construct($id)
    {
        global $db;

        $result = $db->query("SELECT * FROM user WHERE users_id = '$id'");

        $user = $result->fetch_assoc();

        $this->id = $user['user_id'];
        $this->email = $user['email'];
        $this->username = $user['username'];
        $this->password = $user['password'];
    }

    static function getAll($db)
    {
        //global $db;
        $result = $db->query("SELECT * FROM user");
        if ($result)
            return $result->fetch_all(MYSQLI_ASSOC);
    }

    static function CheckUser($email, $db)
    {
        $sql = "SELECT * FROM user WHERE email = ?";

        $stmt = $db->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result) {
            return $result->fetch_assoc();
        }

        return false;
    }

    static function AddUser($email, $password,$username,  $picture, $db)
    {
        $sql = "INSERT INTO user (email, password, username, picture) VALUES (?, ?, ?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->bind_param( "ssss",  $email, $password, $username, $picture);
        $stmt->execute();
        $stmt->close();

    }

    public function EditUser() {
        global $db;

        $stmt = $db->prepare("UPDATE user SET users_email = ?, users_username = ? WHERE users_id = ?");
        $stmt->bind_param("ssi", $this->email, $this->username, $this->id);

        $success = $stmt->execute();

        $stmt->close();

        return $success;
    }

    public function setPassword($pwd) {
        $this->password = password_hash($pwd, PASSWORD_DEFAULT);
    }

    static function login ($user_id) {
        $_SESSION["user_id"] = $user_id;
        $_SESSION["login"] = true;
        header('Location: ../index.php?page=home');
    }

    static function logout () {
        session_destroy();
        header("Location: index.php?page=login");
        exit();
    }

    /**
     * @param $userId
     * @return array|false|null
     */
    public static function getById($userId) {
        global $db;

        $stmt = $db->prepare("SELECT * FROM user WHERE user_id = ?");
        $stmt->bind_param("i", $userId);

        $stmt->execute();
        $result = $stmt->get_result();

        // Fetch user data
        $userData = $result->fetch_assoc();

        $stmt->close();

        return $userData;
    }
}