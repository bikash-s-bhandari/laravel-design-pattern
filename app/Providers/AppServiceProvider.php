<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Book;
use App\Services\Kindle;
use App\Adapters\KindleAdapter;
use App\Contracts\BookInterface;
use App\Contracts\PaymentInterface;
use App\Adapters\EsewaAdapter;
use App\Services\EsewaService;
use App\Adapters\KhaltiAdapter;
use App\Services\KhaltiService;
use App\Services\Logger;
use App\Services\Strategy\LogToFile;
use App\Services\Strategy\LogToDatabase;
use App\Services\Strategy\LogToWebService;
use App\Contracts\LoggerInterface;
use App\Contracts\EasyToMaintain\PaymentGatewayInterface;
use App\Services\EasyMaintain\EsewaGateway;
use App\Services\EasyMaintain\KhaltiGateway;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(BookInterface::class, function () {
            return new Book();
        });


        // $this->app->bind(BookInterface::class, function () {
        //     return new KindleAdapter(new Kindle());
        // });


        $this->app->bind(PaymentInterface::class, function () {
            return new EsewaService();
        });

        // 🟣 Khalti मा switch गर्न — यति मात्र बदल्नुस्!
        // $this->app->bind(PaymentInterface::class, function () {
        //     return new KhaltiAdapter(new KhaltiService());
        // });


        $this->app->bind(LoggerInterface::class, function () {
            return new LogToFile();

            // Database मा switch गर्न:
            // return new LogToDatabase();

            // Web Service मा switch गर्न:
            // return new LogToWebService();
        });

        $this->app->bind(PaymentGatewayInterface::class, function ($app) {
            $gateway = request()->input('gateway', config('payment.default', 'esewa'));

            return match (strtolower($gateway)) {
                'esewa'  => new EsewaGateway(),
                'khalti' => new KhaltiGateway(),
                // 'fonepay' => new FonepayGateway(),
                default  => throw new \Exception("Unsupported gateway: $gateway"),
            };
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
