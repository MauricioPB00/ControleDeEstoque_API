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
    private $mes;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ano;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $diasFaltados;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $diasTrabalhados;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $diasUteis;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $horasFaltando;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $horasNoMesTrabalhadas;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $totalHorasDiasSemana;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $totalHorasDomingo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $totalHorasSabado;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $progresso;

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


    public function getDiasFaltados(): ?string
    {
        return $this->diasFaltados;
    }

    public function setDiasFaltados(?string $diasFaltados): self
    {
        $this->diasFaltados = $diasFaltados;

        return $this;
    }

    public function getDiasTrabalhados(): ?string
    {
        return $this->diasTrabalhados;
    }

    public function setDiasTrabalhados(?string $diasTrabalhados): self
    {
        $this->diasTrabalhados = $diasTrabalhados;

        return $this;
    }

    public function getDiasUteis(): ?string
    {
        return $this->diasUteis;
    }

    public function setDiasUteis(?string $diasUteis): self
    {
        $this->diasUteis = $diasUteis;

        return $this;
    }

    public function getHorasFaltando(): ?string
    {
        return $this->horasFaltando;
    }

    public function setHorasFaltando(?string $horasFaltando): self
    {
        $this->horasFaltando = $horasFaltando;

        return $this;
    }

    public function getHorasNoMesTrabalhadas(): ?string
    {
        return $this->horasNoMesTrabalhadas;
    }

    public function setHorasNoMesTrabalhadas(?string $horasNoMesTrabalhadas): self
    {
        $this->horasNoMesTrabalhadas = $horasNoMesTrabalhadas;

        return $this;
    }

    public function getTotalHorasDiasSemana(): ?string
    {
        return $this->totalHorasDiasSemana;
    }

    public function setTotalHorasDiasSemana(?string $totalHorasDiasSemana): self
    {
        $this->totalHorasDiasSemana = $totalHorasDiasSemana;

        return $this;
    }

    public function getTotalHorasDomingo(): ?string
    {
        return $this->totalHorasDomingo;
    }

    public function setTotalHorasDomingo(?string $totalHorasDomingo): self
    {
        $this->totalHorasDomingo = $totalHorasDomingo;

        return $this;
    }

    public function getTotalHorasSabado(): ?string
    {
        return $this->totalHorasSabado;
    }

    public function setTotalHorasSabado(?string $totalHorasSabado): self
    {
        $this->totalHorasSabado = $totalHorasSabado;

        return $this;
    }

    public function getProgresso(): ?string
    {
        return $this->progresso;
    }

    public function setProgresso(?string $progresso): self
    {
        $this->progresso = $progresso;

        return $this;
    }
}
