<?php
/**
 * Created by JetBrains PhpStorm.
 * User: olly
 * Date: 29.09.11
 * Time: 18:44
 * To change this template use File | Settings | File Templates.
 */
 
class Tx_MenuBalancer_Service_Balancer {
	/**
	 * @var Tx_MenuBalancer_Model_PartCollection
	 */
	protected $partCollection;

	/**
	 * Array of BucketItems, must be reverse ordered!
	 * @var array
	 */
	protected $bucketItems = array();

	/**
	 * @var integer
	 */
	protected $width;

	public function __construct(Tx_MenuBalancer_Model_PartCollection $partCollection, $width) {
		$this->setPartCollection($partCollection->rsort()->reset());
		$this->setWidth($width);
	}

	/**
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

	public function setPartCollection(Tx_MenuBalancer_Model_PartCollection $partCollection) {
		$this->partCollection = $partCollection;
	}

	public function setWidth($width) {
		if (is_integer($width) === FALSE || $width <= 0) {
			throw new RuntimeException('Width must be a positive integer.', 1317315943);
		}

		$this->width = $width;
	}

	/**
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
