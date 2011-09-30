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
 * Abstract class for collections.
 *
 * @author Oliver Hader <oliver.hader@typo3.org>
 * @package menu_balancer
 * @subpackage model
 */
class Tx_MenuBalancer_Model_PartCollection extends Tx_MenuBalancer_Model_AbstractCollection {
	/**
	 * Appends a part to this collection.
	 *
	 * @param Tx_MenuBalancer_Model_Part $object
	 * @return void
	 */
	public function append(Tx_MenuBalancer_Model_Part $object) {
		$this->objects[] = $object;
	}

	/**
	 * Gets the next object.
	 *
	 * @return Tx_MenuBalancer_Model_Part
	 */
	public function next() {
		if (NULL !== $object = $this->current()) {
			$this->pointer++;
		}

		return $object;
	}

	/**
	 * Gets the current object.
	 *
	 * @return Tx_MenuBalancer_Model_Part
	 */
	public function current() {
		$object = NULL;

		if (isset($this->objects[$this->pointer])) {
			$object = $this->objects[$this->pointer];
		}

		return $object;
	}

	/**
	 * Gets the summarized size of all objects in this collection.
	 *
	 * @return integer
	 */
	public function getSize() {
		$size = 0;

		/** @var $object Tx_MenuBalancer_Model_Part */
		foreach ($this->objects as $object) {
			$size += $object->getSize();
		}

		return $size;
	}

	/**
	 * Callback for sorting.
	 *
	 * @param Tx_MenuBalancer_Model_Part $first
	 * @param Tx_MenuBalancer_Model_Part $second
	 * @return integer
	 */
	protected function sortCallback(Tx_MenuBalancer_Model_Part $first, Tx_MenuBalancer_Model_Part $second) {
		$result = 1;

		if ($first->getSize() === $second->getSize()) {
			$result = 0;
		} elseif ($first->getSize() < $second->getSize()) {
			$result = -1;
		}

		return $result;
	}

	/**
	 * Callback for reverse sorting.
	 *
	 * @param Tx_MenuBalancer_Model_Part $first
	 * @param Tx_MenuBalancer_Model_Part $second
	 * @return integer
	 */
	protected function rsortCallback(Tx_MenuBalancer_Model_Part $first, Tx_MenuBalancer_Model_Part $second) {
		// Swap arguments to get reverse order:
		return $this->sortCallback($second, $first);
	}
}
