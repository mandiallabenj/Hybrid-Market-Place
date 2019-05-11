<?php

namespace App\Entity;

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
}
