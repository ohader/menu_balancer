<?php
/**
 * Created by JetBrains PhpStorm.
 * User: olly
 * Date: 29.09.11
 * Time: 18:44
 * To change this template use File | Settings | File Templates.
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
	 * Gets the next part.
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
	 * @param boolean $includeObjects
	 * @return Tx_MenuBalancer_Model_AbstractCollection
	 */
	public function reset($includeObjects = FALSE) {
		if ($includeObjects) {
			/** @var $object Tx_MenuBalancer_Model_PartCollection */
			foreach ($this->objects as $object) {
				$object->reset($includeObjects);
			}
		}

		return parent::reset();
	}

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
