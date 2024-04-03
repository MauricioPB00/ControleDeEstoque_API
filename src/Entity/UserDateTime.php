<?php

namespace App\Entity;

use App\Repository\UserDateTimeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserDateTimeRepository::class)
 */
class UserDateTime
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $time;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", fetch="EAGER")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $insert;

     /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $update;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $horaeditada;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getTime(): ?\DateTimeInterface
    {
        return $this->time;
    }

    public function setTime(?\DateTimeInterface $time): self
    {
        $this->time = $time;

        return $this;
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


    public function getInsert(): ?string
    {
        return $this->insert;
    }

    public function setInsert(?string $insert): self
    {
        $this->insert = $insert;

        return $this;
    }

    public function getUpdate(): ?string
    {
        return $this->update;
    }

    public function setUpdate(?string $update): self
    {
        $this->update = $update;

        return $this;
    }

    public function getHoraeditada(): ?string
    {
        return $this->horaeditada;
    }

    public function setHoraeditada(?string $horaeditada): self
    {
        $this->horaeditada = $horaeditada;

        return $this;
    }
}
