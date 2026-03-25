<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('testimonials', function (Blueprint $table) {
            $table->string('author_photo')->nullable()->after('name');
            $table->string('review_url')->nullable()->after('content');
            $table->string('review_time')->nullable()->after('review_url');
        });
    }

    public function down(): void
    {
        Schema::table('testimonials', function (Blueprint $table) {
            $table->dropColumn(['author_photo', 'review_url', 'review_time']);
        });
    }
};
