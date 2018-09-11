<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PrivacyRepository")
 */
class Privacy
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var datetime $created
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @var datetime $created
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updated;

    /**
     * @var string $isActive
     *
     * @ORM\Column(type="boolean", unique=true, nullable=false)
     */
    private $isActive;

    /**
     * @var string $title
     *
     * @ORM\Column(type="string", length=80)
     */
    private $title;

    /**
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(length=80, unique=true)
     */
    private $slug;

    /**
     * @var string $intro
     *
     * @ORM\Column(type="string", length=255)
     */
    private $intro;

    /**
     * @var string $outro
     *
     * @ORM\Column(type="string", length=80)
     */
    private $outro;

    /**
     * @var string $description
     *
     * @ORM\Column(type="text")
     */
    private $description;


    public function __construct()
    {
        $this->isActive = false ;
    }

    /**
     * @return DateTime
     */
    public function getCreated(): DateTime
    {
        return $this->created;
    }

    /**
     * @param DateTime $created
     */
    public function setCreated(DateTime $created): void
    {
        $this->created = $created;
    }

    /**
     * @return DateTime
     */
    public function getUpdated(): DateTime
    {
        return $this->updated;
    }

    /**
     * @param DateTime $updated
     */
    public function setUpdated(DateTime $updated): void
    {
        $this->updated = $updated;
    }

    /**
     * @return string
     */
    public function getisActive(): string
    {
        return $this->isActive;
    }

    /**
     * @param string $isActive
     */
    public function setIsActive(string $isActive): void
    {
        $this->isActive = $isActive;
    }



    /**
     * @return string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param mixed $slug
     */
    public function setSlug($slug): void
    {
        $this->slug = $slug;
    }

    /**
     * @return string
     */
    public function getIntro(): ?string
    {
        return $this->intro;
    }

    /**
     * @param string $intro
     */
    public function setIntro(string $intro): void
    {
        $this->intro = $intro;
    }

    /**
     * @return string
     */
    public function getOutro(): ?string
    {
        return $this->outro;
    }

    /**
     * @param string $outro
     */
    public function setOutro(string $outro): void
    {
        $this->outro = $outro;
    }

    /**
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }



}
