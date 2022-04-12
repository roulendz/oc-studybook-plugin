<?php namespace Logingrupa\Studybook\Updates;

use Schema;
use Illuminate\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * Class CreateTableUsers
 * @package Logingrupa\Studybook\Classes\Console
 */
class AddUserPhoneField extends Migration
{
    const TABLE = 'users';

    /**
     * Apply migration
     */
    public function up()
    {
        if (Schema::hasColumn(self::TABLE, 'phone')) {
            return;
        }

        Schema::table(self::TABLE, function($table)
        {
            $table->string('phone', 100)->nullable();
        });
    }

    /**
     * Rollback migration
     */
    public function down()
    {
        if (Schema::hasTable(self::TABLE) && Schema::hasColumn(self::TABLE, 'phone')) {
            Schema::table(self::TABLE, function ($table) {
                $table->dropColumn(['phone']);
            });
        }
    }
}
