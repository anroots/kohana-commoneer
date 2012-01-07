<?php defined('SYSPATH') or die('No direct script access.');

// attach YAML config reader
Kohana::$config->attach(new Config_YAML);
