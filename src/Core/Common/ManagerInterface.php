<?php
/*
 * This file is part of the php-deploy package.
 *
 * (c) Marc Aschmann <maschmann@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Core\Common;

/**
 * Base interface for managers (registry pattern)
 *
 * @package Core\Common
 * @author Marc Aschmann <maschmann@gmail.com>
 */
interface ManagerInterface
{
    /**
     * Add a reference to internal storage.
     *
     * @param ReferenceInterface $reference
     * @param string $alias name of the reference
     * @param array $options additional options for the reference
     * @return $this
     */
    public function addReference(ReferenceInterface $reference, $alias, array $options = []);

    /**
     * Remove reference from List
     *
     * @param string $reference
     * @return $this
     */
    public function removeReference($reference);

    /**
     *
     * Get a specific Reference.
     *
     * @param string $alias
     * @return ReferenceInterface|bool
     */
    public function getReference($alias);

    /**
     * Returns array of all References
     *
     * @return array
     */
    public function getReferences();
}
