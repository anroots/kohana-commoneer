Kohana Boilerplate
==================

This is my version of a typical Kohana setup.
The files contain the latest version of Kohana with additional modules and CSS,
 JS and img resources for quick usage and maintenance.

Why it works
------------
It's troublesome to update Kohana or JS libraries in every project for every new version.
Instead, I've collected all my most used modules and assets into one place.

Kohana's modular and dynamic architecture allows me to set up a new project and refer to this common repository
 of awesome and reusable assets.
The application folder is meant to be cloned outside this directory for every new project.

Usage
-----

For a new application, copy the application folder, .htaccess and index.php files to a new location and update
Kohana paths in the index.php folder. Create assets folder and symlink to this dir's assets with the name shared (assets/shared).