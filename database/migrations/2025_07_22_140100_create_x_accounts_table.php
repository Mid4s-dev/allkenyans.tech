<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateXAccountsTable extends Migration
{
    public function up()
    {
        Schema::create('x_accounts', function (Blueprint $table) {
            $table->id();
            // Basic account information
            $table->string('x_id')->unique();
            $table->string('username')->unique();
            $table->string('display_name')->nullable();
            $table->string('profile_image_url')->nullable();
            $table->text('bio')->nullable();
            $table->integer('followers_count')->default(0);
            $table->integer('following_count')->default(0);
            $table->boolean('is_verified')->default(false);
            $table->boolean('is_protected')->default(false);

            // Status and reporting
            $table->enum('status', ['watching', 'reported', 'blocked'])->default('watching');
            $table->integer('report_count')->default(0);
            $table->json('report_details')->nullable(); // Stores category counts and latest reports
            $table->timestamp('last_reported_at')->nullable();
            $table->timestamp('last_blocked_at')->nullable();
            $table->json('reports')->nullable(); // Array of reports with category, description, reporter_id, timestamp
            $table->json('actions')->nullable(); // Array of actions taken with timestamp, user_id, type, notes
            
            // Current active report
            $table->enum('current_report_category', [
                'hate_speech',
                'harassment',
                'spam',
                'impersonation',
                'violence',
                'terrorism',
                'misinformation',
                'scam',
                'other'
            ])->nullable();
            $table->text('current_report_description')->nullable();
            $table->json('current_evidence')->nullable();
            $table->foreignId('current_reporter_id')->nullable()->constrained('users')->nullOnDelete();
            
            // Latest action
            $table->enum('latest_action', ['none', 'warning', 'block', 'report'])->default('none');
            $table->text('latest_action_note')->nullable();
            $table->foreignId('latest_action_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('latest_action_at')->nullable();

            // Timestamps and audit
            $table->foreignId('last_updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('x_accounts');
    }
}
