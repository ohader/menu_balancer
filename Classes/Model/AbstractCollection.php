<?php
/**
 * Created by JetBrains PhpStorm.
 * User: olly
 * Date: 29.09.11
 * Time: 18:44
 * To change this template use File | Settings | File Templates.
 */
 
abstract class Tx_MenuBalancer_Model_AbstractCollection {
	/**
	 * @var array
	 */
	protected $objects = array();

	/**
	 * @var integer
	 */
	protected $pointer = 0;

	/**
	 * Resets the internal pointer.
	 *
	 * @return Tx_MenuBalancer_Model_AbstractCollection
	 */
	public function reset() {
		$this->pointer = 0;
		return $this;
	}

	/**
	 * @return integer
	 */
	public function count() {
		return count($this->objects);
	}

	/**
	 * Sorts the parts by size.
	 *
	 * @return Tx_MenuBalancer_Model_AbstractCollection
	 */
	public function sort() {
		usort($this->objects, array($this, 'sortCallback'));
		return $this;
	}

	/**
	 * Reverse sorts the parts by size.
	 *
	 * @return Tx_MenuBalancer_Model_AbstractCollection
	 */
	public function rsort() {
		usort($this->objects, array($this, 'rsortCallback'));
		return $this;
	}
}
