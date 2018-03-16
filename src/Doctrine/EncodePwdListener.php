<?php

namespace App\Doctrine;

use App\Entity\UserTemp;
use App\Entity\User;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;

class EncodePwdListener implements EventSubscriber
{
    protected $encoder;
    public function __construct(EncoderFactoryInterface $encoderFactory)
    {
        $this->encoder = $encoderFactory;
    }
    public function getSubscribedEvents()
    {
        return [
            'prePersist',
            'preUpdate'
        ];
    }
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if ((!$entity instanceof UserTemp) && (!$entity instanceof User) ) return;
        $this->encodePwd($entity);
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if (!$entity instanceof UserTemp) {
            return;
        }
        $this->encodePwd($entity);
        $em = $args->getEntityManager();
        $meta = $em->getClassMetadata(get_class($entity));
        $em->getUnitOfWork()->recomputeSingleEntityChangeSet($meta, $entity);
    }
    /*
     * https://knpuniversity.com/screencast/symfony-security/encoding-user-password
     * Thank you knp University for the trick about the preUpdate
     */
    public function encodePwd($entity)
    {
        $encoder = $this->encoder->getEncoder($entity);
        $pwd = $encoder->encodePassword($entity->getPlainPassword(),null);
        //$pwd='toto';
        $entity->setPassword($pwd);
    }
}