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

/**
 * Do-nothing authentication implementation, use this if you want to make un-authenticated calls
 * @author Chris Chabot <chabotc@google.com>
 *
 */
class apiAuthNone extends apiAuth {

  public $developerKey = null;

  public function authenticate(apiCache $cache, apiIO $io, $service) {
    // noop
  }

  public function setAccessToken($accessToken) {
    // noop
  }

  public function setDeveloperKey($developerKey) {
    $this->developerKey = $developerKey;
  }


  public function sign(apiHttpRequest $request) {
    if ($this->developerKey) {
      $url = $request->getUrl();
      $url .= ((strpos($url, '?') === false) ? '?' : '&') . 'key='.urlencode($this->developerKey);
    }
    // else noop
    return $request;
  }
}
