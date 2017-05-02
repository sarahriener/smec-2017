# Run the application

## .. for the first time (setup)
npm install

## .. in development
php artisan serve
gulp watch (if that doesn\'t work, try installing gulp globally npm install -g gulp)

# Development guidelines

## Frontend

### View Inheritance

Every view in /resources/views should extend the base template from /resources/views/layouts/ and should define a title.

### Styling

Use /resources/assets/sass/app.scss as base component - this is the only file converted to CSS.