
# Vega CMS PHP Package based on Laravel Framework. 

## It provides:

   Administration user interface.
   Automated creation of routes with authorizations.
   Reusable model search service.
   File management service.
   Translation functionality and URL locales.
   Menu builder.
   Page builder.
   Smart data presentation through Vue.js components.
   Easy to use utilities.
   Automated tests.
    
## Requirements:

    php: ^7.2.5

    laravel/framework: ^8.0

## Getting Started: 

    composer require vegacms/cms
 
    php artisan integrate:vegacms-cms

    php artisan db:seed

    browser: {your host}/en/login

## Commands:

    php artisan integrate:vegacms-cms - integrates Vega CMS to existing laravel project 
    
    php artisan integrate:vegacms-cms-testing - integrates Vega CMS tests to existing laravel project

    php artisan generate:group {title} {--description=} - generates a group

    php artisan destroy:group {title} - destroys a group

    php artisan generate:route {url} {method} {action} {name} {route_type=web} {action_type=front} - generates a route

    php artisan destroy:route {name} - destroys a route

    php artisan attach:route-to-group {name} {title} - makes the route accessible for the group members

    php artisan detach:route-from-group {name} {title} - removes route accessibility for the group members
    
## For more information see:   
    
[Documentation](https://vegacms.com)   
[Packagist](https://packagist.org/packages/vegacms/cms)

## Contributors:

[Nedyalko Raikov](https://github.com/NRaykov)

## License:

Vega CMS Package is open-sourced software licensed under the MIT license. Please see [License file](LICENSE).
