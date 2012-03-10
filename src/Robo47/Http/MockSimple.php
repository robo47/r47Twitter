<?php

/**
 * Mock Implementation for HttpInterface
 */
class Robo47_Http_MockSimple implements Robo47_Http_HttpInterface {

    /**
     * Code the Mock should return on fetch()
     * @var string
     */
    public $code = '';

    /**
     * Last Url fetched is saved here
     * @var null|string
     */
    public $url = null;

    /**
     * @param string $code
     */
    public function __construct($code = '') {
        $this->code = $code;
    }

    /**
     * {@inheritdoc}
     */
    public function fetch($url) {
        $this->url = $url;

        return $this->code;
    }

}
