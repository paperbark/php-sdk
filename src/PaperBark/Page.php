<?php

namespace PaperBark;

class Page extends PropertyContainer
{
	private $_type = 'html';
	private $_content = '';

	/**
	 * Page constructor.
	 * @param string $content
	 * @param array $properties
	 */
	public function __construct($content, $properties = [])
	{
		$this->_content = strval($content);

		foreach ($properties as $name => $value)
			$this->_setProperty($name, $value);
	}

	/**
	 * Serialize to array
	 * @return array
	 */
	public function serialize()
	{
		$json = [];
		$json['properties'] = $this->_properties;
		$json['type'] = $this->_type;
		$json['content'] = $this->_content;

		return $json;
	}
}