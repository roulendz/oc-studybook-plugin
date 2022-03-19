<?php namespace Logingrupa\Studybook\Updates;

use Schema;
use Illuminate\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * Class CreateTableAvailableDates
 * @package Logingrupa\Studybook\Classes\Console
 */
class CreateTableAvailableDates extends Migration
{
    const TABLE = 'logingrupa_studybook_availabledates';

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
            $obTable->boolean('active')->default(1);
            $obTable->dateTime('datetime')->unique();
            $obTable->integer('available_seats')->default(0);
            $obTable->integer('reserved_seats')->default(0)->nullable();
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
