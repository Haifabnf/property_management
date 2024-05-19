<?php
require_once '../src/config/config.php';
require_once '../src/Business/UserService.php';
require_once '../src/DataAccess/UserDAO.php';

$userDAO = new UserDAO($conn);
$userService = new UserService($userDAO);

$request = json_decode(file_get_contents('php://input'), true);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($request['username'], $request['password'])) {
    if (strpos($_SERVER['REQUEST_URI'], 'login') !== false) {
        $token = $userService->login($request['username'], $request['password']);
        if ($token) {
            echo json_encode(['token' => $token]);
        } else {
            http_response_code(401);
            echo json_encode(['message' => 'Invalid credentials']);
        }
    } elseif (strpos($_SERVER['REQUEST_URI'], 'signup') !== false) {
        $success = $userService->signup($request['username'], $request['email'], $request['password']);
        if ($success) {
            echo json_encode(['success' => true]);
        } else {
            http_response_code(500);
            echo json_encode(['message' => 'Error signing up']);
        }
    }
}
?>
