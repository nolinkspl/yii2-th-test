<?php

namespace Service;

use Entity\User;

class AccountService extends BaseService {

    /**
     * @var Repository
     */
    private $_repository;

    public function __construct(Repository $repository) {
        $this->_repository = $repository;
    }

    /**
     * @param string $username
     * @return User
     */
    public function getUserByUsername($username) {
        /** @TODO implements method */
        return null;
    }
}