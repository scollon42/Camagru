<?php

namespace Core\Flash;

use \Core\Session\Session;

class Flash
{

    const KEY = 'flash';

    private $_session;

	static private $_instance;

	static public function getInstance(Session $session)
	{
		if (is_null(self::$_instance))
			self::$_instance = new Flash($session);
		return self::$_instance;
	}

    public function __construct(Session $session)
    {
        $this->_session = $session;
    }

    public function addFlash($content, $type = 'notice')
    {
        $this->_session->set(self::KEY, [
            'message' => $content,
            'type' => $type
        ]);
    }

    public function getFlash()
    {
		if ($this->_session->exists(self::KEY))
		{
        	$flash = $this->_session->get(self::KEY);
        	$this->_session->delete(self::KEY);
        	return "<div class='flash flash-{$flash['type']}'> {$flash['message']} </div>";
		}
		return "";
    }
}
