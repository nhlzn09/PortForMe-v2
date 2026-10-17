<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $t) {
            $t->string('username', 20)->nullable()->unique()->after('id');
        });

        // One portfolio per user (personal information + chosen template + profile picture).
        Schema::create('portfolios', function (Blueprint $t) {
            $t->id();
            $t->foreignId('user_id')->unique()->constrained()->cascadeOnDelete();
            $t->string('template', 10)->default('simple');   // simple | modern | creative
            $t->string('full_name', 100);
            $t->string('headline', 140)->nullable();
            $t->string('email', 120);
            $t->string('phone', 30)->nullable();
            $t->string('address', 200)->nullable();
            $t->text('about')->nullable();
            $t->longText('photo')->nullable();                // resized JPEG stored as a data URI
            $t->timestamps();
        });

        // Child tables: many rows per portfolio, deleted automatically with it.
        $child = function (string $name, callable $columns) {
            Schema::create($name, function (Blueprint $t) use ($columns) {
                $t->id();
                $t->foreignId('portfolio_id')->constrained()->cascadeOnDelete();
                $columns($t);
            });
        };

        $child('educations', function (Blueprint $t) {
            $t->string('school', 120);
            $t->string('degree', 120)->nullable();
            $t->string('years', 40)->nullable();
        });
        $child('skills', function (Blueprint $t) {
            $t->string('name', 60);
        });
        $child('projects', function (Blueprint $t) {
            $t->string('title', 100);
            $t->text('description')->nullable();
            $t->longText('image')->nullable();                // resized JPEG stored as a data URI
        });
        $child('experiences', function (Blueprint $t) {
            $t->string('company', 120);
            $t->string('role', 120)->nullable();
            $t->string('years', 40)->nullable();
            $t->text('description')->nullable();
        });
        $child('social_links', function (Blueprint $t) {
            $t->string('label', 40);
            $t->string('url', 255);
        });
    }

    public function down(): void
    {
        foreach (['social_links', 'experiences', 'projects', 'skills', 'educations', 'portfolios'] as $table) {
            Schema::dropIfExists($table);
        }
        Schema::table('users', fn (Blueprint $t) => $t->dropColumn('username'));
    }
};
