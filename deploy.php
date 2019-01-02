<?php
namespace Deployer;

$dotenv = new \Dotenv\Dotenv(__DIR__);
$dotenv->load();

require 'recipe/laravel.php';
require 'recipe/sentry.php';

// Configuration
set('repository', 'git@bitbucket.org:harukaedudev/pintaria.git');
set('git_tty', true); // [Optional] Allocate tty for git on first deployment
add('shared_files', ['.env']);
add('shared_dirs', []);
add('writable_dirs', []);
set('composer_options', '{{composer_action}} --verbose --prefer-dist --no-progress --no-interaction --optimize-autoloader');
set('keep_releases', 3);
set('allow_anonymous_stats', false);

// Hosts
host('develop-3')
    ->hostname('104.199.140.144')
    ->stage('develop')
    ->set('branch', 'develop-3.0.0')
    ->user('deploy')
    ->forwardAgent()
    ->set('deploy_path', '/home/deploy/htdocs/pintaria-3');

host('staging-3')
    ->hostname('35.194.143.220')
    ->stage('staging')
    ->set('branch', 'release/' . trim(file_get_contents('VERSION')))
    ->user('deploy')
    ->forwardAgent()
    ->set('deploy_path', '/home/deploy/htdocs/pintaria-3-staging');

host('production-3')
    ->hostname('35.194.143.220')
    ->stage('production')
    ->set('branch', 'master')
    ->user('deploy')
    ->forwardAgent()
    ->set('deploy_path', '/home/deploy/htdocs/pintaria-3');

host('104.199.140.144')
    ->stage('develop')
    ->set('branch', 'develop')
    ->user('deploy')
    ->forwardAgent()
    ->set('deploy_path', '/home/deploy/htdocs/pintaria');

host('35.194.143.220/staging')
    ->stage('staging')
    ->set('branch', 'release/' . trim(file_get_contents('VERSION')))
    ->user('deploy')
    ->forwardAgent()
    ->set('deploy_path', '/home/deploy/htdocs/pintaria-staging');

host('35.194.143.220/production')
    ->stage('production')
    ->set('branch', 'master')
    ->user('deploy')
    ->forwardAgent()
    ->set('deploy_path', '/home/deploy/htdocs/pintaria');

set('sentry', [
    'organization' => 'harukaedu', 
    'project' => 'pintaria', 
    'token' => getenv('SENTRY_TOKEN'),
    'version' => trim(file_get_contents('VERSION'))
]);

// Tasks
desc('Restart PHP-FPM service');
task('php-fpm:restart', function () {
    // The user must have rights for restart service
    // /etc/sudoers: username ALL=NOPASSWD:/bin/systemctl restart php-fpm.service
    run('sudo /usr/sbin/service php7.0-fpm reload');
});

task('frontend-dependency', function () {
    run('cd {{release_path}} && npm install');
    run('cd {{release_path}} && npm run production');
});

desc('Remove the configuration cache file');
task('artisan:config:clear', function () {
    run('cd {{current_path}} && php artisan config:clear');
});

desc('Generate Sitemap after deploying');
task('sitemap:generate', function () {
    run('cd {{current_path}} && php artisan sitemap:generate');
});

// Ini tidak akan menghapus/menimpa data yang sudah ada
desc('Seed the database with records with VoyagerDatabaseSeeder');
task('seed-voyager', function () {
    run('cd {{current_path}} && php artisan db:seed --class=VoyagerDatabaseSeeder --force');
});

after('deploy:symlink', 'php-fpm:restart');
after('php-fpm:restart', 'deploy:sentry');
after('artisan:migrate', 'frontend-dependency');

// Force config cache clear
after('cleanup', 'artisan:config:clear');

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.
before('deploy:symlink', 'artisan:migrate');

// Sow the Voyager seed
after('success', 'seed-voyager');

// Generate Sitemap
//after('seed-voyager', 'sitemap:generate');

task('restart:supervisor', function() {
    run('sudo /usr/sbin/service supervisor reload');
});
// Restart queue to get latest code updates
after('seed-voyager', 'restart:supervisor');