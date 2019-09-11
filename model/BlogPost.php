<?php
class BlogPost
{
	private $_id;
	private $_title;
	private $_châpo;
	private $_content;
	private $_dateLastUpdate;
	private $_dateCreated;

	public function __construct(array $data)
	{
		$this->hydrate($data);
	}

	public function hydrate(array $data)
	{
		foreach ($data as $key => $value) 
		{
			$method = 'set' . ucfirst($key);

			if (method_exists($this, $method)) 
			{
				$this->$method($value);
			}
		}
	}

	//Getters

	public function id() { return $this->_id; }
	public function title() { return $this->_title; }
	public function châpo() { return $this->_châpo; }
	public function content() { return $this->_content; }
	public function dateLastUpdate() { return $this->_dateLastUpdate; }
	public function dateCreated() { return $this->_dateCreated; }

	//Setters

	public function setId($id)
	{
		$id = (int) $id;

		if($id > 0)
		{
			$this->_id = $id;
		}
	}

	public function setTitle($title)
	{
		if(is_string($title))
		{
			$this->_title = $title;
		}
	}

	public function setChâpo($châpo)
	{
		if(is_string($châpo))
		{
			$this->_châpo = $châpo;
		}
	}

	public function setContent($content)
	{
		if(is_string($content))
		{
			$this->_content = $content;
		}
	}

	public function setDateLastUpdate($date)
	{
		$date = DateTime::createFromFormat('d/m/Y', $string);
		if($date === true)
		{
			//On vérifie que la date existe
			$validString = $date->format('d/m/Y');
			if($string = $validString)
			{
				$this->_date = $date;
			}
		}
	}

	public function setDateCreated($date)
	{
		$date = DateTime::createdFromFormat('d/m/Y', $string);
		if($date === true)
		{
			$validString = $date->format('d/m/Y');
			if($string = $validString)
			{
				$this->_date = $date;
			}
		}
	}
}
