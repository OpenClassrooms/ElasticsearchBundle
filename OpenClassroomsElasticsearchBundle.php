<?php
namespace OpenClassrooms\Bundle\ElasticsearchBundle;

use OpenClassrooms\Bundle\ElasticsearchBundle\DependencyInjection\Compiler\ClientPass;
use Symfony\Component\DependencyInjection\Compiler\PassConfig;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * @author Romain Kuzniak <romain.kuzniak@turn-it-up.org>
 */
class OpenClassroomsElasticsearchBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new ClientPass(), PassConfig::TYPE_BEFORE_REMOVING);
    }

}
