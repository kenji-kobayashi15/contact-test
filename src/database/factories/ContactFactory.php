<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name'     => $this->faker->firstName(),
            'last_name'      => $this->faker->lastName(),
            'gender'         => $this->faker->randomElement(['男性', '女性', 'その他']),
            'email'          => $this->faker->safeEmail(),
            'tel1'           => $this->faker->numerify('###'),    // 3桁
            'tel2'           => $this->faker->numerify('####'),   // 4桁
            'tel3'           => $this->faker->numerify('####'),   // 4桁
            'address1'       => $this->faker->address(),
            'address2'       => $this->faker->secondaryAddress(), // 建物名
            'select_content' => $this->faker->randomElement(['商品のお届けについて', '商品の交換について', '商品トラブル', 'ショップへのお問い合わせ', 'その他']),
            'content'        => $this->faker->realText(120),      // 120文字以内
        ];
    }
}
