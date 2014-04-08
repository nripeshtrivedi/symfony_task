<?php
namespace Acme\TaskBundle\Form\Type;
use Symfony\Component\Form\AbstractType;;
use Symfony\Component\Form\FormBuilderInterface;
class UserType extends AbstractType
{
public function buildForm(FormBuilderInterface $builder, array $options)
{
$builder->add('firstname','text');
$builder->add('lastname','text');
$builder->add('email', 'email');
$builder->add('password', 'password');
$builder->add('save', 'submit');
}
public function getName()
{
return 'user';
}
}