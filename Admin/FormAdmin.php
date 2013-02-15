<?php

namespace Netvlies\Bundle\FormBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class FormAdmin extends Admin
{
    protected $datagridValues = array(
        '_page'       => 1,
        '_sort_by' => 'label',
        '_sort_order' => 'ASC'
    );

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('label')
            ->add('successUrl', null, array('label' => 'Success URL', 'required' => false))
            ->add('sendMail', null, array('label' => 'Send mail', 'attr' => array('class' => 'mail_toggle')))
            ->add('contactName', null, array('label' => 'Contact name', 'attr' => array('class' => 'mail_related'), 'required' => false))
            ->add('contactEmail', null, array('label' => 'Contact email', 'attr' => array('class' => 'mail_related'), 'required' => false))
            ->add('mailSubject', null, array('label' => 'Mail subject', 'attr' => array('class' => 'mail_related'), 'required' => false))
            ->add('mailBody', null, array('label' => 'Mail body', 'attr' => array('class' => 'mail_related'), 'required' => false))
            ->add('storeResults', null, array('label' => 'Store results'))
            ->add('addCaptcha', null, array('label' => 'Add CAPTCHA'))
            ->add('fields', 'sonata_type_collection',
                array(
                    'required' => false,
                    'by_reference' => false,
                ),
                array(
                    'edit' => 'inline',
                    'inline' => 'table',
                    'sortable' => 'position',
                )
            )
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('label')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'export' => array('template' => 'NetvliesFormBundle:Sonata:CRUD/list__action_export.html.twig'),
                )
            ))
        ;
    }

    public function getTemplate($name)
    {
        switch ($name) {
            case 'edit':
                return 'NetvliesFormBundle:FormAdmin:edit.html.twig';
                break;
            default:
                return parent::getTemplate($name);
                break;
        }
    }
}
