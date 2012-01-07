<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Dashboard controller.
 * Handles posting and viewing of past posts
 */
class Controller_Dash extends Controller_Main
{


    // Show the main Dash view: list posts, allow to post
    public function action_index() {

        $post = $this->request->post();
        $p = ORM::factory('post');

        // New post!
        if (!empty($post)) {
            $p->post($post['post']); // Ask the model to save it
        }

        // Load posts
        $this->template->title = 'Dashboard';
        $this->template->content->posts = $p->get(NULL, TRUE);

    }


    // Delete a post in an CRUD manner
    public function action_delete() {

        // Load the ORM model of the specified post
        $post_id = $this->request->param('id');
        $p = ORM::factory('post', $post_id);
        
        // If it exists, delete!
        if ($p->loaded()) {
            $p->delete();
            Notify::msg('Deleted!', 'info');
        } else {
            Notify::msg('Aww, not found!', 'error');
        }

        $this->request->redirect('dash');
    }


} 
