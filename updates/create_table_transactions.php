<?php namespace Logingrupa\Studybook\Updates;

use Schema;
use Illuminate\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * Class CreateTableTransactions
 * @package Logingrupa\Studybook\Classes\Console
 */
class CreateTableTransactions extends Migration
{
    const TABLE = 'logingrupa_studybook_transactions';

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
            $obTable->integer('company_id')->unsigned()->nullable();
            $obTable->foreign('company_id')->references('id')->on('logingrupa_studybook_companies');
            $obTable->boolean('active')->default(0);
            $obTable->string('type')->nullable();
            $obTable->integer('reservation_id')->nullable()->unsigned();
            $obTable->string('slug')->unique()->index();
            $obTable->integer('student_id')->nullable()->unsigned();
            $obTable->decimal('credit', 15, 2)->nullable();
            $obTable->decimal('debit', 15, 2)->nullable();
            $obTable->text('note')->nullable();
            $obTable->string('transaction_at')->nullable();
            $obTable->integer('parent_id')->nullable()->unsigned();
            $obTable->integer('nest_left')->nullable()->unsigned();
            $obTable->integer('nest_right')->nullable()->unsigned();
            $obTable->integer('nest_depth')->nullable()->unsigned();
            $obTable->timestamps();

            $obTable->index('id');
            $obTable->index('slug');
            $obTable->index('reservation_id');
            $obTable->index('student_id');
            $obTable->index('company_id');
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
