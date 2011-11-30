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
 */

require_once realpath(dirname(__FILE__) . '/../Url/Parser.php');

class URL_Splitting_Test extends PHPUnit_Framework_TestCase
{
    public function testGetProtocolFromURLWithoutAProtocolMustReturnNull()
    {
        $urlParser = new Url_Parser('www.some.thing');
        $this->assertEquals($urlParser->getProtocol(), null);
    }

    public function testGetProtocolFromUrlWithHttpProtocolMustReturnHttp()
    {
        $urlParser = new Url_Parser('http://some.thing');
        $this->assertEquals($urlParser->getProtocol(), 'http');
    }

    public function testGetProtocolFromUrlWithFtpProtocolMustReturnFtp()
    {
        $urlParser = new Url_Parser('ftp://a.large.site');
        $this->assertEquals($urlParser->getProtocol(), 'ftp');
    }

    public function testGetProtocolFromUrlWithFtpsProtocolMustReturnFtps()
    {
        $urlParser = new Url_Parser('ftps://a.large.site');
        $this->assertEquals($urlParser->getProtocol(), 'ftps');
    }

    public function testGetProtocolFromUrlWithUpperCaseProtocolMustReturnLowerCaseProtocol()
    {
        $urlParser = new Url_Parser('HTTPS://a.safe.site');
        $this->assertEquals($urlParser->getProtocol(), 'https');
    }

    public function testGetProtocolFromUrlWithMixedCaseProtocolMustReturnItLowerCase()
    {
        $urlParser = new Url_Parser('HttPS://a.safe.site');
        $this->assertEquals($urlParser->getProtocol(), 'https');
    }

    public function testGetDomainFromUrlWithoutProtocolAndPathParts()
    {
        $urlParser = new Url_Parser('a.large.site');
        $this->assertEquals($urlParser->getDomain(), 'a.large.site');
    }

    public function testGetDomainFromUrlWithProtocol()
    {
        $urlParser = new Url_Parser('http://some.thing');
        $this->assertEquals($urlParser->getDomain(), 'some.thing');
    }

    public function testGetDomainFromUrlWithPathPart()
    {
        $urlParser = new Url_Parser('some.thing/some/path');
        $this->assertEquals($urlParser->getDomain(), 'some.thing');
    }

    public function testGetDomainFromUrlWithUpperCaseDomainMustReturnItLowerCase()
    {
        $urlParser = new Url_Parser('FTP://HEY.IAM.UPPERCASE/');
        $this->assertEquals($urlParser->getDomain(), 'hey.iam.uppercase');
    }

    public function testGetPathFromUrl()
    {
        $urlParser = new Url_Parser('http://a.site.with/a-path');
        $this->assertEquals($urlParser->getPath(), 'a-path');
    }

    public function testGetPathFromUrlWithTwoPathParts()
    {
        $urlParser = new Url_Parser('http://marsh.mallow/sugar/biscuits/');
        $this->assertEquals($urlParser->getPath(), 'sugar/biscuits/');
    }

    public function testGetPathFromUrlWithoutPath()
    {
        $urlParser = new Url_Parser('https://super.market/');
        $this->assertEquals($urlParser->getPath(), null);
    }

    public function testGetPathFromUrlWithThreePatParts()
    {
        $urlParser = new Url_Parser('ftp://my.house/is/burning/man');
        $this->assertEquals($urlParser->getPath(), 'is/burning/man');
    }

    public function testGetPathWithAfile()
    {
        $urlParser = new Url_Parser('http://iam.a.robot/world-domination.txt');
        $this->assertEquals($urlParser->getPath(), 'world-domination.txt');
    }

    public function testGetPathFromUrlWithRelativePath()
    {
        $urlParser = new Url_Parser('http://www.hacked.com/../etc/passwd');
        $this->assertEquals($urlParser->getPath(), '../etc/passwd');
    }
}
