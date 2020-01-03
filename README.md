# profile-management
A simple profile management app to bootstrap your project. Includes registration, account activation and password recovery using functional programming.

# Setup
# Database Credentials
Go to private/config.php
<br>
```php
define('DB_HOST', '');    //db host 

define('DB_USER', '');    //db username

define('DB_PASS', '');    //db password

define('DB_NAME', '');    //db name
```
# PHPMailer settings
Go to private/functions.php
<br>
```php
send_email($options = []) { ... }
```
for more details, https://github.com/PHPMailer/PHPMailer
