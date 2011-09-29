<?php
/**
 * Created by JetBrains PhpStorm.
 * User: olly
 * Date: 29.09.11
 * Time: 18:44
 * To change this template use File | Settings | File Templates.
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

	public function setSize($size) {
		$this->size = (int) $size;
	}

	public function getSize() {
		return $this->size;
	}

	public function setReWrap($reWrap) {
		$this->reWrap = (string) $reWrap;
	}

	public function getReWrap() {
		return $this->reWrap;
	}

	public function setUnWrap($unWrap) {
		$this->unWrap = (string) $unWrap;
	}

	public function getUnWrap() {
		return $this->unWrap;
	}

	public function setSplitPattern($splitPattern) {
		$this->splitPattern = (string) $splitPattern;
	}

	public function getSplitPattern() {
		return $this->splitPattern;
	}

	public function setSplitStart($splitStart) {
		$this->splitStart = (string) $splitStart;
	}

	public function getSplitStart() {
		return $this->splitStart;
	}

	public function setSplitEnd($splitEnd) {
		$this->splitEnd = (string) $splitEnd;
	}

	public function getSplitEnd() {
		return $this->splitEnd;
	}

	public function setSizePattern($sizePattern) {
		$this->sizePattern = (string) $sizePattern;
	}

	public function getSizePattern() {
		return $this->sizePattern;
	}
}
