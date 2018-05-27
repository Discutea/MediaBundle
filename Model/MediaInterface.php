<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 21/05/18
 * Time: 17:31
 */

namespace Discutea\MediaBundle\Model;

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
}
