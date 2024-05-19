<?php
require_once '../src/Models/User.php';
require_once '../src/DataAccess/UserDAO.php';

class UserService {
    private $userDAO;

    public function __construct($userDAO) {
        $this->userDAO = $userDAO;
    }

    public function login($username, $password) {
        $user = $this->userDAO->getUserByUsername($username);
        if ($user && password_verify($password, $user->getPassword())) {
            return bin2hex(random_bytes(16)); // Return a token
        }
        return null;
    }

    public function signup($username, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        return $this->userDAO->createUser($username, $email, $hashedPassword);
    }
}
?>
