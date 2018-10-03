<?php

namespace Controller;

use Exception;
use Service;

class Auth extends BaseController {

    /**
     * @var Service\AuthorizationService
     */
    private $_authService;

    public function __construct(Service\AuthorizationService $authService) {
        $this->_authService = $authService;
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


        $user = null; /** @TODO get user */

        try {
            $this->_authService->authorizeUser($user);
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