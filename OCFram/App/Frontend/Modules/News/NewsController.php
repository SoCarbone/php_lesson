<?php
namespace App\Frontend\Modules\News;

use \OCFram\BackController;
use \OCFram\HTTPRequest;

class NewsController extends BackController
{
    public function executeIndex(HTTPRequest $request)
    {
        $numberOfNews = $this->app->config()->get('number_of_news');
        $numberOfCharacters = $this->app->config()->get('number_of_characters');

        // Add a definition for the title.
        $this->page->addVar('title', 'Liste des '.$numberOfNews.' dernières news');

        // Get the news manager.
        $manager = $this->managers->getManagersOf('News');

        $newsList = $manager->getList(0, $numberOfNews);

        foreach ($newsList as $news)
        {
            if(strlen($news->content()) > $numberOfCharacters)
            {
                $start = substr($news->content(), 0, $numberOfCharacters);
                $start = substr($start, 0, strrpos($start, ' ')) . '...';

                $news->setContent($start);
            }
        }

        // Add the $ listNews variable to the view.
        $this->page->addVar('newsList', $newsList);
    }

    public function executeShow(HTTPRequest $request)
    {
        $news = $this->managers->getManagersOf('News')->getNews($request->getData('id'));

        if(empty($news))
        {
            $this->app->httpResponse()->redirect404();
        }

        $this->page->addVar('title', $news->title());
        $this->page->addVar('news', $news);
    }
}
