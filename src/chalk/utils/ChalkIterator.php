<?php

/*
 * Copyright 2015 ChalkPE
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
 * @author ChalkPE <amato0617@gmail.com>
 * @since 2015-05-03 15:45
 * @copyright Apache-v2.0
 */

namespace chalk\utils;


class ChalkIterator implements \Iterator {
    private $array = [];

    public function __construct(array $array){
        if(is_array($array)){
            $this->array = $array;
        }
    }

    public function rewind(){
        reset($this->array);
    }

    public function current(){
        return current($this->array);
    }

    public function key(){
        return key($this->array);
    }

    public function next(){
        return next($this->array);
    }

    public function valid(){
        $key = key($this->array);
        return $key !== null and is_integer($key);
    }

}