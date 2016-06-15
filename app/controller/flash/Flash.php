<?php

namespace App\Controller\Flash;

use \Core\Session\Session;

class Flash
{

    const KEY = 'cFlash';

    private $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function addFlash($content, $type = 'notice')
    {
        $this->session->set(self::KEY, [
            'message' => $content,
            'type' => $type
        ]);
    }

    public function getFlash()
    {
		if ($this->session->exists(self::KEY))
		{
        	$flash = $this->session->get(self::KEY);
        	$this->session->delete(self::KEY);
        	return "<div class='flash flash-{$flash['type']}'> {$flash['message']} </div>";
		}
		return "";
    }
}
