<?php
namespace Pepijnolivier\Bittrex;

use Illuminate\Support\ServiceProvider;

class BittrexServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/bittrex.php' => base_path('config/bittrex.php'),
        ], 'config');
        
        $file = base_path('config/bittrex.php');

        if(!file_exists($file))
        {
            $file = __DIR__ . '/../config/bittrex.php';
        }

        config()
            ->set('bittrex', require realpath($file));
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('bittrex', function () {
            return new BittrexManager;
        });
    }
}
