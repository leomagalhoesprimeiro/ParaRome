<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProjetoRepository")
 */
class Projeto
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public $nome;

    /**
     * @ORM\Column(type="boolean")
     */
    public $status;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Aluno", mappedBy="projeto")
     */
    public $bolsista;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Professor", mappedBy="projeto")
     */
    public $Orientador;

    public function __construct()
    {
        $this->bolsista = new ArrayCollection();
        $this->Orientador = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection|Aluno[]
     */
    public function getBolsista(): Collection
    {
        return $this->bolsista;
    }

    public function addBolsistum(Aluno $bolsistum): self
    {
        if (!$this->bolsista->contains($bolsistum)) {
            $this->bolsista[] = $bolsistum;
            $bolsistum->setProjeto($this);
        }

        return $this;
    }

    public function removeBolsistum(Aluno $bolsistum): self
    {
        if ($this->bolsista->contains($bolsistum)) {
            $this->bolsista->removeElement($bolsistum);
            // set the owning side to null (unless already changed)
            if ($bolsistum->getProjeto() === $this) {
                $bolsistum->setProjeto(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Professor[]
     */
    public function getOrientador(): Collection
    {
        return $this->Orientador;
    }

    public function addOrientador(Professor $orientador): self
    {
        if (!$this->Orientador->contains($orientador)) {
            $this->Orientador[] = $orientador;
            $orientador->setProjeto($this);
        }

        return $this;
    }

    public function removeOrientador(Professor $orientador): self
    {
        if ($this->Orientador->contains($orientador)) {
            $this->Orientador->removeElement($orientador);
            // set the owning side to null (unless already changed)
            if ($orientador->getProjeto() === $this) {
                $orientador->setProjeto(null);
            }
        }

        return $this;
    }

}
