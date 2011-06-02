<?php
//
define('ROOT_DIR', dirname(dirname(__FILE__)));

set_include_path('.' . PATH_SEPARATOR . ROOT_DIR . '/library'
     . PATH_SEPARATOR . get_include_path());

require_once('zoteroconfig.php');
require_once('library/libZoteroSingle.php');

$library = new Zotero_Library($libraryType, $userID, $userSlug, $apiKey);

$fetchParameters = array('limit'=>10, 'collectionKey'=>'AWB4B3P4');
$items = $library->loadItemsTop($fetchParameters);
//var_dump($items);
$displayFields = array('title', 'creator', 'dateAdded');

//output the list of fetched items with the chosen fields
$output = '';
$output .= "<ul class='zoteroItems'>";
foreach($items as $item){
    $output .= "<li class='zoteroItem'>";
    foreach($displayFields as $field){
        $output .= htmlspecialchars($item->formatItemField($field) . " - ");
    }
    $output .= "</li>";
}
$output .= "</ul>";

echo $output;
//var_dump($output);
?>
