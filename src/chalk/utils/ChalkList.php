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
 * @since 2015-05-03 15:28
 * @copyright Apache-v2.0
 */

namespace chalk\utils;


class ChalkList implements Arrayable, \IteratorAggregate {
    /** @var array */
    private $elements;

    /**
     * @param array $elements
     */
    public function __construct(array $elements = []){
        $this->elements = [];
        foreach($elements as $index => $element){
            $this->elements[] = $element;
        }
    }

    /**
     * @param $index
     * @param array $array
     * @return ChalkList
     */
    public static function createFromArray($index, $array){
        return new ChalkList($array);
    }

    /**
     * @return array
     */
    public function toArray(){
        return $this->elements;
    }

    /**
     * @return ChalkIterator
     */
    public function getIterator(){
        return new ChalkIterator($this->elements);
    }

    function __call($name, $args){
        switch($name){
            case "add":
                if(count($args) == 2 and is_integer($args[0])){
                    $this->addAtIndex($args[0], $args[1]);
                }
                break;

            case "remove":
                if(count($args) == 2 and is_integer($args[0])){
                    $this->removeAtIndex($args[0], $args[1]);
                }
                break;
        }
    }

    /**
     * @return int
     */
    public function size(){
        return count($this->elements);
    }

    /**
     * @return bool
     */
    public function isEmpty(){
        return $this->size() === 0;
    }

    public function clear(){
        $this->elements = [];
    }

    /**
     * @param int $index
     * @return mixed
     */
    public function get($index){
        if($index < 0 or $index >= $this->size()){
            throw new \OutOfBoundsException();
        }

        return $this->elements[$index];
    }

    /**
     * @param mixed $element
     */
    public function add($element){
        $this->elements[] = $element;
    }

    /**
     * @param int $index
     * @param mixed $element
     */
    public function addAtIndex($index, $element){
        if($index < 0 or $index >= $this->size()){
            throw new \OutOfBoundsException();
        }

        array_splice($this->elements, $index, 0, $element);
    }

    /**
     * @param mixed $element
     * @return int
     */
    public function indexOf($element){
        foreach($this as $index => $e){
            if($element === $e){
                return $index;
            }
        }
        return -1;
    }

    /**
     * @param mixed $element
     * @return int
     */
    public function lastIndexOf($element){
        $lastIndex = -1;

        foreach($this as $index => $e){
            if($element === $e){
                $lastIndex = $index;
            }
        }
        return $lastIndex;
    }

    /**
     * @param mixed $element
     * @return null|mixed
     */
    public function remove($element){
        $index = $this->indexOf($element);

        if($index >= 0){
            return $this->removeAtIndex($index);
        }else{
            return null;
        }
    }

    /**
     * @param int $index
     * @return mixed
     */
    public function removeAtIndex($index){
        if($index < 0 or $index >= $this->size()){
            throw new \OutOfBoundsException();
        }

        return array_splice($this->elements, $index, 1)[0];
    }

    /**
     * @param mixed $element
     * @return bool
     */
    public function contains($element){
        return $this->indexOf($element) >= 0;
    }
}