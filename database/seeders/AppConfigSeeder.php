<?php

namespace Database\Seeders;

use App\Models\AppConfig;
use Illuminate\Database\Seeder;

class AppConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createLandingPageConfig();
    }

    private function createLandingPageConfig() {
        AppConfig::create([
            "key" => "landing_page",
            "value" => [
                "cover_video_url" => null,
                "most_popular_courses_ids" => [],
                "testimonials" => [],
                "latest_videos_links" => [],
                "facebook_latest_posts" => []
            ]
        ]);
    }
}
