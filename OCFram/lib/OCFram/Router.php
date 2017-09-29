<?php
namespace OCFram;

class Router
{
    protected $routes = [];

    const NO_ROUTE = 1;

    public function addRoute(Route $route)
    {
        if(!in_array($route, $this->routes))
        {
            $this->routes[] = $route;
        }
    }

    public function getRoute($url)
    {
        foreach($this->routes as $route)
        {
            //If the route matches URL
            if(($varsValues = $route->match($url)) !== false)
            {
                //If has variables
                if($route->hasVars())
                {
                    $varsNames = $route->varsNames();
                    $listVars = [];

                    //Create a new table key/value
                    //(key = variable name, value = this value)
                    foreach ($varsValues as $key => $match)
                    {
                        //The first value contains the captured string
                        if($key !== 0)
                        {
                            $listVars[$varsNames[$key - 1]] = $match;
                        }
                    }

                    //This table of variables is assigned to the road
                    $route->setVars($listVars);
                }

                return $route;
            }
        }

        throw new \RuntimeException('Aucune route ne correspond à l\'URL', self::NO_ROUTE);
    }
}
