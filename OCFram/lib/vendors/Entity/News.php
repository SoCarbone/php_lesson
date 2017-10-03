<?php
namespace Entity;

use \OCFram\Entity;

class News extends Entity
{
    protected $author, $title, $content, $addDate, $updateDate;

    const INVALID_AUTHOR = 1;
    const INVALID_TITLE = 2;
    const INALID_CONTENT = 3;

    public function isValid()
    {
        return !(empty($this->author) OR empty($this->title) OR empty($this->content));
    }

    //SETTERS
    public function setAuthor($author)
    {
        if(!is_string($author) OR empty($author))
        {
            $this->errors[] = self::INVALID_AUTHOR;
        }
        $this->author = $author;
    }

    public function setTitle($title)
    {
        if(!is_string($title) OR empty($title))
        {
            $this->errors[] = self::INVALID_TITLE;
        }
        $this->$title = $title;
    }

    public function setContent($content)
    {
        if(!is_string($content) OR empty($content))
        {
            $this->errors[] = self::INVALID_CONTENT;
        }
        $this->$content = $content;
    }

    public function setAddDate(\DateTime $addDate)
    {
        $this->addDate = $addDate;
    }

    public function setUpdateDate(\DateTime $updateDate)
    {
        $this->updateDate = $updateDate;
    }

    //GETTERS
    public function author()
    {
        return $this->author;
    }

    public function title()
    {
        return $this->title;
    }

    public function content()
    {
        return $this->content;
    }

    public function addDate()
    {
        return $this->addDate;
    }

    public function updateDate()
    {
        return $this->updateDate;
    }
}
