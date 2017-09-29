<?php

class MyClass implements Countable, ArrayAccess, SeekableIterator //SeekableIterator hérite de Iterator et ajoute seek();
{
    private $_position = 0;
    private $_array =[0, 1, 2, 3];

    //Les méthodes de Iterator
    public function current()
    {
        return $this->_array[$this->_position];
    }
    public function key()
    {
        return $this->_position;
    }
    public function next()
    {
        $this->_position++;
    }
    public function rewind()
    {
        $this->_position = 0;
    }
    public function valid()
    {
        return isset($this->_array[$this->_position]);
    }
    public function seek($new_position)
    {
        $last_position = $this->_position;
        $this->_position = $new_position;

        if(!$this->valid())
        {
            trigger_error('La position spécifiée n\'est pas valide', E_USER_WARNING);
            $this->position = $anciennePosition;
        }
    }
    public function offsetExists($key)
    {
       return isset($this->_array[$key]);
    }
    public function offsetGet($key)
    {
        return $this->_array[$key];
    }
    public function offsetSet($key, $value)
    {
        $this->_array[$key] = $value;
    }
    public function offsetUnset($key)
    {
        unset($this->_array[$key]);
    }
    public function count()
    {
        return count($this->_array);
    }
}

$obj = new MyClass();
foreach ($obj as $key => $value)
{
    echo $key. ' => '. $value . '<br />';
}

$obj->seek(3);
echo $obj->current();

echo $obj[3];

echo count($obj);


