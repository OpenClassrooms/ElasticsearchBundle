<?php

namespace OpenClassrooms\Bundle\ElasticsearchBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

/**
 * @author Romain Kuzniak <romain.kuzniak@turn-it-up.org>
 */
class ClientPass implements CompilerPassInterface
{
    /**
     * You can modify the container here before it is dumped to PHP code.
     *
     * @param ContainerBuilder $container
     *
     * @api
     */
    public function process(ContainerBuilder $container)
    {
        $clients_parameters = $container->getParameter('openclassrooms.elasticsearch.clients_parameters');
        foreach ($clients_parameters as $clientName => $parameters) {
            $clientServiceId = 'openclassrooms.elasticsearch.client.' . $clientName;

            $factoryDefinition = new Definition('\Elasticsearch\Client');
            $factoryDefinition->setFactoryService('openclassrooms.elasticsearch.client_factory');
            $factoryDefinition->setFactoryMethod('create');
            $factoryDefinition->setArguments(array($parameters));
            $container->setDefinition($clientServiceId, $factoryDefinition);
        }
    }
}
