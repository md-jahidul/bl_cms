<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 27-Aug-19
 * Time: 3:56 PM
 */

namespace App\Services;

use App\Repositories\AboutPageRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;


use Kreait\Firebase;
use Kreait\Firebase\DynamicLink\CreateDynamicLink;
use Kreait\Firebase\DynamicLink\CreateDynamicLink\FailedToCreateDynamicLink;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Database;
use Kreait\Firebase\ServiceAccount;

use Kreait\Firebase\DynamicLink\GetStatisticsForDynamicLink\FailedToGetStatisticsForDynamicLink;


use Kreait\Firebase\DynamicLink;
use Exception;
use Kreait\Firebase\Exception\Auth\EmailExists as FirebaseEmailExists;

class FirebaseService
{

    private $firebaseDatabase;
    /**
     * @var Factory
     */
    private $factory;

    /**
     * AboutPageService constructor.
     */
    public function __construct(Factory $factory)
    {
//        dd(config('services.firebase'));
        $this->factory = $factory;

        $serviceAccount = ServiceAccount::fromArray([
            "type" => "service_account",
            "project_id" => config('services.firebase.project_id'),
            "private_key_id" => config('services.firebase.private_key_id'),
            "private_key" => config('services.firebase.private_key'),
            "client_email" => config('services.firebase.client_email'),
            "client_id" => config('services.firebase.client_id'),
            "auth_uri" => "https://accounts.google.com/o/oauth2/auth",
            "token_uri" => "https://oauth2.googleapis.com/token",
            "auth_provider_x509_cert_url" => "https://www.googleapis.com/oauth2/v1/certs",
            "client_x509_cert_url" => config('services.firebase.client_x509_cert_url')
        ]);



        $this->firebaseDatabase = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->withDatabaseUri(config('services.firebase.database_url'))
            ->createDatabase();
    }

    public function testData()
    {

        $path = base_path('test-analytic-bl-firebase-admin.json');

        $factory = (new Factory)->withServiceAccount($path);

        $dynamicLinksDomain = 'https://pgf25.app.goo.gl/';
//        $dynamicLinks = $this->factory->createDynamicLinksService($dynamicLinksDomain);
        $dynamicLinks = $factory->createDynamicLinksService($dynamicLinksDomain);


        dd($dynamicLinks->getStatistics('https://pgf25.app.goo.gl/BalanceTransfer'));
        $stats = $dynamicLinks->getStatistics('https://mybl.digital/KtQEKzh8B6imuqQ98', 7);

        dd($stats->eventStatistics()->clicks());

        $url = 'https://www.example.com/some/path';

//        $link = $dynamicLinks->createUnguessableLink($url);
//        $link = $dynamicLinks->createDynamicLink($url, CreateDynamicLink::WITH_UNGUESSABLE_SUFFIX);

        $link = $dynamicLinks->createShortLink($url);
        $link = $dynamicLinks->createDynamicLink($url, CreateDynamicLink::WITH_SHORT_SUFFIX);

        dd($link);

        $dynamicLinks = FailedToCreateDynamicLink::class;
        try {
            $link = $dynamicLinks->createUnguessableLink($url);
            $link = $dynamicLinks->createDynamicLink($url, CreateDynamicLink::WITH_UNGUESSABLE_SUFFIX);

            $link = $dynamicLinks->createShortLink($url);
            $link = $dynamicLinks->createDynamicLink($url, CreateDynamicLink::WITH_SHORT_SUFFIX);
            dd($link);
        } catch (FailedToCreateDynamicLink $e) {
            echo $e->getMessage(); exit;
        }


//        $reference = $this->firebaseDatabase->getReference('contact');
//        $dynamicLinksDomain = 'https://example.page.link';
//       $data = $this->factory->createDynamicLinksService($dynamicLinksDomain);
//        dd($data);
    }
}
