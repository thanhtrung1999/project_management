<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Admin;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        echo "RUNNING...\n";
        DB::table('accounts')->truncate();
        DB::table('admins')->truncate();
        DB::table('students')->truncate();
        DB::table('teachers')->truncate();
        // Admin::factory()->count(1)->create();
        // Student::factory()->count(20)->create();
        // Teacher::factory()->count(20)->create();
        Account::factory()->count(1)->for(
            Admin::factory(), 'accountable'
        )->create();
        Account::factory()->count(1)->for(
            Student::factory(), 'accountable'
        )->create();
        Account::factory()->count(1)->for(
            Teacher::factory(), 'accountable'
        )->create();
        echo "FINISH!\n";

        Schema::enableForeignKeyConstraints();
    }
}
