<?php
/***************************************************************
 * Copyright notice
 *
 * (c) 2011 Oliver Hader <oliver.hader@typo3.org>
 * All rights reserved
 *
 * This script is part of the TYPO3 project. The TYPO3 project is
 * free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * The GNU General Public License can be found at
 * http://www.gnu.org/copyleft/gpl.html.
 *
 * This script is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Holds content considered as separate part to be balanced.
 *
 * @author Oliver Hader <oliver.hader@typo3.org>
 * @package menu_balancer
 * @subpackage model
 */
class Tx_MenuBalancer_Model_Part {
	/**
	 * @var integer
	 */
	protected $size = 0;

	/**
	 * @var string
	 */
	protected $content;

	/**
	 * Creates this object.
	 *
	 * @param integer $size
	 * @param string $content
	 */
	public function __construct($size, $content) {
		$this->setSize($size);
		$this->setContent($content);
	}

	/**
	 * Sets the size.
	 *
	 * @param integer $size
	 * @return void
	 */
	public function setSize($size) {
		$this->size = (int) $size;
	}

	/**
	 * Gets the size.
	 *
	 * @return integer
	 */
	public function getSize() {
		return $this->size;
	}

	/**
	 * Sets the content.
	 *
	 * @param string $content
	 * @return void
	 */
	public function setContent($content) {
		$this->content = (string) $content;
	}

	/**
	 * Gets the content.
	 *
	 * @return string
	 */
	public function getContent() {
		return $this->content;
	}
}
