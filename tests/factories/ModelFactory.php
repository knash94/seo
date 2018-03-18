<?php

$factory->define(\Knash94\Seo\Store\Eloquent\Models\HttpError::class, function(\Faker\Generator $faker) {
    return [
        'path' => $faker->word . '/' . $faker->word,
        'hits' => 1,
        'last_hit' => \Carbon\Carbon::now()
    ];
});

$factory->define(\Knash94\Seo\Store\Eloquent\Models\HttpRedirect::class, function(\Faker\Generator $faker) {
    return [
        'path' => $faker->word . '/' . $faker->word,
        'redirect_url' => $faker->url
    ];
});

$factory->define(\Knash94\Seo\Store\Eloquent\Models\HttpErrorRequest::class, function(\Faker\Generator $faker) {
    return [
        'user_agent' => $faker->userAgent,
        'ip_address' => $faker->ipv4,
        'previous_url' => $faker->url
    ];
});