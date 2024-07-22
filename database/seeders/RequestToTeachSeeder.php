<?php

namespace Database\Seeders;

use App\Models\RequestToTeach;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class RequestToTeachSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'customer');
        })
            ->active()
            ->inRandomOrder()
            ->take(10)
            ->get();

        foreach ($users as $user) {
            RequestToTeach::create([
                'full_name' => ['en' => $faker->name, 'ar' => $faker->name,],
                'date_of_birth' => $faker->dateTimeBetween('-30 years', '-18 years'),
                'place_of_birth' => $faker->city,
                'nationality' => $faker->country,
                'residence_address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'educational_qualification' => $faker->word,
                'specialization' => $faker->word,
                'years_of_training_experience' => $faker->numberBetween(0, 10),
                'identity' => $faker->word,
                'biography' => 'biographies/' . $faker->uuid . '.pdf',
                'Certificates' => 'certificates/' . $faker->uuid . '.pdf',
                'motivation' => $faker->paragraph,
                'user_id' => $user->id,
                'status' => $faker->numberBetween(0, 1),
                'request_status' => $faker->numberBetween(0, 1),
                'published_on' => $faker->dateTimeBetween('-1 years', 'now'),
                'created_by' => $faker->name,
                'updated_by' => $faker->name,
                'deleted_by' => $faker->name,
            ]);
        }
    }
}
