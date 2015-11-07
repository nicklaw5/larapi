Larapi
======
A simple Laravel 5 package for handling common HTTP API responses in JSON form.

# Installation
To install the package, simply add the following to your Laravel installation's `composer.json` file:

```json
"require": {
	"laravel/framework": "5.*",
	"nicklaw5/larapi": "1.1.*"
},
```

Run `composer update` to pull the files.  Then, add the following **Service Provider** to your `providers` array in your `config/app.php` config:

```php
'providers' => array(
	...
	Larapi\LarapiServiceProvider::class,
);
```

# Usage
###Succes Responses###
Available responses:
```php
Larapi::respondOk();			// 200 HTTP Response
Larapi::respondCreated();		// 201 HTTP Response
Larapi::respondAccepted();		// 202 HTTP Response
```

**Example: Return HTTP OK**
```php
// app/Http/routes.php

Route::get('/', function()
{
	return Larapi::respondOk();
});
```

Will return:
```json
{
	"code":200,
	"status":"OK",
	"message":"success",
	"response":[]
}
```

**Example:  Return HTTP OK with Response Data**
```php
// app/Http/routes.php

Route::get('/', function()
{
	return Larapi::respondOk([
		[
			'user_id' 	=> 	1,
			'name'		=>	'John Doe',
			'email'		=>	'john@doe.com'
		],
		[
			'user_id' 	=> 	2,
			'name'		=>	'Jane Doe',
			'email'		=>	'jane@doe.com'
		]
	]);
});
```

Will return:
```json
{
	"code":200,
	"status":"OK",
	"message":"success",
	"response": [
		{
			"id":1,
			"name":"John Doe",
			"email":"john@doe.com"
		},
		{
			"id":2,
			"name":"Jane Doe",
			"email":"jane@doe.com"
		}
	]
}
```
###Error Responses###

Available responses:
```php
Larapi::respondBadRequest();		// 400 HTTP Response
Larapi::respondUnauthorized();		// 401 HTTP Response
Larapi::respondForbidden(); 		// 403 HTTP Response
Larapi::respondNotFound(); 			// 404 HTTP Response
Larapi::respondMethodNotAllowed(); 	// 405 HTTP Response
Larapi::respondInternalError();		// 500 HTTP Response
Larapi::respondNotImplemented(); 	// 501 HTTP Response
Larapi::respondNotAvailable(); 		// 503 HTTP Response
```


**Example: Return HTTP Bad Request**
```php
// app/Http/routes.php

Route::get('/', function()
{
	return Larapi::respondBadRequest();
});
```

Will return:
```json
{
	"code":400,
	"status":"Bad Request",
	"message":"error"
}
```

**Example: Return HTTP Bad Request with Custom Application Error Message**
```php
// app/Http/routes.php

Route::get('/', function()
{
	return Larapi::respondBadRequest('Invalid email address.', 4001);
});
```

Will return:
```json
{
	"code":400,
	"status":"Bad Request",
	"message":"error",
	"response":{
		"error-code":4001,
		"error-message":"Invalid email address."
	}
}
```

###Header Responses###
The HTTP response headers are also automatically assigned to the response. For example, calling ```Larapi::respondNotFound();``` will add the below to the response header:
```json
HTTP/1.1 404 Not Found
```

# Need More?
I have left this package rather basic, as my needs do not currenlty exceed what it currenlty provides. If there is anyone that would like to see this package extented, please let me know your ideas. Or, simply extend it yourself :)