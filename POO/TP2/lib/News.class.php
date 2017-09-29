<?php

class News {

	protected  $errors;
	protected  $id;
	protected  $author;
	protected  $title;
	protected  $content;
	protected  $add_date;
	protected  $update_date;

	public final  function __construct($datas = array()) {

        $this->hydrate($datas);

	}

	public final  function hydrate($datas) {

        foreach ($datas as $key => $value)
        {
            $method = 'set' . ucfirst($key);

            if (method_exists($this, $method)){
                $this->$method($value);
            }
        }

	}


	/**
	 * @access public
	 * @return bool const
	 */

	public final  function isNew() {

	}


	/**
	 * @access public
	 * @return bool const
	 */

	public final  function isValid() {

	}

	public final  function setId($id) {

        $id = (int)$id;

        if($id > 0)
        {
            $this->id = $id;
        }

	}

	public final  function setAuthor($author) {

        $author = htmlspecialchars($author);

        if(is_string($author))
        {
            $this->author = $author;
        }

	}

	public final  function setTitle($title) {

        $title = htmlspecialchars($title);

        if(is_string($title))
        {
            $this->title = $title;
        }

	}

	public final  function setContent($content) {

        $content = htmlspecialchars($content);

        if(is_string($content))
        {
            $this->content = $content;
        }
	}

	public final  function setAdd_date($date) {


        if(is_string($date))
        {
            $this->add_date = $date;
        }
        else
        {
            $date = $date->format('d/m/Y à H\hi');
            $this->add_date = $date;
        }

	}

	public final  function setUpdate_date($date) {

        $update_date = $date->format('d/m/Y à H\hi');

        if($update_date !== $this->add_date)
        {
            $this->update_date = $update_date;
        }
        else {
            $this->update_date = '-';
        }

	}

	public final  function Errors() { return $this->errors;	}
	public final  function Id() { return $this->id; }
	public final  function Author() { return $this->author; }
	public final  function Title() { return $this->title; }
	public final  function Content() { return $this->content; }
	public final  function AddDate() { return $this->add_date; }
	public final  function UpdateDate() { return $this->update_date; }

}
?>
