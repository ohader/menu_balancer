<?php
/**
 * Created by JetBrains PhpStorm.
 * User: olly
 * Date: 29.09.11
 * Time: 18:44
 * To change this template use File | Settings | File Templates.
 */
 
class Tx_MenuBalancer_Renderer {
	/**
	 * @return tslib_cObj
	 */
	public $cObj;

	/**
	 * @param string $content
	 * @param array $configuration
	 * @return string
	 */
	public function execute($content, array $configuration = NULL) {
		$localConfiguration = $this->getConfiguration((array) $configuration);
		$balancedPartCollection = $this->getBalancedPartCollection($content, $localConfiguration);

		if ($balancedPartCollection !== NULL) {
			$content = '';

			while (NULL !== $partCollection = $balancedPartCollection->next()) {
				$partContent = '';
				while (NULL !== $part = $partCollection->next()) {
					$partContent .= $part->getContent();
				}
				$content .= $this->cObj->wrap(
					$partContent,
					$localConfiguration->getReWrap()
				);
			}
		}

		return $content;
	}

	/**
	 * @param $content
	 * @param Tx_MenuBalancer_Model_Configuration $configuration
	 * @return Tx_MenuBalancer_Model_BalancedPartCollection
	 */
	protected function getBalancedPartCollection($content, Tx_MenuBalancer_Model_Configuration $configuration) {
		$balancedPartCollection = NULL;

		/** @var $splitter Tx_MenuBalancer_Service_Splitter */
		$splitter = t3lib_div::makeInstance(
			'Tx_MenuBalancer_Service_Splitter',
			$content,
			$configuration
		);

		$partCollection = $splitter->getPartCollection();

		if ($partCollection->count()) {
			/** @var $balancer Tx_MenuBalancer_Service_Balancer */
			$balancer = t3lib_div::makeInstance(
				'Tx_MenuBalancer_Service_Balancer',
				$splitter->getPartCollection(),
				$configuration->getSize()
			);

			$balancedPartCollection = $balancer->getBalancedPartCollection();
		}

		return $balancedPartCollection;
	}

	/**
	 * @param array $configuration
	 * @return Tx_MenuBalancer_Model_Configuration
	 */
	protected function getConfiguration(array $configuration) {
		return t3lib_div::makeInstance(
			'Tx_MenuBalancer_Model_Configuration',
			$configuration
		);
	}
}
