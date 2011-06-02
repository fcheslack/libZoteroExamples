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
 * Internal representation of a Google API request, used by the apiServiceResource class to
 * construct API function calls and passing them to the IO layer who knows how to execute
 * the request
 *
 * @author Chris Chabot <chabotc@google.com>
 *
 */
class apiServiceRequest {

  protected $io;
  protected $baseUrl;
  protected $pathUrl;
  protected $rpcName;
  protected $httpMethod;
  protected $parameters;
  protected $postBody;
  protected $batchKey;

  /**
   * Only used internally, so using a quick-and-dirty constuctor
   * @param $pathUrl
   * @param $rpcName
   * @param $httpMethod
   * @param $parameters
   */
  public function __construct(apiIO $io, $baseUrl, $pathUrl, $rpcName, $httpMethod, $parameters, $postBody = null) {
    $this->io = $io;
    $this->baseUrl = $baseUrl;
    $this->pathUrl = $pathUrl;
    $this->rpcName = $rpcName;
    $this->httpMethod = $httpMethod;
    $this->parameters = $parameters;
    $this->postBody = $postBody;
  }

  /**
   * @return the $postBody
   */
  public function getPostBody() {
    return $this->postBody;
  }

  /**
   * @param $postBody the $postBody to set
   */
  public function setPostBody($postBody) {
    $this->postBody = $postBody;
  }

  /**
   * @return the $io
   */
  public function getIo() {
    return $this->io;
  }

  /**
   * @param $io the $io to set
   */
  public function setIo($io) {
    $this->io = $io;
  }

  /**
   * @return the $baseUrl
   */
  public function getBaseUrl() {
    return $this->baseUrl;
  }

  /**
   * @param $baseUrl the $baseUrl to set
   */
  public function setBaseUrl($baseUrl) {
    $this->baseUrl = $baseUrl;
  }

  /**
   * @return the $pathUrl
   */
  public function getPathUrl() {
    return $this->pathUrl;
  }

  /**
   * @return the $rpcName
   */
  public function getRpcName() {
    return $this->rpcName;
  }

  /**
   * @return the $httpMethod
   */
  public function getHttpMethod() {
    return $this->httpMethod;
  }

  /**
   * @return the $parameters
   */
  public function getParameters() {
    return $this->parameters;
  }

  /**
   * @param $pathUrl the $pathUrl to set
   */
  public function setPathUrl($pathUrl) {
    $this->pathUrl = $pathUrl;
  }

  /**
   * @param $rpcName the $rpcName to set
   */
  public function setRpcName($rpcName) {
    $this->rpcName = $rpcName;
  }

  /**
   * @param $httpMethod the $httpMethod to set
   */
  public function setHttpMethod($httpMethod) {
    $this->httpMethod = $httpMethod;
  }

  /**
   * @param $parameters the $parameters to set
   */
  public function setParameters($parameters) {
    $this->parameters = $parameters;
  }

  /**
   * @return the $batchKey
   */
  public function getBatchKey() {
    return $this->batchKey;
  }

  /**
   * @param $batchKey the $batchKey to set
   */
  public function setBatchKey($batchKey) {
    $this->batchKey = $batchKey;
  }

}
