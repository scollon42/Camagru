<?php

namespace App\Controller\Pager;

class Pager
{
	private $nbpage;
	private $current;
	private $perpage;

	public function __construct($nb_elem, $elem_per_page)
	{
		if ($elem_per_page <= 0)
			throw new Exception('Pager::elem_per_page must be n > 0');

		$this->nbpage = ceil($nb_elem / $elem_per_page);
		if (isset($_GET['p']) && $_GET['p'] > 0 && $_GET['p'] <= $this->nbpage)
			$this->current = $_GET['p'];
		else
			$this->current = 1;

		$this->perpage = $elem_per_page;
	}

	public function prepare()
	{
		return (($this->current - 1) * $this->perpage);
	}

	public function pagination()
	{
		$pager = "<ul class='pagination'>" . PHP_EOL;

		for ($i = 1 ; $i <= $this->nbpage ; $i++)
		{
			if ($i == $this->current)
				$class = 'active';
			else
				$class = 'none';
			$pager .= "<li><a class='$class' href='?p=$i'>$i</a></li>" . PHP_EOL;
		}
		$pager .= "</ul>" . PHP_EOL;

		echo ($pager);
	}
}


?>
