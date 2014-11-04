# sadakhata.com Website!
---

License
=======

---


> The contents of this file are subject to the Mozilla Public License
  Version 1.1 (the "License"); you may not use this file except in
  compliance with the License. You may obtain a copy of the License       at http://www.mozilla.org/MPL/
  
  
##  Installation
----------------
You need to get `composer` installed in your machine.  

Go to your working directory of sadakhata.

Run This command on your terminal: `composer install`  

You need to setup some server variable and DataBase connection settings.

Make a file `.env.php` in the root, Where composer.json located at.  

Put this content with appropiate settings:

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
);
```  

Then you need to setup appropiate DataBase settings in `app/config/database` or `app/config/production/database`

You need to make proper Database Tabels in the database. Still We don't make migratation system of Laravel.