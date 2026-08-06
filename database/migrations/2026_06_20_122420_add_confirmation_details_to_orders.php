<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            if (!Schema::hasColumn('orders', 'confirmation_dtmf')) {
                $table->string('confirmation_dtmf')->nullable()->after('confirmation_called_at');
            }
            if (!Schema::hasColumn('orders', 'confirmation_duration')) {
                $table->string('confirmation_duration')->nullable()->after('confirmation_dtmf');
            }
            if (!Schema::hasColumn('orders', 'confirmation_charged')) {
                $table->decimal('confirmation_charged', 10, 4)->nullable()->after('confirmation_duration');
            }
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'confirmation_dtmf',
                'confirmation_duration',
                'confirmation_charged'
            ]);
        });
    }
};
