<?php namespace Logingrupa\Studybook\Updates;

use Schema;
use Illuminate\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * Class CreateTablecompany
 * @package Logingrupa\Studybook\Classes\Console
 */
class CreateTablecompany extends Migration
{
    const TABLE = 'logingrupa_studybook_company';

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
            $obTable->string('name')->index();
            $obTable->string('slug')->unique()->index();
            $obTable->string('code')->nullable()->index();
            $obTable->string('external_id')->nullable()->index();
            $obTable->text('preview_text')->nullable();
            $obTable->text('description')->nullable();
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
