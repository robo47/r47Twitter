<?php

/**
 * Curl Implementation for HttpInterface
 */
class Robo47_Http_Curl implements Robo47_Http_HttpInterface {

    /**
     * {@inheritdoc} 
     */
    public function fetch($url) {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

}