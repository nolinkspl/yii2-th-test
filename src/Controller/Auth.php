<?php

namespace Controller;

use Exception;

class Auth extends BaseController {

    public function authorization() {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        try {
            $this->_checkUsername($username);
            $this->_checkPassword($password);
        } catch (Exception\BadRequest $e) {
            return $this->_jsonFailResponse([$e->getMessage()]);
        }

        /** @TODO make authorization service */

        return $this->_jsonSuccessResponse([]);
    }

    /**
     * @param string $username
     */
    private function _checkUsername($username) {
        /** @TODO implements method */
    }

    private function _checkPassword($password) {
        /** @TODO implements method */
    }
}