<?php

return [

	/*
	 |--------------------------------------------------------------------------
	 | verifyAppId
	 |--------------------------------------------------------------------------
	 |
	 | Should the application verify that the incoming appId matches your appId?
	 |
	 | @see https://developer.amazon.com/public/solutions/devices/echo/alexa-app-kit/docs/handling-requests-sent-by-the-alexa-service
	 |
	 */
	'verifyAppId' => env('ALEXA_VERIFY_APP_ID', true),

	/*
	 |--------------------------------------------------------------------------
	 | appIds
	 |--------------------------------------------------------------------------
	 |
	 | Application IDs for your application(s)
	 |
	 | @see https://developer.amazon.com/public/solutions/devices/echo/alexa-app-kit/docs/handling-requests-sent-by-the-alexa-service
	 |
	 */
	'appIds' => env('ALEXA_POSSIBLE_APP_IDS', []),


	/*
	 |--------------------------------------------------------------------------
	 | timestampTolerance
	 |--------------------------------------------------------------------------
	 |
	 | This is the amount of time your application should allow pass before
	 | considering a request invalid. This is to prevent replay attacks.
	 | Note that if this value is set to 0 the timestamp will not be checked
	 | which is designed for testing.
	 |
	 | @see https://developer.amazon.com/public/solutions/devices/echo/alexa-app-kit/docs/developing-your-app-with-the-alexa-appkit
	 |
	 */
	'timestampTolerance' => env('ALEXA_TIMESTAMP_TOLERANCE', 150),

	/*
	|--------------------------------------------------------------------------
	| origin
	|--------------------------------------------------------------------------
	|
	| These configuration options relate to verifying that the request origin is
	| really Amazon's official AppKit system. Note that while you can change these
	| if you want to make sample/test request from your own Alexa simulator,
	| you can also simply not include the Certificate middleware when testing
	| your application.
	|
	*/
	'origin' => [
		/*
		|--------------------------------------------------------------------------
		| host
		|--------------------------------------------------------------------------
		|
		| The valid host the the request origin needs to match with
		| (this probably shouldn't be touched unless you're testing, etc)
		|
		*/
		'host' => env('ALEXA_ORIGIN_HOST', 's3.amazonaws.com'),

		/*
		|--------------------------------------------------------------------------
		| path
		|--------------------------------------------------------------------------
		|
		| The valid path the the request origin needs to match with
		| (this probably shouldn't be touched unless you're testing, etc)
		|
		*/
		'path' => env('ALEXA_ORIGIN_PATH', '/echo.api/'),


		/*
		|--------------------------------------------------------------------------
		| scheme
		|--------------------------------------------------------------------------
		|
		| The scheme (https is default/correct for real requests the origin needs to match with
		| (this probably shouldn't be touched unless you're testing, etc)
		|
		*/
		'scheme' => env('ALEXA_ORIGIN_SCHEME', 'https'),

		/*
		|--------------------------------------------------------------------------
		| port
		|--------------------------------------------------------------------------
		|
		| IF SPECIFIED, which port should the origin request be over?
		| (this probably shouldn't be touched unless you're testing, etc)
		|
		*/
		'port' => env('ALEXA_ORIGIN_PORT', '443'),
	],

	'certificate' => [


		/*
		|--------------------------------------------------------------------------
		| provider
		|--------------------------------------------------------------------------
		|
		| How should the certificate be stored?
		| `file`, `redis`, `database` and `eloquent` providers are supported
		|
		*/
		'provider' => env('ALEXA_CERTIFICATE_PROVIDER', 'file'),

		/*
		|--------------------------------------------------------------------------
		| filePath
		|--------------------------------------------------------------------------
		|
		| Where should the cert file be saved if downloaded with the `file` provider
		|
		*/
		'filePath' => env('ALEXA_CERTIFICATE_FILE_PATH', storage_path('certificates/')),

	],


	'device' => [

		/*
		|--------------------------------------------------------------------------
		| provider
		|--------------------------------------------------------------------------
		|
		| How should the device be accessed? `database` and `eloquent` providers are supported
		|
		*/
		'provider' => env('ALEXA_DEVICE_PROVIDER', 'eloquent'),

		/*
		|--------------------------------------------------------------------------
		| model
		|--------------------------------------------------------------------------
		|
		| For *eloquent* provider, which model should be used for a Device. A Device
		| model is provided out of the box, but any other eloquent model can be used
		| as long as it implements the AmazonEchoDevice contract.
		|
		*/
		'model' => env('ALEXA_ELOQUENT_DEVICE_MODEL', 'Develpr\AlexaApp\Device\Device'),

		/*
		|--------------------------------------------------------------------------
		| table
		|--------------------------------------------------------------------------
		|
		| For *database* provider, which table will store your alexa device
		| data?
		|
		*/
		'table' => env('ALEXA_DATABASE_DEVICE_TABLE', 'alexa_devices'),

		/*
		|--------------------------------------------------------------------------
		| device_identifier
		|--------------------------------------------------------------------------
		|
		| What is the attribute or table column name for the unique echo device
		| id? This is the attribute used to look up a specific device via either
		| eloquent or database providers.
		|
		*/
		'device_identifier' => env('ALEXA_DEVICE_ID_ATTRIBUTE', 'device_user_id'),

	],

];
