
# Introduction

  

The **zekini/laravel-generics** package allows us to store our generic classes in a package so we can reuse them

  

**Installation**

    composer require zekini/laravel-generics

    sail artisan vendor:publish --tag=zekini-config
    sail artisan vendor:publish --provider="Spatie\Activitylog\ActivitylogServiceProvider" --tag="activitylog-migrations"
    sail artisan vendor:publish --provider="Spatie\Activitylog\ActivitylogServiceProvider" --tag="activitylog-config"
    sail artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"

    sail artisan migrate

**Usage**

To reset password in a local database environment

    sail artisan local:password-reset --password=password

To generate or update the code checkers config files:

    sail artisan vendor:publish --tag=zekini-config --force

To add another generic command

    sail artisan generic:command TestCommand

To add another generic helper

    sail artisan generic:helper TestHelper

**Available Helpers**

    use Zekini\Generics\Helpers\ArrayHelper;
    use Zekini\Generics\Helpers\ArrayToObjectHelper;
    use Zekini\Generics\Helpers\CsvHelper;
    use Zekini\Generics\Helpers\EnvironmentHelper;
    use Zekini\Generics\Helpers\FileHelper;
    use Zekini\Generics\Helpers\FlashHelper;
    use Zekini\Generics\Helpers\ForeignKeyHelper;
    use Zekini\Generics\Helpers\HttpHelper;
    use Zekini\Generics\Helpers\LoggingHelper;
    use Zekini\Generics\Helpers\StringHelper;
    use Zekini\Generics\Helpers\UIHelper;

**Standard Packages**

    https://github.com/arcanedev/log-viewer
    https://github.com/barryvdh/laravel-dompdf
    https://github.com/laravel/jetstream
    https://github.com/livewire/livewire
    https://github.com/mediconesystems/livewire-datatables
    https://github.com/spatie/laravel-activitylog
    https://github.com/spatie/laravel-permission
    https://github.com/maatwebsite/excel
    https://github.com/spatie/laravel-backup
    https://github.com/spatie/laravel-schedule-monitor

**Standard Dev Packages**

    https://github.com/barryvdh/laravel-debugbar
    https://github.com/nunomaduro/larastan
    https://github.com/protoqol/prequel
    https://github.com/symplify/easy-coding-standard
    https://github.com/vimeo/psalm

**Removed to be re-added once conflict is resolved**
        "spatie/laravel-backup"
        "spatie/laravel-schedule-monitor"
        "arcanedev/log-viewer"