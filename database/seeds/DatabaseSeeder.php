<?php



use App\Models\Quiz;
use App\Models\User;
use App\Models\Choice;
use App\Models\Module;

use App\Models\Question;
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
        
        DB::table('choices')->delete();
        DB::table('questions')->delete();
        DB::table('quizzes')->delete();
        DB::table('users')->delete();
        DB::table('modules')->delete();
        DB::table('user_quiz')->delete();

        factory(User::class, rand(1,5))->create()->each(function($user) {
            $user->modules()->saveMany(factory(Module::class, rand(1,2))->make())
              ->each(function ($module) {
                $module->quizzes()->saveMany(factory(Quiz::class, rand(1,3))->make())
                ->each(function($quiz){ 
                $quiz->questions()->saveMany(factory(Question::class, rand(1,5))->make())
                    ->each(function($question){ 
                        $question->choices()->saveMany(factory(Choice::class, rand(1,4))->make());
                });
             });
              });
        });  


        $users = DB::table('users')->get();
        $quizzes = DB::table('quizzes')->get();

        for ($i=0; $i <rand(0,10) ; $i++) { 
            $user_id = $users->random(1)[0]->id;
            $quiz_id = $quizzes->random(1)[0]->id;
            DB::table('user_quiz')->insert([
                'user_id' => $user_id,
                'quiz_id' => $quiz_id,
                'score' => rand(0,100),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }


        foreach(Question::all() as $question){
            $choice = $question->choices->random();
            $question->right_choice_id = $choice->id;
            $question->save();
        }

        // factory(App\Module::class, 5)->create();
        // factory(App\Quiz::class, 5)->create();
                
        
    }
}
