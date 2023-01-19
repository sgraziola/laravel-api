<?php

namespace Database\Seeders;

use Faker\Generator as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 10; $i++) {
            $project = new Project();
            $project->title = $faker->sentence(5);
            $project->slug = STR::slug($project->title, '-');
            $project->thumb = 'placeholders/' . $faker->image('storage/app/public/placeholders', 600, 300, 'Project', false);
            $project->language = $faker->randomElement(['HTML', 'CSS', 'PHP', 'JS', 'C++']);
            $project->save();
        }
    }
}
