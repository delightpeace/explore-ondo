<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table): void {
            $table->id();
            $table->string('name', 120);
            $table->string('slug', 100)->unique();
            $table->string('description', 255)->nullable();
            $table->string('symbol', 12)->default('◉');
            $table->string('image_url', 2048)->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('featured_profiles', function (Blueprint $table): void {
            $table->id();
            $table->string('type', 20)->index();
            $table->string('name', 160);
            $table->string('subtitle', 180)->nullable();
            $table->text('description');
            $table->string('image_url', 2048)->nullable();
            $table->string('website_url', 2048)->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        $now = now();
        $categories = [
            ['attractions', 'Attractions & heritage', 'Historic places, landmarks and cultural heritage.', '◉', 'https://commons.wikimedia.org/wiki/Special:Redirect/file/Ondo_city_gate.jpg', 1],
            ['schools', 'Schools & education', 'Schools, colleges and learning centres.', '▤', 'https://commons.wikimedia.org/wiki/Special:Redirect/file/Student_Union_Government_building,_Adeyemi_College_of_Education.jpg', 2],
            ['stays', 'Hotels, stays & resorts', 'Places to stay, relax and enjoy your visit.', '⌂', 'https://commons.wikimedia.org/wiki/Special:Redirect/file/From_the_top_of_the_Pele_mountain.jpg', 3],
            ['worship', 'Churches & places of worship', 'Places of worship and faith communities.', '⌂', null, 4],
            ['markets', 'Markets & shopping', 'Markets, shops and local finds.', '⌂', 'https://thumb.wikimedia.org/wikipedia/commons/thumb/d/d6/Iya_Alaje_Market%2C_Ondo.jpg/960px-Iya_Alaje_Market%2C_Ondo.jpg', 5],
            ['food', 'Food & restaurants', 'Restaurants, local food and places to eat.', '✦', 'https://commons.wikimedia.org/wiki/Special:Redirect/file/Food_Point_Restaurant.jpg', 6],
            ['health', 'Healthcare', 'Hospitals, clinics and health services.', '+', null, 7],
            ['events', 'Events & festivals', 'Festivals, events and cultural gatherings.', '✦', null, 8],
            ['motor-parks', 'Motor parks & transport', 'Motor parks and local transport services.', '↗', null, 9],
            ['services', 'Useful services', 'Everyday services and local businesses.', '＋', null, 10],
        ];

        foreach ($categories as [$slug, $name, $description, $symbol, $imageUrl, $sortOrder]) {
            DB::table('categories')->insert([
                'name' => $name,
                'slug' => $slug,
                'description' => $description,
                'symbol' => $symbol,
                'image_url' => $imageUrl,
                'sort_order' => $sortOrder,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        $profiles = [
            ['person', 'Gani Fawehinmi', 'Lawyer · publisher · human rights advocate', 'Born in Ondo in 1938, Gani Fawehinmi became one of Nigeria’s best-known lawyers and advocates for human rights and public accountability.', null, 'https://www.osgf.gov.ng/storage/app/media/pdf/Profiles%20of%20the%20National%20Awardees.pdf', 1],
            ['person', 'King Sunny Adé', 'Jùjú musician · Ondo family roots', 'A renowned Nigerian Jùjú musician whose father was from Ondo City. King Sunny Adé was born in Osogbo.', null, 'https://dawncommission.org/otunba-king-sunny-ade-mfr-at-80-the-global-king-of-juju-music/', 2],
            ['person', 'Biodun Bamigboye', 'Software engineer · education technology', 'His profile describes more than a decade working in educational technology, building school management systems and AI-supported learning tools. He is listed as founder and CTO of Hunnovate.', 'https://biodunbamigboye.com/images/image1.png', 'https://biodunbamigboye.com/', 3],
            ['business', 'Hunnovate', 'Technology · Ondo City', 'A technology company in Ondo City working across programming and software development.', null, 'https://hunnovate.com', 1],
            ['business', 'Charis Brand', 'Local brand · Ondo City', 'A local brand featured in the Explore Ondo business guide.', null, null, 2],
            ['business', 'GE Interiors', 'Interiors · Ondo City', 'An interiors business featured in the Explore Ondo business guide.', null, null, 3],
            ['business', 'Nibanola Motherland Resort & Golf', 'A local stay · Igbado', 'A resort and leisure destination on Ondo-Ore Road in Ondo City.', null, 'https://www.nibanola.com/', 4],
        ];

        foreach ($profiles as [$type, $name, $subtitle, $description, $imageUrl, $websiteUrl, $sortOrder]) {
            DB::table('featured_profiles')->insert([
                'type' => $type,
                'name' => $name,
                'subtitle' => $subtitle,
                'description' => $description,
                'image_url' => $imageUrl,
                'website_url' => $websiteUrl,
                'sort_order' => $sortOrder,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('featured_profiles');
        Schema::dropIfExists('categories');
    }
};
