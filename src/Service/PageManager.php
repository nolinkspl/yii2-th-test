<?php

namespace Service;

use Entity;

class PageManager extends BaseService {

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
}