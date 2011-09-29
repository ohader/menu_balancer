<?php
/**
 * Created by JetBrains PhpStorm.
 * User: olly
 * Date: 29.09.11
 * Time: 18:44
 * To change this template use File | Settings | File Templates.
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
	 * Gets the next part.
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
	 * @return Tx_MenuBalancer_Model_Part
	 */
	public function current() {
		$object = NULL;

		if (isset($this->objects[$this->pointer])) {
			$object = $this->objects[$this->pointer];
		}

		return $object;
	}

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
