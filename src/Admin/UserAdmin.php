<?php
/**
 * Created by PhpStorm.
 * User: nemanja
 * Date: 10/17/18
 * Time: 7:06 PM
 */
namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class UserAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper

            ->tab('User Basic Info')

                ->with('User Name', ['class' => 'col-md-3', 'box_class' => 'box box-primary'])
                    ->add('firstName')
                    ->add('lastName')
                ->end()

                ->with('User Email', ['class' => 'col-md-3', 'box_class' => 'box box-primary'])
                    ->add('email')
                    ->add('enabled')
                ->end()

                ->with('User About', ['class' => 'col-md-6', 'box_class' => 'box box-secondary'])
                    ->add('about', null, ['attr' => ['style' => 'height:144px']])
                ->end()

            ->end()

            ->tab('User Additional Info')

                ->with('User Address', ['class' => 'col-md-3', 'box_class' => 'box box-secondary'])
                    ->add('country')
                    ->add('city')
                    ->add('address', null, ['attr' => ['style' => 'height:109px']])
                    ->add('postalCode')
                ->end()

                ->with('User Contact', ['class' => 'col-md-3', 'box_class' => 'box box-secondary'])
                    ->add('phone')
                    ->add('birthday')
                ->end()

                ->with('User Links', ['class' => 'col-md-6', 'box_class' => 'box box-secondary'])
                    ->add('website')
                    ->add('facebook')
                    ->add('twitter')
                ->end()

            ->end()

            ->tab('User Roles')
                ->with('User Roles', ['class' => 'col-md-6', 'box_class' => 'box box-secondary'])
//                    ->add('roles', 'choice', array(
//                        'choices' => array(
//                            'Admin' => 'ROLE_ADMIN',
//                            'Super Admin' => 'ROLE_SUPER_ADMIN',
//                            'Content Manager' => 'ROLE_CONTENT_MANAGER',
//                            'Agent' => 'ROLE_AGENT'
//                        ),
//                        'expanded' => true,
//                        'multiple' => true,
//                        'required' => false
//                    ))
                    ->add('roles')
                ->end();
            ;

        if ($this->getSubject()->getId() == null) {
            $formMapper
                ->add('email')
                ->add('plainPassword', RepeatedType::class, [
                    'type' => PasswordType::class,
                    'first_options' => [
                        'label' => 'form.label_password',
                    ],
                    'second_options' => [
                        'label' => 'form.label_password_confirmation',
                    ],
                    'translation_domain' => "BandplanetAdminBundle",
                    'invalid_message' => 'fos_user.password.mismatch',
                ])
            ;
        }
    }


    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('email');
    }

    protected function configureListFields(ListMapper $listMapper)
    {

        $listMapper

            ->addIdentifier('id')
            ->add('firstName', null, ['editable' => true])
            ->add('lastName', null, ['editable' => true])
            ->addIdentifier('email')
            ->add('country')
            ->add('city')
            ->add('birthday', null, ['editable' => true])
            ->add('enabled', null, ['editable' => true])

            ->add('_action', 'actions', [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                ]
            ])
        ;

    }

    /**
     * { @inheritdoc }
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper

            ->with('User Info', ['class' => 'col-md-7', 'box_class' => 'box box-secondary'])
                ->add('firstName')
                ->add('lastName')
                ->add('email')
                ->add('about')
                ->add('enabled')
                ->add('country')
                ->add('city')
                ->add('address')
                ->add('postalCode')
                ->add('phone')
                ->add('birthday')
                ->end()
            ->end()

            ->with('User Links', ['class' => 'col-md-4', 'box_class' => 'box box-secondary'])
                ->add('website')
                ->add('facebook')
                ->add('twitter')
            ->end()

            ->with('User Roles', ['class' => 'col-md-4', 'box_class' => 'box box-secondary'])
                ->add('roles')
            ->end()

        ;
    }

    /**
     * {@inheritdoc }
     */
    protected function configureRoutes(\Sonata\AdminBundle\Route\RouteCollection $collection)
    {
        //$collection->remove('create');
    }

}