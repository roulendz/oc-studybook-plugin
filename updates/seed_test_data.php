<?php namespace Logingrupa\Studybook\Updates;

use Logingrupa\Studybook\Models\Course;
use Logingrupa\Studybook\Models\Reservation;
use October\Rain\Database\Updates\Seeder;
use RainLab\User\Models\User;
use DB;
use Carbon\Carbon;
use Backend\Models\User as BackendUser;

class SeedTestData extends Seeder
{
    public function run()
    {

        DB::table('users')->delete();
        DB::table('logingrupa_studybook_courses')->delete();
        DB::table('logingrupa_studybook_reservations')->delete();
        $name = ['Baiba Zariņa', 'Zane Zeltiņa', 'Ieva Razgalae', 'Vera Liole', 'Roberts Zeltiņš', 'Normunds Zeltiņš', 'Toms Muižnieks', 'Zigurds Mežš', 'Lauma Rudze', 'Aiga Zara', 'Artis Ābols', 'Gunārs Bumbiers', 'Raitis Raiders', 'Gunita Preile', 'Laila Briede'];
        foreach ($name as $key => $value) {
            User::create([
                'name' => $value,
                'email' => str_slug($value, '.').'@gmail.com',
                'is_activated' => 1,
                'password' => '123123123',
                'password_confirmation' => '123123123',
            ]);
        }//END

        $name = ['Gēla nagu modelēšanas kursi', 'Apvienotā manikīra un gēla programma', 'Jaunās paaudzes aparāta manikīrs'];
        foreach ($name as $key => $value) {
            Course::create([
                'active' => 1,
                'name' => $value,
                'slug' => uniqid(str_slug($value, '-'),false),
                'code' => 1+423+$key*999,
                'external_id' => 1+3412+$key*123999,
                'preview_text' => $value,
                'description' => 'Description ' . $value . $value . $value  ,
                'view_count' => rand(0, 100),
                'price' => rand(50000, 70000),
                'old_price' => rand(70000, 80000),
                'available_seats' => 10,
                'duration_days' => 14,
                'student_count' => rand(1, 7),
                'settings' => ['practical_lesson_count'=>10, 'lesson_count'=>20],
            ]);
        }//END

        $name = ['Pedikīra tehnoloģijas', 'Vaksācijas kursi', 'Zīda skropstu pieaudzēšanas kursi'];
        foreach ($name as $key => $value) {
            Course::create([
                'active' => 1,
                'name' => $value,
                'slug' => uniqid(str_slug($value, '-'),false),
                'code' => 1+5123+$key*999+1,
                'external_id' => 1+3213+$key*123999+1,
                'preview_text' => $value,
                'description' => 'Description ' . $value . $value . $value  ,
                'view_count' => rand(0, 100),
                'price' => rand(50000, 70000),
                'old_price' => rand(70000, 80000),
                'available_seats' => 10,
                'duration_days' => 14,
                'student_count' => rand(1, 7),
                'settings' => ['practical_lesson_count'=>10, 'lesson_count'=>20],
            ]);
        }//END

        $students = User::all();
        foreach ($students as $student) {
            $course = Course::inRandomOrder()->first();
            Reservation::create([
                'status' => 'ongoing',
                'name' => $course->name,
                'course_id' => $course->id,
                'active' => 1,
                'start_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'full_name' => $student->name,
                'student_id' => $student->id,
                'attendance' => rand(0, 1),
                'health' => rand(0, 1),
                'mobile' => '+32727831183',
                'email' => $student->email,
                'model_status' => 1,
                'slug' => uniqid(str_slug($course->name, '-'),true),
                'price' => $course->price,
                'old_price' => $course->old_price,
                'code' => $course->price*999+1,
                'external_id' => $course->price*123999+1,
                'preview_text' => $course->preview_text,
                'description' => $course->description,
                'view_count' => rand(0, 100),
            ]);
        }//END

        $students = User::all();
        foreach ($students as $student) {
            $course = Course::inRandomOrder()->first();
            Reservation::create([
                'status' => 'ongoing',
                'name' => $course->name,
                'course_id' => $course->id,
                'active' => 1,
                'start_at' => Carbon::now()->add(2, 'day')->format('Y-m-d H:i:s'),
                'full_name' => $student->name,
                'student_id' => $student->id,
                'attendance' => rand(0, 1),
                'health' => rand(0, 1),
                'mobile' => '+32727831183',
                'email' => $student->email,
                'model_status' => 1,
                'slug' => uniqid(str_slug($course->name, '-'),true),
                'price' => $course->price,
                'old_price' => $course->old_price,
                'code' => $course->price*999+1,
                'external_id' => $course->price*123999+1,
                'preview_text' => $course->preview_text,
                'description' => $course->description,
                'view_count' => rand(0, 100),
            ]);
        }//END

        $students = User::all();
        foreach ($students as $student) {
            $course = Course::inRandomOrder()->first();
            Reservation::create([
                'status' => 'ongoing',
                'name' => $course->name,
                'course_id' => $course->id,
                'active' => 1,
                'start_at' => Carbon::now()->add(10, 'day')->format('Y-m-d H:i:s'),
                'full_name' => $student->name,
                'student_id' => $student->id,
                'attendance' => rand(0, 1),
                'health' => rand(0, 1),
                'mobile' => '+32727831183',
                'email' => $student->email,
                'model_status' => 1,
                'slug' => uniqid(str_slug($course->name, '-'),true),
                'price' => $course->price,
                'old_price' => $course->old_price,
                'code' => $course->price*999+1,
                'external_id' => $course->price*123999+1,
                'preview_text' => $course->preview_text,
                'description' => $course->description,
                'view_count' => rand(0, 100),
            ]);
        }//END

    }
}