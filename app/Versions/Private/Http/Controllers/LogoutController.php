<?php

namespace App\Versions\Private\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

final class LogoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Отзывает текущий access-токен и связанные с ним refresh-токены.
     */
    public function __invoke(Request $request): Response
    {
        Auth::user()->token()->revoke();

        return response()->noContent();
    }
}
