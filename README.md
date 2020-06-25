
README

Vega CMS

This package is build on top of Laravel. 

It provides:

    Administration user interface.
    Automated creation of routes with authorizations.
    Reusable model search service.
    File management service.
    Functionality for using locales.
    Functionality for manage phrases.
    UI menu builder.
    UI page builder.
    Smart presentation of data through Vue components.
    Automated tests
    
Requirements:

        php: ^7.2.5

        laravel/framework: ^7.0

Getting Started: 

    composer require vegacms/cms
 
    php artisan integrate:vegacms-cms

Commands:

    php artisan integrate:vegacms-cms - integrates Vega CMS to existing laravel project 
    
    php artisan integrate:vegacms-cms-testing - integrates Vega CMS tests to existing laravel project

    php artisan generate:group {title} {--description=} - generates a group

    php artisan destroy:group {title} - destroys a group

    php artisan generate:route {url} {method} {action} {name} {route_type=web} {action_type=front} - generates a route

    php artisan destroy:route {name} - destroys a route

    php artisan attach:route-to-group {name} {title} - makes the route accessible for the group members

    php artisan detach:route-from-group {name} {title} - removes route accessibility for the group members

License:

    Vega CMS is open-sourced software licensed under the MIT license.
