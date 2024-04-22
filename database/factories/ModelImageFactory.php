<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Modele;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ModelImage>
 */
class ModelImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $urls = [
            'https://images.unsplash.com/photo-1655721528985-c491cc1a3d57?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=774&q=80',
            'https://images.unsplash.com/photo-1655720842809-0db94ab43f02?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80',
            'https://images.unsplash.com/photo-1655721532485-0fba33207593?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=774&q=80',
            'https://images.pexels.com/photos/8728388/pexels-photo-8728388.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
            'https://images.pexels.com/photos/8728386/pexels-photo-8728386.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
            'https://images.pexels.com/photos/8439007/pexels-photo-8439007.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
            'https://images.pexels.com/photos/5668887/pexels-photo-5668887.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
            'https://images.pexels.com/photos/8297030/pexels-photo-8297030.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
            'https://images.pexels.com/photos/7681088/pexels-photo-7681088.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'
        ];
        
        return [
            'url' => $this->faker->randomElement($urls),
            'isposter' => 0,
            'modele_id' => Modele::all()->random()->id
        ];
    }
}
