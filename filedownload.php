<?php
//
define('ROOT_DIR', dirname(dirname(__FILE__)));

set_include_path('.' . PATH_SEPARATOR . ROOT_DIR . '/library'
     . PATH_SEPARATOR . get_include_path());

require_once('zoteroconfig.php');
require_once('library/libZoteroSingle.php');

$library = new Zotero_Library($libraryType, $userID, $userSlug, $apiKey);

$itemKey = 'IZIU3PST';
$item = $library->loadItem($itemKey);

if($item->hasFile()){
    echo "Has File";
    var_dump($item->links['enclosure']);
    $downloadLink = $library->itemDownloadLink($itemKey);
    echo "<a href='{$downloadLink}'>Download</a>";
}
else{
    echo "does not have file";
}


?>
