<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProjectfilesRepository")
 */
class Projectfiles
{
/**
 * @ORM\Id()
 * @ORM\GeneratedValue()
 * @ORM\Column(type="integer")
 */
private $id;

/**
 * @ORM\Column(type="string", length=255, nullable=true) * 
 * @Assert\NotBlank(message="Please, upload the project File as a ZIP.")
 * @Assert\File(
 * maxSize="2M",
 * mimeTypes={ "application/zip","application/octet-stream", "application/x-zip-compressed", "multipart/x-zip"})
 */
private $projectfile;


/**
 * @ORM\ManyToOne(targetEntity="App\Entity\user", inversedBy="projectfiles")
 */
private $user;

/**
 * @ORM\Column(type="datetime")
 */
private $createdAt;



/**
 * @ORM\ManyToOne(targetEntity="App\Entity\project", inversedBy="projectfiles")
 */
private $project;

/**
 * @ORM\Column(type="string", length=255, nullable=true)
 */
private $versionName;

/**
 * @ORM\Column(type="text", nullable=true)
 */
private $features;



public function getId(): ?int
{
return $this->id;
}

public function getProjectfile(): ?string
{
return $this->projectfile;
}

public function setProjectfile(?string $projectfile): self
{
$this->projectfile = $projectfile;

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

public function getCreatedAt(): ?\DateTimeInterface
{
return $this->createdAt;
}

public function setCreatedAt(\DateTimeInterface $createdAt): self
{
$this->createdAt = $createdAt;

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

public function getVersionName(): ?string
{
    return $this->versionName;
}

public function setVersionName(?string $versionName): self
{
    $this->versionName = $versionName;

    return $this;
}

public function getFeatures(): ?string
{
    return $this->features;
}

public function setFeatures(?string $features): self
{
    $this->features = $features;

    return $this;
}

}
