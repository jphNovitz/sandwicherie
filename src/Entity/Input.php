<?php

namespace App\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InputRepository")
 */
class Input
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(name="slug", type="string", length=20, unique=true)
     */
    private $slug;

    /**
     * @var datetime $created
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @var datetime $updated
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updated;

    /**
     * @var datetime $dateEntry
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateEntry;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="App\Entity\Line", mappedBy="input", cascade={"persist", "remove"})
     */
    private $lines;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var String
     */
    private $name;

    /**
     * Input constructor.
     */
    public function __construct()
    {
        $this->created = new \DateTime();
        $this->updated = new \DateTime();
        $this->dateEntry = new \DateTime();
        $this->lines = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return String
     */
    public function getName(): String
    {
        return $this->name;
    }

    /**
     * @return ArrayCollection
     */
    public function getLines(): ArrayCollection
    {
        return $this->lines;
    }

    /**
     * @param mixed $line
     */
    public function addLine($line)
    {
        $this->lines->add($line);
        // uncomment if you want to update other side
        //$line->setInput($this);
    }

    /**
     * @param mixed $line
     */
    public function removeLine($line)
    {
        $this->lines->removeElement($line);
        // uncomment if you want to update other side
        //$line->setInput(null);
    }

    /**
     * @return DateTime
     */
    public function getDateEntry(): DateTime
    {
        return $this->dateEntry;
    }

    /**
     * @param DateTime $dateEntry
     */
    public function setDateEntry(DateTime $dateEntry): void
    {
        $this->dateEntry = $dateEntry;
        $this->name= $dateEntry->format('Y-m-d H:i:s');
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

}
