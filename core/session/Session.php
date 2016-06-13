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

    /**
     * Whether a offset exists
     * @link http://php.net/manual/en/arrayaccess.offsetexists.php
     * @param mixed $offset <p>
     * An offset to check for.
     * </p>
     * @return boolean true on success or false on failure.
     * </p>
     * <p>
     * The return value will be casted to boolean if non-boolean was returned.
     * @since 5.0.0
     */
    public function offsetExists($offset)
    {
        return $this->exists($key);
    }

    /**
     * Offset to retrieve
     * @link http://php.net/manual/en/arrayaccess.offsetget.php
     * @param mixed $offset <p>
     * The offset to retrieve.
     * </p>
     * @return mixed Can return all value types.
     * @since 5.0.0
     */
    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    /**
     * Offset to set
     * @link http://php.net/manual/en/arrayaccess.offsetset.php
     * @param mixed $offset <p>
     * The offset to assign the value to.
     * </p>
     * @param mixed $value <p>
     * The value to set.
     * </p>
     * @return void
     * @since 5.0.0
     */
    public function offsetSet($offset, $value)
    {
        return $this->set($offset, $value);
    }

    /**
     * Offset to unset
     * @link http://php.net/manual/en/arrayaccess.offsetunset.php
     * @param mixed $offset <p>
     * The offset to unset.
     * </p>
     * @return void
     * @since 5.0.0
     */
    public function offsetUnset($offset)
    {
        return $this->delete($offset);
    }
}

?>
