# Run the application

composer install

## .. for the first time (setup)
node.js download
npm install (installs also gulp!)
gulp  --production

## .. in development
php artisan serve

## compile css and js file

# Run all tasks (--production will minify all CSS and JavaScript)
gulp OR gulp --production

#watch changes
gulp watch (if that doesn\'t work, try installing gulp globally npm install -g gulp)

# Development guidelines

## Frontend

### View Inheritance

Every view in /resources/views should extend the base template from /resources/views/layouts/ and should define a title.

### Styling

Use /resources/assets/sass/app.scss as base component - this is the only file converted to CSS.

## Database

Always use current configuration from .env.example.