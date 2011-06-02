<?php
/*
 * Copyright 2010 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

$apiConfig = array(

    // Site name to show in the Google's oauth authentication screen
    'site_name' => 'www.example.org',

    // If you're using the apiOAuth auth class, it will use these values for the oauth consumer key and secret.
    // See http://code.google.com/apis/accounts/docs/RegistrationForWebAppsAuto.html for info on how to obtain those
    'oauth_consumer_key'    => 'anonymous',
    'oauth_consumer_secret' => 'anonymous',

    // Which Authentication, Storage and HTTP IO classes to use.
    'authClass'    => 'apiOAuth',
    'ioClass'      => 'apiCurlIO',
	'cacheClass'   => 'apiFileCache',

    // If you want to run the test suite (by running # phpunit AllTests.php in the tests/ directory), fill in the settings below
    'oauth_test_token' => '', // the oauth access token to use (which you can get by runing authenticate() as the test user and copying the token value), ie '{"key":"foo","secret":"bar","callback_url":null}'
    'oauth_test_user' => '', // and the user ID to use, this can either be a vanity name 'testuser' or a numberic ID '123456'

	// IO Class dependent configuration, you only have to configure the values for the class that was configured as the ioClass above
    'ioFileCache_directory'  => '/tmp/apiClient',
    'ioMemCacheStorage_host' => '127.0.0.1',
    'ioMemcacheStorage_port' => '11211',

    // Definition of service specific values like scopes, oauth token url's, etc
    'services' => array(
    	'buzz' => array('scope' => 'https://www.googleapis.com/auth/buzz', 'authorization_token_url' => 'https://www.google.com/buzz/api/auth/OAuthAuthorizeToken'),
    	'latitude' => array('scope' => 'https://www.googleapis.com/auth/latitude', 'authorization_token_url' => 'https://www.google.com/latitude/apps/OAuthAuthorizeToken'),
        'moderator' => array('scope' => 'https://www.googleapis.com/auth/moderator'),
        'easyhybrid' => array('scope' => 'https://www.googleapis.com/auth/userinfo#email')
    )
);
