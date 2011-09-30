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
 * Collects the balanced PartCollection objects.
 *
 * @author Oliver Hader <oliver.hader@typo3.org>
 * @package menu_balancer
 * @subpackage model
 */
class Tx_MenuBalancer_Model_BalancedPartCollection extends Tx_MenuBalancer_Model_AbstractCollection {
	/**
	 * Appends a part to this collection.
	 *
	 * @param Tx_MenuBalancer_Model_PartCollection $object
	 * @return void
	 */
	public function append(Tx_MenuBalancer_Model_PartCollection $object) {
		$this->objects[] = $object;
	}

	/**
	 * Gets the next object.
	 *
	 * @return Tx_MenuBalancer_Model_PartCollection
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
	 * @return Tx_MenuBalancer_Model_PartCollection
	 */
	public function current() {
		$object = NULL;

		if (isset($this->objects[$this->pointer])) {
			$object = $this->objects[$this->pointer];
		}

		return $object;
	}

	/**
	 * Gets the most unbalanced object, which is the
	 * object with the lowest amount of objects compared
	 * to the other PartCollection objects in this collection.
	 *
	 * @return Tx_MenuBalancer_Model_PartCollection
	 */
	public function unbalanced() {
		$unbalancedPointer = 0;
		$size = $this->getHeight();

		/** @var $object Tx_MenuBalancer_Model_PartCollection */
		foreach ($this->objects as $index => $object) {
			$partCollectionSize = $object->getSize();
			if ($partCollectionSize < $size) {
				$size = $partCollectionSize;
				$unbalancedPointer = $index;
			}
		}

		$this->pointer = $unbalancedPointer;
		return $this->current();
	}

	/**
	 * Resets the internal pointer.
	 *
	 * @param boolean $invokeObjects Invoke objects in this collection
	 * @return Tx_MenuBalancer_Model_AbstractCollection
	 */
	public function reset($invokeObjects = FALSE) {
		if ($invokeObjects) {
			/** @var $object Tx_MenuBalancer_Model_PartCollection */
			foreach ($this->objects as $object) {
				$object->reset($includeObjects);
			}
		}

		return parent::reset();
	}

	/**
	 * Gets the height of this collection (maximum amount of
	 * child objects in any of the objects in this collection).
	 *
	 * @return integer
	 */
	public function getHeight() {
		$height = 0;

		/** @var $object Tx_MenuBalancer_Model_PartCollection */
		foreach ($this->objects as $object) {
			$partCollectionSize = $object->getSize();
			if ($partCollectionSize > $height) {
				$height = $partCollectionSize;
			}
		}

		return $height;
	}

	/**
	 * Callback for sorting.
	 *
	 * @param Tx_MenuBalancer_Model_PartCollection $first
	 * @param Tx_MenuBalancer_Model_PartCollection $second
	 * @return integer
	 */
	protected function sortCallback(Tx_MenuBalancer_Model_PartCollection $first, Tx_MenuBalancer_Model_PartCollection $second) {
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
	 * @param Tx_MenuBalancer_Model_PartCollection $first
	 * @param Tx_MenuBalancer_Model_PartCollection $second
	 * @return integer
	 */
	protected function rsortCallback(Tx_MenuBalancer_Model_PartCollection $first, Tx_MenuBalancer_Model_PartCollection $second) {
		// Swap arguments to get reverse order:
		return $this->sortCallback($second, $first);
	}
}
