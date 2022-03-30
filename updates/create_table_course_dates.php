<?php namespace Logingrupa\Studybook\Updates;

use Schema;
use Illuminate\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * Class CreateTableCourseDates
 * @package Logingrupa\Studybook\Classes\Console
 */
class CreateTableCourseDates extends Migration
{
    const TABLE = 'logingrupa_studybook_course_dates';

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
            $obTable->integer('date_id')->unsigned();
            $obTable->integer('course_id')->unsigned();
            $obTable->primary(['date_id', 'course_id'], 'course_dates');
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
