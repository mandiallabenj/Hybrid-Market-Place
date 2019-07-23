<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\ProjectRepository")

 */
class Project
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
private $title;

/**
 * @ORM\Column(type="string", length=255)
 * @Assert\NotBlank(message="Please, upload the project icon as a JPEG,JPG or PNG file.")
 * @Assert\File(
 * maxSize="2M",
 * mimeTypes={ "image/jpg","image/jpeg","image/png" })
 */
private $icon;

/**
 * @ORM\Column(type="text")
 */
private $description;

/**
 * @ORM\Column(type="datetime")
 */
private $publishedAt;

/**
 * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="projects" ,cascade={"persist"})
 * @ORM\JoinColumn(nullable=false)
 */
private $user;


/**
 * @ORM\OneToMany(targetEntity="App\Entity\Issues", mappedBy="project")
 */
private $issues;

/**
 * @ORM\OneToMany(targetEntity="App\Entity\Donations", mappedBy="project")
 */
private $donations;


/**
 * @ORM\OneToMany(targetEntity="App\Entity\Projectfiles", mappedBy="project")
 */
private $projectfiles;


/**
 * @ORM\Column(type="string", length=255, nullable=true)
 */
private $category;

/**
 * @ORM\OneToMany(targetEntity="App\Entity\Screenshot", mappedBy="project")
 */
private $screenshots;

/**
 * @ORM\Column(type="string", length=255, nullable=true)
 */
private $isEnterprise;

/**
 * @ORM\OneToMany(targetEntity="App\Entity\Collaborator", mappedBy="project")
 */
private $collaborators;

/**
 * @ORM\Column(type="string", length=255, nullable=true)
 */
private $isblocked;

/**
 * @ORM\Column(type="string", length=255, nullable=true)
 */
private $isApproved;

/**
 * @ORM\Column(type="integer", nullable=true)
 */
private $price;



public function __construct()
{
 
    $this->issues = new ArrayCollection();
    $this->donations = new ArrayCollection();
    $this->projectfiles = new ArrayCollection();
    $this->screenshots = new ArrayCollection();
    $this->collaborators = new ArrayCollection();
}



public function getId(): ?int
{
return $this->id;
}

public function getTitle(): ?string
{
return $this->title;
}

public function setTitle(string $title): self
{
$this->title = $title;

return $this;
}

public function getIcon(): ?string
{
return $this->icon;
}

public function setIcon(string $icon): self
{
$this->icon = $icon;

return $this;
}

public function getDescription(): ?string
{
return $this->description;
}

public function setDescription(string $description): self
{
$this->description = $description;

return $this;
}

public function getUser(): ?user
{
return $this->user;
}

public function setUser(?user $user): self
{
$this->user = $user;

return $this;
}

public function getPublishedAt(): ?\DateTimeInterface
{
return $this->publishedAt;
}

/*
 * @ORM/PrePersist
 * 
 */
public function setPublishedAt(\DateTimeInterface $publishedAt): self
{
$this->publishedAt = $publishedAt;

return $this;
}


/**
 * @return Collection|Issues[]
 */
public function getIssues(): Collection
{
    return $this->issues;
}

public function addIssue(Issues $issue): self
{
    if (!$this->issues->contains($issue)) {
        $this->issues[] = $issue;
        $issue->setProject($this);
    }

    return $this;
}

public function removeIssue(Issues $issue): self
{
    if ($this->issues->contains($issue)) {
        $this->issues->removeElement($issue);
        // set the owning side to null (unless already changed)
        if ($issue->getProject() === $this) {
            $issue->setProject(null);
        }
    }

    return $this;
}

/**
 * @return Collection|Donations[]
 */
public function getDonations(): Collection
{
    return $this->donations;
}

public function addDonation(Donations $donation): self
{
    if (!$this->donations->contains($donation)) {
        $this->donations[] = $donation;
        $donation->setProject($this);
    }

    return $this;
}

public function removeDonation(Donations $donation): self
{
    if ($this->donations->contains($donation)) {
        $this->donations->removeElement($donation);
        // set the owning side to null (unless already changed)
        if ($donation->getProject() === $this) {
            $donation->setProject(null);
        }
    }

    return $this;
}


/**
 * @return Collection|Projectfiles[]
 */
public function getProjectfiles(): Collection
{
    return $this->projectfiles;
}

public function addProjectfile(Projectfiles $projectfile): self
{
    if (!$this->projectfiles->contains($projectfile)) {
        $this->projectfiles[] = $projectfile;
        $projectfile->setProject($this);
    }

    return $this;
}

public function removeProjectfile(Projectfiles $projectfile): self
{
    if ($this->projectfiles->contains($projectfile)) {
        $this->projectfiles->removeElement($projectfile);
        // set the owning side to null (unless already changed)
        if ($projectfile->getProject() === $this) {
            $projectfile->setProject(null);
        }
    }

    return $this;
}



public function getCategory(): ?string
{
    return $this->category;
}

public function setCategory(?string $category): self
{
    $this->category = $category;

    return $this;
}

/**
 * @return Collection|Screenshot[]
 */
public function getScreenshots(): Collection
{
    return $this->screenshots;
}

public function addScreenshot(Screenshot $screenshot): self
{
    if (!$this->screenshots->contains($screenshot)) {
        $this->screenshots[] = $screenshot;
        $screenshot->setProject($this);
    }

    return $this;
}

public function removeScreenshot(Screenshot $screenshot): self
{
    if ($this->screenshots->contains($screenshot)) {
        $this->screenshots->removeElement($screenshot);
        // set the owning side to null (unless already changed)
        if ($screenshot->getProject() === $this) {
            $screenshot->setProject(null);
        }
    }

    return $this;
}

public function getIsEnterprise(): ?string
{
    return $this->isEnterprise;
}

public function setIsEnterprise(?string $isEnterprise): self
{
    $this->isEnterprise = $isEnterprise;

    return $this;
}

/**
 * @return Collection|Collaborator[]
 */
public function getCollaborators(): Collection
{
    return $this->collaborators;
}

public function addCollaborator(Collaborator $collaborator): self
{
    if (!$this->collaborators->contains($collaborator)) {
        $this->collaborators[] = $collaborator;
        $collaborator->setProject($this);
    }

    return $this;
}

public function removeCollaborator(Collaborator $collaborator): self
{
    if ($this->collaborators->contains($collaborator)) {
        $this->collaborators->removeElement($collaborator);
        // set the owning side to null (unless already changed)
        if ($collaborator->getProject() === $this) {
            $collaborator->setProject(null);
        }
    }

    return $this;
}

public function getIsblocked(): ?string
{
    return $this->isblocked;
}

public function setIsblocked(?string $isblocked): self
{
    $this->isblocked = $isblocked;

    return $this;
}

public function getIsApproved(): ?string
{
    return $this->isApproved;
}

public function setIsApproved(?string $isApproved): self
{
    $this->isApproved = $isApproved;

    return $this;
}

public function getPrice(): ?int
{
    return $this->price;
}

public function setPrice(?int $price): self
{
    $this->price = $price;

    return $this;
}




}

