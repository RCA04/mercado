<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('vendas', function (Blueprint $table) {
        $table->string('pedido')->after('id'); // ou 'name', dependendo da ordem desejada
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
            Schema::table('vendas', function (Blueprint $table) {
            $table->dropColumn('pedido');
        });
    }
};
