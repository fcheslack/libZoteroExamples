<?php
define('ROOT_DIR', dirname(dirname(__FILE__)));

set_include_path('.' . PATH_SEPARATOR . ROOT_DIR . '/library'
     . PATH_SEPARATOR . get_include_path());

require_once('zoteroconfig.php');
require_once('library/libZoteroSingle.php');


$library = new Zotero_Library($libraryType, $userID, $userSlug, $apiKey);

//get some tags
$tags = $library->fetchTags(array('limit'=>15, 'order'=>'title', 'sort'=>'desc'));
foreach($tags as $tag){
    if($tag->numItems > 0){
        echo $tag->name . " - " . $tag->numItems . "<br />";
    }
    else{
        echo $tag->name . " - has no items <br />"; 
    }
}


?>
