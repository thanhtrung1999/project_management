<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\Account;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function getViewLogin($role)
    {
        if (in_array($role, Account::INVALID_ROLE)) {
            return view('auth.login', [
                'role' => $role
            ]);
        }
        return view('errors.404');
    }

    public function executeLogin($role, LoginRequest $request)
    {
        $response = $this->authService->executeLogin($role, $request->validated());
        if ($response['status']) {
            return redirect($response['data']['route'])->with('success', $response['message']);
        }
        return redirect("{$role}/login")->withInput()->with('error', $response['message']);
    }

    public function logout(Request $request)
    {
        $role = getLoginRole();
        if (Auth::guard('accounts')->check()) {
            Auth::guard('accounts')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }
        return redirect("{$role}/login")->with('success', 'Đăng xuất thành công');
    }
}
