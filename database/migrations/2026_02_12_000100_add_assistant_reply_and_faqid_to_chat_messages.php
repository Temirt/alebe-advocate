<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('chat_messages', function (Blueprint $table) {
            $table->text('assistant_reply')->nullable()->after('message');
            $table->unsignedBigInteger('faq_id')->nullable()->after('assistant_reply');
            $table->foreign('faq_id')->references('id')->on('faqs')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('chat_messages', function (Blueprint $table) {
            $table->dropForeign(['faq_id']);
            $table->dropColumn(['assistant_reply','faq_id']);
        });
    }
};
