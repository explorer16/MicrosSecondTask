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
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->text('description')->nullable();
            $table->foreignUuid('category_id')->constrained('categories', 'id');
            $table->foreignUuid('supplier_id')->constrained('suppliers', 'id');
            $table->decimal('price', 8, 2);
            $table->string('file_url');
            $table->boolean('is_active')->default(true)->comment('For soft delete');
            $table->foreignUuid('created_by')->constrained('users', 'id');
            $table->foreignUuid('updated_by')->constrained('users', 'id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
