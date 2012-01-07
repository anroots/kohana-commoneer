# Kohana 3.x YAML Module

YAML stands for YAML Ain't a Markup Language. Enjoy easy to understand syntax
even your boss will be able to read and write! This module will let you write
your Kohana config and i18n files in YAML.

## Installation

Clone the repository (or add it as a submodule) to your modules directory:

    $ git clone git://github.com/gevans/kohana-yaml.git modules/yaml

Update & initiate submodules (to get the latest Symfony YAML libraries):

    $ cd modules/yaml
    $ git submodule update --init

Enable the module in your `bootstrap.php`:

```php
<?php
Kohana::modules(array(
    'yaml' => MODPATH.'yaml', // YAML config & i18n reader
    // ...
));
```

**Optionally**, you can compile php-yaml.

## General Usage

### Configuration

You can write your config files in YAML like so:

```yaml
# This is a comment
some_key: some_value
group:
  # unfortunately, the \n is needed or PHP will mess up the line breaks:
  dynamic_key: <?php echo "PHP!\n"; ?>
  another_key: another_value
```

Save the files as `config/<filename>.yml` and Kohana will be able to read them as
usual.

### I18n

I18n is just as easy as the last part was. Just save your `.yml` files in the
`i18n/` while the module does that rest. For example:

```yaml
# i18n/es.yml
"Hola, :name!": "Hello, :name!"
Yo no hablo Español.: I don't speak Spanish.
Wait. What?: Espere. ¿Qué?
```

After that, using `__('Yo no hablo Español.')` returns `I don't speak Spanish.`
Having fun yet?

You can read [The Official YAML Web Site](http://www.yaml.org/) for more advanced syntax.

## Optionally, install php-yaml (Linux only)

If you're on Linux, you can enjoy a increased speed in YAML parsing by compiling
the php-yaml extension. Even if you don't do this, config files will still be
cached when you enable caching in Kohana. To start, you need to install some
dependencies.

On Ubuntu 10.10, install the needed packages to build the extension:

    $ aptitude install build-essential php5-dev libyaml-dev

Then, use PECL to install the extension:

    $ pecl install channel://pecl.php.net/yaml-0.6.3

You'll want to enable the extension in PHP. On Ubuntu, you can do so by creating
a new file called `/etc/php5/conf.d/yaml.ini`:

```ini
; configuration for php YAML module
extension=yaml.so
```

Save the file, restart your web server, then you should be good to go!
