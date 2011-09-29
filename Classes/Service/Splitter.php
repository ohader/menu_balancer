<?php
/**
 * Created by JetBrains PhpStorm.
 * User: olly
 * Date: 29.09.11
 * Time: 18:44
 * To change this template use File | Settings | File Templates.
 */
 
class Tx_MenuBalancer_Service_Splitter {
	protected $content;

	/**
	 * @var Tx_MenuBalancer_Model_Configuration
	 */
	protected $configuration;

	public function __construct($content, Tx_MenuBalancer_Model_Configuration $configuration) {
		$this->setContent($content);
		$this->setConfiguration($configuration);
		$this->unWrap();
	}

	/**
	 * Gets the splitted part collection.
	 *
	 * @return Tx_MenuBalancer_Model_PartCollection
	 */
	public function getPartCollection() {
		/** @var $partCollection Tx_MenuBalancer_Model_PartCollection */
		$partCollection = t3lib_div::makeInstance('Tx_MenuBalancer_Model_PartCollection');

		if ($this->configuration->getSplitPattern()) {
			$allParts = preg_split(
				$this->configuration->getSplitPattern(),
				$this->content, NULL, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY
			);

			$level = 0;
			$content = '';
			$splitParts = '';

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

	public function setContent($content) {
		$this->content = (string) $content;
	}

	public function getContent() {
		return $this->content;
	}

	public function setConfiguration(Tx_MenuBalancer_Model_Configuration $configuration) {
		$this->configuration = $configuration;
	}

	public function getConfiguration() {
		return $this->configuration;
	}

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
