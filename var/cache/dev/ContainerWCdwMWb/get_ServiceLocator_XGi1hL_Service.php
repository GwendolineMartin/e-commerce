<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private '.service_locator.xGi1hL.' shared service.

return $this->privates['.service_locator.xGi1hL.'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($this->getService, [
    'brand' => ['privates', '.errored..service_locator.xGi1hL..App\\Entity\\Brand', NULL, 'Cannot autowire service ".service_locator.xGi1hL.": it references class "App\\Entity\\Brand" but no such service exists.'],
], [
    'brand' => 'App\\Entity\\Brand',
]);
