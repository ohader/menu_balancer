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
 * Service class to perform the balancing.
 *
 * @author Oliver Hader <oliver.hader@typo3.org>
 * @package menu_balancer
 * @subpackage service
 */
class Tx_MenuBalancer_Service_Balancer {
	/**
	 * @var Tx_MenuBalancer_Model_PartCollection
	 */
	protected $partCollection;

	/**
	 * @var integer
	 */
	protected $width;

	public function __construct(Tx_MenuBalancer_Model_PartCollection $partCollection, $width) {
			// The parts in the collection must be reversed ordered:
		$this->setPartCollection($partCollection->rsort()->reset());
		$this->setWidth($width);
	}

	/**
	 * Executes the balancing and gets the accordant collection.
	 *
	 * @return Tx_MenuBalancer_Model_BalancedPartCollection
	 */
	public function getBalancedPartCollection() {
		$balancedPartCollection = $this->createNewBalancedPartCollection();

		// Arrange largest parts on available slots:
		while (NULL !== $partCollection = $balancedPartCollection->next()) {
			if (NULL !== $part = $this->partCollection->next()) {
				$partCollection->append($part);
			}
		}

		// Arrange largest parts on most unbalanced slots:
		while (NULL !== $part = $this->partCollection->next()) {
			$balancedPartCollection->unbalanced()->append($part);
		}

		return $balancedPartCollection->reset(TRUE);
	}

	/**
	 * Sets the part collection.
	 *
	 * @param Tx_MenuBalancer_Model_PartCollection $partCollection
	 * @return void
	 */
	public function setPartCollection(Tx_MenuBalancer_Model_PartCollection $partCollection) {
		$this->partCollection = $partCollection;
	}

	/**
	 * Sets ths width of this collection
	 * (= number of columns the parts shall be balanced to)
	 *
	 * @throws RuntimeException
	 * @param integer $width
	 * @return void
	 */
	public function setWidth($width) {
		if (is_integer($width) === FALSE || $width <= 0) {
			throw new RuntimeException('Width must be a positive integer.', 1317315943);
		}

		$this->width = $width;
	}

	/**
	 * Creates a new balanced part collection with the amount of
	 * part collections (= columns) as defined in $this->width.
	 *
	 * @return Tx_MenuBalancer_Model_BalancedPartCollection
	 */
	protected function createNewBalancedPartCollection() {
		/** @var $balancedPartCollection Tx_MenuBalancer_Model_BalancedPartCollection */
		$balancedPartCollection = t3lib_div::makeInstance(
			'Tx_MenuBalancer_Model_BalancedPartCollection'
		);

		for ($index=0; $index<$this->width; $index++) {
			$balancedPartCollection->append(
				t3lib_div::makeInstance(
					'Tx_MenuBalancer_Model_PartCollection'
				)
			);
		}

		return $balancedPartCollection;
	}
}
