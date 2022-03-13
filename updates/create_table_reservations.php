<?php namespace Logingrupa\Studybook\Updates;

use Schema;
use Illuminate\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * Class CreateTableReservations
 * @package Logingrupa\Studybook\Classes\Console
 */
class CreateTableReservations extends Migration
{
    const TABLE = 'logingrupa_studybook_reservations';

    /**
     * Apply migration
     */
    public function up()
    {
        if (Schema::hasTable(self::TABLE)) {
            return;
        }

        Schema::create(self::TABLE, function (Blueprint $obTable)
        {
            $obTable->engine = 'InnoDB';
            $obTable->increments('id')->unsigned();
            $obTable->string('status')->nullable()->index();
            $obTable->string('name')->index();
            $obTable->integer('course_id')->unsigned()->nullable();
            $obTable->foreign('course_id')->references('id')->on('logingrupa_studybook_courses');
            $obTable->boolean('active')->default(0);
            $obTable->dateTime('start_at')->default(null)->index();
            $obTable->string('full_name')->nullable()->index();
            $obTable->integer('student_id')->unsigned()->nullable();
            $obTable->foreign('student_id')->references('id')->on('users');
            $obTable->boolean('attendance')->nullable()->default(0);
            $obTable->boolean('health')->nullable()->default(0);
            $obTable->string('mobile')->nullable()->index();
            $obTable->string('email')->nullable()->index();
            $obTable->string('model_status')->nullable()->index();
            $obTable->string('slug')->unique()->index();
            $obTable->integer('price')->nullable();
            $obTable->integer('old_price')->nullable();
            $obTable->string('code')->nullable();
            $obTable->string('external_id')->nullable();
            $obTable->text('preview_text')->nullable();
            $obTable->text('description')->nullable();
            $obTable->integer('view_count')->nullable()->default(0);
            $obTable->timestamps();
        });
    }

    /**
     * Rollback migration
     */
    public function down()
    {
        Schema::dropIfExists(self::TABLE);
    }
}
