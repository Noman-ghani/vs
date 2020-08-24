# Project Configuration

<p>
    Before moving towards configuration, make sure the following prerequisites are met.
    
    - PHP 7
    - MySQL 5.6 or higher
    - composer
    - npm
</p>



## Open terminal and enter the following command:
<p><code>mv .env.example .env</code></p>

<p><code>composer install</code></p>

<p><code>npm install</code></p>

<p><code>php artisan key:generate</code></p>

<p>The above command will update the `APP_KEY` variable in .env file</p>

<p><code>php artisan config:cache</code></p>

<p><code>php artisan serve</code></p>

<p>Open your browser and enter http://localhost:8000</p>