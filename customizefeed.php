<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>libZotero Examples</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>

    <header role="banner">
    <h1>libZotero Examples</h1>
    </header>
    <nav>
    <ul>
    <li><a href="inpage.php">Load Zotero data within a page</a></li>
    <li><a href="container.html">Load a frame the load Zotero data into it</a></li>
    <li><a href="customizefeed.php">Customize a Zotero items feed</a></li>
    <li><a href="createitem.php">Create Item</a></li>
    </ul>
    </nav>
<form>
    <ul>
    <li><input type="text" name="collectionKey"></input> CollectionKey</li>
    <li><input type="text" name="limit"></input> Limit</li>
    <li><input type="text" name="style"></input> Style</li>
    <li>
        <select name="content">
            <option value="json">JSON</option>
            <option value="html">html</option>
            <option value="none">none</option>
            <option value="bib">bib</option>
        </select> Content
    </li>
    <li><input type="submit" /></li>
    </ul>
</form>

<?php
define('ROOT_DIR', dirname(dirname(__FILE__)));

set_include_path('.' . PATH_SEPARATOR . ROOT_DIR . '/library'
     . PATH_SEPARATOR . get_include_path());

require_once('zoteroconfig.php');
require_once('library/libZoteroSingle.php');

if(isset($_GET['collectionKey'])){
    $collectionKey = $_GET['collectionKey'];
}
else{
    die;
}

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
</body>
</html>