<?php

namespace Service;

use Entity;

class PageManager extends BaseService {

    /**
     * @var Repository
     */
    private $_repository;

    public function __construct(Repository $repository) {
        $this->_repository = $repository;
    }

    public function createNewPage() {
        /** @TODO implements method */
    }

    /**
     * @param $id
     * @return Entity\Page
     */
    public function getPageById($id) {
        /** @TODO implements method */
        return null;
    }

    /**
     * @param Entity\User $user
     * @return Entity\Page[]
     */
    public function getPagesListByUser(Entity\User $user) {
        /** @TODO implements method */
        return [];
    }

    /**
     * @param Entity\Page $page
     */
    public function savePage(Entity\Page $page) {
        $this->_repository->savePage($page);
    }
}