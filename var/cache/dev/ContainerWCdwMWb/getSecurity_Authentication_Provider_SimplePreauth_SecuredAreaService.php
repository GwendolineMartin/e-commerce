<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'security.authentication.provider.simple_preauth.secured_area' shared service.

include_once $this->targetDirs[3].'/vendor/symfony/security-core/User/UserCheckerInterface.php';
include_once $this->targetDirs[3].'/vendor/symfony/security-core/User/UserChecker.php';

@trigger_error('The "security.authentication.provider.simple_preauth.secured_area" service is deprecated since Symfony 4.2.', E_USER_DEPRECATED);

return $this->privates['security.authentication.provider.simple_preauth.secured_area'] = new \Symfony\Component\Security\Core\Authentication\Provider\SimpleAuthenticationProvider(($this->privates['jwt_auth.jwt_authenticator'] ?? $this->load('getJwtAuth_JwtAuthenticatorService.php')), ($this->privates['web_service_user_provider'] ?? $this->load('getWebServiceUserProviderService.php')), 'secured_area', new \Symfony\Component\Security\Core\User\UserChecker());
