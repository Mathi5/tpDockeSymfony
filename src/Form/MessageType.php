<?php

namespace App\Form;

use App\Entity\Message;
use Karser\Recaptcha3Bundle\Form\Recaptcha3Type;
use Karser\Recaptcha3Bundle\Validator\Constraints\Recaptcha3;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\Validator\Constraints as Assert;

class MessageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('text', TextareaType::class, [
                'label' => 'Message* :',
                'attr' => [
                    'placeholder' => 'Contenu du message',
                    'rows' => 7
                ]
            ])
            ->add('imageFile', VichImageType::class, [
                'required' => false,
                'download_uri' => false,
                'image_uri' => true,
                'asset_helper' => true,
                'label' => 'Image',
                'allow_delete' => true,
                'delete_label' => 'Supprimer l\'image',
                'constraints' => [
                    new Assert\File([
                        'maxSize' => '2048k',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/gif',
                        ],
                        'mimeTypesMessage' => 'Envoyer une image au format jpg, png ou gif',
                    ])
                ],
            ])
//            ->add('subbmit', SubmitType::class, [
//                'label' => 'Envoyer',
//                'attr' => [
//                    'class' => 'btn btn-primary btn-lg btn-block'
//                ]
//            ])
//            ->add('captcha', Recaptcha3Type::class, [
//                'constraints' => new Recaptcha3(),
//                'action_name' => 'new_message',
//                'locale' => 'fr',
//            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Message::class,
        ]);
    }
}
