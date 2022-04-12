<?php namespace Logingrupa\Studybook\Updates;

use Faker\Factory;
use Faker\Provider\lv_LV\PhoneNumber;
use Logingrupa\Studybook\Models\AvailableDate;
use Logingrupa\Studybook\Models\Category;
use Logingrupa\Studybook\Models\Course;
use Logingrupa\Studybook\Models\Reservation;
use Logingrupa\Studybook\Models\Transaction;
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
        DB::table('logingrupa_studybook_availabledates')->delete();
        DB::table('logingrupa_studybook_course_dates')->delete();
        DB::table('logingrupa_studybook_additional_categories')->delete();
        DB::table('logingrupa_studybook_categories')->delete();
        DB::table('logingrupa_studybook_transactions')->delete();
        $name = ['Baiba Zariņa', 'Zane Zeltiņa', 'Ieva Razgalae', 'Vera Liole', 'Roberts Zeltiņš', 'Normunds Zeltiņš', 'Toms Muižnieks', 'Zigurds Mežš', 'Lauma Rudze', 'Aiga Zara', 'Artis Ābols', 'Gunārs Bumbiers', 'Raitis Raiders', 'Gunita Preile', 'Laila Briede'];
        $faker = Factory::create('lv_LV');
        $faker->addProvider(new PhoneNumber($faker));
        foreach ($name as $key => $value) {
            $pieces = explode(" ", $value);
            User::create(array(
                'name' => $pieces[0],
                'surname' => $pieces[1],
                'email' => str_slug($value, '.').'@gmail.com',
                'is_activated' => 1,
                'phone' => $faker->e164PhoneNumber,
                'password' => '123123123',
                'password_confirmation' => '123123123',
            ));
        }//END

        $categories = [
            'Apmācības klātiene' => ['parent_id' => null],
            'Manikīra kursi bez priekšzināšanām' => ['parent_id' => 1],
            'Manikīra kursu programmas ar priekšzināšanām' => ['parent_id' => 1],
            'Vaksācijas kursi' => ['parent_id' => 1],
            'Skropstu pieaudzēšana kursi' => ['parent_id' => 1],
            'Nagu Dizaina kursi un apmācības' => ['parent_id' => 1],
            'Manikīra meistaru kvalifikācijas celšanas kursi' => ['parent_id' => 1],
            'Online manikīra kursi' => ['parent_id' => null],
            'Nagu kopšanas speciālists' => ['parent_id' => 8],
            'Kvalifikācijas celšanas kursi' => ['parent_id' => 8],
            'Gēla nagu dizaina kursi' => ['parent_id' => 8],
        ];
        foreach ($categories as $key => $category) {
            Category::create([
                'active' => '1',
                'name' => $key,
                'slug' => uniqid(str_slug($key, '-'),false),
                'description' => $key,
                'parent_id' => $category['parent_id'],
            ]);
        }//END

        $datetime = array(
            Carbon::create(null, null, 01, 10, 00, 00),
            Carbon::create(null, null, 05, 10, 00, 00),
            Carbon::create(null, null, 10, 10, 00, 00),
            Carbon::create(null, null, 15, 10, 00, 00),
            Carbon::create(null, null, 20, 10, 00, 00),
            Carbon::create(null, null, 25, 10, 00, 00),
            Carbon::create(null, null, 02, 10, 00, 00),
            Carbon::create(null, null, 06, 11, 00, 00),
            Carbon::create(null, null, 11, 12, 00, 00),
            Carbon::create(null, null, 16, 13, 00, 00),
            Carbon::create(null, null, 21, 14, 00, 00),
            Carbon::create(null, null, 26, 15, 00, 00),
            Carbon::create(null, null, 31, 11, 00, 00),
        );
        foreach ($datetime as $key => $value) {
            AvailableDate::create([
                'active' => '1',
                'datetime' => $value,
                'available_seats' => $key+2*2,
                'reserved_seats' => '0',
            ]);
        }//END

        $name = ['Gēla nagu modelēšanas kursi', 'Apvienotā manikīra un gēla programma', 'Jaunās paaudzes aparāta manikīrs'];
        foreach ($name as $key => $value) {
            $availableDate = AvailableDate::inRandomOrder()->first();
            $course =  Course::create([
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
            $course->availabledates()->attach($availableDate->id);
        }//END

        $name = ['Pedikīra tehnoloģijas', 'Vaksācijas kursi', 'Zīda skropstu pieaudzēšanas kursi'];
        foreach ($name as $key => $value) {
            $availableDate = AvailableDate::inRandomOrder()->first();
            $course =  Course::create([
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
            $course->availabledates()->attach($availableDate->id);
        }//END

        $availableDates = AvailableDate::all();
        foreach ($availableDates as $availableDate) {
            $course = Course::inRandomOrder()->first();
            $availableDate->courses()->syncWithoutDetaching($course->id);
        }//END

        $students = User::all();
        foreach ($students as $student) {
            $course = Course::inRandomOrder()->first();
            $availableDate = AvailableDate::inRandomOrder()->first();
            $reserv = Reservation::create([
                'status' => 'ongoing',
                'name' => $course->name,
                'course_id' => $course->id,
                'active' => 1,
                'start_at' => $course->availabledates->random()->datetime,
                'full_name' => $student->name . " " . $student->surname,
                'student_id' => $student->id,
                'attendance' => rand(0, 1),
                'health' => rand(0, 1),
                'phone' => $student->phone,
                'email' => $student->email,
                'model_status' => 1,
                'slug' => uniqid(str_slug($course->name, '-'),true),
                'price' => $course->price,
                'old_price' => $course->old_price,
                'code' => $course->price*999+1,
                'external_id' => $course->price*123999+1,
                'preview_text' => $course->preview_text,
                'description' => $course->description,
            ]);
            $transaction1 = Transaction::create([
                'active' => true,
                'type' => array_random(['cache','bank']),
                'reservation_id' => $reserv->id,
                'slug' => uniqid(false),
                'student_id' => $reserv->student_id,
                'credit' => $reserv->price,
                'debit' => null,
                'note' => 'Pieteikums kursiem ' . $reserv->name . ' no ' . $reserv->full_name,
                'transaction_at' => Carbon::now()->add(1, 'day'),
                'parent_id' => null,
            ]);
            $transaction2 = Transaction::create([
                'active' => array_random([1, 0]),
                'type' => array_random(['cache','bank']),
                'reservation_id' => $reserv->id,
                'slug' => uniqid(false),
                'student_id' => $reserv->student_id,
                'credit' => null,
                'debit' => 5000,
                'note' => 'Priekšapmaksas rēķins',
                'transaction_at' => Carbon::now()->add(2, 'day'),
                'parent_id' => $transaction1->id,
            ]);
            $transaction3 = Transaction::create([
                'active' => true,
                'type' => array_random(['cache','bank']),
                'reservation_id' => $reserv->id,
                'slug' => uniqid(false),
                'student_id' => $reserv->student_id,
                'credit' => null,
                'debit' => $reserv->price / 5 / 1,
                'note' => 'Apmaksa saņamta no ' . $reserv->full_name . ' par ' . $reserv->name,
                'transaction_at' => Carbon::now()->add(3, 'day'),
                'parent_id' => $transaction1->id,
            ]);
            $transaction4 = Transaction::create([
                'active' => array_random([1, 0]),
                'type' => array_random(['cache','bank']),
                'reservation_id' => $reserv->id,
                'slug' => uniqid(false),
                'student_id' => $reserv->student_id,
                'credit' => null,
                'debit' => $reserv->price / 3,
                'note' => 'Nav apmaksāts',
                'transaction_at' => Carbon::now()->add(5, 'day'),
                'parent_id' => $transaction1->id,
            ]);
        }//END

        $students = User::all();
        foreach ($students as $student) {
            $availableDate = AvailableDate::inRandomOrder()->first();
            $course = Course::inRandomOrder()->first();
            Reservation::create([
                'status' => 'ongoing',
                'name' => $course->name,
                'course_id' => $course->id,
                'active' => 1,
                'start_at' => $course->availabledates->random()->datetime,
                'full_name' => $student->name . " " . $student->surname,
                'student_id' => $student->id,
                'attendance' => rand(0, 1),
                'health' => rand(0, 1),
                'phone' => $student->phone,
                'email' => $student->email,
                'model_status' => 1,
                'slug' => uniqid(str_slug($course->name, '-'),true),
                'price' => $course->price,
                'old_price' => $course->old_price,
                'code' => $course->price*999+1,
                'external_id' => $course->price*123999+1,
                'preview_text' => $course->preview_text,
                'description' => $course->description,
            ]);
        }//END

        $students = User::all();
        foreach ($students as $student) {
            $availableDate = AvailableDate::inRandomOrder()->first();
            $course = Course::inRandomOrder()->first();
            Reservation::create([
                'status' => 'ongoing',
                'name' => $course->name,
                'course_id' => $course->id,
                'active' => 1,
                'start_at' => $course->availabledates->random()->datetime,
                'full_name' => $student->name . " " . $student->surname,
                'student_id' => $student->id,
                'attendance' => rand(0, 1),
                'health' => rand(0, 1),
                'phone' => $student->phone,
                'email' => $student->email,
                'model_status' => 1,
                'slug' => uniqid(true),
                'price' => $course->price,
                'old_price' => $course->old_price,
                'code' => $course->price*999+1,
                'external_id' => $course->price*123999+1,
                'preview_text' => $course->preview_text,
                'description' => $course->description,
            ]);
        }//END

    }
}
