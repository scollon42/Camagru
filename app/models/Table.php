<?php

namespace App\Models;

class Table
{
	protected $table;
	protected $db;

	public function __construct()
	{
		$name = explode('\\', get_class($this));
		$name = str_replace('Table', '', array_pop($name));
		$table = strtolower($name);
		$this->table = $table;
		$this->db = Database::getDb();
	}

	//GENERIC FUNCTIONS

	// This function will return how many items
	// are in table
	public function count()
	{
		$sql = "SELECT COUNT(id) as count
				FROM `{$this->table}`";

		$ret = $this->execute($sql, false);
		return ($ret['count']);
	}

	public function getBy($name, $content)
	{
		// $name = $this->db->quote($name);
		// $content = $this->db->quote($content);
		$sql = "SELECT * FROM `$this->table` WHERE $name='$content'";
		$ret = $this->execute($sql, false);
		return ($ret);
	}

	// This function will return all items FROM
	// a table
	public function getAll()
	{
		$sql = "SELECT *
				FROM `$this->table`";

		$ret = $this->execute($sql);
		return ($ret);

	}

	public function getAllBy($name, $content)
	{
		// $name = $this->db->quote($name);
		// $content = $this->db->quote($content);
		$sql = "SELECT * FROM `$this->table` WHERE $name=$content";

		$ret = $this->execute($sql);
		return ($ret);
	}

	public function getAllByQuery(array $query)
	{
		$sql = "SELECT * FROM `$this->table`";
		if (key_exists('where', $query))
			$sql = $sql . ' WHERE ' . $query['where'];
		if (key_exists('order', $query))
			$sql = $sql . ' ORDER BY ' . $query['order'];
		if (key_exists('limit', $query))
			$sql = $sql . ' LIMIT ' . $query['limit'];
		return ($this->execute($sql));
	}

	public function delete($name, $content)
	{
		// $name = $this->db->quote($name);
		// $content = $this->db->quote($content);
		$sql = "DELETE FROM `$this->table`
				WHERE $name=$content";

		$this->update($sql);
	}

	public function execute($sql, $all = true)
	{
		try
		{
			$query = $this->db->query($sql);
			if ($all === true)
			{
				$ret = $query->fetchAll();
			}
			else
			{
				$ret = $query->fetch();
			}
		}
		catch (Exception $e)
		{
			die ('Error ' . $e->getMessage());
		}
		return ($ret);
	}

	public function update($sql)
	{
		try
		{
			$this->db->beginTransaction();
			$this->db->exec($sql);
			$this->db->commit();
		}
		catch (Exception $e)
		{
			$this->db->rollback();
			die ('Error : ' .  $e->getMessage());
		}
	}

	public function updateWith($sql, Array $exec)
	{
		try
		{
			$this->db->beginTransaction();
			$request = $this->db->prepare($sql);
			$request->execute($exec);
			$this->db->commit();
		}
		catch (Exception $e)
		{
			$this->db->rollback();
			die ('Error : ' . $e->getMessage());
		}
	}


}

?>
