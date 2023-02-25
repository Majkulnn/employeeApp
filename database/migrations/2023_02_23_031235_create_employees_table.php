<?php

use App\Models\City;
use App\Models\Country;
use App\Models\Department;
use App\Models\State;
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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string("last_name");
            $table->string("first_name");
            $table->string("middle_name")->nullable();
            $table->string("address");
            $table->foreignIdFor(Department::class)->constrained();
            $table->foreignIdFor(City::class)->constrained();
            $table->foreignIdFor(State::class)->constrained();
            $table->foreignIdFor(Country::class)->constrained();
            $table->char("zip_code",10);
            $table->date("birthdate")->nullable();
            $table->date("date_hired")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
