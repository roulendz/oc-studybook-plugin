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
            $obTable->string('status')->nullable();
            $obTable->string('name');
            $obTable->integer('course_id')->unsigned()->nullable();
            $obTable->foreign('course_id')->references('id')->on('logingrupa_studybook_courses');
            $obTable->boolean('active')->default(0);
            $obTable->dateTime('start_at')->default(null);
            $obTable->foreign('start_at')->references('datetime')->on('logingrupa_studybook_availabledates');
            $obTable->string('full_name')->nullable();
            $obTable->integer('student_id')->unsigned()->nullable();
            $obTable->foreign('student_id')->references('id')->on('users');
            $obTable->boolean('attendance')->nullable()->default(0);
            $obTable->boolean('health')->nullable()->default(0);
            $obTable->string('phone')->nullable();
            $obTable->string('email')->nullable();
            $obTable->string('model_status')->nullable();
            $obTable->string('slug')->unique();
            $obTable->integer('price')->nullable();
            $obTable->integer('old_price')->nullable();
            $obTable->string('code')->nullable();
            $obTable->string('external_id')->nullable();
            $obTable->text('preview_text')->nullable();
            $obTable->text('description')->nullable();
            $obTable->timestamps();

            $obTable->index('name');
            $obTable->index('course_id');
            $obTable->index('start_at');
            $obTable->index('full_name');
            $obTable->index('student_id');
            $obTable->index('phone');
            $obTable->index('email');
            $obTable->index('status');
            $obTable->index('price');
            $obTable->index('old_price');
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
