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

use Asm\Data\Data;

/**
 * Class AbstractManager
 *
 * @package Core\Common
 * @author Marc Aschmann <maschmann@gmail.com>
 */
abstract class AbstractManager extends Data implements ManagerInterface
{
    /**
     * @inheritdoc
     */
    public function addReference(ReferenceInterface $reference, $alias, array $options = [])
    {
        $this->set(
            $alias,
            $reference
        );

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function removeReference($reference)
    {
        $this->remove($reference);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getReference($alias)
    {
        return $this->get($alias);
    }

    /**
     * @inheritdoc
     */
    public function getReferences()
    {
        return $this->toArray();
    }
}
