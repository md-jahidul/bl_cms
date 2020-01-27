<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param \Exception $exception
     * @return void
     * @throws Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param Request $request
     * @param \Exception $exception
     * @return Response
     */
    public function render($request, Exception $exception)
    {	
	if ($exception instanceof \Illuminate\Http\Exceptions\PostTooLargeException) {
		return redirect()->back()->with('error', 'File size too large!');
        }

        if (!App::environment('local')) {
            // The environment is not local
            if ($this->isHttpException($exception)) {
                if (!view()->exists('errors.' . $exception->getStatusCode())) {
                    return response()->view('errors.general');
                }
            }
        }

        return parent::render($request, $exception);
    }
}
