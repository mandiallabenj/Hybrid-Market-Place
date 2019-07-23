<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CollaboratorRepository")
 */
class Collaborator
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="collaborators")
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Url(
     *    dnsMessage = "The host '{{ value }}' could not be resolved.",
     *    message = "The url '{{ value }}' is not a valid url",
     *    protocols = {"http", "https", "ftp"}
     * )
     */
    private $githubUrl;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $reason;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $isAccepted;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CollaboratorProjects", mappedBy="collaborator")
     */
    private $collaboratorProjects;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\project", inversedBy="collaborators")
     */
    private $project;

    public function __construct()
    {
        $this->collaboratorProjects = new ArrayCollection();
    }

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

    public function getGithubUrl(): ?string
    {
        return $this->githubUrl;
    }

    public function setGithubUrl(string $githubUrl): self
    {
        $this->githubUrl = $githubUrl;

        return $this;
    }

    public function getReason(): ?string
    {
        return $this->reason;
    }

    public function setReason(string $reason): self
    {
        $this->reason = $reason;

        return $this;
    }

    public function getIsAccepted(): ?string
    {
        return $this->isAccepted;
    }

    public function setIsAccepted(string $isAccepted): self
    {
        $this->isAccepted = $isAccepted;

        return $this;
    }

    /**
     * @return Collection|CollaboratorProjects[]
     */
    public function getCollaboratorProjects(): Collection
    {
        return $this->collaboratorProjects;
    }

    public function addCollaboratorProject(CollaboratorProjects $collaboratorProject): self
    {
        if (!$this->collaboratorProjects->contains($collaboratorProject)) {
            $this->collaboratorProjects[] = $collaboratorProject;
            $collaboratorProject->setCollaborator($this);
        }

        return $this;
    }

    public function removeCollaboratorProject(CollaboratorProjects $collaboratorProject): self
    {
        if ($this->collaboratorProjects->contains($collaboratorProject)) {
            $this->collaboratorProjects->removeElement($collaboratorProject);
            // set the owning side to null (unless already changed)
            if ($collaboratorProject->getCollaborator() === $this) {
                $collaboratorProject->setCollaborator(null);
            }
        }

        return $this;
    }

    public function getProject(): ?project
    {
        return $this->project;
    }

    public function setProject(?project $project): self
    {
        $this->project = $project;

        return $this;
    }
}
