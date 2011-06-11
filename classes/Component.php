<?php

	require_once("Template_PHPLib.php");

	class Component extends Template_PHPLIB {

		public $classname="Component";
	
		function Component($root="."){
			parent::Template_PHPLIB($root);
		}
		
		function getComponent(){}
	}
?>