<?php
/**
 * Created by JetBrains PhpStorm.
 * User: olly
 * Date: 29.09.11
 * Time: 18:44
 * To change this template use File | Settings | File Templates.
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
