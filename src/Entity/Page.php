<?php

namespace Entity;

class Page {

    /** @var int */
    private $_id;

    /** @var string */
    private $_title;

    /** @var string */
    private $_header;

    /** @var string */
    private $_mainContent;

    /** @var string */
    private $_additionalContent;

    /** @var \DateTime */
    private $_creationDate;

    /** @var \DateTime */
    private $_lastEditionDate;

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
    public function title() {
        return $this->_title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title) {
        $this->_title = $title;
    }

    /**
     * @return string
     */
    public function header() {
        return $this->_header;
    }

    /**
     * @param string $header
     */
    public function setHeader($header) {
        $this->_header = $header;
    }

    /**
     * @return string
     */
    public function mainContent() {
        return $this->_mainContent;
    }

    /**
     * @param string $mainContent
     */
    public function setMainContent($mainContent) {
        $this->_mainContent = $mainContent;
    }

    /**
     * @return string
     */
    public function additionalContent() {
        return $this->_additionalContent;
    }

    /**
     * @param string $additionalContent
     */
    public function setAdditionalContent($additionalContent) {
        $this->_additionalContent = $additionalContent;
    }

    /**
     * @return \DateTime
     */
    public function creationDate() {
        return $this->_creationDate;
    }

    /**
     * @param \DateTime $creationDate
     */
    public function setCreationDate(\DateTime $creationDate) {
        $this->_creationDate = $creationDate;
    }

    /**
     * @return \DateTime
     */
    public function lastEditionDate() {
        return $this->_lastEditionDate;
    }

    /**
     * @param \DateTime $lastEditionDate
     */
    public function setLastEditionDate(\DateTime $lastEditionDate) {
        $this->_lastEditionDate = $lastEditionDate;
    }
}