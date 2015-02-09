ElasticsearchBundle
===================
[![Build Status](https://travis-ci.org/OpenClassrooms/ElasticsearchBundle.svg?branch=master)](https://travis-ci.org/OpenClassrooms/ElasticsearchBundle)
[![Coverage Status](https://img.shields.io/coveralls/OpenClassrooms/ElasticsearchBundle.svg)](https://coveralls.io/r/OpenClassrooms/ElasticsearchBundle?branch=master)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/dd489bfe-98bf-484f-816f-830fe7319780/mini.png)](https://insight.sensiolabs.com/projects/dd489bfe-98bf-484f-816f-830fe7319780)

Symfony2 Bundle that expose Elasticsearch official client configuration

## Installation
This bundle can be installed using composer:

```composer require openclassrooms/use-case-bundle```
or by adding the package to the composer.json file directly.

```json
{
    "require": {
        "openclassrooms/elasticsearch-bundle": "*"
    }
}
```

After the package has been installed, add the bundle to the AppKernel.php file:

```php
// in AppKernel::registerBundles()
    $bundles = array(
        // ...
        new OpenClassrooms\Bundle\ElasticsearchBundle\OpenClassroomsElasticsearchBundle(),
        // ...
);
```

## Configuration
Add the elasticsearch hosts to the config.yml

``` yml
open_classrooms_elasticsearch:
    clients:
        client_name:
            hosts :
                - host
                - 127.0.0.1
        second_client_name:
            hosts :
                - second-host

```
