<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'student_code' => Str::random(8),
            'gender' => Arr::random(['0', '1']),
            'date_of_birth' => $this->faker->date('Y-m-d', '2001-12-31'),
            'class' => Str::random(5),
            'specialized_training' => Arr::random(['AT', 'CT', 'DT']),
            'address' => $this->faker->address(),
        ];
    }
}
