<?php

/**
 * This file is part of the Axstrad library.
 *
 * (c) Dan Kempster <dev@dankempster.co.uk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright 2014-2015 Dan Kempster <dev@dankempster.co.uk>
 */

namespace Axstrad\Common\Entity;

/**
 * Axstrad\Common\Entity\IdTrait
 *
 * Class IdTrait
 *
 * @package Axstrad\Common\Entity
 */
trait IdTrait
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var null|integer
     */
    protected $id;

    /**
     * Get the entity's unique ID.
     *
     * @return null|integer Before the entity is persisted null is return. Then
     *         after, it's integer ID is returned.
     */
    public function getId()
    {
        return $this->id;
    }
}
