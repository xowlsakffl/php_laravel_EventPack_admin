<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventspackAdminTables extends Migration
{
    public function up()
    {
        Schema::create('works', function (Blueprint $table) {
            $table->bigIncrements('wdx');
            $table->unsignedBigInteger('udx');
            $table->string('name');
            $table->string('participant')->nullable();
            $table->string('duration')->nullable();
            $table->unsignedTinyInteger('state')->default(10);
            $table->timestamps();
            $table->softDeletes();
            $table->index('udx');
        });

        Schema::create('sites', function (Blueprint $table) {
            $table->bigIncrements('sdx');
            $table->unsignedBigInteger('wdx');
            $table->string('name');
            $table->string('domain')->nullable();
            $table->string('email_name')->nullable();
            $table->string('email_address')->nullable();
            $table->string('phone_name')->nullable();
            $table->string('phone_address')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->text('keyword')->nullable();
            $table->unsignedBigInteger('favicon_fdx')->nullable();
            $table->string('og_title')->nullable();
            $table->string('og_url')->nullable();
            $table->text('og_description')->nullable();
            $table->text('og_images')->nullable();
            $table->longText('meta')->nullable();
            $table->string('saving_events_pack')->nullable();
            $table->char('use_email_auth', 1)->default('N');
            $table->text('main_user_policy')->nullable();
            $table->text('seperate_user_policy')->nullable();
            $table->unsignedTinyInteger('state')->default(10);
            $table->timestamps();
            $table->softDeletes();
            $table->index('wdx');
        });

        Schema::create('packs', function (Blueprint $table) {
            $table->bigIncrements('pdx');
            $table->string('code')->unique();
            $table->string('name_ko');
            $table->string('name_en');
            $table->text('explain_ko')->nullable();
            $table->text('explain_en')->nullable();
            $table->string('default_path');
            $table->unsignedTinyInteger('state')->default(10);
            $table->timestamps();
        });

        Schema::create('pack_board', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('stdx')->nullable();
            $table->string('title');
            $table->longText('content')->nullable();
            $table->text('files')->nullable();
            $table->unsignedBigInteger('udx')->nullable();
            $table->string('name')->nullable();
            $table->string('password')->nullable();
            $table->string('ip', 45)->nullable();
            $table->char('show_this', 1)->default('Y');
            $table->char('secret', 1)->default('N');
            $table->char('notice', 1)->default('N');
            $table->unsignedTinyInteger('state')->default(10);
            $table->timestamps();
        });

        Schema::create('pack_page', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('stdx')->nullable();
            $table->string('title');
            $table->longText('content')->nullable();
            $table->text('files')->nullable();
            $table->unsignedBigInteger('udx')->nullable();
            $table->string('name')->nullable();
            $table->string('ip', 45)->nullable();
            $table->char('show_this', 1)->default('Y');
            $table->unsignedTinyInteger('state')->default(10);
            $table->timestamps();
        });

        $this->createLayoutSectionTable('layout_tops', 'lotdx');
        $this->createLayoutSectionTable('layout_navigations', 'londx');
        $this->createLayoutSectionTable('layout_middles', 'lomdx');
        $this->createLayoutSectionTable('layout_bottoms', 'lobdx');

        Schema::create('layout_etcs', function (Blueprint $table) {
            $table->bigIncrements('loedx');
            $table->string('category')->nullable();
            $table->string('name_ko');
            $table->string('name_en');
            $table->string('code')->unique();
            $table->string('display_type')->nullable();
            $table->unsignedInteger('display_duration')->nullable();
            $table->text('font_default')->nullable();
            $table->text('font_resource')->nullable();
            $table->unsignedTinyInteger('state')->default(10);
            $table->timestamps();
        });

        Schema::create('layouts', function (Blueprint $table) {
            $table->bigIncrements('lodx');
            $table->string('category')->nullable();
            $table->string('name_ko');
            $table->string('name_en');
            $table->text('descript_ko')->nullable();
            $table->text('descript_en')->nullable();
            $table->unsignedBigInteger('lotdx')->nullable();
            $table->unsignedBigInteger('londx')->nullable();
            $table->unsignedBigInteger('lomdx')->nullable();
            $table->unsignedBigInteger('lobdx')->nullable();
            $table->unsignedBigInteger('loedx')->nullable();
            $table->char('default', 1)->default('N');
            $table->unsignedTinyInteger('state')->default(10);
            $table->timestamps();
        });

        Schema::create('user_action_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('udx')->nullable();
            $table->string('action');
            $table->text('content')->nullable();
            $table->string('ip', 45)->nullable();
            $table->text('ua')->nullable();
            $table->unsignedTinyInteger('state')->default(10);
            $table->timestamp('created_at')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_action_logs');
        Schema::dropIfExists('layouts');
        Schema::dropIfExists('layout_etcs');
        Schema::dropIfExists('layout_bottoms');
        Schema::dropIfExists('layout_middles');
        Schema::dropIfExists('layout_navigations');
        Schema::dropIfExists('layout_tops');
        Schema::dropIfExists('pack_page');
        Schema::dropIfExists('pack_board');
        Schema::dropIfExists('packs');
        Schema::dropIfExists('sites');
        Schema::dropIfExists('works');
    }

    private function createLayoutSectionTable($tableName, $primaryKey)
    {
        Schema::create($tableName, function (Blueprint $table) use ($primaryKey) {
            $table->bigIncrements($primaryKey);
            $table->string('category')->nullable();
            $table->string('name_ko');
            $table->string('name_en');
            $table->string('code')->unique();
            $table->longText('html')->nullable();
            $table->longText('css')->nullable();
            $table->unsignedTinyInteger('state')->default(10);
            $table->timestamps();
        });
    }
}
