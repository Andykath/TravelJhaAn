<?php
require_once("Component.php");

class Panel extends Component{
		
		
		private $components=array();
		public $classname="Panel";
		private $bool=true;
		
		function Panel($file_str,$root="."){
			parent::Component($root);
			$this->tfile="file_".rand();
			$this->file_str=$file_str;
			$this->setFile($this->tfile,$this->file_str);
		}
		
		function add($layout,$component=""){
			if(is_object($component))$component=$component->getComponent();
			$this->setVar($layout,$component);
		}
		
		function getComponent($finish=true){
			//if($this->bool==true)$this->add("SID",SID);
			//$this->add("BIO_URL",BIO_URL);
			$h_OUT="out_".rand();
			$this->parse($h_OUT,$this->tfile);
			if($finish){
				return $this->finish($this->getVar($h_OUT));
			}else{
				return $this->getVar($h_OUT);
			}
		}
/*		function setBlock($block){
			$handler="BLOCK_".rand();
			parent::setBlock($this->tfile,$block,$handler);
			return $handler;
		}*/
		
		function concat($block,$handler){
			$this->parse($handler,$block,true);
		}
		
		/* activa-desactiva al panel a colocar el SID*/
		function setSID($bool=true){
			$this->bool=$bool;
		}
	
		
		function show($bool=false){
			echo $this->getComponent();
		}
}
?>