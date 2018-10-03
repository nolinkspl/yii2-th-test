<?php

namespace Entity;

class User {

    /**
     * @var int
     */
    private $_id;

    /**
     * @var string
     */
    private $_username;

    /**
     * @var string
     */
    private $_password;

    /**
     * @return int
     */
    public function id() {
        return $this->_id;
    }

    /**
     * @param int $id
     */
    public function setId($id) {
        $this->_id = $id;
    }

    /**
     * @return string
     */
    public function username() {
        return $this->_username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username) {
        $this->_username = $username;
    }

    /**
     * @return string
     */
    public function password() {
        return $this->_password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password) {
        $this->_password = $password;
    }
}