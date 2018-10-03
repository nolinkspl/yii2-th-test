<?php

namespace Controller;

use Exception;
use Service;

class Auth extends BaseController {

    /**
     * @var Service\AuthorizationService
     */
    private $_authService;

    /**
     * @var Service\AccountService
     */
    private $_accountService;

    public function __construct(
        Service\AuthorizationService $authService,
        Service\AccountService $accountService
    ) {
        $this->_authService = $authService;
        $this->_accountService = $accountService;
    }

    public function authorization() {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        try {
            $this->_checkUsername($username);
            $this->_checkPassword($password);
        } catch (Exception\BadRequest $e) {
            return $this->_jsonFailResponse([$e->getMessage()]);
        }

        $user = $this->_accountService->getUserByUsername($username);
        if ($user === null) {
            return $this->_jsonFailResponse(["User doesn't exist"]);
        }

        try {
            $this->_authService->authorizeUser($user, $password);
        } catch (\Throwable $e) {
            return $this->_jsonFailResponse([$e->getMessage()]);
        } catch (Exception $e) {
            return $this->_jsonFailResponse([$e->getMessage()]);
        }

        return $this->_jsonSuccessResponse([/** @TODO responce */]);
    }

    /**
     * @param string $username
     * @throws Exception\BadRequest
     */
    private function _checkUsername($username) {
        /** @TODO implements method */
    }

    /**
     * @param $password
     * @throws Exception\BadRequest
     */
    private function _checkPassword($password) {
        /** @TODO implements method */
    }
}