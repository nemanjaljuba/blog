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
use Symfony\Component\Form\Extension\Core\Type\TextType;

class BlogPostAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('title', TextType::class);
        $formMapper->add('body');
        $formMapper->add('description');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('title');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('title');
        $listMapper->add('body');
        $listMapper->add('description');
        $listMapper->add('createdAt');
        $listMapper->add('updatedAt');

        $listMapper->add('_action', 'actions', [
        'actions' => [
            'show' => [],
            'edit' => [],
            'delete' => []
        ]
        ]);
    }

    /**
     * { @inheritdoc }
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {


        $showMapper->add('title');
        $showMapper->add('body');
        $showMapper->add('description');
        $showMapper->add('createdAt');
        $showMapper->add('updatedAt');

        ;
    }
}