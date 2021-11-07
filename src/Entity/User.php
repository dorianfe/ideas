<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="app_user")
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields="username", message="this username is already taken.")
 * @UniqueEntity(fields="mail", message="This email is already used.")
 */
class User implements UserInterface, \Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * 
     * @ORM\Column(type="string", length=50, unique=true)
     */
    private $username;

    /**
     * @Assert\Email(
     *     message = "{{ value }} is not a valid email."
     * )
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $mail;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

//not saved for the moment
    /**
     * @todo Create a real functioning roles system. For now, getRoles returns ["ROLE_USER"]
     */
    private $roles;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRoles()
    {
        return ["ROLE_USER"];
    }

    public function getSalt()
    {
        return null;
    }

    public function eraseCredentials()
    {

    }


}
