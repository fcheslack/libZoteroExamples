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
<form method="POST">
    <ul>
    <li><input type="text" name="title" />Book Title</li>
    <li><input type="text" name="note" />Note</li>
    <li><input type="submit" /></li>
    </ul>
</form>

<?php
define('ROOT_DIR', dirname(dirname(__FILE__)));

set_include_path('.' . PATH_SEPARATOR . ROOT_DIR . '/library'
     . PATH_SEPARATOR . get_include_path());

require_once('zoteroconfig.php');
require_once('library/libZoteroSingle.php');

$library = new Zotero_Library($libraryType, $userID, $userSlug, $apiKey);

if(!empty($_POST)){
    if(empty($_POST['title'])){
        die("Item must have title");
    }
    //create a new item of type book
    $newItem = $library->getTemplateItem('book');
    $newItem->set('title', $_POST['title']);
    $newItem->set('abstractNote', 'Created using a zotero php library and the write api');
    $createItemResponse = $library->createItem($newItem);
    if($createItemResponse->isError()){
        echo $createItemResponse->getStatus() . "\n";
        echo $createItemResponse->getBody() . "\n";
        die("Error creating Zotero item\n\n");
    }
    echo "Item created\n\n";
    $existingItem = new Zotero_Item($createItemResponse->getBody());
    //add child note
    $newNoteItem = $library->getTemplateItem('note');
    $addNoteResponse = $library->addNotes($existingItem, $newNoteItem);
    if($addNoteResponse->isError()){
        echo $addNoteResponse->getStatus() . "\n";
        echo $addNoteResponse->getBody() . "\n";
        die("error adding child note to item");
    }
    echo "added child note\n";
}


?>
</body>
</html>