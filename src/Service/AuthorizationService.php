<?php

namespace Service;

use Entity;

class AuthorizationService extends BaseService {

    /**
     * @var Repository
     */
    private $_repository;

    public function __construct(Repository $repository) {
        $this->_repository = $repository;
    }

    /**
     * @param Entity\User $user
     * @param string $password
     */
    public function authorizeUser(Entity\User $user, $password) {
        /** @TODO implement method */
    }
}