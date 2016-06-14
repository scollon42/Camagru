<?php

namespace Core\Session;

class Session implements SessionInterface, \ArrayAccess
{

	static private $_instance;


	static public function getInstance()
	{
		if (is_null(self::$_instance))
			self::$_instance = new Session();
		return self::$_instance;
	}

    public function __construct()
    {
	    session_start();
    }

	public function get($key)
	{
		if (isset($_SESSION[$key]))
		{
			return $_SESSION[$key];
		}
		else
		{
			return NULL;
		}
	}

	public function set($key, $value)
	{
		$_SESSION[$key] = $value;
	}

	public function delete($key)
	{
        unset($_SESSION[$key]);
    }

	public function exists($key)
	{
		return isset($_SESSION[$key]);
	}


// Functions implements for ArrayAccess interface

    public function offsetExists($offset)
    {
        return $this->exists($key);
    }

    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    public function offsetSet($offset, $value)
    {
        return $this->set($offset, $value);
    }

    public function offsetUnset($offset)
    {
        return $this->delete($offset);
    }
}

?>
