<?php
namespace Model;

use \Entity\News;

class NewsManagerPDO extends NewsManager
{
    public function getList($start = -1, $limit = -1)
    {
        $sql = 'SELECT id, author, title, content, add_date, update_date FROM news ORDER BY id DESC';

        if($start != -1 OR $limit != -1)
        {
            $sql .= ' LIMIT '.(int) $limit.' OFFSET '.(int) $start;
        }

        $request = $this->dao->query($sql);
        $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\News');

        $newsList = $request->fetchAll();

        foreach ($newsList as $news)
        {
            $news->setAddDate(new \DateTime($news->addDate()));
            $news->setUpdateDate(new \DateTime($news->updateDate()));
        }

        $request->closeCursor();

        return $newsList;
    }

    public function getNews($id)
    {
        $request = $this->dao->prepare('SELECT id, author, title, content, add_date, update_date FROM news WHERE id = :id');
        $request->bindValue(':id', (int) $id, \PDO::PARAM_INT);
        $request->execute();

        $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\News');
            if($news = $request->fetch())
            {
                $news->setAddDate(new \DateTime($news->addDate()));
                $news->setUpdateDate(new \DateTime($news->updateDate()));

                return $news;
            }

        return null;
    }
}
