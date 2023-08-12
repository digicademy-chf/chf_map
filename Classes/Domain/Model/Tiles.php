<?php

declare(strict_types=1);

# This file is part of the extension DA Map for TYPO3.
#
# For the full copyright and license information, please read the
# LICENSE.txt file that was distributed with this source code.


namespace Digicademy\DAMap\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/**
 * Model for tiles
 */
class Tiles extends AbstractEntity
{
    /**
     * Resource that this tile layer is attached to
     * 
     * @var MapResource
     */
    protected MapResource $parent_id;

    /**
     * Name of the tile layer
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'StringLength',
        'options'   => [
            'minimum' => 1,
            'maximum' => 255,
        ],
    ])]
    protected string $title = '';

    /**
     * External web address of the tile layer to use, including wildcards for coordinates and zoom
     * 
     * @var string
     */
    #[Validate([
        'validator' => 'Url',
    ])]
    protected string $uri = '';

    /**
     * Initialize object
     *
     * @param MapResource $parent_id
     * @param string $title
     * @param string $uri
     * @return Tiles
     */
    public function __construct(MapResource $parent_id, string $title, string $uri)
    {
        $this->setParentId($parent_id);
        $this->setTitle($title);
        $this->setUri($uri);
    }

    /**
     * Get parent ID
     * 
     * @return MapResource
     */
    public function getParentId(): MapResource
    {
        return $this->parent_id;
    }

    /**
     * Set parent ID
     * 
     * @param MapResource $parent_id
     */
    public function setParentId(MapResource $parent_id): void
    {
        $this->parent_id = $parent_id;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Set title
     *
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * Get URI
     *
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * Set URI
     *
     * @param string $uri
     */
    public function setUri(string $uri): void
    {
        $this->uri = $uri;
    }
}

?>