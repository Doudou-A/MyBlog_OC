<?php
class Comment
{
	private $_id;
	private $_pseudo;
	private $_date;
	private $_content;
	private $_valid;

	public function __construct(array $data)
	{
		$this->hydrate($data);
	}

	public function hydrate(array $data)
	{
		foreach ($data as $key => $value) {
			$method = 'set' . ucfirst($key);

			if (method_exists($this, $method)) {
				$this->method($value);
			}
		}
	}

	//Getters

	public function id() { return $this->_id; };
	public function pseudo() { return $this->_pseudo };
	public function date() { return $this->_date };
	public function content() { return $this->_content };
	public function valid() { return $this->_valid };

	//Setters

	public function setId($id)
	{
		$id = (int) $id;

		if ($id >0)
		{
			$this->_id = $id;
		}
	}

	public function setPseudo($pseudo)
	{
		if(is_string($pseudo))
		{
			$this->_pseudo = $pseudo;
		}
	}


}