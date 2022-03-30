<?php namespace Logingrupa\Studybook\Updates;

use Schema;
use Illuminate\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * Class CreateTableCourseCategories
 * @package Logingrupa\Studybook\Classes\Console
 */
class CreateTableCourseCategories extends Migration
{
    const TABLE = 'logingrupa_studybook_additional_categories';

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
            $obTable->integer('category_id')->unsigned();
            $obTable->integer('course_id')->unsigned();
            $obTable->primary(['category_id', 'course_id'], 'course_category');
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
