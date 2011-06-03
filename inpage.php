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
<?php
define('ROOT_DIR', dirname(dirname(__FILE__)));

set_include_path('.' . PATH_SEPARATOR . ROOT_DIR . '/library'
     . PATH_SEPARATOR . get_include_path());

require_once('zoteroconfig.php');
require_once('library/libZoteroSingle.php');


$library = new Zotero_Library($libraryType, $userID, $userSlug, $apiKey);

$fetchParameters = array('limit'=>10);
$items = $library->loadItemsTop($fetchParameters);

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
?>
</body>
</html>