<?php
class Comment
{
	private $_idComment;
	private $_pseudo;
	private $_dateCreated;
	private $_content;
	private $_valid;

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

	public function idComment() { return $this->_idComment; }
	public function pseudo() { return $this->_pseudo; }
	public function dateCreated() { return $this->_dateCreated; }
	public function content() { return $this->_content; }
	public function valid() { return $this->_valid; }

	//Setters

	public function setIdComment($idComment)
	{
		$idComment = (int) $idComment;

		if ($idComment >0)
		{
			$this->_idComment = $idComment;
		}
	}

	public function setPseudo($pseudo)
	{
		if(is_string($pseudo))
		{
			$this->_pseudo = $pseudo;
		}
	}

	public function setDateCreated($dateCreated)
	{
		if(is_string($dateCreated))
		{
			$this->_dateCreated = $dateCreated;
		}
	}

	public function setContent($content)
	{
		if(is_string($content))
		{
			$this->_content = $content;
		}
	}

	public function setValid($valid)
	{
		if(is_bool($valid) === true)
		{
			$this->_valid = $valid;
		}
	}
}