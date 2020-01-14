<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InstagramRepository")
 */
class Instagram
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=190, nullable=true)
     */
    private $insta_id;

    /**
     * @ORM\Column(type="string", length=190, nullable=true)
     */
    private $link;

    /**
     * @ORM\Column(type="string", length=240)
     */
    private $thumbnail;

    /**
     * @ORM\Column(type="string", length=240, nullable=true)
     */
    private $low_resolution;

    /**
     * @ORM\Column(type="string", length=240)
     */
    private $standard_resolution;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $caption;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getInstaId()
    {
        return $this->insta_id;
    }

    /**
     * @param mixed $insta_id
     */
    public function setInstaId($insta_id): void
    {
        $this->insta_id = $insta_id;
    }

    /**
     * @return mixed
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @param mixed $link
     */
    public function setLink($link): void
    {
        $this->link = $link;
    }



    public function getThumbnail(): ?string
    {
        return $this->thumbnail;
    }

    public function setThumbnail(string $thumbnail): self
    {
        $this->thumbnail = $thumbnail;

        return $this;
    }

    public function getLowResolution(): ?string
    {
        return $this->low_resolution;
    }

    public function setLowResolution(?string $low_resolution): self
    {
        $this->low_resolution = $low_resolution;

        return $this;
    }

    public function getStandardResolution(): ?string
    {
        return $this->standard_resolution;
    }

    public function setStandardResolution(string $standard_resolution): self
    {
        $this->standard_resolution = $standard_resolution;

        return $this;
    }

    public function getCaption(): ?string
    {
        return $this->caption;
    }

    public function setCaption(?string $caption): self
    {
        $this->caption = $caption;

        return $this;
    }
}
