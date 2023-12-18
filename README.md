# By the Pixel Laravel Base
This repository serves as a foundation to start a new Laravel project.

## Features
- Laravel Nova CMS
- Laravel 9.x
- Blog Management
- Responsive images
- Meta data helpers
- Shopify integration

## Initial Laravel project setup
- Fork this project
- Find every instance of the string `btp-laravel-base` and replace with relevant string
- Delete everything from this line up, and update project documentation below as needed

\----------------------------------------------------------------------------------------------------


# *PROJECT NAME GOES HERE*

## Technology

* Ubuntu 18.04
* PHP 8.1.^
* Apache 2.4
* Mysql 8.0^
* NodeJS LTS 20.9.0
* Webpack 4^
* Redis 3.7^

## Application

- Backend: Laravel 9.x
- Frontend: Laravel Mix, @bythepixel/component-loader 0.5^

## Step 1 - Setup Backend

- Navigate to project directory
- Configure environment:  `cp .env.local.example .env` - customize if needed
- Install php dependencies: `composer install`
    - You will be prompted for [Nova](https://nova.laravel.com/) credentials which can be found in the BTP password vault. These should not be stored or committed to the repository.
- Set application key: `php artisan key:generate`
- Run database migrations: `./vendor/bin/sail artisan migrate`
- Seed the database: `./vendor/bin/sail artisan db:seed`
- Setup Nova admin tool and its plugins:
    - `php artisan nova:publish`
    - `php artisan vendor:publish --provider="Bythepixel\\NovaTinymceField\\FieldServiceProvider"`

## Step 2 - Setup Frontend

- Use the latest Node LTS version (v20.9.0): `nvm use 20.9.0` (assuming NVM is installed)
- Install frontend dependencies: `npm install`
- Build assets for Development: `npm run dev`
- Build assets for Production: `npm run prod`

### Working in Development
When working locally, run `npm run watch` to have Webpack automatically compile your frontend assets after each file change.

# Development Topics

## Creating alias to boot containers
For more concise interactions with Sail, in your `.bashrc`, `.zshrc`, or whatever `rc` file your terminal of choice uses, add the following alias:

```
alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'
```

After adding the alias, in your terminal, run:

```
source /path/to/your/rc/file
```

Now, instead of `./vendor/bin/sail <command>` each time you want to run a Sail command, you can use `sail <command>`.

## PHP Linting

Laravel projects use `squizlabs/php_codesniffer` to lint PHP code.

### Analyzing code

To only report formatting errors, run:

```
composer sniff
```

### Autofixing code

To automatically fix linting errors, run:

```
composer sniff-fix
```

## Database Seeding
The database is seeded with the base `./vendor/bin/sail artisan db:seed` command. Only seeders found in `DatabaseSeeder.php` will be automatically executed.

### Normal Seeders
- Traditional Laravel seeders
- Seeders contain the data in PHP objects/arrays in the seeder class itself, allowing the use of complex logic
- Useful for system-like seeders that will not be managed via CMS (i.e. `FormSeeder` or `UserSeeder`)

### Source Seeders
- Read their data from json files located at `/database/seeders/Source`
- Should be used when dealing with data that is managed via the CMS and must be propagated to all environments
- Json source files can be automatically generated from an existing database using the
[Build Seeder Source Files](#build-seeder-source-files) Artisan command

### Building Seeder Source Files

```
./vendor/bin/sail artisan seeder:build {table?}
```

- Generates .json files for all relevant tables (or as passed in by the table parameter)
- This command will typically be executed on a production environment
- Once files have been generated, they can be committed to the repository, allowing new environments to stay up-to-date.
- If executed on a remote environment, `scp` is recommended to copy the JSON files:

```
scp -rp ./database/seeders/Source <user>@<public_ip>:/srv/www/database/seeders/Source
```

### When not to use source seeders

Large tables with tons of data should _never_ have a source seeder (i.e. a form submissions table).

### Mock seeders
- Creates new records in the DB with randomized data
- Useful for performance benchmarks and test UI with larger datasets
- Execute by class name:

```
./vendor/bin/sail artisan db:seed --class=Database\\Seeders\\Mock\\NameOfSeeder
```

## Frontend

### Generating Critical Styles

```
npm run critical-css
```

Critical Styles are CSS classes that are inlined directly onto the webpage, allowing the browser to style content without waiting on an extra network request. Using this technique can make the website appear faster to new visitors, and improve the site's overall page speed index (an important factor in search engine rankings).

We have a semi-automated process for generating critical styles, provided by the NPM package, `laravel-mix-criticalcss`. Configuration can be found in `webpack.mix.js`. It does this by creating a headless browser instance, rendering a URL, and analyzing it for any CSS classes found "above the fold" (the part of the page that is visible before scrolling).

`laravel-mix-criticalcss` will automatically generate critical styles for any page listed in its configuration. These files will be saved to the directory `public/css-critical`, and should be committed to git before deploying, as our current process doesn't allow them to be generated in our deployment pipeline.

### Rendering critical styles

There are two ways to add critical styles to the rendered webpage:

1. **Match the filename to a Laravel route name:** By naming the generated CSS file to match the named routes in Laravel's router, the styles will automatically be added to the page.

    **Examples:**
    - The file `public/css-critical/home.css` will be applied to a route named `'home'`.
    - The file `public/css-critical/blog.index.css` will be applied to the route named `'blog.index'`.
2. **Use the 'critical-styles' Blade Stack:** We can also push any styles onto the page with the following syntax:
    ```blade
    @push('critical-styles')
        {!! inlineCssFile('/css-critical/critical-styles.css') !!}
    @endpush
    ```
    This is a little more verbose, but you can use it to share critical styles across different named routes.

### Maintaining Critical Styles

Since the critical styles are committed to git, we need to manually run this task from time to time to keep them up to date. If the critical styles aren't up to date with the main stylesheets, some elements might not appear correctly.

### Common Pitfalls with Critical Styles
- Seeded content, such as blog posts, may not exist in every developer's local database. Before running the command, you may need to update some URLs to match those found on your local instance.
- Errors aren't very helpful, and a page that doesn't render properly can be hard to pin-point. If the build command results in an error, you may need to comment out some URLs in `webpackmix.webpack.js` to help narrow down the culprit. Seeded content is generally a good place to check.
- Watch the file size of the generated critical css files. These styles get added directly to the page, which means they increase the total size of the HTML file. A large critical CSS file can sometimes negatively affect the page speed. Generally, the increased page size is offset by the faster rendering the technique allows, but it's still a good idea to check up on these files and make sure they aren't larger than expected.
- If page-specific styles are applied using a class name used on other pages, those page-specific styles can be included along with the critical styles on the wrong page. The best way to avoid page-specific styles bleeding across pages is to use unique class names to apply these styles. Sass's `@extend` method or BEM-style modifiers are good methods to use.
