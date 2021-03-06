###TMY SETUP

1. Install mysql and add:

  `export PATH="/usr/local/mysql/bin:$PATH"`
  
  to your bash_profile ( in terminal: `nano ~.bash_profile`)
  
2. Create a Sites folder in your `/users/username/` directory

3. Make a `username.conf` file and put it in `/etc/apache2/users` with permissions `-rw-r-r` or `sudo chmod 644`

4. Open `/etc/apache2/httpd.conf` and make sure these modules are NOT commented out:

  `LoadModule authz_core_module libexec/apache2/mod_authz_core.so`
  
  `LoadModule authz_host_module libexec/apache2/mod_authz_host.so`
  
  `LoadModule userdir_module libexec/apache2/mod_userdir.so`
  
  `LoadModule include_module libexec/apache2/mod_include.so`
  
  `LoadModule rewrite_module libexec/apache2/mod_rewrite.so`
  
  `LoadModule php5_module libexec/apache2/libphp5.so`
  
  `Include /private/etc/apache2/extra/httpd-userdir.conf`
  
5. Open `/etc/apache2/extra/httpd-userdir.conf` and uncomment:
  
  `Include /private/etc/apache2/users/*.con`
  
6. Restart Apache, in terminal `sudo apachectl restart`, if apache is not running `sudo apachectl start` and now your directory for anything in your Sites folder will be `http://localhost/~username`

7. Open `httpd.conf` file and make sure `AllowOverride None` is set to `AllowOverride All`

8. Navigate to your `~username/sites` folder and `git clone https://github.com/kevin-wynn/TMY.git`

9. Navigate to your `~username/sites` folder and in the terminal do `npm install -g grunt-cli` to install the grunt client

10. Then run `npm install` to install project dependencies

11. Navigate to `http://localhost.com/~username/db_setup.php` and run the database setup.

12. Now you're all set up, please note, anytime you're working with SASS or JS run `grunt watch` in your terminal in the directory to actively compile your styles and run JS Lint to make sure nothing breaks
