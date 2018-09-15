<?php

namespace App\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;

use Doctrine\ORM\Mapping as ORM;

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
     * @var string $comment
     *
     * @ORM\Column(type="string")
     */
    private $comment;

    /**
     * @var ArrayCollection $provider
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Provider", inversedBy="inputs")
     */
    private $provider;

    /**
     * @var ArrayCollection $tags
     * @ORM\ManyToMany(targetEntity="App\Entity\Tag")
     */
    private $tags;

    public function __construct()
    {
        $this->provider = new ArrayCollection();
        $this->tags = new ArrayCollection();
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
    public function setId($id): void
    {
        $this->id = $id;
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
    public function getComment(): string
    {
        return $this->comment;
    }

    /**
     * @param string $comment
     */
    public function setComment(string $comment): void
    {
        $this->comment = $comment;
    }

    /**
     * @return ArrayCollection
     */
    public function getProvider(): ArrayCollection
    {
        return $this->provider;
    }

    /**
     * @param mixed $provider
     */
    public function addProvider($provider)
    {
        $this->provider->add($provider);
        $provider->setInput($this);
    }

    /**
     * @param mixed $provider
     */
    public function removeProvider($provider)
    {
        $this->provider->removeElement($provider);
        $provider->setInput(null);
    }

    /**
     * @return ArrayCollection
     */
    public function getTags(): ArrayCollection
    {
        return $this->tags;
    }

    /**
     * @param mixed $tag
     */
    public function addTag($tag)
    {
        $this->tags->add($tag);
        // uncomment if you want to update other side
        //$tag->setInput($this);
    }

    /**
     * @param mixed $tag
     */
    public function removeTag($tag)
    {
        $this->tags->removeElement($tag);
        // uncomment if you want to update other side
        //$tag->setInput(null);
    }


}
