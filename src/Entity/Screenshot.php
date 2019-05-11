<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ScreenshotRepository")
 */
class Screenshot
{
/**
 * @ORM\Id()
 * @ORM\GeneratedValue()
 * @ORM\Column(type="integer")
 */
private $id;

/**
 * @ORM\ManyToOne(targetEntity="App\Entity\Project", inversedBy="screenshots")
 */
private $project;

/**
 * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="screenshots")
 */
private $user;

/**
 * @ORM\Column(type="string", length=255, nullable=true)
 * @Assert\NotBlank(message="Please, upload the project screenshot as a JPEG,JPG or PNG file.")
 * @Assert\File(
 * maxSize="20M",
 * mimeTypes={ "image/jpg","image/jpeg","image/png" })
 */
private $screenshot;

public function getId(): ?int
{
return $this->id;
}

public function getProject(): ?Project
{
return $this->project;
}

public function setProject(?Project $project): self
{
$this->project = $project;

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

public function getScreenshot(): ?string
{
return $this->screenshot;
}

public function setScreenshot(?string $screenshot): self
{
$this->screenshot = $screenshot;

return $this;
}
}
