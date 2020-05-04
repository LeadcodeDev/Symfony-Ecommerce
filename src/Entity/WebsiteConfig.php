<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WebsiteConfigRepository")
 */
class WebsiteConfig
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
     * @ORM\Column(type="text")
     */
    private $describes;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $author;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $copyright;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $twitter_tag;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Keywords", mappedBy="websiteConfig")
     */
    private $keywords;

    public function __construct()
    {
        $this->keywords = new ArrayCollection();
    }

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

    public function getDescribes(): ?string
    {
        return $this->describes;
    }

    public function setDescribes(string $describes): self
    {
        $this->describes = $describes;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getCopyright(): ?string
    {
        return $this->copyright;
    }

    public function setCopyright(string $copyright): self
    {
        $this->copyright = $copyright;

        return $this;
    }

    public function getTwitterTag(): ?string
    {
        return $this->twitter_tag;
    }

    public function setTwitterTag(string $twitter_tag): self
    {
        $this->twitter_tag = $twitter_tag;

        return $this;
    }

    /**
     * @return Collection|Keywords[]
     */
    public function getKeywords(): Collection
    {
        return $this->keywords;
    }

    public function addKeyword(Keywords $keyword): self
    {
        if (!$this->keywords->contains($keyword)) {
            $this->keywords[] = $keyword;
            $keyword->setWebsiteConfig($this);
        }

        return $this;
    }

    public function removeKeyword(Keywords $keyword): self
    {
        if ($this->keywords->contains($keyword)) {
            $this->keywords->removeElement($keyword);
            // set the owning side to null (unless already changed)
            if ($keyword->getWebsiteConfig() === $this) {
                $keyword->setWebsiteConfig(null);
            }
        }

        return $this;
    }
}
