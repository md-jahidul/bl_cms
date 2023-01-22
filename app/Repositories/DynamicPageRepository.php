<?php

namespace App\Repositories;

use App\Models\OtherDynamicPage;
use Illuminate\Support\Facades\Auth;

class DynamicPageRepository extends BaseRepository {

    public $modelName = OtherDynamicPage::class;
}
