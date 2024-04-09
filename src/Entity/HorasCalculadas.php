<?php

namespace App\Entity;

use App\Repository\HorasCalculadasRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HorasCalculadasRepository::class)
 */
class HorasCalculadas
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

     /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $horasTrabalhadas;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mes;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ano;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getHorasTrabalhadas(): ?string
    {
        return $this->horasTrabalhadas;
    }

    public function setHorasTrabalhadas(?string $horasTrabalhadas): self
    {
        $this->horasTrabalhadas = $horasTrabalhadas;

        return $this;
    }

    public function getMes(): ?string
    {
        return $this->mes;
    }

    public function setMes(?string $mes): self
    {
        $this->mes = $mes;

        return $this;
    }

    public function getAno(): ?string
    {
        return $this->ano;
    }

    public function setAno(string $ano): self
    {
        $this->ano = $ano;

        return $this;
    }
}
