<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 21/05/18
 * Time: 17:31
 */

namespace Discutea\MediaBundle\Model;

use Symfony\Component\HttpFoundation\File\File;

interface MediaInterface
{
    /**
     * MediaInterface constructor.
     */
    public function __construct();

    /**
     * @return string
     */
    public function __toString(): string;

    /**
     * @return int|null
     */
    public function getId(): ?int;

    /**
     * @param string $name
     * @return MediaInterface
     */
    public function setName(string $name): MediaInterface;

    /**
     * @return null|string
     */
    public function getName(): ?string;

    /**
     * @param string $alt
     * @return MediaInterface
     */
    public function setAlt(string $alt): MediaInterface;

    /**
     * @return null|string
     */
    public function getAlt(): ?string ;

    /**
     * @param string $description
     * @return MediaInterface
     */
    public function setDescription(string $description): MediaInterface;

    /**
     * @return null|string
     */
    public function getDescription(): ?string;

    /**
     * @param int $width
     * @return MediaInterface
     */
    public function setWidth(int $width): MediaInterface;

    /**
     * @return int|null
     */
    public function getWidth(): ?int;

    /**
     * @param int $height
     * @return MediaInterface
     */
    public function setHeight(int $height): MediaInterface;

    /**
     * @return int|null
     */
    public function getHeight(): ?int;

    /**
     * @param int $size
     * @return MediaInterface
     */
    public function setSize(int $size): MediaInterface;

    /**
     * @return int|null
     */
    public function getSize(): ?int;

    /**
     * @param string $mimeType
     * @return MediaInterface
     */
    public function setMimeType(string $mimeType): MediaInterface;

    /**
     * @return null|string
     */
    public function getMimeType(): ?string;

    /**
     * @param string $extension
     * @return MediaInterface
     */
    public function setExtension(string $extension): MediaInterface;

    /**
     * @return null|string
     */
    public function getExtension(): ?string;

    /**
     * @param string $reference
     * @return MediaInterface
     */
    public function setReference(string $reference): MediaInterface;

    /**
     * @return null|string
     */
    public function getReference(): ?string;

    /**
     * @param \Datetime $createdAt
     * @return MediaInterface
     */
    public function setCreatedAt(\Datetime $createdAt): MediaInterface;

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime;

    /**
     * @param \Datetime $updatedAt
     * @return MediaInterface
     */
    public function setUpdatedAt(\Datetime $updatedAt): MediaInterface;

    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime;

    /**
     * @param int $type
     * @return MediaInterface
     */
    public function setType(int $type): MediaInterface;

    /**
     * @return int|null
     */
    public function getType(): ?int;

    /**
     * @param float $focusLeft
     * @return MediaInterface
     */
    public function setFocusLeft(float $focusLeft): MediaInterface;

    /**
     * @return float
     */
    public function getFocusLeft(): float;

    /**
     * @param float $focusTop
     * @return MediaInterface
     */
    public function setFocusTop(float $focusTop): MediaInterface;

    /**
     * @return float
     */
    public function getFocusTop(): float;

    /**
     * @param string $filter
     * @return MediaInterface
     */
    public function setFilter(string $filter): MediaInterface;

    /**
     * @return null|string
     */
    public function getFilter(): ?string ;

    /**
     * @param string $cryptedFilter
     * @return MediaInterface
     */
    public function setCryptedFilter(string $cryptedFilter): MediaInterface;

    /**
     * @return null|string
     */
    public function getCryptedFilter(): ?string;

    /**
     * @param bool $focusIsEdited
     * @return MediaInterface
     */
    public function setFocusIsEdited(bool $focusIsEdited): MediaInterface;

    /**
     * @return bool
     */
    public function getFocusIsEdited(): bool;

    /**
     * @param null|File $file
     * @return MediaInterface
     */
    public function setFile(?File $file): MediaInterface;

    /**
     * @return null|File
     */
    public function getFile(): ?File;

    /**
     * @param array $urls
     * @return MediaInterface
     */
    public function setUrls(array $urls): MediaInterface;

    /**
     * @return array
     */
    public function getUrls(): array;

    /**
     * @param string $html
     * @return MediaInterface
     */
    public function setHtml(string $html): MediaInterface;

    /**
     * @return null|string
     */
    public function getHtml(): ?string;
}
