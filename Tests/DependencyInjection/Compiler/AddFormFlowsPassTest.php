<?php

namespace Craue\FormFlowBundle\Tests\DependencyInjection\Compiler;

use Craue\FormFlowBundle\DependencyInjection\Compiler\AddFormFlowsPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

/**
 * @group unit
 *
 * @author Toni Uebernickel <tuebernickel@gmail.com>
 * @copyright 2011-2013 Christian Raue
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class AddFormFlowsPassTest extends \PHPUnit_Framework_TestCase {

	public function testWithProvider() {
		$registryService = new Definition();
		$registryService->setClass('Craue\FormFlowBundle\Form\Registry');

		$flow = $this->getMock('Craue\FormFlowBundle\Form\FormFlowInterface');
		$flowService = new Definition();
		$flowService->setClass(get_class($flow));
		$flowService->addTag('craue.form.flow');

		$builder = new ContainerBuilder();
		$builder->addDefinitions(array(
			'craue.form.flow.registry' => $registryService,
			'acme.flow' => $flowService,
		));

		$builder->addCompilerPass(new AddFormFlowsPass());
		$builder->compile();

		$this->assertNotEmpty($builder->getServiceIds(),
			'The services have been injected.');
		$this->assertNotEmpty($builder->get('craue.form.flow.registry'),
			'The registry service has been injected.');
		$this->assertNotEmpty($builder->get('acme.flow'),
			'The flow service injected.');

		/*
		 * Schema:
		 *
		 * [0] The list of methods.
		 *   [0] The name of the method to call.
		 *   [1] The arguments to pass into the method call.
		 *	 [0] First argument to pass into the method call.
		 *	 ...
		 */
		$registryMethodCalls = $builder->getDefinition('craue.form.flow.registry')->getMethodCalls();
		$this->assertNotEmpty($registryMethodCalls,
			'The registry got method calls added.');
		$this->assertEquals('addFlow', $registryMethodCalls[0][0],
			'The registry got a flow added.');
		$this->assertEquals('acme.flow', $registryMethodCalls[0][1][0],
			'The registry got the correct flow added.');
	}

	protected function getBuilder()
	{
		$builder = $this->getMock('Symfony\Component\DependencyInjection\ContainerBuilder');

		return $builder;
	}
}
