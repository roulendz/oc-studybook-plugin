<?php namespace Logingrupa\Studybook\Updates;

use Faker\Factory;
use Faker\Provider\lv_LV\PhoneNumber;
use Logingrupa\Studybook\Models\AvailableDate;
use Logingrupa\Studybook\Models\Category;
use Logingrupa\Studybook\Models\Company;
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
        DB::table('logingrupa_studybook_companies')->delete();
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
                'phone' => $faker->phoneNumber,
                'password' => '123123123',
                'password_confirmation' => '123123123',
            ));
        }//END

        $companies = [
            'Vīzija L' => [
                'active' => true,
                'description' => 'Vīzija L description',
            ],
            'Starptautiskā Manikīra studija' => [
                'active' => true,
                'description' => 'Starptautiskā Manikīra studija description',
            ],
            'Starptautiskā Skasituma skola' => [
                'active' => true,
                'description' => 'Starptautiskā Skasituma skola description',
            ]
        ];
        foreach ($companies as $key => $company) {
            Company::create([
                'active' => '1',
                'name' => $key,
                'slug' => uniqid(str_slug($key, '-'), false),
                'description' => $company['description'],
            ]);
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
        $courses = [
            0 => ['name' => 'Nagu kopšanas speciālists - Standart', 'category_id' => 2, 'price' => '365.00', 'old_price' => null, 'settings' => ['practical_lesson_count'=>16, 'lesson_count'=>18]],
            1 => ['name' => 'Nagu kopšanas speciālists - Proffesional', 'category_id' => 2, 'price' => '479.75', 'old_price' => null, 'settings' => ['practical_lesson_count'=>22, 'lesson_count'=>25]],
            2 =>  ['name' => 'Gēla nagu modelēsana - Proffesiona', 'category_id' => 2, 'price' => '446.50', 'old_price' => '470.00', 'settings' => ['practical_lesson_count'=>19, 'lesson_count'=>20]],
            3 =>  ['name' => 'Apvienotā programma (Manikīrs + Gēls)', 'category_id' => 2, 'price' => '612.75', 'old_price' => '645.00', 'settings' => ['practical_lesson_count'=>29, 'lesson_count'=>32]],
            4 =>  ['name' => 'Bāzes aparāta manikīra kurss bez priekšzināšanām (3 dienas)', 'category_id' => 2, 'price' => '736.25', 'old_price' => '775.00', 'settings' => ['practical_lesson_count'=>35, 'lesson_count'=>39]],
            5 =>  ['name' => 'Pedikīra speciālists', 'category_id' => 3, 'price' => '237.50', 'old_price' => '250.00', 'settings' => ['practical_lesson_count'=>6, 'lesson_count'=>7]],
            6 =>  ['name' => 'Gēla nagu modelēsana - Standart', 'category_id' => 3, 'price' => '389.50', 'old_price' => '410.00', 'settings' => ['practical_lesson_count'=>13, 'lesson_count'=>14]],
            7 =>  ['name' => 'Vaksācijas tehnoloģija', 'category_id' => 4, 'price' => '85.00', 'old_price' => '99.00', 'settings' => ['practical_lesson_count'=>3, 'lesson_count'=>4]],
            8 =>  ['name' => 'Cukura pastas vaksācija (sugar wax)', 'category_id' => 4, 'price' => '85.00', 'old_price' => '99.00', 'settings' => ['practical_lesson_count'=>3, 'lesson_count'=>4]],
            9 =>  ['name' => 'Klasiskā skropstu pieaudzēšana 1 dienas', 'category_id' => 5, 'price' => '85.00', 'old_price' => '99.00', 'settings' => ['practical_lesson_count'=>3, 'lesson_count'=>4]],
            10 =>  ['name' => 'Klasiskā skropstu pieaudzēšana 2 dienas', 'category_id' => 5, 'price' => '99.00', 'old_price' => '110.00', 'settings' => ['practical_lesson_count'=>3, 'lesson_count'=>4]],
            11 =>  ['name' => 'Apjoma skropstu pieaudzēšana (iegūts sertifikāta klasisikā skropstu pieaudzēšana)', 'category_id' => 5, 'price' => '99.00', 'old_price' => '110.00', 'settings' => ['practical_lesson_count'=>3, 'lesson_count'=>4]],
            12 =>  ['name' => 'Dizaina kurss “Aqurelle”', 'category_id' => 6, 'price' => '50.00', 'old_price' => '70.00', 'settings' => ['practical_lesson_count'=>5, 'lesson_count'=>5]],
            13 =>  ['name' => 'Dizaina kurss “Stamping” dizaina noslēpumi', 'category_id' => 6, 'price' => '50.00', 'old_price' => '70.00', 'settings' => ['practical_lesson_count'=>5, 'lesson_count'=>5]],
            14 =>  ['name' => 'Dizaina kurss “Winter mix”', 'category_id' => 6, 'price' => '90.00', 'old_price' => '100.00', 'settings' => ['practical_lesson_count'=>5, 'lesson_count'=>5]],
            15 =>  ['name' => 'Aerogrāfijas dizains uz nagiem ar AIRnails I līmenis (bez priekšzināšanām)', 'category_id' => 6, 'price' => '190.00', 'old_price' => '220.00', 'settings' => ['practical_lesson_count'=>5, 'lesson_count'=>5]],
            16 =>  ['name' => 'Aerogrāfijas dizains uz nagiem ar AIRnails II līmenis (ar priekšzināšanām)', 'category_id' => 6, 'price' => '190.00', 'old_price' => '220.00', 'settings' => ['practical_lesson_count'=>5, 'lesson_count'=>5]],
            17 =>  ['name' => 'Aparata manikīrs “kombis”  (iegūts sertifikāts nagu kopšanas speicālists)', 'category_id' => 7, 'price' => '190.00', 'old_price' => '220.00', 'settings' => ['practical_lesson_count'=>5, 'lesson_count'=>5]],
            18 =>  ['name' => 'Aparāta pedikīrs(iegūts sertifikāts pedikīra speicālists)', 'category_id' => 7, 'price' => '190.00', 'old_price' => '220.00', 'settings' => ['practical_lesson_count'=>5, 'lesson_count'=>5]],
            19 =>  ['name' => 'Gēla nagu pieaudzēšana ar duo gēl  (praktiski bez apvīlēšanas)', 'category_id' => 7, 'price' => '190.00', 'old_price' => '220.00', 'settings' => ['practical_lesson_count'=>5, 'lesson_count'=>5]],
            20 =>  ['name' => 'Japānas manikīrs - apmācības', 'category_id' => 7, 'price' => '190.00', 'old_price' => '220.00', 'settings' => ['practical_lesson_count'=>5, 'lesson_count'=>5]],
            21 =>  ['name' => 'BASIC KURSS PATSTĀVĪGAI APGŪŠANAI', 'category_id' => 9, 'price' => '190.00', 'old_price' => '220.00', 'settings' => ['practical_lesson_count'=>5, 'lesson_count'=>5]],
            22 =>  ['name' => 'LEVEL UP KURSS AR PASNIEDZĒJU', 'category_id' => 9, 'price' => '190.00', 'old_price' => '220.00', 'settings' => ['practical_lesson_count'=>5, 'lesson_count'=>5]],
            23 =>  ['name' => 'Drīzumā! Skaistumkopšanas pakalpojumu sniegšanai noteiktās higiēnas prasības', 'category_id' => 9, 'price' => '190.00', 'old_price' => '220.00', 'settings' => ['practical_lesson_count'=>5, 'lesson_count'=>5]],
            24 =>  ['name' => 'Drīzumā! Manikīra meistara portfolio izveide, apstrāde', 'category_id' => 10, 'price' => '190.00', 'old_price' => '220.00', 'settings' => ['practical_lesson_count'=>5, 'lesson_count'=>5]],
            25 =>  ['name' => 'Kā atjaunot un stiprināt vājus, bojātus, trauslus nagus', 'category_id' => 10, 'price' => '190.00', 'old_price' => '220.00', 'settings' => ['practical_lesson_count'=>5, 'lesson_count'=>5]],
            26 =>  ['name' => 'Aerogrāfijas dizains uz nagiem ar AIRnails I līmenis (bez priekšzināšanām)', 'category_id' => 11, 'price' => '190.00', 'old_price' => '220.00', 'settings' => ['practical_lesson_count'=>5, 'lesson_count'=>5]],
        ];
        foreach ($courses as $key => $value) {
            $availableDate = AvailableDate::inRandomOrder()->first();
            $course =  Course::create([
                'active' => 1,
                'name' => $value['name'],
                'category_id' => $value['category_id'],
                'slug' => uniqid(str_slug($value['name'],'-'),false),
                'code' => 1+423+$key*999,
                'external_id' => 1+3412+$key*123999,
                'preview_text' => $value['name'],
                'description' => 'Description ' . $value['name'] . $value['name'] . $value['name'],
                'view_count' => rand(0, 100),
                'price' => $value['price'],
                'old_price' => $value['old_price'],
                'available_seats' => 10,
                'duration_days' => 14,
                'student_count' => rand(1, 7),
                'settings' => $value['settings'],
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
                'price' => rand(50, 70),
                'old_price' => rand(70, 80),
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
                'company_id' => array_random([1,2,3]),
                'type' => array_random(['cache','bank']),
                'reservation_id' => $reserv->id,
                'slug' => uniqid(false),
                'student_id' => $reserv->student_id,
                'credit' => $reserv->price,
                'debit' => null,
                'note' => 'Pieteikums kursiem ' . $reserv->name . ' no ' . $reserv->full_name,
                'transaction_at' => Carbon::now()->subMonths(array_random([1, 2, 3, 4, 5])),
                'parent_id' => null,
            ]);
            $transaction2 = Transaction::create([
                'active' => true,
                'company_id' => array_random([1,2,3]),
                'type' => array_random(['cache','bank']),
                'reservation_id' => $reserv->id,
                'slug' => uniqid(false),
                'student_id' => $reserv->student_id,
                'credit' => $reserv->price,
                'debit' => null,
                'note' => 'Priekšapmaksas rēķins',
                'transaction_at' => Carbon::now()->addMonths(array_random([1, 2, 3, 4, 5 , 6, 7])),
                'parent_id' => null,
            ]);
            $transaction3 = Transaction::create([
                'active' => true,
                'company_id' =>  $transaction1->company_id,
                'type' => array_random(['cache','bank']),
                'reservation_id' => $reserv->id,
                'slug' => uniqid(false),
                'student_id' => $reserv->student_id,
                'credit' => null,
                'debit' => $reserv->price / 5 / 1,
                'note' => 'Apmaksa saņamta no ' . $reserv->full_name . ' par ' . $reserv->name,
                'transaction_at' => Carbon::now()->subMonths(array_random([1, 2, 3, 4, 5 , 6, 7])),
                'parent_id' => $transaction1->id,
            ]);
            $transaction4 = Transaction::create([
                'active' => array_random([1, 0]),
                'company_id' => $transaction1->company_id,
                'type' => array_random(['cache','bank']),
                'reservation_id' => $reserv->id,
                'slug' => uniqid(false),
                'student_id' => $reserv->student_id,
                'credit' => null,
                'debit' => $reserv->price / 3,
                'note' => 'Nav apmaksāts',
                'transaction_at' => Carbon::now()->subMonths(array_random([1, 2, 3, 4, 5 , 6, 7])),
                'parent_id' => $transaction1->id,
            ]);
            $transaction5 = Transaction::create([
                'active' => array_random([1, 0]),
                'company_id' => $transaction1->company_id,
                'type' => array_random(['cache','bank']),
                'reservation_id' => $reserv->id,
                'slug' => uniqid(false),
                'student_id' => $reserv->student_id,
                'credit' => null,
                'debit' => $reserv->price / 3,
                'note' => 'Nav apmaksāts',
                'transaction_at' => Carbon::now()->subMonths(array_random([1, 2, 3, 4, 5 , 6, 7])),
                'parent_id' => $transaction1->id,
            ]);
            $transaction6 = Transaction::create([
                'active' => array_random([1, 0]),
                'company_id' => $transaction1->company_id,
                'type' => array_random(['cache','bank']),
                'reservation_id' => $reserv->id,
                'slug' => uniqid(false),
                'student_id' => $reserv->student_id,
                'credit' => null,
                'debit' => $reserv->price / 3,
                'note' => 'Nav apmaksāts',
                'transaction_at' => Carbon::now()->subMonths(array_random([1, 2, 3, 4, 5 , 6, 7])),
                'parent_id' => $transaction1->id,
            ]);
            $transaction7 = Transaction::create([
                'active' => array_random([1, 0]),
                'company_id' => $transaction1->company_id,
                'type' => array_random(['cache','bank']),
                'reservation_id' => $reserv->id,
                'slug' => uniqid(false),
                'student_id' => $reserv->student_id,
                'credit' => null,
                'debit' => $reserv->price / 3,
                'note' => 'Nav apmaksāts',
                'transaction_at' => Carbon::now()->subMonths(array_random([1, 2, 3, 4, 5 , 6, 7])),
                'parent_id' => $transaction1->id,
            ]);
            $transaction8 = Transaction::create([
                'active' => array_random([1, 0]),
                'company_id' => $transaction2->company_id,
                'type' => array_random(['cache','bank']),
                'reservation_id' => $reserv->id,
                'slug' => uniqid(false),
                'student_id' => $reserv->student_id,
                'credit' => null,
                'debit' => 50,
                'note' => 'Priekšapmaksas rēķins',
                'transaction_at' => Carbon::now()->addMonths(array_random([1, 2, 3, 4, 5 , 6, 7])),
                'parent_id' => $transaction2->id,
            ]);
            $transaction9 = Transaction::create([
                'active' => true,
                'company_id' => $transaction2->company_id,
                'type' => array_random(['cache','bank']),
                'reservation_id' => $reserv->id,
                'slug' => uniqid(false),
                'student_id' => $reserv->student_id,
                'credit' => null,
                'debit' => $reserv->price / 5 / 1,
                'note' => 'Apmaksa saņamta no ' . $reserv->full_name . ' par ' . $reserv->name,
                'transaction_at' => Carbon::now()->addMonths(array_random([1, 2, 3, 4, 5 , 6, 7])),
                'parent_id' => $transaction2->id,
            ]);
            $transaction10 = Transaction::create([
                'active' => array_random([1, 0]),
                'company_id' => $transaction2->company_id,
                'type' => array_random(['cache','bank']),
                'reservation_id' => $reserv->id,
                'slug' => uniqid(false),
                'student_id' => $reserv->student_id,
                'credit' => null,
                'debit' => $reserv->price / 3,
                'note' => 'Nav apmaksāts',
                'transaction_at' => Carbon::now()->addMonths(array_random([1, 2, 3, 4, 5 , 6, 7])),
                'parent_id' => $transaction2->id,
            ]);
            $transaction11 = Transaction::create([
                'active' => array_random([1, 0]),
                'company_id' => $transaction2->company_id,
                'type' => array_random(['cache','bank']),
                'reservation_id' => $reserv->id,
                'slug' => uniqid(false),
                'student_id' => $reserv->student_id,
                'credit' => null,
                'debit' => $reserv->price / 3,
                'note' => 'Nav apmaksāts',
                'transaction_at' => Carbon::now()->addMonths(array_random([1, 2, 3, 4, 5 , 6, 7])),
                'parent_id' => $transaction2->id,
            ]);
            $transaction12 = Transaction::create([
                'active' => array_random([1, 0]),
                'company_id' => $transaction2->company_id,
                'type' => array_random(['cache','bank']),
                'reservation_id' => $reserv->id,
                'slug' => uniqid(false),
                'student_id' => $reserv->student_id,
                'credit' => null,
                'debit' => $reserv->price / 3,
                'note' => 'Nav apmaksāts',
                'transaction_at' => Carbon::now()->addMonths(array_random([1, 2, 3, 4, 5 , 6, 7])),
                'parent_id' => $transaction2->id,
            ]);
            $transaction13 = Transaction::create([
                'active' => array_random([1, 0]),
                'company_id' => $transaction2->company_id,
                'type' => array_random(['cache','bank']),
                'reservation_id' => $reserv->id,
                'slug' => uniqid(false),
                'student_id' => $reserv->student_id,
                'credit' => null,
                'debit' => $reserv->price / 3,
                'note' => 'Nav apmaksāts',
                'transaction_at' => Carbon::now()->addMonths(array_random([1, 2, 3, 4, 5 , 6, 7])),
                'parent_id' => $transaction2->id,
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
