Kohana Module Template
======================

This is a base template to create your own Kohana 3 Module. The intention is not to provide with a fix structure of how a module should be but to provide an start point for your our custom modules.
Fell free to Fork and make your own changes.


Planned support
---------------

In the near future, additional support for the following methods will be included.

1. Drivers

Using Cache
-----------

To use this Kohana Module Template, just:

1. Download and extract the code from [Github](https://github.com/sebicas/kohana-module-template).
2. Place the module into your Kohana instances modules folder.
3. Finally enable the module within the application bootstrap within the section entitled _modules_.

Quick example
-------------

The following is a quick example of how to use a normal Module.

	<?php
	// Get a Sqlite Cache instance
	$mycache = Cache::instance('sqlite');

	// Create some data
	$data = array('foo' => 'bar', 'apples' => 'pear', 'BDFL' => 'Shadowhand');

	// Save the data to cache, with an id of test_id and a lifetime of 10 minutes
	$mycache->set('test_id', $data, 600);

	// Retrieve the data from cache
	$retrieved_data = $mycache->get('test_id');

	// Remove the cache item
	$mycache->delete('test_id');

	// Clear the cache of all stored items
	$mycache->delete_all();

The example is using the SQLite driver.