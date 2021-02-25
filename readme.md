# Loop Events User documentation

## 👔 Users
1. Copy `loop-events` folder to `wp-content/plugins` or upload `loop-events.zip` from *Admin dashboard -> Plugins*
2. Install and activate **Advanced Custom Fields** plugin.
3. Activate **Loop Events** plugin.
4. **Import** sample data by running `wp loop-events import`.
5. You can **import** custom json data from *Admin dashboard -> Settings -> Loop Events settings*
6. In order to **export** data use *Export existing data* button from *Admin dashboard -> Settings -> Loop Events settings* to download data as a json file.
7. You can **export** data by checking `http://site.dom/wp-admin/options-general.php?page=loop-events-settings&export=1` to get events in a json format.





## 💻 Developers

1. Copy whole project in `wp-content/plugins`
2. Run `composer install`
3. Run `composer dump-autoload`
4. Run `npm install`
5. Run `gulp` to generate assets.
6. Activate plugin from WordPress admin dashboard.


### Notes
* You can see all available **Gulp tasks**  by running `gulp --tasks`.

* In case you see errors about `gulp-cli`, please run `npm install --global gulp-cli`.
* In case you see errors about node-sass, please  run `npm rebuild node-sass` and if it is not fixing the issue, you may need to check [this issue on github](https://github.com/sass/node-sass/issues/1980).