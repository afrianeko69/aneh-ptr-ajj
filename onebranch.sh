#!/bin/bash
branch_lms_sso='master'
lower_case=$(echo $1 | awk '{print tolower($0)}' )

ssh deploy@35.197.156.169 -oStrictHostKeyChecking=no $h uptime "
cd ~/htdocs/pintaria/
cd source
git pull origin master
cd ..
rm -fR $1
rm -fR $lower_case
cp source $1 -R
cd $1
git pull
git checkout $1
rm -fR storage
cp /home/deploy/htdocs/pintaria/shared/.env /home/deploy/htdocs/pintaria/$1/.env
sed -i -- 's/pintaria.harukaeduapps.net/$lower_case.pintaria.harukaeduapps.net/g' /home/deploy/htdocs/pintaria/$1/.env
sed -i -- 's/lms-sso.harukaeduapps.net/$lower_case.lms-sso.harukaeduapps.net/g' /home/deploy/htdocs/pintaria/$1/.env
sed -i -- 's/DB_DATABASE=pintaria/DB_DATABASE=$1/g' /home/deploy/htdocs/pintaria/$1/.env
ln -s /home/deploy/htdocs/pintaria/shared/storage /home/deploy/htdocs/pintaria/$1/storage
composer install --verbose --prefer-dist --no-progress --no-interaction --optimize-autoloader
php artisan cache:clear
npm install
npm run production

cd ~/htdocs/lms-sso/
cd source
git pull origin master
cd ..
rm -fR $1
rm -fR $lower_case
cp source $1 -R
cd $1
git pull
git checkout $branch_lms_sso
rm -fR storage
cp /home/deploy/htdocs/lms-sso/shared/.env /home/deploy/htdocs/lms-sso/$1/.env
sed -i -- 's/staging.pintaria.com/$lower_case.pintaria.harukaeduapps.net/g' /home/deploy/htdocs/lms-sso/$1/.env
sed -i -- 's/lms-sso.harukaeduapps.net/$lower_case.lms-sso.harukaeduapps.net/g' /home/deploy/htdocs/lms-sso/$1/.env
sed -i -- 's/DB_DATABASE=lmsums/DB_DATABASE=$1/g' /home/deploy/htdocs/pintaria/$1/.env
ln -s /home/deploy/htdocs/lms-sso/shared/storage /home/deploy/htdocs/lms-sso/$1/storage
composer install --verbose --prefer-dist --no-progress --no-interaction --optimize-autoloader --no-dev
php artisan cache:clear

cd ~/htdocs/pintaria/
mv $1 $lower_case
cd ~/htdocs/lms-sso/
mv $1 $lower_case

PGPASSFILE=~/.pgpass psql -h 10.148.0.2 lmsums -c \"
UPDATE pg_database SET datallowconn = 'false' WHERE datname = '$1';
ALTER DATABASE \\\"$1\\\" CONNECTION LIMIT 1;
SELECT pg_terminate_backend(pid)
FROM pg_stat_activity
WHERE datname = '$1';\"

dropdb $1
createdb $1

pg_dump -c lmsums | psql $1

PGPASSFILE=~/.pgpass psql -h 10.148.0.2 lmsums -c \"
UPDATE oauth_clients SET redirect = 'https://$lower_case.pintaria.harukaeduapps.net/oauth/callback'
WHERE id = '7';\"

PGPASSFILE=~/.pgpass psql -h 10.148.0.2 lmsums -c \"
UPDATE oauth_clients SET redirect = 'https://heduaffiliates.$lower_case.staging2.heduaffiliates.com/oauth/callback'
WHERE id = '6';\"

mysql -h 104.199.166.208 -e 'DROP DATABASE IF EXISTS \`$1\`'
mysql -h 104.199.166.208 -e 'CREATE DATABASE \`$1\`'
mysqldump -h 104.199.166.208 pintaria --set-gtid-purged=OFF | mysql -h 104.199.166.208 $1
mysql -h 104.199.166.208 $1 -e 'UPDATE affiliates SET domain_url = \"$lower_case.staging2.heduaffiliates.com\" WHERE id = 1;'
mysql -h 104.199.166.208 $1 -e 'UPDATE affiliates SET logged_in_domain_url = \"heduaffiliates.$lower_case.staging2.heduaffiliates.com\" WHERE id = 1;'

sudo -n ~/auto_generate_nginx_vhost.sh $lower_case
"
