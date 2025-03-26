<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        User::create([
            'name' => 'Antonio',
            'email' => 'quadjovie.antonio@gmail.com',
            'password' => Hash::make('Hikarichan12345'),
            'role' => 'admin',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('default_admin_user');
    }
};
