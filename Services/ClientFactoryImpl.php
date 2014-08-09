<?php

namespace OpenClassrooms\Bundle\ElasticsearchBundle\Services;

use Elasticsearch\Client;

/**
 * @author Romain Kuzniak <romain.kuzniak@turn-it-up.org>
 */
class ClientFactoryImpl implements ClientFactory
{
    /**
     * @return Client
     */
    public function create(array $params)
    {
        return new Client($params);
    }
}
