<?php

class NewsManager {

    private $_db;

    protected final  function save(News $obj) {

	}

	/**
	 * @access protected
	 * @param News $obj
	 * @return void
	 */

	public final  function addNews(News $obj) {

        $add = $this->_db->prepare('INSERT INTO poo_news(author, title, content, add_date, update_date) VALUES (:author, :title, :content, :add_date, :update_date)');
        $add->bindValue(':author', $obj->Author(), PDO::PARAM_STR );
        $add->bindValue(':title', $obj->Title(), PDO::PARAM_STR );
        $add->bindValue(':content', $obj->Content(), PDO::PARAM_STR );
        $add->bindValue(':add_date', $obj->AddDate(), PDO::PARAM_STR );
        $add->bindValue(':update_date', $obj->UpdateDate(), PDO::PARAM_STR );
        $add->execute();

	}

	public final  function updateNews(News $obj) {

        $update = $this->_db->prepare('UPDATE poo_news SET author=:author, title=:title, content=:content, add_date=:add_date, update_date=:update_date WHERE id=:id');
        $update->bindValue(':id', $obj->Id(), PDO::PARAM_INT );
        $update->bindValue(':author', $obj->Author(), PDO::PARAM_STR );
        $update->bindValue(':title', $obj->Title(), PDO::PARAM_STR );
        $update->bindValue(':content', $obj->Content(), PDO::PARAM_STR );
        $update->bindValue(':add_date', $obj->AddDate(), PDO::PARAM_STR );
        $update->bindValue(':update_date', $obj->UpdateDate(), PDO::PARAM_STR );
        $update->execute();

	}

	public final  function __construct($db)
    {
        $this->setDb($db);
    }


	/**
	 * @access public
	 * @param int $start
	 * @param int $end
	 * @return array
	 */
    public final  function getLastNews() {

        $getLast = $this->_db->prepare('SELECT * FROM poo_news ORDER BY id DESC LIMIT 5');
        $getLast->execute();
        $getLast->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'News');

        $list = $getLast->fetchAll();
        return $list;

	}

	public final  function getAllNews() {

        $getAll = $this->_db->prepare('SELECT * FROM poo_news');
        $getAll->execute();
        $getAll->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'News');

        $list = $getAll->fetchAll();
        return $list;

	}

	public final  function Count() {

        $count = $this->_db->prepare('SELECT COUNT(*) FROM poo_news');
        $count->execute();
        $number = $count->fetchColumn();

        return $number;

	}


	/**
	 * @access public
	 * @param int $id
	 * @return News
	 */

	public final  function getOneNews($id) {

        $id = (int)$id;

        $getOne = $this->_db->prepare('SELECT * FROM poo_news WHERE id=:id');
        $getOne->bindValue(':id', $id, PDO::PARAM_INT);
        $getOne->execute();
        $getOne->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'News');

        $list = $getOne->fetchAll();
        return $list;

	}


	/**
	 * @access public
	 * @param News $obj
	 * @return void
	 */

	public final  function deleteNews($id) {

        $id = (int)$id;

        $delete = $this->_db->prepare('DELETE FROM poo_news WHERE id=:id');
        $delete->bindValue(':id', $id, PDO::PARAM_INT);
        $delete->execute();

	}

    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}
?>
