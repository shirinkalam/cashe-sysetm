<?php

namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->randomElement([
                'موبایل سامسونگ',
                'موبایل اپل',
                'موبایل شیائومی',
                'موبایل هواوی',
                'لپ تاپ اپل',
                'لپ تاپ ایسوس',
                'لپ تاپ لنوو',
                'لپ تاپ سامسونگ',
                'ساعت مچی',
                'ساعت مچی',
                'ساعت کلاسیک',
                'اپل واچ',
                'ساعت ضد آب',
            ]),

            'description' => 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک استها و متون بلکه ',

            'image' => asset('img/apple-watch.jpg'),

            'price'=>$this->faker->randomElement([
                150000,350000,45000,75000,60000,20000,256000,4000000,350000,333333
            ]),
            'stock'=>$this->faker->randomDigitNotNull()
        ];
    }
}
