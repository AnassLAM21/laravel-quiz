<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('answers')->delete();
        DB::table('questions')->delete();
        DB::table('quizzes')->delete();
        DB::table('users')->delete();
        DB::table('modules')->delete();
        DB::table('user_quiz')->delete();

        factory(App\User::class, 1)->create()->each(function($user) {
            $user->modules()->saveMany(factory(App\Module::class, 1)->make())
              ->each(function ($module) {
                $module->quizzes()->saveMany(factory(App\Quiz::class, 1)->make())
                ->each(function($quiz){ 
                $quiz->questions()->saveMany(factory(App\Question::class, 1)->make())
                    ->each(function($question){ 
                        $question->answers()->saveMany(factory(App\Answer::class, 1)->make());
                });
             });
              });
        });  


     


        // factory(App\Module::class, 5)->create();
        // factory(App\Quiz::class, 5)->create();
                
        
    }
}
