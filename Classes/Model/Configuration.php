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
 * Holds the TypoScript configuration.
 *
 * @author Oliver Hader <oliver.hader@typo3.org>
 * @package menu_balancer
 * @subpackage model
 */
class Tx_MenuBalancer_Model_Configuration {
	/**
	 * @var integer
	 */
	protected $size;

	/**
	 * @var string
	 */
	protected $unWrap;

	/**
	 * @var string
	 */
	protected $reWrap;

	/**
	 * @var string
	 */
	protected $splitPattern;

	/**
	 * @var string
	 */
	protected $splitStart;

	/**
	 * @var string
	 */
	protected $splitEnd;

	/**
	 * @var string
	 */
	protected $sizePattern;

	/**
	 * Creates this object.
	 *
	 * @param array $configuration TypoScript configuration
	 */
	public function __construct(array $configuration) {
		foreach ($configuration as $property => $value) {
			switch ($property) {
				case 'size':
					$this->setSize($value);
					break;
				case 'unWrap':
					$this->setUnWrap($value);
					break;
				case 'reWrap':
					$this->setReWrap($value);
					break;
				case 'splitPattern':
					$this->setSplitPattern($value);
					break;
				case 'splitStart':
					$this->setSplitStart($value);
					break;
				case 'splitEnd':
					$this->setSplitEnd($value);
					break;
				case 'sizePattern':
					$this->setSizePattern($value);
					break;
			}
		}
	}

	/**
	 * Sets the size property.
	 *
	 * @param integer $size
	 * @return void
	 */
	public function setSize($size) {
		$this->size = (int) $size;
	}

	/**
	 * Gets the size property.
	 *
	 * @return integer
	 */
	public function getSize() {
		return $this->size;
	}

	/**
	 * Sets the reWrap property.
	 *
	 * @param string $reWrap
	 * @return void
	 */
	public function setReWrap($reWrap) {
		$this->reWrap = (string) $reWrap;
	}

	/**
	 * Gets the reWrap property.
	 *
	 * @return string
	 */
	public function getReWrap() {
		return $this->reWrap;
	}

	/**
	 * Sets the unWrap property.
	 *
	 * @param string $unWrap
	 * @return void
	 */
	public function setUnWrap($unWrap) {
		$this->unWrap = (string) $unWrap;
	}

	/**
	 * Gets the unWrap property.
	 *
	 * @return string
	 */
	public function getUnWrap() {
		return $this->unWrap;
	}

	/**
	 * Sets the splitPattern property.
	 *
	 * @param string $splitPattern
	 * @return void
	 */
	public function setSplitPattern($splitPattern) {
		$this->splitPattern = (string) $splitPattern;
	}

	/**
	 * Gets the splitPattern property.
	 *
	 * @return string
	 */
	public function getSplitPattern() {
		return $this->splitPattern;
	}

	/**
	 * Sets the splitStart property.
	 *
	 * @param string $splitStart
	 * @return void
	 */
	public function setSplitStart($splitStart) {
		$this->splitStart = (string) $splitStart;
	}

	/**
	 * Gets the splitStart property.
	 *
	 * @return string
	 */
	public function getSplitStart() {
		return $this->splitStart;
	}

	/**
	 * Sets the splitEnd property.
	 *
	 * @param string $splitEnd
	 * @return void
	 */
	public function setSplitEnd($splitEnd) {
		$this->splitEnd = (string) $splitEnd;
	}

	/**
	 * Gets the splitEnd property.
	 *
	 * @return string
	 */
	public function getSplitEnd() {
		return $this->splitEnd;
	}

	/**
	 * Sets the sizePattern property.
	 *
	 * @param string $sizePattern
	 * @return void
	 */
	public function setSizePattern($sizePattern) {
		$this->sizePattern = (string) $sizePattern;
	}

	/**
	 * Gets the sizePattern property.
	 *
	 * @return string
	 */
	public function getSizePattern() {
		return $this->sizePattern;
	}
}
