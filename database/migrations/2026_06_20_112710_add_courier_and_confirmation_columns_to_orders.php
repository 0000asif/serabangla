<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCourierAndConfirmationColumnsToOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Sales Confirmation Columns
            if (!Schema::hasColumn('orders', 'confirmation_status')) {
                $table->string('confirmation_status')->nullable()->after('status');
            }
            
            if (!Schema::hasColumn('orders', 'confirmation_called_at')) {
                $table->timestamp('confirmation_called_at')->nullable()->after('confirmation_status');
            }
            
            // BD Courier / Fraud Check Columns
            if (!Schema::hasColumn('orders', 'courier_data')) {
                $table->json('courier_data')->nullable()->after('confirmation_called_at');
            }
            
            if (!Schema::hasColumn('orders', 'courier_total_parcel')) {
                $table->integer('courier_total_parcel')->nullable()->after('courier_data');
            }
            
            if (!Schema::hasColumn('orders', 'courier_success_ratio')) {
                $table->float('courier_success_ratio')->nullable()->after('courier_total_parcel');
            }
            
            if (!Schema::hasColumn('orders', 'is_fraud_risk')) {
                $table->boolean('is_fraud_risk')->default(false)->after('courier_success_ratio');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $columns = [
                'confirmation_status',
                'confirmation_called_at',
                'courier_data',
                'courier_total_parcel',
                'courier_success_ratio',
                'is_fraud_risk'
            ];
            
            foreach ($columns as $column) {
                if (Schema::hasColumn('orders', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
}
