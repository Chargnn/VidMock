<?php

use App\Comment;
use App\User;
use App\Video;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Webpatser\Uuid\Uuid;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$images = [
    '0smPhoTWYeE.jpg',
    '0ZPlUMo2lis.jpg',
    '1g49x5NSWH0.jpg',
    '4BvvvgTBObw.jpg',
    '85spsIgccGY.jpg',
    '-Yw5dLaCXYY.jpg',
    'APL8RzuQVA0.jpg',
    'bYuI23mnmDQ.jpg',
    'cLh4dqj2i4Y.jpg',
    'dBzUuNUvCwM.jpg',
    'dE9BUGX4UV8.jpg',
    'eCpdGoq9gdI.jpg',
    'fwlEfOEpd_E.jpg',
    'G0GyVaBP73E.jpg',
    'HwPgyWk9h-o.jpg',
    'kbGo1cTa5OE.jpg',
    'kx_uU9bfQBU.jpg',
    'L6bfAoC1HS8.jpg',
    'lwHNPvw2nVA.jpg',
    'mXlOuM4unSg.jpg',
    'q36y-w_RjG4.jpg',
    'qgyNUfMQO_0.jpg',
    'tYGHavQaxbQ.jpg',
    'UaSKd83CXsQ.jpg',
    'ULk5WMgudSY.jpg',
    'vAxQRGqezXk.jpg',
    'vg_jQG1jtVg.jpg',
    'ySkQHAQy7y4.jpg',
    'YTNeojro-fY.jpg',
    'ZAk2WOxbLD4.jpg'
];

$icons = [
    "fas fa-air-freshener",
    "fas fa-adjust",
    "fab fa-algolia",
    "fas fa-allergies",
    "fas fa-american-sign-language-interpreting",
    "fab fa-android",
    "fas fa-archive",
    "fab fa-artstation",
    "fas fa-atom",
    "fas fa-baby",
];

$factory->define(
    App\User::class,
    static function (Faker $faker) use ($images) {
        return [
            'name' => $faker->unique()->name,
            'email' => $faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'avatar' => $images[$faker->numberBetween(0, count($images) - 1)],
            'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
            'remember_token' => Str::random(10),
        ];
    }
);

$factory->define(
    App\ChannelSetting::class,
    static function (Faker $faker) {
        return [
            'channel_id' => User::inRandomOrder()->first()->id,
            'about' => $faker->realText(200),
            'background_image' => storage_path('app/img/') . 'channel-banner.png'
        ];
    }
);

$factory->define(
    App\Subscription::class,
    static function (Faker $faker) {
        return [
            'author_id' => User::inRandomOrder()->first()->id,
            'user_id' => User::inRandomOrder()->first()->id,
        ];
    }
);

$factory->define(
    App\Video::class,
    static function (Faker $faker) use ($images) {
        return [
            'id' => Uuid::generate()->string,
            'author_id' => User::inRandomOrder()->first()->id,
            'category_id' => \App\Category::inRandomOrder()->first()->id,
            'title' => $faker->realText(25),
            'description' => $faker->realText(200),
            'duration' => $faker->numberBetween(1, 6000),
            'extension' => 'mp4',
            'location' => 'videos/seed.mp4',
            'thumbnail' => $images[$faker->numberBetween(0, count($images) - 1)],
            'frame_rate' => 15,
            'mime_type' => 'video/mp4',
            'views_count' => $faker->numberBetween(1, 1000000),
        ];
    }
);

$factory->define(
    App\Category::class,
    static function (Faker $faker) use ($icons) {
        return [
            'title' => $faker->word,
            'icon' => $icons[$faker->numberBetween(0, count($icons) - 1)]
        ];
    }
);

$factory->define(
    App\VideoVote::class,
    static function (Faker $faker) {
        return [
            'video_id' => Video::inRandomOrder()->first()->id,
            'author_id' => User::inRandomOrder()->first()->id,
            'value' => $faker->boolean ? 1 : 0,
        ];
    }
);

$factory->define(
    App\VideoSetting::class,
    static function (Faker $faker) {
        return [
            'video_id' => Video::inRandomOrder()->first()->id,
            'private' => $faker->boolean ? 1 : 0,
            'allow_comments' => $faker->boolean ? 1 : 0,
            'allow_votes' => $faker->boolean ? 1 : 0,
        ];
    }
);

$factory->define(
    App\Comment::class,
    static function (Faker $faker) {
        return [
            'video_id' => Video::inRandomOrder()->first()->id,
            'author_id' => User::inRandomOrder()->first()->id,
            'body' => $faker->realText(100),
        ];
    }
);

$factory->define(
    App\CommentVote::class,
    static function (Faker $faker) {
        return [
            'comment_id' => Comment::inRandomOrder()->first()->id,
            'author_id' => User::inRandomOrder()->first()->id,
            'value' => $faker->boolean ? 1 : 0,
        ];
    }
);

$factory->define(
    App\Views::class,
    static function (Faker $faker) {
        return [
            'video_id' => Video::inRandomOrder()->first()->id,
            'author_id' => User::inRandomOrder()->first()->id,
            'show_in_history' => $faker->boolean,
        ];
    }
);
