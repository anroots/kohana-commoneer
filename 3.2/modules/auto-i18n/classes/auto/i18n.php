<?php defined('SYSPATH') or die('No direct script access.');

    /**
     * A patch for the Internationalization (i18n) class.
     *
     * @package I18n
     * @author Mikito Takada
     * @reviewer Jakub Synowiec
     * @see http://blog.mixu.net/2010/06/02/kohana3-automatically-collect-internationalization-strings/
     */

    class Auto_I18n extends Kohana_I18n {
        // Cache of missing strings
        protected static $_cache_missing = array();

        /**
        * Returns translation of a string. If no translation exists, the original
        * string will be returned. No parameters are replaced.
        *
        *     $hello = I18n::get('Hello friends, my name is :name');
        *
        * @param   string   text to translate
        * @param   string   target language
        * @return  string
        */
        public static function get($string, $lang = NULL)
        {
            if (!$lang)
            {
                // Use the global target language
                $lang = I18n::$lang;
            }

            // Load the translation table for this language
            $table = I18n::load($lang);

            // Return the translated string if it exists
            if (isset($table[$string]))
            {
                return $table[$string];
            }
            else
            {
                // Translated string does not exist
                // Store the original string as missing - still makes sense to store the English string so that loading the untranslated file will work.
                I18n::$_cache_missing[$lang][$string] = $string;
                return $string;
            }
        }

        public static function write()
        {
            // something new must be added for anything to happen
            if (!empty(I18n::$_cache_missing))
            {
                $contents[] = "<?php defined('SYSPATH') or die('No direct script access.');";
                $contents[] = "";
                $contents[] = "/**";
                $contents[] = "* Translation file in language: ".I18n::$lang;
                $contents[] = "* Automatically generated from previous translation file.";
                $contents[] = "*/";
                $contents[] = "";
                $contents[] = "return ".var_export(array_merge(I18n::$_cache_missing[I18n::$lang], I18n::$_cache[I18n::$lang]), true).';';
                $contents[] = "?>";

                $contents = implode(PHP_EOL, $contents);

                // save string to file
                $savepath = APPPATH.'/i18n/';
                $filename = I18n::$lang.'.php';

                // check that the path exists
                if (!file_exists($savepath))
                {
                    // if not, create directory
                    mkdir($savepath, 0777, true);
                }

                // rename the old file - if the file size is different.
                if (file_exists($savepath.$filename) && (filesize($savepath.$filename) != strlen($contents)))
                {
                    if (!rename($savepath.$filename, $savepath.I18n::$lang.'_'.date('Y_m_d_H_i_s').'.php'))
                    {
                        // Rename failed! Don't write the file.
                        return;
                    }
                }

                // save the file
                file_put_contents($savepath.$filename, $contents);
            }
        }
    }

?>