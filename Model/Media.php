<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 21/05/18
 * Time: 17:31
 */

namespace Discutea\MediaBundle\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * Abstract Media.
 *
 * @ORM\MappedSuperclass
 */
abstract class Media implements MediaInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    protected $name;

    /**
     * @var int
     *
     * @ORM\Column(name="size", type="integer")
     */
    protected $size;

    /**
     * @var string
     *
     * @ORM\Column(name="mime_type", type="string", length=65)
     */
    protected $mimeType;

    /**
     * @var string
     *
     * @ORM\Column(name="extension", type="string", length=25)
     */
    protected $extension;

    /**
     * @var string
     *
     * @ORM\Column(name="reference", type="string", length=255)
     */
    protected $reference;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    protected $createdAt;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->createdAt = new \Datetime();
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->name ?? 'n/a';
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param string $name
     * @return MediaInterface
     */
    public function setName(string $name): MediaInterface
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param int $size
     * @return MediaInterface
     */
    public function setSize(int $size): MediaInterface
    {
        $this->size = $size;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getSize(): ?int
    {
        return $this->size;
    }

    /**
     * @param string $mimeType
     * @return MediaInterface
     */
    public function setMimeType(string $mimeType): MediaInterface
    {
        $this->mimeType = $mimeType;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getMimeType(): ?string
    {
        return $this->mimeType;
    }

    /**
     * @param string $extension
     * @return MediaInterface
     */
    public function setExtension(string $extension): MediaInterface
    {
        $this->extension = strtolower($extension);

        return $this;
    }

    /**
     * @return null|string
     */
    public function getExtension(): ?string
    {
        return $this->extension;
    }

    /**
     * @param string $reference
     * @return MediaInterface
     */
    public function setReference(string $reference): MediaInterface
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getReference(): ?string
    {
        return $this->reference;
    }

    /**
     * @param \Datetime $createdAt
     * @return MediaInterface
     */
    public function setCreatedAt(\Datetime $createdAt): MediaInterface
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }
}
