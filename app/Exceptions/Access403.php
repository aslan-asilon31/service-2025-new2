<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Access403 extends Exception
{
    /**
     * Report the exception.
     */
    public function report(): void
    {
        //
    }

    /**
     * Render the exception as an HTTP response.
     */
    public function render(Request $request, Throwable $e): Response
    {
        if ($e instanceof \Illuminate\Auth\Access\AuthorizationException) {
            return response()->view('components.errors.missing-permission', [], 403);
        }

        return parent::render($request, $e);
    }
}
