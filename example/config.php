<?php

return [
    'strategy' => [
        [
            'method' => 'User',
            'params' => [10],
            'strategy' => [
                [
                    'method' => 'Comment',
                    'params' => [20],
                ],
                [
                    'method' => 'Like',
                ],
            ],
        ],
        [
            'method' => 'Finish',
        ],
    ],
];
