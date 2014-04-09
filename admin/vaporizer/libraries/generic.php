<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Generic {

	var $vars;

	//constructor
	function generic() {  }

	// gets a value
	function get($var) {
		return $this->vars[$var];
	}

	// sets a key => value
	function set($key,$value) {
		$this->vars[$key] = $value;
	}

	// loads a key => value array into the class
	function load($array) {
		if(is_array($array)) {
			foreach($array as $key=>$value) {
				$this->vars[$key] = $value;
			}
		}
	}

	// empties a specified setting or all of them
	function unload($vars = '') {
		if($vars) {
			if(is_array($vars)) {
				foreach($vars as $var) {
					unset($this->vars[$var]);
				}
			}
			else {
				unset($this->vars[$vars]);
			}
		}
		else {
			$this->vars = array();
		}
	}

	/* return the object as an array */
	function get_all() {
		return $this->vars;
	}

}