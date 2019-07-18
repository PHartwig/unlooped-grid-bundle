<?php

namespace Unlooped\GridBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Unlooped\GridBundle\Repository\FilterRepository")
 */
class Filter
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="Unlooped\GridBundle\Entity\FilterRow", mappedBy="filter", orphanRemoval=true, cascade={"ALL"})
     */
    private $rows;

    /**
     * @ORM\Column(type="string")
     */
    private $entity;

    /**
     * @ORM\Column(type="string", unique=true)
     */
    private $hash;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $route;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $name;

    private $fields;
    private $isSaveable = false;

    public function __construct()
    {
        $this->rows = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|FilterRow[]
     */
    public function getRows(): Collection
    {
        return $this->rows;
    }

    public function addRow(FilterRow $row): self
    {
        if (!$this->rows->contains($row)) {
            $this->rows[] = $row;
            $row->setFilter($this);
        }

        return $this;
    }

    public function removeRow(FilterRow $row): self
    {
        if ($this->rows->contains($row)) {
            $this->rows->removeElement($row);
            // set the owning side to null (unless already changed)
            if ($row->getFilter() === $this) {
                $row->setFilter(null);
            }
        }

        return $this;
    }

    public function getFields()
    {
        return $this->fields;
    }

    public function setFields($fields): self
    {
        $this->fields = $fields;

        return $this;
    }

    public function setIsSaveable(bool $isSaveable): void
    {
        $this->isSaveable = $isSaveable;
    }

    public function isSaveable(): bool
    {
        return $this->isSaveable;
    }

    public function getEntity(): string
    {
        return $this->entity;
    }

    public function setEntity(string $entity): self
    {
        $this->entity = $entity;

        return $this;
    }

    public function getHash(): ?string
    {
        return $this->hash;
    }

    public function setHash(string $hash): self
    {
        $this->hash = $hash;

        return $this;
    }

    public function getRoute(): ?string
    {
        return $this->route;
    }

    public function setRoute(string $route): self
    {
        $this->route = $route;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }


    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

}