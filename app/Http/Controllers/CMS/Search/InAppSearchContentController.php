<?php

namespace App\Http\Controllers\CMS\Search;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class InAppSearchContentController
 * @package App\Http\Controllers\CMS\Search
 */
class InAppSearchContentController extends Controller
{

    public function index()
    {
        return view('my-bl-search.partials');
    }
}
