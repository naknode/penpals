<?php

$factory->define(App\Languages::class, function ($faker) {
    $fluency = ['beginner', 'intermediate', 'advanced', 'fluent', 'native', 'conversational', 'working fluency', 'professional fluency'];
    $type = ['learning', 'speaks'];

    return [
        'user_id' => function () {
            return factory(\App\User::class)->create()->id;
        },
        'language_name' => 'English',
        'fluency' => $fluency[$faker->numberBetween(0, 7)],
        'type' => $type[$faker->numberBetween(0, 1)],
    ];
});
