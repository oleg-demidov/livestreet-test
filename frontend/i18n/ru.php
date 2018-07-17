<?php

return [
    'admin' => [
        'menu' => [
            'title' => 'Тесты',
            'settings' => 'Настройки'
        ],
        'test' => [
            'button_add' => [
                'text' => 'Добавить тип тестов'
            ],
            'notices' => [
                'add_success' => 'Тип тестов успешно добавлен'
            ],
            'validate_errors' => [
                'code_not_uniq' => 'Тип тестов с таким кодом уже существует',
                'category_type' => 'Не могу создать тип категорий'
            ]
        ],
        'bilet' => [
            'notices' => [
                'save_success' => 'Билет успешно сохранен',
                'no_test_find' => 'Тест не найден',
                'no_bilet_find' => 'Билет не найден'
            ],
            'error' => [
                'no_bilet' => 'Билет не найден'
            ]
        ]
    ],
    'main_menu' => [
        'tests' => [
            'text' => 'Обучение'
        ]
    ],
    'panel' => [
        'bilets' => [
            'text' => 'Билеты'
        ],
        'categories' => [
            'text' => 'Категории'
        ],
        'bilet' => [
            'button_start' => 'Старт',
            'count_ask' => 'количество'
        ]
    ],
    'bilet' => [
        'error' => [
            'no_find' => 'Билет не найден'
        ]
    ],
    'ask' => [
        'error' => [
            'no_find' => 'Вопрос не найден'
        ]
    ]
];