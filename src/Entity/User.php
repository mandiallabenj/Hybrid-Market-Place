<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields={"username"}, message="There is already an account with this username")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Project", mappedBy="user")
     */
    private $projects;

   

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Issues", mappedBy="user")
     */
    private $issues;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Donations", mappedBy="user")
     */
    private $donations;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Projectfiles", mappedBy="user")
     */
    private $projectfiles;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Screenshot", mappedBy="user")
     */
    private $screenshots;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Collaborator", mappedBy="user")
     */
    private $collaborators;

     

    public function __construct()
    {
        $this->projects = new ArrayCollection();
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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
     * @return Collection|Project[]
     */
    public function getProjects(): Collection
    {
        return $this->projects;
    }

    public function addProject(Project $project): self
    {
        if (!$this->projects->contains($project)) {
            $this->projects[] = $project;
            $project->setUser($this);
        }

        return $this;
    }

    public function removeProject(Project $project): self
    {
        if ($this->projects->contains($project)) {
            $this->projects->removeElement($project);
            // set the owning side to null (unless already changed)
            if ($project->getUser() === $this) {
                $project->setUser(null);
            }
        }

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
            $issue->setUser($this);
        }

        return $this;
    }

    public function removeIssue(Issues $issue): self
    {
        if ($this->issues->contains($issue)) {
            $this->issues->removeElement($issue);
            // set the owning side to null (unless already changed)
            if ($issue->getUser() === $this) {
                $issue->setUser(null);
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
            $donation->setUser($this);
        }

        return $this;
    }

    public function removeDonation(Donations $donation): self
    {
        if ($this->donations->contains($donation)) {
            $this->donations->removeElement($donation);
            // set the owning side to null (unless already changed)
            if ($donation->getUser() === $this) {
                $donation->setUser(null);
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
            $projectfile->setUser($this);
        }

        return $this;
    }

    public function removeProjectfile(Projectfiles $projectfile): self
    {
        if ($this->projectfiles->contains($projectfile)) {
            $this->projectfiles->removeElement($projectfile);
            // set the owning side to null (unless already changed)
            if ($projectfile->getUser() === $this) {
                $projectfile->setUser(null);
            }
        }

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
            $screenshot->setUser($this);
        }

        return $this;
    }

    public function removeScreenshot(Screenshot $screenshot): self
    {
        if ($this->screenshots->contains($screenshot)) {
            $this->screenshots->removeElement($screenshot);
            // set the owning side to null (unless already changed)
            if ($screenshot->getUser() === $this) {
                $screenshot->setUser(null);
            }
        }

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
            $collaborator->setUser($this);
        }

        return $this;
    }

    public function removeCollaborator(Collaborator $collaborator): self
    {
        if ($this->collaborators->contains($collaborator)) {
            $this->collaborators->removeElement($collaborator);
            // set the owning side to null (unless already changed)
            if ($collaborator->getUser() === $this) {
                $collaborator->setUser(null);
            }
        }

        return $this;
    }



}
