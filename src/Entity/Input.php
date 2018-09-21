<?php

namespace App\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Gedmo\Mapping\Annotation as Gedmo;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InputRepository")
 * @ORM\HasLifecycleCallbacks()
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
     * @var string $title
     *
     * @ORM\Column(type="string")
     */
    private $title;

    /**
     * @var Provider $provider
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Provider", inversedBy="inputs")
     */
    private $provider;

    /**
     * @var ArrayCollection $tags
     * @ORM\ManyToMany(targetEntity="App\Entity\Tag", cascade={"persist"})
     */
    private $tags;

    /**
     * @Gedmo\Slug(fields={"title", "id"})
     * @ORM\Column(length=128, unique=true)
     */
    private $slug;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Invoice", mappedBy="input", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $invoices;

    /**
     * Input constructor.
     */

    public function __construct()
    {
        $this->tags = new ArrayCollection();
        $this->invoices = new ArrayCollection();
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
    public function getComment(): ?string
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
    public function getTags(): ?Collection
    {
        return $this->tags;
    }

    /**
     * @param mixed $tag
     */
    public function addTag($tag)
    {
        $this->tags->add($tag);
    }

    /**
     * @param mixed $tag
     */
    public function removeTag($tag)
    {
        $this->tags->removeElement($tag);
    }

    /**
     * @return Provider
     */
    public function getProvider(): ?Provider
    {
        return $this->provider;
    }

    /**
     * @param Provider $provider
     */
    public function setProvider(Provider $provider): void
    {
        $this->provider = $provider;
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
     * @ORM\PostPersist
     */
    public function setSlug($slug): void
    {
        $this->slug = $slug;
    }

    /**
     * @return string
     */
    public function getTitle(): string
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
     * @return ArrayCollection
     */
    public function getInvoices(): ?Collection
    {
        return $this->invoices;
    }

    /**
     * @param mixed $invoice
     */
    public function addInvoice($invoice)
    {
        $this->invoices->add($invoice);
        $invoice->setInput($this);
    }

    /**
     * @param mixed $invoice
     */
    public function removeInvoice($invoice)
    {
        $this->invoices->removeElement($invoice);
        $invoice->setInput(null);
    }


}
