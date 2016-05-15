Larapi
======
A simple Laravel 5 package for handling common HTTP API responses in JSON form.

# Installation
To install the package, simply add the following to your Laravel installation's `composer.json` file:

```json
"require": {
	"laravel/framework": "5.*",
	"nicklaw5/larapi": "2.0.*"
},
```

Run `composer update` to pull in the files. Then, add the following **Service Provider** to your `providers` array in your `config/app.php` file:

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

This:
```php
// app/Http/routes.php

Route::get('/', function()
{
	return Larapi::respondOk();
});
```

will return:
```json
{
	"code":200,
	"status":"OK",
	"message":"success"
}
```
with these headers:
```text
HTTP/1.1 200 OK
Content-Type: application/json
```

**Example: Return HTTP OK with Response Data**

This:
```php
// app/Http/routes.php

Route::get('/', function()
{
	$data = [
		['id' => 1, 'name' => 'John Doe', 'email' => 'john@doe.com'],
		['id' => 2, 'name' => 'Jane Doe', 'email' => 'jane@doe.com']
	];

	return Larapi::respondOk($data);
});
```

will return:
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
with these headers:
```text
HTTP/1.1 200 OK
Content-Type: application/json
```

**Example: Return HTTP OK with Custom Response Headers**

This:
```php
// app/Http/routes.php

Route::get('/', function()
{
	$data = [
		['id' => 1, 'name' => 'John Doe', 'email' => 'john@doe.com'],
		['id' => 2, 'name' => 'Jane Doe', 'email' => 'jane@doe.com']
	];

	$headers = [
		'Header-1' => 'Header-1 Data',
		'Header-2' => 'Header-2 Data'
	];

	return Larapi::respondOk($data, $headers);
});
```
will return:
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
with these headers:
```text
HTTP/1.1 200 OK
Content-Type: application/json
Header-1: Header-1 Data
Header-2: Header-2 Data
```

###Error Responses###

Available responses:
```php
Larapi::respondBadRequest();		// 400 HTTP Response
Larapi::respondUnauthorized();		// 401 HTTP Response
Larapi::respondForbidden(); 		// 403 HTTP Response
Larapi::respondNotFound(); 			// 404 HTTP Response
Larapi::respondMethodNotAllowed(); 	// 405 HTTP Response
Larapi::respondConflict(); 			// 409 HTTP Response
Larapi::respondInternalError();		// 500 HTTP Response
Larapi::respondNotImplemented(); 	// 501 HTTP Response
Larapi::respondNotAvailable(); 		// 503 HTTP Response
```


**Example: Return HTTP Bad Request**

This:
```php
// app/Http/routes.php

Route::get('/', function()
{
	return Larapi::respondBadRequest();
});
```
will return:
```json
{
	"code":400,
	"status":"Bad Request",
	"message":"error"
}
```
with these headers:
```text
HTTP/1.1 400 Bad Request
Content-Type: application/json
```

**Example: Return HTTP Bad Request with Custom Application Error Message**

This:
```php
// app/Http/routes.php

Route::get('/', function()
{
	$errorCode = 4001;
	$errorMessage = 'Invalid email address.';

	return Larapi::respondBadRequest($errorMessage, $errorCode);
});
```
will return:
```json
{
	"code":400,
	"status":"Bad Request",
	"message":"error",
	"response":{
		"errorCode":4001,
		"errorMessage":"Invalid email address."
	}
}
```
with these headers:
```text
HTTP/1.1 400 Bad Request
Content-Type: application/json
```

**Example: Return HTTP Bad Request with Custom Response Headers**

This:
```php
// app/Http/routes.php

Route::get('/', function()
{
	$errorCode = 4001;
	$errorMessage = 'Invalid email address.';

	$headers = [
		'Header-1' => 'Header-1 Data',
		'Header-2' => 'Header-2 Data'
	];

	return Larapi::respondBadRequest($errorMessage, $errorCode, $headers);
});
```
will return:
```json
{
	"code":400,
	"status":"Bad Request",
	"message":"error",
	"response":{
		"errorCode":4001,
		"error-message":"Invalid email address."
	}
}
```
with these headers:
```text
HTTP/1.1 200 OK
Content-Type: application/json
Header-1: Header-1 Data
Header-2: Header-2 Data
```

# License
Larapi is licensed under the terms of the MIT License.

# TODO
- test, test, test