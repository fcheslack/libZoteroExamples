<?php
// Include the library files
require_once 'google-api-php-client/src/apiClient.php';
require_once 'google-api-php-client/src/contrib/apiBuzzService.php';

// Create the apiClient and Buzz service classes:
$apiClient = new apiClient();
$buzz = new apiBuzzService($apiClient);

// Add the OAuth authentication flow to your app:
// If a oauth token was stored in the session, use that and otherwise go through the oauth dance
session_start();
if (isset($_SESSION['auth_token'])) {
      $apiClient->setAccessToken($_SESSION['auth_token']);
} else {
      // In a real application this would be stored in a database, and not in the session!
        $_SESSION['auth_token'] = $apiClient->authenticate();
}

// Make an API call
$activities = $buzz->listActivities('@consumption', '@me');

// And echo the returned activities
echo '<pre>Activities:\n' . print_r($activities, true) . '</pre>';

?>
