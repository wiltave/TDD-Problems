<?php
/**
 * URL splitting
 * http://sites.google.com/site/tddproblems/all-problems-1/URL-splitting
 *
 * We all know URLs, http://www.google.se is a popular one.
 * Develop a class that decomposes a given URL into its constituents.
 * In the above example, we would like to get the result:
 *
 * The protocol: "http".
 * The domain name: "www.google.se".
 * The path: an empty string in our example.
 *
 * Here are some example tests you could write to design this functionality:
 *
 * "http://some.thing" should give protocol=="http"
 * "ftp://a.large.site" should give domain=="a.large.site"
 * "http://a.site.with/a-path" should give path=="a-path"
 *
 * @package Strings
 * @subpackage URL splitting
 * @version 0.2
 * @license http://opensource.org/licenses/GPL-3.0 GNU GENERAL PUBLIC LICENSE
 * @author Willian Gustavo Veiga <wiltave@gmail.com>
 */
class Url_Parser
{
    const URL_PATTERN = '#^((?P<protocol>[a-z]{3,5})://)?(?P<domain>[a-z.]+)/?(?P<path>([a-z-.]+/?)+)?$#i';
    private $_protocol;
    private $_domain;
    private $_path;

    /**
     * @param string $url URL to parse
     * @access private
     */
    public function __construct($url)
    {
        $this->_parseUrl($url);
    }

    private function _parseUrl($url)
    {
        $matches = array();
        preg_match(self::URL_PATTERN, $url, $matches);

        /**
         * #TODO: What about DRY ? =)
         * https://en.wikipedia.org/wiki/Don%27t_repeat_yourself
         */
        if (isset($matches['protocol'])) {
            $this->_protocol = strtolower($matches['protocol']);
        }

        if (isset($matches['domain'])) {
            $this->_domain = strtolower($matches['domain']);
        }

        if (isset($matches['path'])) {
            $this->_path = $matches['path'];
        }
    }

    /**
     * @return string|null Parsed protocol
     */
    public function getProtocol()
    {
        return $this->_protocol;
    }

    /**
     * @return string|null Parsed domain
     */
    public function getDomain()
    {
        return $this->_domain;
    }

    /**
     * @return string|null Parsed path
     */
    public function getPath()
    {
        return $this->_path;
    }
}
