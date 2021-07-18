<?php

namespace App\Repositories;

use App\Models\Account;

class AccountRepository extends BaseRepository
{
    public function model()
    {
        return Account::class;
    }
}
