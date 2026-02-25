<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('settings')->insert([
            [
                'key' => 'general',
                'value' => json_encode([
                    'site_name' => 'My Blog',
                    'site_email' => 'admin@example.com',
                    'site_phone' => '+1234567890',
                    'site_timezone' => 'UTC',
                    'site_description' => 'Welcome to my blog website.',
                    'site_address' => '123 Main Street',
                    'site_keywords' => 'blog, articles, news',
                    'site_language' => 'en',
                ]),
            ],
            [
                'key' => 'appearance',
                'value' => json_encode([
                    'site_logo' => null,
                    'site_favicon' => null,
                    'primary_color' => '#4f46e5',
                    'secondary_color' => '#7c3aed',
                    'posts_per_page' => 10,
                    'header_layout' => 'default',
                    'show_author' => true,
                    'show_date' => true,
                    'show_views' => true,
                    'show_shares' => true,
                ]),
            ],
            [
                'key' => 'seo',
                'value' => json_encode([
                    'meta_title' => 'My Blog',
                    'meta_description' => 'Best blog website.',
                    'meta_keywords' => 'blog, writing',
                    'google_analytics_id' => null,
                    'facebook_pixel_id' => null,
                    'enable_sitemap' => true,
                    'enable_robots_txt' => true,
                ]),
            ],
            [
                'key' => 'social',
                'value' => json_encode([
                    'facebook_url' => null,
                    'twitter_url' => null,
                    'instagram_url' => null,
                    'linkedin_url' => null,
                    'youtube_url' => null,
                    'github_url' => null,
                    'pinterest_url' => null,
                    'tiktok_url' => null,
                ]),
            ],
            [
                'key' => 'email',
                'value' => json_encode([
                    'mail_driver' => 'smtp',
                    'mail_host' => 'smtp.mailtrap.io',
                    'mail_port' => 587,
                    'mail_username' => null,
                    'mail_password' => null,
                    'mail_encryption' => 'tls',
                    'mail_from_address' => 'noreply@example.com',
                    'mail_from_name' => 'My Blog',
                ]),
            ],
            [
                'key' => 'comments',
                'value' => json_encode([
                    'enable_comments' => true,
                    'comments_approval' => 'automatic',
                    'allow_guest_comments' => true,
                    'comments_per_page' => 20,
                    'enable_nested_comments' => true,
                    'max_nesting_level' => 3,
                    'enable_likes' => true,
                ]),
            ],
            [
                'key' => 'security',
                'value' => json_encode([
                    'enable_captcha' => false,
                    'captcha_site_key' => null,
                    'captcha_secret_key' => null,
                    'enable_ssl' => false,
                    'enable_maintenance' => false,
                    'maintenance_message' => 'We are under maintenance.',
                    'allowed_ips' => null,
                ]),
            ],
        ]);
    }
}