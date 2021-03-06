<?php
define('ROOT_DIR', dirname(dirname(__FILE__)));

set_include_path('.' . PATH_SEPARATOR . ROOT_DIR . '/library'
     . PATH_SEPARATOR . get_include_path());

require_once('zoteroconfig.php');
require_once('library/libZoteroSingle.php');

$library = new Zotero_Library($libraryType, $userID, $userSlug, $apiKey);

$collectionKey = !empty($_GET['collectionKey']) ? $_GET['collectionKey'] : '';
$limit = !empty($_GET['limit']) ? $_GET['limit'] : 10;
$style = !empty($_GET['style']) ? $_GET['style'] : '';
$content = !empty($_GET['content']) ? $_GET['content'] : 'html';
$format = !empty($_GET['format']) ? $_GET['format'] : 'atom';

$fetchParameters = array('limit'=>$limit, 'style'=>$style, 'collectionKey'=>$collectionKey, 'content'=>$content, 'format'=>$format);
foreach($fetchParameters as $key=>$val){
    if(empty($val)){
        unset($fetchParameters[$key]);
    }
}

$items = $library->loadItemsTop($fetchParameters);
//var_dump($items);
//output the list of fetched items with the chosen fields
$output = '';

switch($content){
    case 'html':
    case 'bib':
        foreach($items as $item){
            $output .= $item->content;
        }
        break;
    case 'json':
        $output .= "<ul class='zoteroItems'>";
        $displayFields = array('title', 'creator', 'dateAdded');
        foreach($items as $item){
            $output .= "<li class='zoteroItem'>";
            foreach($displayFields as $field){
                $output .= htmlspecialchars($item->formatItemField($field) . " - ");
            }
            $output .= "</li>";
        }
        $output .= "</ul>";
        break;
    case 'none':
        $output .= "<ul class='zoteroItems'>";
        foreach($items as $item){
            $output .= "<li class='zoteroItem'>";
            foreach($displayFields as $field){
                $output .= htmlspecialchars($item->title) . ' - ' . $item->itemKey;
            }
            $output .= "</li>";
        }
        $output .= "</ul>";
        break;
}

echo $output;
?>
