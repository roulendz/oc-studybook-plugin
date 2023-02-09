<?php namespace Logingrupa\Studybook\Updates;

use Schema;
use Illuminate\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * Class CreateTableCourses
 * @package Logingrupa\Studybook\Classes\Console
 */
class CreateTableCourses extends Migration
{
    const TABLE = 'logingrupa_studybook_courses';

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
            $obTable->boolean('active')->default(0);
            $obTable->string('name');
            $obTable->integer('category_id')->nullable()->unsigned();
            $obTable->foreign('category_id')->references('id')->on('logingrupa_studybook_categories');
            $obTable->string('slug')->unique()->index();
            $obTable->string('code')->nullable()->index();
            $obTable->string('external_id')->nullable()->index();
            $obTable->text('preview_text')->nullable();
            $obTable->text('description')->nullable();
            $obTable->integer('view_count')->nullable()->default(0);
            $obTable->decimal('price', 15, 2)->nullable();
            $obTable->decimal('old_price', 15, 2)->nullable();
            $obTable->integer('available_seats')->nullable();
            $obTable->integer('duration_days')->nullable();
            $obTable->integer('student_count')->nullable();
            $obTable->json('settings')->nullable();
            $obTable->timestamps();

            $obTable->index('name');
            $obTable->index('category_id');
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
