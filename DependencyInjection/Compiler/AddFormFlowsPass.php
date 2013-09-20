<?php

namespace Craue\FormFlowBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Adds all tagged form flows to the registry.
 *
 * @author Toni Uebernickel <tuebernickel@gmail.com>
 * @copyright 2011-2013 Christian Raue
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class AddFormFlowsPass implements CompilerPassInterface {

	/**
	 * {@inheritDoc}
	 */
	public function process(ContainerBuilder $container) {
		if (!$container->hasDefinition('craue.form.flow.registry')) {
			return;
		}

		$registry = $container->getDefinition('craue.form.flow.registry');
		foreach ($container->findTaggedServiceIds('craue.form.flow') as $serviceId => $tags) {
			$alias = isset($tag[0]['alias'])
				? $tag[0]['alias']
				: $serviceId;

			$registry->addMethodCall('addFlow', array(new Reference($serviceId), $alias));
		}
	}
}
