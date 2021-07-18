<?php

namespace App\Services;

use App\Models\Account;
use App\Models\Admin;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthService extends BaseService
{
    public function executeLogin($role, array $data)
    {
        $accountType = $this->getAccountTypeByRole($role);
        $credentials = $this->credentials($data, $accountType);
        $isLogin = Auth::guard('accounts')->attempt($credentials);
        if ($isLogin) {
            return $this->sendResponse('Đăng nhập thành công', [
                'route' => $role
            ]);
        }
        return $this->sendError('Đăng nhập thất bại', Response::HTTP_BAD_REQUEST);
    }

    private function getAccountTypeByRole($role)
    {
        switch ($role) {
            case Account::ADMIN_ROLE:
                return Admin::class;
                break;
            case Account::STUDENT_ROLE:
                return Student::class;
                break;
            case Account::TEACHER_ROLE:
                return Teacher::class;
                break;
        }
    }

    private function credentials($data, $accountType)
    {
        return [
            'email' => $data['email'],
            'password' => $data['password'],
            'accountable_type' => $accountType
        ];
    }
}
