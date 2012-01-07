# Notify Installation

### Getting the Notify module

Download the latest version of this module from [github](http://github.com/kaltar/notify) and 
copy the downloaded folder to your 'modules/' folder.

### Add the Notify module in Kohana

Open your application/bootstrap.php, and add Notify in the modules section


	Kohana::modules(array(
		//'auth'      	=> MODPATH.'auth',      // Basic authentication
		//'codebench'   => MODPATH.'codebench', // Benchmarking tool
		//'database'   	=> MODPATH.'database',  // Database access
		//'image'       => MODPATH.'image',     // Image manipulation
		//'orm'        	=> MODPATH.'orm',       // Object Relationship Mapping
		//'pagination' 	=> MODPATH.'pagination',// Paging of results
		//'userguide'  	=> MODPATH.'userguide', // User guide and API documentation
		//'table'		=> MODPATH.'table',		// Table

		'notify'		=> MODPATH.'notify',	// Notify Module

	));