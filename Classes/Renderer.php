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
 * Renders the content and serves as user function in TypoScript.
 *
 * @author Oliver Hader <oliver.hader@typo3.org>
 * @package menu_balancer
 */
class Tx_MenuBalancer_Renderer {
	/**
	 * @return tslib_cObj
	 */
	public $cObj;

	/**
	 * Executes the splitting, balancing and accordant content rendering.
	 *
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
	 * Gets the balanced part collection.
	 *
	 * @param string $content
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
	 * Gets the configuration object.
	 *
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
