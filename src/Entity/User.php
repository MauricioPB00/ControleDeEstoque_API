<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $permi;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cpf;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $rg;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $datNasc;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cidade;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $horTrab;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $wage;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $job;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $horIni;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $horIniFim;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $horIniAft;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $horFimAft;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $file;

    
    /**
     * @return string|null
     */
    public function getSalt(): ?string
    {
        return null;
    }

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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }
    /**
     * @return array|string[]
     */
    public function getRoles(): array
    {
        return array('ROLE_USER');
    }

    public function eraseCredentials()
    {
    }

    public function getPermi(): ?string
    {
        return $this->permi;
    }

    public function setPermi(?string $permi): self
    {
        $this->permi = $permi;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCpf(): ?string
    {
        return $this->cpf;
    }

    public function setCpf(?string $cpf): self
    {
        $this->cpf = $cpf;

        return $this;
    }

    public function getRg(): ?string
    {
        return $this->rg;
    }

    public function setRg(?string $rg): self
    {
        $this->rg = $rg;

        return $this;
    }

    public function getDatNasc(): ?string
    {
        return $this->datNasc;
    }

    public function setDatNasc(?string $datNasc): self
    {
        $this->datNasc = $datNasc;

        return $this;
    }

    public function getCidade(): ?string
    {
        return $this->cidade;
    }

    public function setCidade(?string $cidade): self
    {
        $this->cidade = $cidade;

        return $this;
    }

    public function getHorTrab(): ?string
    {
        return $this->horTrab;
    }

    public function setHorTrab(?string $horTrab): self
    {
        $this->horTrab = $horTrab;

        return $this;
    }

    public function getWage(): ?string
    {
        return $this->wage;
    }

    public function setWage(?string $wage): self
    {
        $this->wage = $wage;

        return $this;
    }

    public function getJob(): ?string
    {
        return $this->job;
    }

    public function setJob(?string $job): self
    {
        $this->job = $job;

        return $this;
    }

    public function getHorIni(): ?string
    {
        return $this->horIni;
    }

    public function setHorIni(?string $horIni): self
    {
        $this->horIni = $horIni;

        return $this;
    }

    public function getHorIniFim(): ?string
    {
        return $this->horIniFim;
    }

    public function setHorIniFim(?string $horIniFim): self
    {
        $this->horIniFim = $horIniFim;

        return $this;
    }

    public function getHorIniAft(): ?string
    {
        return $this->horIniAft;
    }

    public function setHorIniAft(?string $horIniAft): self
    {
        $this->horIniAft = $horIniAft;

        return $this;
    }

    public function getHorFimAft(): ?string
    {
        return $this->horFimAft;
    }

    public function setHorFimAft(?string $horFimAft): self
    {
        $this->horFimAft = $horFimAft;

        return $this;
    }

    public function getFile(): ?string
    {
        return $this->file;
    }

    public function setFile(?string $file): self
    {
        $this->file = $file;

        return $this;
    }
}
