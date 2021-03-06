<?php

class Administrator
{
	private $_idAdministrator;
	private $_email;
	private $_name;
	private $_firstName;
	private $_password;


	public function __construct(array $data)
    {
        $this->hydrate($data);
    }
 
    public function hydrate(array $data)
    {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);
 
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

	//Getters

	public function idAdministrator() { return $this->_idAdministrator; }
	public function email()	{ return $this->_email;	}
	public function name() { return $this->_name; }
	public function firstName() { return $this->_firstName;	}
	public function password() { return $this->_password; }

	//Setters

	public function setIdAdministrator($idAdministrator)
	{
		$idAdministrator = (int) $idAdministrator;

		if ($idAdministrator >0)
		{
			$this->_idAdministrator = $idAdministrator;
		}
	}

	public function setEmail($email)
	{
		if (is_string($email))
		{
			$this->_email = $email;
		}
	}

	public function setName($name)
	{
		if (is_string($name))
		{
			$this->_name = $name;
		}
	}

	public function setFirstName($firstName)
	{
		if (is_string($firstName))
		{
			$this->_firstName = $firstName;
		}
	}

	public function setPassword($password)
	{
		if (is_string($password))
		{
			$this->_password = $password;
		}
	}
}