<?php defined('SYSPATH') or die('No direct script access.');

class Model_Post extends ORM
{

    /**
     * Get all or a single post
     * @param null|int $id Post ID or empty
     * @param bool $only_mine If true, limits posts to the current user's
     * @return Database_Result|ORM
     */
    public function get($id = NULL, $only_mine = TRUE) {

        // find_all can't be called on loaded objects
        if ($this->loaded()) {
            $this->clear();
        }

        if ($only_mine) {
            $this->where('user_id', '=', Auth::instance()->get_user()->id);
        }

        if ($id) {
            return $this->where('id', '=', $id)
                    ->find();
        }
        return $this->limit(10)
                ->find_all();
    }


    /**
     * Define the rules of the model.
     * For example, don't let the user create a new post with an empty content
     * The rules function is called automatically when the model data is saved.
     *
     * @return array An array of Validation rules
     */
    public function rules() {
        return array(
            'post' => array(
                array('not_empty')
            )
        );
    }


    /**
     * Define filters for input data.
     * For example, trim (remove whitespace) from the start and end of the post.
     * @return array
     */
    public function filters() {
        return array(
            'post' => array(
                array('trim'),
            )
        );
    }

    /**
     * Save a new post
     * @param string $content Post content, max 140 chars
     * @return int|bool Post ID
     */
    public function post($content) {
        $this->post = $content;
        $this->user_id = Auth::instance()->get_user()->id;

        // Saving might fail when rules() fail.
        try {
            $this->save();

        } catch (ORM_Validation_Exception $e) {
            // Show errors to the user
            $e = $e->errors('validation');

            foreach ($e as $error) {
                Notify::msg($error, 'error');
            }

            return FALSE;
        }
        return $this->id;
    }
}