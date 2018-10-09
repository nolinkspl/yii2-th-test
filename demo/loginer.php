<?php

$request = $_POST;

if (!array_key_exists('action', $request)) {
    echo jsonResponse(false);
    return;
}

switch ($request['action']) {
    case 'authorization':
        authorizeUser($request);
        break;
    case 'check_authorization':
        checkAuthorization($request);
        break;
    default:
        break;
}

/**
 * @param array $request
 */
function authorizeUser(array $request) {
    if (!array_key_exists('username', $request) || !array_key_exists('password', $request)) {
        echo jsonResponse(false);
        return;
    }
    $username = trim($request['username']);
    $password = trim($request['password']);

    if ($username === 'demo' && $password === 'demo') {
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;

        return;
    }
    echo jsonResponse(false);
}

/**
 * @param array $request
 */
function checkAuthorization(array $request) {
    if (empty($_SESSION['username']) || empty($_SESSION['password'])) {

    }
    echo jsonResponse(true);
}

/**
 * @param bool $isSuccess
 * @param array $data
 * @return string
 */
function jsonResponse($isSuccess, $data = []) {
    return json_encode([
        'success' => $isSuccess,
        'data'    => $data,
    ]);
}