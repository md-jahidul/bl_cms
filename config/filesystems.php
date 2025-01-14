<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DRIVER', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Default Cloud Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Many applications store files both locally and in the cloud. For this
    | reason, you may specify a default "cloud" driver here. This driver
    | will be bound as the Cloud disk implementation in the container.
    |
    */

    'cloud' => env('FILESYSTEM_CLOUD', 's3'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3", "rackspace"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
        ],
        'cs-selfcare' => [
            'driver' => 'local',
            'root' => storage_path('app/public/cs'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
        ],

        'internal' => [
            'driver' => 'local',
            'root' => env('UPLOAD_BASE_PATH', '/src/uploads'),
            'url' => env('APP_URL') . '/uploads',
            'visibility' => 'public',
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
        ],
        'sftp' => [
            'driver' => 'sftp',
            'host' => env('FTP_HOST'),
            'username' => env('FTP_USERNAME'),
            'password' => env('FTP_PASSWORD'),

            // Settings for SSH key based authentication...
            //'privateKey' => '/path/to/privateKey',
            //'password' => 'encryption-password',

            // Optional SFTP Settings...
            'port' => 22,
            // 'root' => '',
            // 'timeout' => 30,
        ]

    ],
    'paths' => [
        'test' => 'test',
        'task_attachments' => 'task_attachments',
        'monthly_update_attachments' => 'monthly_update_attachments',
    ],

    'file_base_url' => env('FILE_BASE_URL', '/uploads/'),
    'media_storage_location' => env('MEDIA_STORAGE_LOCATION', 'http://192.168.0.107:6080/uploads')

];
//http://192.168.0.107:8080
