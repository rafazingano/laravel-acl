<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAclTable extends Migration
{

    public function up()
    {
        Schema::create(config('cw_acl.roles_table', 'acl_roles'), function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->string('display_name')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create(config('cw_acl.role_user_table', 'acl_role_user'), function (Blueprint $table) {
            $table->unsignedBigInteger(config('cw_acl.user_foreign_key', 'user_id'));
            $table->unsignedBigInteger(config('cw_acl.role_foreign_key', 'role_id'));

            $table->foreign(config('cw_acl.user_foreign_key', 'user_id'))
                ->references('id')
                ->on(config('cw_acl.users_table', 'users'))
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign(config('cw_acl.role_foreign_key', 'role_id'))
                ->references('id')
                ->on(config('cw_acl.roles_table', 'acl_roles'))
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::create(config('cw_acl.permissions_table', 'acl_permissions'), function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->string('display_name')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create(config('cw_acl.permission_role_table', 'acl_permission_role'), function (Blueprint $table) {
            $table->unsignedBigInteger(config('cw_acl.permission_foreign_key', 'permission_id'));
            $table->unsignedBigInteger(config('cw_acl.role_foreign_key', 'role_id'));

            $table->foreign(config('cw_acl.permission_foreign_key', 'permission_id'))
                ->references('id')
                ->on(config('cw_acl.permissions_table', 'acl_permissions'))
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign(config('cw_acl.role_foreign_key', 'role_id'))
                ->references('id')
                ->on(config('cw_acl.roles_table', 'acl_roles'))
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

    }

    public function down()
    {
        Schema::dropIfExists(config('cw_acl.permission_role_table', 'acl_permission_role'));
        Schema::dropIfExists(config('cw_acl.permissions_table', 'acl_permissions'));
        Schema::dropIfExists(config('cw_acl.role_user_table', 'acl_role_user'));
        Schema::dropIfExists(config('cw_acl.roles_table', 'acl_roles'));
    }
}
