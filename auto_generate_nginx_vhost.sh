# sudo chown root.root <my script>
# sudo chmod 4755 <my script>

#!/bin/bash
lower_case=$(echo $1 | awk '{print tolower($0)}' )
rm /etc/nginx/sites-available/lms-sso-$lower_case
rm /etc/nginx/sites-enabled/lms-sso-$lower_case
cp /etc/nginx/sites-available/lms-sso-source /etc/nginx/sites-available/lms-sso-$lower_case
sed -i -- "s/source/$lower_case/g" /etc/nginx/sites-available/lms-sso-$lower_case
ln -s /etc/nginx/sites-available/lms-sso-$lower_case /etc/nginx/sites-enabled/lms-sso-$lower_case

rm /etc/nginx/sites-available/pintaria-$lower_case
rm /etc/nginx/sites-enabled/pintaria-$lower_case
cp /etc/nginx/sites-available/pintaria-source /etc/nginx/sites-available/pintaria-$lower_case
sed -i -- "s/source/$lower_case/g" /etc/nginx/sites-available/pintaria-$lower_case
ln -s /etc/nginx/sites-available/pintaria-$lower_case /etc/nginx/sites-enabled/pintaria-$lower_case

rm /etc/nginx/sites-available/affiliates-$lower_case
rm /etc/nginx/sites-enabled/affiliates-$lower_case
cp /etc/nginx/sites-available/affiliates-source /etc/nginx/sites-available/affiliates-$lower_case
sed -i -- "s/source/$lower_case/g" /etc/nginx/sites-available/affiliates-$lower_case
ln -s /etc/nginx/sites-available/affiliates-$lower_case /etc/nginx/sites-enabled/affiliates-$lower_case

service nginx restart

certbot --nginx -d $lower_case.lms-sso.harukaeduapps.net -n
certbot --nginx -d $lower_case.pintaria.harukaeduapps.net -n
certbot --nginx -d $lower_case.staging2.heduaffiliates.com -n
certbot --nginx -d heduaffiliates.$lower_case.staging2.heduaffiliates.com -n