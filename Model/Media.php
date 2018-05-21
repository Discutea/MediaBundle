<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 21/05/18
 * Time: 17:31
 */

namespace Discutea\MediaBundle\Model;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\SerializedName;

/**
 * Abstract Media.
 *
 * @ORM\MappedSuperclass
 * @ExclusionPolicy("all")
 */
abstract class Media implements MediaInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Expose
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @Expose
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="alt", type="string", length=255, nullable=true)
     * @Expose
     */
    protected $alt;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     * @Expose
     */
    protected $description;

    /**
     * @var int
     *
     * @ORM\Column(name="width", type="integer", nullable=true)
     * @Expose
     */
    protected $width;

    /**
     * @var int
     *
     * @ORM\Column(name="height", type="integer", nullable=true)
     * @Expose
     */
    protected $height;

    /**
     * @var int
     *
     * @ORM\Column(name="size", type="integer")
     * @Expose
     */
    protected $size;

    /**
     * @var string
     *
     * @ORM\Column(name="mime_type", type="string", length=65)
     * @Expose
     */
    protected $mimeType;

    /**
     * @var string
     *
     * @ORM\Column(name="extension", type="string", length=25)
     * @Expose
     */
    protected $extension;

    /**
     * @var string
     *
     * @ORM\Column(name="reference", type="string", length=255)
     * @Expose
     */
    protected $reference;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     * @Expose
     */
    protected $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     * @Expose
     */
    protected $updatedAt;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="integer")
     * @Expose
     */
    protected $type;

    /**
     * @var float
     *
     * @ORM\Column(name="focus_left", type="float", options={"default" = 50})
     * @Expose
     */
    protected $focusLeft = 50;

    /**
     * @var float
     *
     * @ORM\Column(name="focus_top", type="float", options={"default" = 50})
     * @Expose
     */
    protected $focusTop = 50;

    /**
     * @var string
     *
     * @ORM\Column(name="filter", type="string", length=255, nullable=true)
     */
    protected $filter;

    /**
     * @var string
     * @Expose
     * @SerializedName("filter")
     */
    protected $cryptedFilter;

    /**
     * @var bool
     *
     * Only for MediaManager: if the focus is edited, clear cache of media contexts
     */
    protected $focusIsEdited = false;

    /**
     * @var \Symfony\Component\HttpFoundation\File\File
     *
     * Only for MediaManager: On persist, if the file is defined, move id on media original directory
     */
    protected $file;

    /**
     * @var array
     *
     * Media urls
     * @Expose
     */
    protected $urls = array();

    /**
     * @var string
     *
     * Get media html for reference
     * @Expose
     */
    protected $html;

    const OTHER = 1;
    const IMAGE = 2;
    const VIDEO = 3;
    const AUDIO = 4;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->createdAt = new \Datetime();
        $this->updatedAt = new \Datetime();
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
     * @param string $alt
     * @return MediaInterface
     */
    public function setAlt(string $alt): MediaInterface
    {
        $this->alt = $alt;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getAlt(): ?string
    {
        return $this->alt;
    }

    /**
     * @param string $description
     * @return MediaInterface
     */
    public function setDescription(string $description): MediaInterface
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param int $width
     * @return MediaInterface
     */
    public function setWidth(int $width): MediaInterface
    {
        $this->width = $width;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getWidth(): ?int
    {
        return $this->width;
    }

    /**
     * @param int $height
     * @return MediaInterface
     */
    public function setHeight(int $height): MediaInterface
    {
        $this->height = $height;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getHeight(): ?int
    {
        return $this->height;
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

    /**
     * @param \Datetime $updatedAt
     * @return MediaInterface
     */
    public function setUpdatedAt(\Datetime $updatedAt): MediaInterface
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param int $type
     * @return MediaInterface
     */
    public function setType(int $type): MediaInterface
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getType(): ?int
    {
        return $this->type;
    }

    /**
     * @param float $focusLeft
     * @return MediaInterface
     */
    public function setFocusLeft(float $focusLeft): MediaInterface
    {
        if ($focusLeft !== $this->focusLeft) {
            $this->focusIsEdited = true;
            $this->focusLeft = $focusLeft;
        }

        return $this;
    }

    /**
     * @return float
     */
    public function getFocusLeft(): float
    {
        return $this->focusLeft;
    }

    /**
     * @param float $focusTop
     * @return MediaInterface
     */
    public function setFocusTop(float $focusTop): MediaInterface
    {
        if ($focusTop !== $this->focusTop) {
            $this->focusIsEdited = true;
            $this->focusTop = $focusTop;
        }

        return $this;
    }

    /**
     * @return float
     */
    public function getFocusTop(): float
    {
        return $this->focusTop;
    }

    /**
     * @param string $filter
     * @return MediaInterface
     */
    public function setFilter(string $filter): MediaInterface
    {
        $this->filter = $filter;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getFilter(): ?string
    {
        return $this->filter;
    }

    /**
     * @param string $cryptedFilter
     * @return MediaInterface
     */
    public function setCryptedFilter(string $cryptedFilter): MediaInterface
    {
        $this->cryptedFilter = $cryptedFilter;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getCryptedFilter(): ?string
    {
        return $this->cryptedFilter;
    }

    /**
     * @param bool $focusIsEdited
     * @return MediaInterface
     */
    public function setFocusIsEdited(bool $focusIsEdited): MediaInterface
    {
        $this->focusIsEdited = $focusIsEdited;

        return $this;
    }

    /**
     * @return bool
     */
    public function getFocusIsEdited(): bool
    {
        return $this->focusIsEdited;
    }

    /**
     * @param null|File $file
     * @return MediaInterface
     */
    public function setFile(?File $file): MediaInterface
    {
        $this->file = $file;

        return $this;
    }

    /**
     * @return null|File
     */
    public function getFile(): ?File
    {
        return $this->file;
    }

    /**
     * @param array $urls
     * @return MediaInterface
     */
    public function setUrls(array $urls): MediaInterface
    {
        $this->urls = $urls;

        return $this;
    }

    /**
     * @return array
     */
    public function getUrls(): array
    {
        return $this->urls;
    }

    /**
     * @param string $html
     * @return MediaInterface
     */
    public function setHtml(string $html): MediaInterface
    {
        $this->html = $html;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getHtml(): ?string
    {
        return $this->html;
    }
}
