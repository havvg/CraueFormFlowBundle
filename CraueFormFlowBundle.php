<?php

namespace Craue\FormFlowBundle;

use Craue\FormFlowBundle\DependencyInjection\Compiler\AddFormFlowsPass;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * @author Christian Raue <christian.raue@gmail.com>
 * @copyright 2011-2013 Christian Raue
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class CraueFormFlowBundle extends Bundle {

	public function build(ContainerBuilder $container) {
		parent::build($container);

		$container->addCompilerPass(new AddFormFlowsPass());
	}
}
