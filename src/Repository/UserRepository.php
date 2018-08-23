<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class UserRepository extends ServiceEntityRepository //implements  UserProviderInterface
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }

    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('u')
            ->where('u.something = :value')->setParameter('value', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
//    /**
//     * Loads the user for the given username.
//     *
//     * This method must throw UsernameNotFoundException if the user is not
//     * found.
//     *
//     * @param string $username The username
//     *
//     * @return UserInterface
//     *
//     * @throws UsernameNotFoundException if the user is not found
//     */
//    public function loadUserByUsername($username)
//    {
//       try {
//           $user = $this->createQueryBuilder('u')
//               ->addSelect('u')
//               ->andWhere('u.username = :username')
//               ->setParameter('username', $username)
//               ->getQuery()->getOneOrNullResult();
//
//            } catch (UsernameNotFoundException $e) {
//           $message = sprintf(
//               'Unable to find an active admin AcmeDemoBundle:User object identified by "%s".',
//               $username
//           );
//           throw new UsernameNotFoundException($message, 0, $e);
//       }
//
//       return $user;
//    }
//
//    /**
//     * Refreshes the user.
//     *
//     * It is up to the implementation to decide if the user data should be
//     * totally reloaded (e.g. from the database), or if the UserInterface
//     * object can just be merged into some internal array of users / identity
//     * map.
//     *
//     * @return UserInterface
//     *
//     * @throws UnsupportedUserException if the user is not supported
//     */
//    public function refreshUser(UserInterface $user)
//    {
//        // TODO: Implement refreshUser() method.
//    }
//
//    /**
//     * Whether this provider supports the given user class.
//     *
//     * @param string $class
//     *
//     * @return bool
//     */
//    public function supportsClass($class)
//    {
//        // TODO: Implement supportsClass() method.
//    }
}
