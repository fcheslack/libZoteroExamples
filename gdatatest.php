<?php
//
define('ROOT_DIR', dirname(__FILE__));

set_include_path('.' . PATH_SEPARATOR . ROOT_DIR . '/library'
     . PATH_SEPARATOR . ROOT_DIR . '/library/Zend'
     . PATH_SEPARATOR . get_include_path());

require_once 'Zend/Loader/Autoloader.php';
$loader = Zend_Loader_Autoloader::getInstance();
$loader->registerNamespace(array('Models_', 'Zotero_', 'Forms_'));
$loader->setFallbackAutoloader(true);


//$gdata = new Zend_Gdata();

$service = Zend_Gdata_Docs::AUTH_SERVICE_NAME;

$my_docs = 'https://docs.google.com/feeds/default/private/full';
 
if (!isset($_SESSION['docs_token'])) {
    if (isset($_GET['token'])) {
        // You can convert the single-use token to a session token.
        $session_token =
            Zend_Gdata_AuthSub::getAuthSubSessionToken($_GET['token']);
        // Store the session token in our session.
        $_SESSION['docs_token'] = $session_token;
    } else {
        // Display link to generate single-use token
        $googleUri = Zend_Gdata_AuthSub::getAuthSubTokenUri(
            'http://'. $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'],
            $my_docs, 0, 1);
        echo "Click <a href='$googleUri'>here</a> " .
             "to authorize this application.";
        exit();
    }
}
 
// Create an authenticated HTTP Client to talk to Google.
$client = Zend_Gdata_AuthSub::getHttpClient($_SESSION['docs_token']);

// Create a Gdata object using the authenticated Http Client

//$client = Zend_Gdata_ClientLogin::getHttpClient('username', 'password', $service);
//$gdata = new Zend_Gdata($client);
//$gdata->setMajorProtocolVersion(3);
//$gdata->setMinorProtocolVersion(null);
$docs = new Zend_Gdata_Docs($client);


$newdoc = $docs->uploadFile('/home/fcheslack/Desktop/sports.png', 'Sports', 'image/png', 'https://docs.google.com/feeds/default/private/full?ocr=true');

//$feed = $docs->getDocumentListFeed();

//var_dump($feed->entries);
var_dump($newdoc);
?>