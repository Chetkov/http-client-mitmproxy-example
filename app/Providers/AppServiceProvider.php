<?php

namespace App\Providers;

use Chetkov\HttpClientMitmproxy\DefaultFactory;
use Chetkov\HttpClientMitmproxy\MITM\ProxyUID;
use GuzzleHttp\Client;
use Illuminate\Contracts\Container\Container;
use Illuminate\Support\ServiceProvider;
use Psr\Http\Client\ClientInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(ClientInterface::class, function (Container $container) {
            $client = new Client(['allow_redirects' => true]);

            if ($proxyUid = ProxyUID::detect()) {
                $config = require dirname(__DIR__, 2) . '/config/mitmproxy.config.php';
                $mitmproxyFactory = new DefaultFactory($config);

                $client = $mitmproxyFactory->createHttpClientDecorator($proxyUid, $client);
            }

            return $client;
        });
    }
}
