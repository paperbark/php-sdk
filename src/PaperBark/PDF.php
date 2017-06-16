<?php

namespace PaperBark;

class PDF extends PropertyContainer
{
	private $_pages = [];

	/**
	 * Add page to the document, returns the page
	 * @param Page|string $page
	 * @return Page
	 */
	public function addPage($page)
	{
		if (!$page instanceof Page)
			$page = new Page($page);

		$this->_pages[] = $page;

		return $page;
	}

	/**
	 * Serialize to array
	 * @return array
	 */
	public function serialize()
	{
		$json = [];
		$json['properties'] = $this->_properties;
		$json['pages'] = [];

		foreach ($this->_pages as $page) {
			$json['pages'][] = $page->serialize();
		}

		return $json;
	}
}