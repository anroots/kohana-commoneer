# Assets

Comoneer includes an assets manager class that takes care of dynamically including dependencies like jQuery onoly the pages you specify.
The advantage of this is that you don't have to load all your CSS files/libraries on every page you load just to use it once or twice.

The purpose of the Assets class is not to minify/combine asset files although this could be a further development goal.

The assets manager class accepts static calls to load script/style files and renders them in your template with `Assets::render()`. CSS, JavaScript and LESS file types are supported, with LESS being the default stylesheet type.


Usage
=====

* Copy `MODPATH/commoneer/config/assets.php` to `APPPATH/config/assets.php` and change appropriate values.
* Use one of the three inclusion calls where appropriate:
    `Assets::use_style();` for LESS, `Assets::use_script();` for JavaScript and `Assets::use_css();` for CSS files.
* Call `Assets::render()` in your template to output the generated HTML.
You can echo different resource types separately, for example one would use `Assets::render(Assets:LESS);` in the `<head>`
section of the template and `Assets::render(Assets::SCRIPT);` just below the `<body>` tag.

To dynamically include assets you call one of the three inclusion functions during the execution of the request. To add a style to controllers/dashboard/action_index you would use:

    // Add LESS styles
    Assets::use_style('forms');
    Assets::use_style(array('forms', 'typo')); // This works too

    Assets::use_css('reset'); // A normal CSS file

    Assets::use_script(array('modal', 'jquery')); // Load some scripts in the dashboard too

For `use_css()`, `use_script()` and `use_style()` to work you must first specify the include paths in *config/assets.php*.

Configuration
=============

The purpose of the configuration file is twofold:

* Specify aliases and paths for commonly used (long) scripts/styles
* Specify the search paths for script/style files

The *known_assets* array consists of alias => file path to the asset file. You can use aliases defined here in `use_*type*()` call.

The *assets_path* defines the directories where assets files are located. Each of these locations is searched for the file when you call `use_*type*()`.

Rendering
=========

Use `Assets::render();` in your template to output the HTML for all the assets you've included.
The asset que is cleared after a `render()` call.

    Assets::render(); // Outputs all included LESS, CSS and JS files as HTML includes, clears everything
    Assets::render(ASSETS::STYLE); // Output only LESS styles, clears the STYLE que
