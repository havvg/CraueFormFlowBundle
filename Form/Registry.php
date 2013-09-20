<?php

namespace Craue\FormFlowBundle\Form;

/**
 * The default implementation of the flow registry.
 *
 * @author Toni Uebernickel <tuebernickel@gmail.com>
 * @copyright 2011-2013 Christian Raue
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class Registry implements RegistryInterface {

	protected $flows = array();

	/**
	 * {@inheritDoc}
	 */
	public function addFlow(FormFlowInterface $flow, $alias = null) {
		$name = $flow->getName();
		if ($alias) {
			$name = $alias;
		}

		if (!empty($this->flows[$name])) {
			throw new \InvalidArgumentException(sprintf('There already is a flow of name "%s".', $name));
		}

		$this->flows[$name] = $flow;

		return $this;
	}

	/**
	 * {@inheritDoc}
	 */
	public function removeFlow($name) {
		unset($this->flows[$name]);
	}

	/**
	 * {@inheritDoc}
	 */
	public function getFlow($name) {
		if (empty($this->flows[$name])) {
			throw new \OutOfBoundsException(sprintf('There is no flow of name "%s".', $name));
		}

		return $this->flows[$name];
	}
}
