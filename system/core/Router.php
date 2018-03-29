<?php

class Router
{
	public function __construct()
	{
	
	}
}

































#	public $uri;
#	public $controller;
#	public $method;
#	public $param;
#	
#	public function __construct()
#	{
#		$this->setUri();
#		$this->setController();
#		$this->setMethod();
#		$this->setParam();
#	}
#	
#	public function setUri()
#	{
#		$this->uri = explode('/', URI);
#	}
#	
#	public function setController()
#	{
#		$this->controller = $this->uri[1] === '' ? 'Home' : $this->uri[1];
#	}
#	
#	public function setMethod()
#	{
#		$this->method = !empty($this->uri[2]) ? $this->uri[2] : 'index';
#	}
#	
#	public function setParam()
#	{
#		$this->param = !empty($this->uri[3]) ? $this->uri[3] : '';
#	}
#	
#	public function get($var)
#	{
#		return $this->$var;
#	}

