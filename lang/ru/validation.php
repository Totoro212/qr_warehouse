<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines (Russian)
    |--------------------------------------------------------------------------
    */

    'accepted'             => 'Вы должны принять :attribute.',
    'accepted_if'          => 'Вы должны принять :attribute, когда :other — :value.',
    'active_url'           => 'Значение поля :attribute не является допустимым URL.',
    'after'                => 'Значение поля :attribute должно быть датой после :date.',
    'after_or_equal'       => 'Значение поля :attribute должно быть датой после или равной :date.',
    'alpha'                => 'Значение поля :attribute может содержать только буквы.',
    'alpha_dash'           => 'Значение поля :attribute может содержать только буквы, цифры, дефисы и подчёркивания.',
    'alpha_num'            => 'Значение поля :attribute может содержать только буквы и цифры.',
    'array'                => 'Значение поля :attribute должно быть массивом.',
    'ascii'                => 'Значение поля :attribute может содержать только однобайтовые буквенно-цифровые символы.',
    'before'               => 'Значение поля :attribute должно быть датой до :date.',
    'before_or_equal'      => 'Значение поля :attribute должно быть датой до или равной :date.',
    'between'              => [
        'array'   => 'Количество элементов в поле :attribute должно быть от :min до :max.',
        'file'    => 'Размер файла в поле :attribute должен быть от :min до :max Кб.',
        'numeric' => 'Значение поля :attribute должно быть от :min до :max.',
        'string'  => 'Количество символов в поле :attribute должно быть от :min до :max.',
    ],
    'boolean'              => 'Значение поля :attribute должно быть логическим.',
    'can'                  => 'Значение поля :attribute содержит неавторизованное значение.',
    'confirmed'            => 'Значение поля :attribute не совпадает с подтверждением.',
    'contains'             => 'Значение поля :attribute не содержит обязательного значения.',
    'current_password'     => 'Неверный пароль.',
    'date'                 => 'Значение поля :attribute не является датой.',
    'date_equals'          => 'Значение поля :attribute должно быть датой, равной :date.',
    'date_format'          => 'Значение поля :attribute не соответствует формату :format.',
    'decimal'              => 'Значение поля :attribute должно содержать :decimal десятичных знаков.',
    'declined'             => 'Значение поля :attribute должно быть отклонено.',
    'declined_if'          => 'Значение поля :attribute должно быть отклонено, когда :other — :value.',
    'different'            => 'Значения полей :attribute и :other должны различаться.',
    'digits'               => 'Количество цифр в поле :attribute должно быть :digits.',
    'digits_between'       => 'Количество цифр в поле :attribute должно быть от :min до :max.',
    'dimensions'           => 'Изображение в поле :attribute имеет недопустимые размеры.',
    'distinct'             => 'Значение поля :attribute содержит дублирующее значение.',
    'doesnt_end_with'      => 'Значение поля :attribute не может заканчиваться на: :values.',
    'doesnt_start_with'    => 'Значение поля :attribute не может начинаться с: :values.',
    'email'                => 'Значение поля :attribute должно быть действительным электронным адресом.',
    'ends_with'            => 'Значение поля :attribute должно заканчиваться на: :values.',
    'enum'                 => 'Выбранное значение для :attribute некорректно.',
    'exists'               => 'Выбранное значение для :attribute некорректно.',
    'extensions'           => 'Файл в поле :attribute должен иметь одно из расширений: :values.',
    'file'                 => 'Значение поля :attribute должно быть файлом.',
    'filled'               => 'Значение поля :attribute обязательно.',
    'gt'                   => [
        'array'   => 'Количество элементов в поле :attribute должно быть больше :value.',
        'file'    => 'Размер файла в поле :attribute должен быть больше :value Кб.',
        'numeric' => 'Значение поля :attribute должно быть больше :value.',
        'string'  => 'Количество символов в поле :attribute должно быть больше :value.',
    ],
    'gte'                  => [
        'array'   => 'Количество элементов в поле :attribute должно быть :value или больше.',
        'file'    => 'Размер файла в поле :attribute должен быть :value Кб или больше.',
        'numeric' => 'Значение поля :attribute должно быть :value или больше.',
        'string'  => 'Количество символов в поле :attribute должно быть :value или больше.',
    ],
    'hex_color'            => 'Значение поля :attribute должно быть допустимым шестнадцатеричным цветом.',
    'image'                => 'Файл в поле :attribute должен быть изображением.',
    'in'                   => 'Выбранное значение для :attribute некорректно.',
    'in_array'             => 'Значение поля :attribute не существует в :other.',
    'integer'              => 'Значение поля :attribute должно быть целым числом.',
    'ip'                   => 'Значение поля :attribute должно быть действительным IP-адресом.',
    'ipv4'                 => 'Значение поля :attribute должно быть действительным IPv4-адресом.',
    'ipv6'                 => 'Значение поля :attribute должно быть действительным IPv6-адресом.',
    'json'                 => 'Значение поля :attribute должно быть допустимой JSON-строкой.',
    'list'                 => 'Значение поля :attribute должно быть списком.',
    'lowercase'            => 'Значение поля :attribute должно быть в нижнем регистре.',
    'lt'                   => [
        'array'   => 'Количество элементов в поле :attribute должно быть меньше :value.',
        'file'    => 'Размер файла в поле :attribute должен быть меньше :value Кб.',
        'numeric' => 'Значение поля :attribute должно быть меньше :value.',
        'string'  => 'Количество символов в поле :attribute должно быть меньше :value.',
    ],
    'lte'                  => [
        'array'   => 'Количество элементов в поле :attribute должно быть :value или меньше.',
        'file'    => 'Размер файла в поле :attribute должен быть :value Кб или меньше.',
        'numeric' => 'Значение поля :attribute должно быть :value или меньше.',
        'string'  => 'Количество символов в поле :attribute должно быть :value или меньше.',
    ],
    'mac_address'          => 'Значение поля :attribute должно быть допустимым MAC-адресом.',
    'max'                  => [
        'array'   => 'Количество элементов в поле :attribute не может превышать :max.',
        'file'    => 'Размер файла в поле :attribute не может быть больше :max Кб.',
        'numeric' => 'Значение поля :attribute не может быть больше :max.',
        'string'  => 'Количество символов в поле :attribute не может превышать :max.',
    ],
    'max_digits'           => 'Количество цифр в поле :attribute не может превышать :max.',
    'mimes'                => 'Файл в поле :attribute должен быть одного из типов: :values.',
    'mimetypes'            => 'Файл в поле :attribute должен быть одного из типов: :values.',
    'min'                  => [
        'array'   => 'Количество элементов в поле :attribute должно быть не менее :min.',
        'file'    => 'Размер файла в поле :attribute должен быть не менее :min Кб.',
        'numeric' => 'Значение поля :attribute должно быть не менее :min.',
        'string'  => 'Количество символов в поле :attribute должно быть не менее :min.',
    ],
    'min_digits'           => 'Количество цифр в поле :attribute должно быть не менее :min.',
    'missing'              => 'Поле :attribute должно отсутствовать.',
    'missing_if'           => 'Поле :attribute должно отсутствовать, когда :other — :value.',
    'missing_unless'       => 'Поле :attribute должно отсутствовать, если :other не равно :value.',
    'missing_with'         => 'Поле :attribute должно отсутствовать, когда присутствует :values.',
    'missing_with_all'     => 'Поле :attribute должно отсутствовать, когда присутствуют :values.',
    'multiple_of'          => 'Значение поля :attribute должно быть кратным :value.',
    'not_in'               => 'Выбранное значение для :attribute некорректно.',
    'not_regex'            => 'Формат значения в поле :attribute некорректен.',
    'numeric'              => 'Значение поля :attribute должно быть числом.',
    'password'             => [
        'letters'       => 'Значение поля :attribute должно содержать хотя бы одну букву.',
        'mixed'         => 'Значение поля :attribute должно содержать хотя бы одну заглавную и одну строчную буквы.',
        'numbers'       => 'Значение поля :attribute должно содержать хотя бы одну цифру.',
        'symbols'       => 'Значение поля :attribute должно содержать хотя бы один специальный символ.',
        'uncompromised' => 'Значение поля :attribute было найдено в утечке данных. Пожалуйста, выберите другое значение.',
    ],
    'present'              => 'Поле :attribute должно присутствовать.',
    'present_if'           => 'Поле :attribute должно присутствовать, когда :other — :value.',
    'present_unless'       => 'Поле :attribute должно присутствовать, если :other не равно :value.',
    'present_with'         => 'Поле :attribute должно присутствовать, когда присутствует :values.',
    'present_with_all'     => 'Поле :attribute должно присутствовать, когда присутствуют :values.',
    'prohibited'           => 'Поле :attribute запрещено.',
    'prohibited_if'        => 'Поле :attribute запрещено, когда :other — :value.',
    'prohibited_unless'    => 'Поле :attribute запрещено, если :other не входит в :values.',
    'prohibits'            => 'Поле :attribute запрещает присутствие :other.',
    'regex'                => 'Формат значения в поле :attribute некорректен.',
    'required'             => 'Поле :attribute обязательно для заполнения.',
    'required_array_keys'  => 'Поле :attribute должно содержать записи для: :values.',
    'required_if'          => 'Поле :attribute обязательно, когда :other — :value.',
    'required_if_accepted' => 'Поле :attribute обязательно, когда :other принято.',
    'required_if_declined' => 'Поле :attribute обязательно, когда :other отклонено.',
    'required_unless'      => 'Поле :attribute обязательно, если :other не входит в :values.',
    'required_with'        => 'Поле :attribute обязательно, когда присутствует :values.',
    'required_with_all'    => 'Поле :attribute обязательно, когда присутствуют :values.',
    'required_without'     => 'Поле :attribute обязательно, когда отсутствует :values.',
    'required_without_all' => 'Поле :attribute обязательно, когда отсутствуют :values.',
    'same'                 => 'Значения полей :attribute и :other должны совпадать.',
    'size'                 => [
        'array'   => 'Количество элементов в поле :attribute должно быть равным :size.',
        'file'    => 'Размер файла в поле :attribute должен быть равен :size Кб.',
        'numeric' => 'Значение поля :attribute должно быть равным :size.',
        'string'  => 'Количество символов в поле :attribute должно быть равным :size.',
    ],
    'starts_with'          => 'Значение поля :attribute должно начинаться с: :values.',
    'string'               => 'Значение поля :attribute должно быть строкой.',
    'timezone'             => 'Значение поля :attribute должно быть допустимым часовым поясом.',
    'unique'               => 'Такое значение поля :attribute уже существует.',
    'uploaded'             => 'Загрузка файла в поле :attribute не удалась.',
    'uppercase'            => 'Значение поля :attribute должно быть в верхнем регистре.',
    'url'                  => 'Значение поля :attribute должно быть допустимым URL.',
    'ulid'                 => 'Значение поля :attribute должно быть допустимым ULID.',
    'uuid'                 => 'Значение поля :attribute должно быть допустимым UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    */

    'custom' => [
        'name' => [
            'unique' => 'Запись с таким названием уже существует.',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    */

    'attributes' => [
        'name'         => 'название',
        'price'        => 'цена',
        'quantity'     => 'количество',
        'min_quantity' => 'минимальное количество',
        'category_id'  => 'категория',
        'sku'          => 'артикул',
        'location'     => 'расположение',
        'email'        => 'электронная почта',
        'password'     => 'пароль',
    ],

];
