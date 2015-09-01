<?php

/**
 * @author ChalkPE <chalkpe@gmail.com>
 * @since 2015-09-01 16:05
 */

namespace chalk\utils;

class Time {
	const HOUR_OFFSET = 6;
	const TICK_ONE_HOUR = 1000;

	/** @var int */
	private $time;

	public function __construct($time = 0){
		$this->time = $time;
	}

	public function getTotalHours(){
		return ($this->time / self::TICK_ONE_HOUR) + self::HOUR_OFFSET;
	}

	public function getTotalDays(){
		return ($this->getTotalHours() / 24);
	}

	public function getDays(){
		return floor($this->getTotalDays());
	}

	public function getHours(){
		return fmod($this->getTotalHours(), 24);
	}

	public function getMinutes(){
		return fmod($this->getHours(), 1) * 60;
	}

	public function getSeconds(){
		return fmod($this->getMinutes(), 1) * 60;
	}

	public function getMinecraftSeconds(){
		return fmod($this->getMinutes(), 1) * 50;
	}
}