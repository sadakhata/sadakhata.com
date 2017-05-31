# sadakhata.com Website!

Complete skeleton of http://www.sadakhata.com

## License

> The contents of this file are subject to the Mozilla Public License Version 1.1 (the "License"); you may not use this file except in compliance with the License. You may obtain a copy of the License at http://www.mozilla.org/MPL/

##  Installation

+ Make a file `.env.php` in the root, Where composer.json located at.
Put this content with appropriate settings:

```
<?php

/**
 * Set up Credential informetion which we don't want to share
  */
 return array(

	'FACEBOOK_APP_ID'                => 'YOUR_FACEBOOK_APP_ID',

	'FACEBOOK_APP_SECRET'            => 'YOUR_FACEBOOK_APP_SECRET',

	'SADAKHATA_ADMIN_USERNAME'       => 'YOUR_USERNAME',

	'SADAKHATA_ADMIN_PASSWORD'       => 'YOUR_PASSWORD',

	'DB_HOST'                        => 'YOUR_DATABASE_HOST_ADDRESS',

	'DB_DATABASE'                    => 'YOUR_DATABASE_NAME',

	'DB_USERNAME'                    => 'YOUR_DATABASE_USERNAME',

	'DB_PASSWORD'                    => 'YOUR_DATABASE_PASSWORD',

	'FACEBOOK_CHATBOT_ACCESS_TOKEN'  => 'YOUR_FACEBOOK_CHATBOT_ACCESS_TOKEN',

	'FACEBOOK_CHATBOT_VERIFY_TOKEN'  => 'YOUR_FACEBOOK_CHATBOT_VERIFY_TOKEN',

	'FACEBOOK_CHATBOT_APP_SECRET'    => 'YOUR_FACEBOOK_CHATBOT_APP_SECRET',

);
```

+ `cd sadakhata.com`

+ `composer install`

+ `php artisan migrate`

+ `php artisan key:generate`

+ Don't forget to change permission of `app/storage` so that laravel can put file in there.
