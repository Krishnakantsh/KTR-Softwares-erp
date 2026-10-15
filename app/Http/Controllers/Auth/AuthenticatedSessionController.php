<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\Auth\LoginService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;


class AuthenticatedSessionController extends Controller
{
    public function __construct(
        protected LoginService $loginService
    ) {}

    public function create(): View
    {
        return view('School.Authentication.login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        return $this->loginService->login($request);
    }

    public function destroy(Request $request): RedirectResponse
    {
        return $this->loginService->logout($request);
    }
}
