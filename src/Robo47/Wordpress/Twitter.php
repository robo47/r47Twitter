<?php

class Robo47_Wordpress_Twitter
{
    /**
     * Status Url
     */
    const statusurl = 'https://twitter.com/statuses/user_timeline/%s.json';

    /**
     * Name of the Account for which to fetch the Tweets
     *
     * @var string
     */
    protected $account;

    /**
     * @var Robo47_Http_HttpInterface
     */
    protected $http;

    public function __construct($account, Robo47_Http_HttpInterface $http = null)
    {
        $this->setAccount($account);
        if ($http === null) {
            $http = new Robo47_Http_Curl();
        }
        $this->setHttp($http);
    }

    /**
     *
     * @return string
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     *
     * @param string $account
     */
    public function setAccount($account)
    {
        $this->account = $account;

        return $this;
    }

    /**
     *
     * @return Robo47_Http_HttpInterface
     */
    public function getHttp()
    {
        return $this->http;
    }

    /**
     *
     * @param type $http
     */
    public function setHttp(Robo47_Http_HttpInterface $http)
    {
        $this->http = $http;

        return $this;
    }

    /**
     * Fetches Tweets of a user
     *
     * @return array
     */
    public function fetchTweets()
    {
        $url = sprintf(self::statusurl, $this->getAccount());
        $code = $this->http->fetch($url);
        $json = json_decode($code, true);;

        return $json;
    }

}
