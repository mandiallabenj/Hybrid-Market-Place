<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CollaboratorProjectsRepository")
 */
class CollaboratorProjects
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Collaborator", inversedBy="collaboratorProjects")
     */
    private $collaborator;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCollaborator(): ?Collaborator
    {
        return $this->collaborator;
    }

    public function setCollaborator(?Collaborator $collaborator): self
    {
        $this->collaborator = $collaborator;

        return $this;
    }
}
