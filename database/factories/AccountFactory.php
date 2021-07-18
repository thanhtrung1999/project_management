<?php

namespace Database\Factories;

use App\Models\Account;
use App\Models\Admin;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class AccountFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Account::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $data = [
            'email' => $this->faker->safeEmail(),
            'phone_number' => $this->faker->phoneNumber(),
            'password' => Hash::make('123456'),
            'accountable_id' => '',
            'accountable_type' => ''
        ];

        // $accountTypeRand = Arr::random(Account::INVALID_ROLE);
        // switch ($accountTypeRand) {
        //     case Account::ADMIN_ROLE:
        //         $data['accountable_id'] = Admin::factory()->create()->id;
        //         $data['accountable_type'] = Admin::class;
        //         break;
        //     case Account::TEACHER_ROLE:
        //         $data['accountable_id'] = Teacher::factory()->create()->id;
        //         $data['accountable_type'] = Teacher::class;
        //         break;
        //     case Account::STUDENT_ROLE:
        //         $data['accountable_id'] = Student::factory()->create()->id;
        //         $data['accountable_type'] = Student::class;
        //         break;
        //     default:
        //         break;
        // }

        return $data;
    }
}
