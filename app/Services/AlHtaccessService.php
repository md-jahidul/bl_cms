<?php

/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:23
 */

namespace App\Services;

use App\Repositories\AlHtaccessRepository;
use App\Repositories\AlRobotsRepository;
use App\Repositories\AmarOfferRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AlHtaccessService
{
    use CrudTrait;
    use FileTrait;

    /**
     * @var AlHtaccessRepository
     */
    private $alHtaccessRepository;

    /**
     * AlHtaccessRepository constructor.
     * @param AlHtaccessRepository $alHtaccessRepository
     */
    public function __construct(AlHtaccessRepository $alHtaccessRepository)
    {
        $this->alHtaccessRepository = $alHtaccessRepository;
        $this->setActionRepository($alHtaccessRepository);
    }

    public function getHtaccess()
    {
        return $this->alHtaccessRepository->htaccessData();
    }

    /**
     * Updating the banner
     * @param $data
     * @return Response
     */
    public function updateHtaccess($data)
    {
        request()->validate([
            'data' => 'required'
        ]);

        $coreContent = "";
        $coreContent .= "<Files 'apple-app-site-association'>ForceType 'application/json'</Files>
<IfModule mod_rewrite.c>
RewriteEngine On
RewriteBase /
RewriteRule ^index\.html$ - [L]
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-l
RewriteRule . /index.html [L]

# ensure www.
#RewriteCond %{HTTP_HOST} !^www\. [NC]
#RewriteRule ^ https://www.%{HTTP_HOST}%{REQUEST_URI} [L,R=301]

# ensure https
#RewriteCond %{HTTP:X-Forwarded-Proto} !https
#RewriteCond %{HTTPS} off
#RewriteRule ^ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]

</IfModule>

";

        $coreContent .= $data['data'];


        $this->deleteFile('assetlite/server-files/name.htaccess');
        $this->makeFile('assetlite/server-files/name.htaccess', $coreContent);
        $this->rename('assetlite/server-files/name.htaccess', '', 'assetlite/server-files/');

        $htaccess = $this->alHtaccessRepository->htaccessData();
        if ($htaccess) {
            $data['updated_by'] = Auth::id();
            $htaccess->update($data);
        } else {
            $data['created_by'] = Auth::id();
            $this->save($data);
        }

        return Response('Robots txt has been successfully updated');
    }
}
