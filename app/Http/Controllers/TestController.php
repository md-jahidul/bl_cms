<?php

namespace App\Http\Controllers;

use Box\Spout\Common\Type;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use Box\Spout\Reader\Common\Creator\ReaderFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\StreamedResponse;

class TestController extends Controller
{
    public function test()
    {
        $response = new StreamedResponse();
        $response->headers->set('Content-Type', 'text/event-stream');
        $response->headers->set('Cache-Control', 'no-cache');
        $arr = []; 
        $response->setCallback(
            function() {
                    echo "retry: 100\n\n"; // no retry would default to 3 seconds.
                    sleep(5);
                    $arr[] = 1;
                    echo "after 5 sec\n\n" . json_encode($arr) . "\n";
                    sleep(5);
                    $arr[] = 2;
                    echo "after 5 sec\n\n" . json_encode($arr) . "\n";
                    sleep(5);
                    $arr[] = 3;
                    echo "after 5 sec\n\n" . json_encode($arr) . "\n";
                    sleep(5);
                    $arr[] = 4;
                    echo "after 5 sec\n\n" . json_encode($arr) . "\n";
                    sleep(5);
                    $arr[] = 5;
                    echo "after 5 sec\n\n" . json_encode($arr) . "\n";
                    echo "data: Hello There\n\n";
                    // ob_flush();
                    // flush();
            });
        $response->send();
    }
}
