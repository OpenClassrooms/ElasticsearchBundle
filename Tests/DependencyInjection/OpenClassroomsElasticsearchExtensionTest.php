<?php

namespace OpenClassrooms\Bundle\ElasticsearchBundle\Tests\DependencyInjection;

use Elasticsearch\Client;
use OpenClassrooms\Bundle\ElasticsearchBundle\DependencyInjection\OpenClassroomsElasticsearchExtension;
use OpenClassrooms\Bundle\ElasticsearchBundle\OpenClassroomsElasticsearchBundle;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

/**
 * @author Romain Kuzniak <romain.kuzniak@turn-it-up.org>
 */
class OpenClassroomsElasticsearchExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ExtensionInterface
     */
    private $extension;

    /**
     * @var ContainerBuilder
     */
    private $container;

    /**
     * @var YamlFileLoader
     */
    private $configLoader;

    /**
     * @test
     * @expectedException \Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
     */
    public function NoConfiguration_ThrowException()
    {
        $this->configLoader->load('empty_config.yml');
        $this->container->compile();
    }

    /**
     * @test
     * @expectedException \Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
     */
    public function WithoutHostConfiguration_ThrowException()
    {
        $this->configLoader->load('without_host_config.yml');
        $this->container->compile();
    }

    /**
     * @test
     */
    public function OneHostConfiguration()
    {
        $this->configLoader->load('config.yml');
        $this->container->compile();
        /** @var Client $client */
        $client = $this->container->get('openclassrooms.elasticsearch.client.client_name');
        $expected = array(
            array('scheme' => 'http', 'host' => 'host-test', 'port' => '9200'),
            array('scheme' => 'http', 'host' => '127.0.0.1', 'port' => '9200')
        );
        $this->assertAttributeEquals($expected, 'seeds', $client->transport);
    }

    /**
     * @test
     */
    public function TwoHostsConfiguration()
    {
        $this->configLoader->load('two_hosts_config.yml');
        $this->container->compile();
        /** @var Client $client */
        $client = $this->container->get('openclassrooms.elasticsearch.client.client_name');
        $expected = array(
            array('scheme' => 'http', 'host' => 'host-test', 'port' => '9200'),
            array('scheme' => 'http', 'host' => '127.0.0.1', 'port' => '9200')
        );
        $this->assertAttributeEquals($expected, 'seeds', $client->transport);

        $client = $this->container->get('openclassrooms.elasticsearch.client.second_client_name');
        $expected = array(
            array('scheme' => 'http', 'host' => 'second-host-test', 'port' => '9200'),
        );
        $this->assertAttributeEquals($expected, 'seeds', $client->transport);
    }

    protected function setUp()
    {
        $this->container = new ContainerBuilder();
        $this->extension = new OpenClassroomsElasticsearchExtension();
        $this->container->registerExtension($this->extension);
        $this->container->loadFromExtension('open_classrooms_elasticsearch');
        $this->configLoader = new YamlFileLoader($this->container, new FileLocator(__DIR__ . '/Fixtures/Resources/config'));
//        $this->serviceLoader = new XmlFileLoader($this->container, new FileLocator(__DIR__ . '/Fixtures/Resources/config'));
//        $this->serviceLoader->load('services.xml');

        $bundle = new OpenClassroomsElasticsearchBundle();
        $bundle->build($this->container);
    }

}
