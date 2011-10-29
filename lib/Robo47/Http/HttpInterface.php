<?php

/**
 * Simple Interface for fetching http data
 */
interface Robo47_Http_HttpInterface
{
    /**
     * Fetch a HTTP resource
     * @param string $url
     * @return string|false
     */
    public function fetch($url);
}