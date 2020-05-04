<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\KeywordsRepository")
 */
class Keywords
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
    private $label;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\WebsiteConfig", inversedBy="keywords")
     */
    private $websiteConfig;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getWebsiteConfig(): ?WebsiteConfig
    {
        return $this->websiteConfig;
    }

    public function setWebsiteConfig(?WebsiteConfig $websiteConfig): self
    {
        $this->websiteConfig = $websiteConfig;

        return $this;
    }
}
