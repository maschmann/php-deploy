<?php
/*
 * This file is part of the php-deploy package.
 *
 * (c) Marc Aschmann <maschmann@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProjectType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array('required' => true))
            ->add('playbook', 'text', array('required' => true))
            ->add('inventory', 'text', array('required' => true))
            ->add('verbose', 'checkbox', array('required' => false))
            ->add('check', 'checkbox', array('required' => false))
            ->add('limit', 'text', array('required' => false))
            ->add('username', 'text', array('required' => false))
            ->add('password', 'text', array('required' => false))
            ->add('privateKeyFile', 'text', array('required' => false))
            ->add('vaultPassword', 'text', array('required' => false))
            ->add('vaultPasswordFile', 'text', array('required' => false))
            ->add('suPassword', 'text', array('required' => false))
            ->add('connection', 'text', array('required' => false))
            ->add('forceHandlers', 'checkbox', array('required' => false))
            ->add('modulePath', 'text', array('required' => false))
            ->add('skipPaths', 'text', array('required' => false))
            ->add('startAtTask', 'text', array('required' => false))
            ->add('su', 'text', array('required' => false))
            ->add('suUser', 'text', array('required' => false))
            ->add('sudoUser', 'text', array('required' => false))
            ->add('tags', 'text', array('required' => false))
            ->add('timeout', 'text', array('required' => false))
            ->add('save', 'submit');
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'CoreBundle\Entity\Project',
            )
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'asm_project_form';
    }
}
