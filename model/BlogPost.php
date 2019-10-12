<?php
class BlogPost
{
	private $_idBlogPost;
	private $_title;
	private $_chapo;
	private $_content;
	private $_dateLastUpdate;
	private $_dateCreated;
	private $_image;
	private $_idAdministrator;

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

	public function idBlogPost() { return $this->_idBlogPost; }
	public function title() { return $this->_title; }
	public function chapo() { return $this->_chapo; }
	public function content() { return $this->_content; }
	public function dateLastUpdate() { return $this->_dateLastUpdate; }
	public function dateCreated() { return $this->_dateCreated; }
	public function image() { return $this->_image; }
	public function idAdministrator() { return $this->_idAdministrator; }

	//Setters

	public function setIdBlogPost($idBlogPost)
	{
		$idBlogPost = (int) $idBlogPost;

		if($idBlogPost > 0)
		{
			$this->_idBlogPost = $idBlogPost;
		}
	}

	public function setTitle($title)
	{
		if(is_string($title))
		{
			$this->_title = $title;
		}
	}

	public function setChapo($chapo)
	{
		if(is_string($chapo))
		{
			$this->_chapo = $chapo;
		}
	}

	public function setContent($content)
	{
		if(is_string($content))
		{
			$this->_content = $content;
		}
	}

	public function setDateLastUpdate($dateLastUpdate)
	{
		if(is_string($dateLastUpdate))
		{
			$this->_dateLastUpdate = $dateLastUpdate;
		}
	}

	public function setDateCreated($dateCreated)
	{
		if(is_string($dateCreated))
		{
			$this->_dateCreated = $dateCreated;
		}
	}

	public function setImage($image)
	{
		if(is_string($image))
		{
			$this->_image = $image;
		}
	}

	public function setIdAdministrator($idAdministrator)
	{
		$idAdministrator = (int) $idAdministrator;

		if ($idAdministrator >0)
		{
			$this->_idAdministrator = $idAdministrator;
		}
	}
}
