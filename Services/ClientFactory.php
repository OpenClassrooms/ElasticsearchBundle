<?php

namespace OpenClassrooms\Bundle\ElasticsearchBundle\Services;

use Elasticsearch\Client;

/**
 * @author Romain Kuzniak <romain.kuzniak@turn-it-up.org>
 */
interface ClientFactory
{
    /**
     * @return Client
     */
    public function create(array $params);
} 
