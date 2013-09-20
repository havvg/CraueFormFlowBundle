<?php

namespace Craue\FormFlowBundle\Form;

/**
 * This interface describes how a Registry of flows is defined.
 *
 * @author Toni Uebernickel <tuebernickel@gmail.com>
 * @copyright 2011-2013 Christian Raue
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
interface RegistryInterface {

	/**
	 * Add the given flow to the registry.
	 *
	 * @param FormFlowInterface $flow
	 * @param string|null $alias If given the flow will be available under the given alias.
	 *
	 * @return void
	 */
	function addFlow(FormFlowInterface $flow, $alias = null);

	/**
	 * Remove a flow from the registry by its name or alias.
	 *
	 * @param string $name
	 *
	 * @return void
	 */
	function removeFlow($name);

	/**
	 * Retrieve a flow by its name or alias.
	 *
	 * @param string $name
	 *
	 * @return FormFlowInterface
	 *
	 * @throws \OutOfBoundsException If the flow has not been registered.
	 */
	function getFlow($name);
}
