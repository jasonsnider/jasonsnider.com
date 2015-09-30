<?php
/**
 * TinkerPlugin Controller
 */
namespace Content\Controller;

/**
 * TinkerPlugin Controller
 * 
 * Just a mock up of a controller
 */
class PostsController extends \App\Controller\AppController
{

    /**
     * Provides a default landing page for TinkerMVC
     * 
     * Sets View::vars an example of how to inject variables into the view
     * 
     * @return void
     */
    public function index()
    {
        $this->View->vars['posts'] = $this->Post->posts();
    }
    

    /**
     * Provides a default landing page for TinkerMVC
     * 
     * Sets View::vars an example of how to inject variables into the view
     * 
     * @return void
     */
    public function view()
    {
        $params = $this->View->Router->getParams();
        $this->View->vars = $this->Post->post($params['passed'][0]);
    }
}
