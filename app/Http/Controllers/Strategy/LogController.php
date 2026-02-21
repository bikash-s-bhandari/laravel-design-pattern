<?php

namespace App\Http\Controllers\Strategy;

use App\Http\Controllers\Controller;
use App\Contracts\LoggerInterface;
use Illuminate\Http\Request;
use App\Services\Strategy\LogToDatabase;
use App\Services\Strategy\LogToWebService;
use App\Services\Strategy\LogToFile;
use App\Services\Logger;


class LogController extends Controller
{
    public function __construct(private LoggerInterface $logger) {}

    public function log()
    {
        $this->logger->log("Log Order #" . rand(100, 999));

        return response()->json([
            'status'  => 'success',
            'message' => 'Log is successful!',
        ]);
    }

    //runtime logger change
    public function storeWithCustomLogger(Request $request)
    {
        $request->validate([
            'product' => 'required|string',
            'logger'  => 'required|in:file,database,webservice',
        ]);

        // Request अनुसार Strategy छान्ने
        $logger = match($request->logger) {
            'database'   => new LogToDatabase(),
            'webservice' => new LogToWebService(),
            default      => new LogToFile(),
        };

        // Context मा inject गर्ने
        $app = new Logger($logger);
        $app->doSomething();

        $logger->log("Log Order #{$request->product}");

        return response()->json([
            'status'  => 'success',
            'message' => 'Order is stored with '.$request->logger.'!',
            'logger'  => $request->logger,
        ]);
    }
}
