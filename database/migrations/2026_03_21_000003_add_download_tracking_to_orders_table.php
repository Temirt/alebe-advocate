<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedInteger('download_count')->default(0)->after('transaction_id');
            $table->timestamp('downloaded_at')->nullable()->after('download_count');
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['download_count', 'downloaded_at']);
        });
    }
};
