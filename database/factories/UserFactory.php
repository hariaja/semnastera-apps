<?php

namespace Database\Factories;

use App\Helpers\Auto\Name;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    $first_name = fake()->unique()->firstName('male' | 'female');
    $last_name = fake()->lastName();

    $object = new Name;
    $name = $first_name . " " .  $last_name;
    $email = strtolower($object->firstName($name)) . "@gmail.com";

    return [
      'unique_id' => Str::random(20),
      'first_name' => $first_name,
      'last_name' => $last_name,
      'first_title' => fake()->title('male' | 'female') . ' ',
      'last_title' => 'AMD',
      'email' => $email,
      'phone' => fake()->unique()->e164PhoneNumber(),
      'gender' => fake()->randomElement(['Laki - Laki', 'Perempuan']),
      'institution' => 'POLITEKNIK SUKABUMI',
      'address' => $this->faker->address(),
      'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
      'remember_token' => Str::random(10),
      'status' => fake()->randomElement(['1', '0'])
    ];
  }

  /**
   * Indicate that the model's email address should be unverified.
   */
  public function unverified(): static
  {
    return $this->state(fn (array $attributes) => [
      'email_verified_at' => null,
    ]);
  }
}
