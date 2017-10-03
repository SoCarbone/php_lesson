<?php
namespace OCFram;

abstract class Application
{
    protected $httpRequest;
    protected $httpResponse;
    protected $name;
    protected $user;
    protected $config;

    public function __construct()
    {
        $this->httpRequest = new HTTPRequest;
        $this->httpResponse = new HTTPResponse;
        $this->name = '';
        $this->user = new User;
        $this->config = new Config($this);
    }

    public function getController()
    {
        $router = new Router;

        $xml = new \DOMDocument;
        $xml->load(__DIR__.'/../../App/'.$this->name.'/Config/routes.xml');

        $routes = $xml->getElementsByTagName('route');

        //The routes of the XML file are scanned.
        foreach ($routes as $route)
        {
            $vars = [];

            //Add the route in the router
            if($route->hasAttribute('vars'))
            {
                $vars = explode(',', $route->getAttribute('vars'));
            }

            //Add the route in the router
            $router->addRoute(new Route($route->getAttribute('url'), $route->getAttribute('module'), $route->getAttribute('action'), $vars));
        }

        try
        {
            //The route corresponding to the URL is retrieved.
            $matchedRoute = $router->getRoute($this->httpRequest->requestURI());
        }
        catch (\RuntimeException $e)
        {
            if ($e->getCode() == Router::NO_ROUTE)
            {
                //If no route matches, the requested page does not exist.
                $this->httpResponse->redirect404();
            }
        }

        //Add the URL variables to the $ _GET array.
        $_GET = array_merge($_GET, $matchedRoute->vars());

        //The controller is instantiated
        $controllerClass = 'App\\'.$this->name.'\\Modules\\'.$matchedRoute->module().'\\'.$matchedRoute->module().'Controller';
        return new $controllerClass($this, $matchedRoute->module(), $matchedRoute->action());
    }

    abstract public function run();

    public function httpRequest()
    {
        return $this->httpRequest;
    }

    public function httpResponse()
    {
        return $this->httpResponse;
    }

    public function name()
    {
        return $this->name;
    }

    public function config()
    {
        return $this->config;
    }

    public function user()
    {
        return $this->user;
    }
}
