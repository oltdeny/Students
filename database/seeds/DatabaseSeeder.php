<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $subjects = factory(App\Models\Subject::class, 3)->create();
        $groups = factory(App\Models\Group::class, 5)->create();
        foreach ($groups as $group) {
            $students = factory(App\Models\Student::class, 10)
                ->create([
                    'group_id' => $group->id
                ]);
            foreach ($students as $student) {
                foreach ($subjects as $subject) {
                    factory(App\Models\Mark::class, 1)
                        ->create([
                            'group_id' => $group->id,
                            'student_id' => $student->id,
                            'subject_id' => $subject->id
                        ]);
                }
            }
        }
    }
}
