<?php

namespace PaperBark;

abstract class PropertyContainer
{
	protected $_properties = [];

	/**
	 * @param string $name
	 * @param mixed $value
	 */
	protected function _setProperty($name, $value)
	{
		$this->_properties[$name] = $value;
	}

	/**
	 * @param string $name
	 * @param mixed $default
	 * @return mixed
	 */
	protected function _getProperty($name, $default = null)
	{
		return $this->_properties[$name] ?: $default;
	}

	/**
	 * @param string $name
	 * @param mixed $value
	 */
	public function __set($name, $value)
	{
		$this->_setProperty($name, $value);
	}

	/**
	 * @param string $name
	 * @return mixed
	 */
	public function __get($name)
	{
		return $this->_getProperty($name);
	}
}