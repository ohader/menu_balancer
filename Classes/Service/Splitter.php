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
 * Service class for splitting the content into separate parts.
 *
 * @author Oliver Hader <oliver.hader@typo3.org>
 * @package menu_balancer
 * @subpackage service
 */
class Tx_MenuBalancer_Service_Splitter {
	/**
	 * @var string
	 */
	protected $content;

	/**
	 * @var Tx_MenuBalancer_Model_Configuration
	 */
	protected $configuration;

	/**
	 * Creates this object.
	 *
	 * @param string $content
	 * @param Tx_MenuBalancer_Model_Configuration $configuration
	 */
	public function __construct($content, Tx_MenuBalancer_Model_Configuration $configuration) {
		$this->setContent($content);
		$this->setConfiguration($configuration);
		$this->unWrap();
	}

	/**
	 * Gets the split part collection.
	 *
	 * @return Tx_MenuBalancer_Model_PartCollection
	 */
	public function getPartCollection() {
		/** @var $partCollection Tx_MenuBalancer_Model_PartCollection */
		$partCollection = t3lib_div::makeInstance('Tx_MenuBalancer_Model_PartCollection');

		if ($this->configuration->getSplitPattern()) {
				// Split into raw content parts:
			$allParts = preg_split(
				$this->configuration->getSplitPattern(),
				$this->content, NULL, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY
			);

			$level = 0;
			$content = '';
			$splitParts = array();

				// Collect to only separate parts on the first level:
			foreach ($allParts as $allPart) {
				if (stripos($allPart, $this->configuration->getSplitStart()) !== FALSE) {
					$level++;
				} elseif (stripos($allPart, $this->configuration->getSplitEnd()) !== FALSE) {
					$level--;
				}

				$content .= trim($allPart);

				if ($level === 0) {
					if (empty($content) === FALSE) {
						$splitParts[] = $content;
					}
					$content = '';
				}
			}

				// Create part objects out of the raw split parts:
			foreach ($splitParts as $splitPart) {
				$matches = array();
				if (preg_match_all($this->configuration->getSizePattern(), $splitPart, $matches)) {
					$partCollection->append(
						t3lib_div::makeInstance(
							'Tx_MenuBalancer_Model_Part',
							count($matches[0]), $splitPart
						)
					);
				}
			}
		}

		return $partCollection;
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

	/**
	 * Sets the configuration.
	 *
	 * @param Tx_MenuBalancer_Model_Configuration $configuration
	 * @return void
	 */
	public function setConfiguration(Tx_MenuBalancer_Model_Configuration $configuration) {
		$this->configuration = $configuration;
	}

	/**
	 * Gets the configuration.
	 *
	 * @return Tx_MenuBalancer_Model_Configuration
	 */
	public function getConfiguration() {
		return $this->configuration;
	}

	/**
	 * Unwraps the content (opposite to wrap in TypoScript).
	 *
	 * @return void
	 */
	protected function unWrap() {
		if ($this->configuration->getUnWrap()) {
			$unWrap = t3lib_div::trimExplode('|', $this->configuration->getUnWrap(), FALSE, 2);

			$this->content = preg_replace(
				'#^\s*' . preg_quote($unWrap[0], '#') . '\s*(.*)\s*' . preg_quote($unWrap[1], '#') . '\s*$#s',
				'${1}', $this->content
			);

			$this->content = trim($this->content);
		}
	}
}
