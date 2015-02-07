<?php namespace Flyr\Http;

class Url {

    protected $scheme;
    protected $url;

    /**
     * @param string $url
     */

    public function __construct($url = ''){
        if (strlen(trim($url)) == 0){
            $this->scheme = (getenv('HTTPS')) ? 'https' : 'http';
            $this->url = $this->scheme ."://". getenv('HTTP_HOST') ."". getenv('REQUEST_URI');
        } else {
            $this->scheme = (getenv('HTTPS')) ? 'https' : 'http';
            $this->url = $url;
        }
    }

    /**
     * @return string
     */

    public function getUrl() {
        return $this->url;
    }

    /**
     * @return mixed
     */

    public function getParsedUrl() {
        return parse_url($this->url);
    }

    /**
     * @return string
     */

    public function getScheme() {
        return parse_url($this->url, PHP_URL_SCHEME);
    }

    /**
     * @return string
     */

    public function getPort() {
        return parse_url($this->url, PHP_URL_PORT);
    }

    /**
     * @return string
     */

    public function getHost() {
        return parse_url($this->url, PHP_URL_HOST);
    }

    public function getUser() {
        return parse_url($this->url, PHP_URL_USER);
    }

    public function getPass() {
        return parse_url($this->url, PHP_URL_PASS);
    }

    public function getPath() {
        return parse_url($this->url, PHP_URL_PATH);
    }

    public function getQuery() {
        return parse_url($this->url, PHP_URL_QUERY);
    }

    public function getFragment() {
        return parse_url($this->url, PHP_URL_FRAGMENT);
    }

    public function parse_decode($query, $q) {
        if (strlen(trim($query)) == 0) {
            return [];
        }
        $query = urldecode($query);
        $keyval = [[], []];
        foreach(explode('&', $query) as $chunk) {
            $param = explode('=', $chunk);
            array_push($keyval[0], $param[0]);
            array_push($keyval[1], $param[1]);
        }
        return $keyval;
    }

    public function encode($url) {
        return urlencode($url);
    }

}