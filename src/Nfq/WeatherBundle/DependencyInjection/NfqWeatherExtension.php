<?php

namespace Nfq\WeatherBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * @link http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class NfqWeatherExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $provider = $config['provider'];
        $delegatingProviderApiKey = array();
        $delegatingProviderClass = array();
        $cachedProvider = $config['providers'][$provider]['provider'];
        $delegatingProviders = $config['providers'][$cachedProvider]['providers'];
        $container->setAlias('nfq_weather', 'nfq_weather.provider.'.$cachedProvider);

        foreach ($delegatingProviders as $providerName)
        {
            $delegatingProviderClass[] = "Nfq\\WeatherBundle\Provider\\" . $providerName . "Provider";
            $delegatingProviderApiKey[$providerName] = $config['providers']
                                            [strtolower($providerName)]
                                            ['api_key'];
        }

        $container->setParameter('nfq_weather.providers', $delegatingProviderClass);
        $container->setParameter('nfq_weather.api_key', $delegatingProviderApiKey);
    }
}
