<?php

namespace Controller;

use Service;

class Page extends BaseController {

    /**
     * @var Service\AuthorizationService
     */
    private $_authService;

    /**
     * @var Service\AccountService
     */
    private $_accountService;

    /**
     * @var Service\PageManager
     */
    private $_pageManager;

    public function __construct(
        Service\AuthorizationService $authorizationService,
        Service\AccountService $accountService,
        Service\PageManager $pageManager
    ) {
        $this->_authService = $authorizationService;
        $this->_accountService = $accountService;
        $this->_pageManager = $pageManager;
    }

    public function createPage() {
        /** @TODO implements method */
    }

    public function loadPages() {
        /** @TODO implements method */
    }

    public function savePage() {
        /** @TODO implements method */
    }
}
