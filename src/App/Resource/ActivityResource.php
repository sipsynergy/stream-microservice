<?php

namespace App\Resource;

use App\ResourceAbstract;
use App\Entity\Action;
use Doctrine\ORM\EntityManager;

/**
 * Class ActivityResource.
 */
class ActivityResource extends ResourceAbstract
{
    /** @var \Doctrine\ORM\EntityRepository */
    protected $repository;


    /**
     * Construct.
     *
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager);

        $this->repository = $entityManager->getRepository(Action::class);
    }


    /**
     * Get all.
     *
     * @return array
     */
    public function getAll()
    {
        $activities = $this->repository->findAll();

        $activities = array_map(
            function (Action $activity) {
                return $activity->toString();
            },
            $activities
        );

        return $activities;
    }


    /**
     * Create activity.
     *
     * @param      $actor
     * @param      $verb
     * @param null $actionRef
     * @param null $target
     *
     * @return void
     */
    public function create($actor, $verb, $actionRef = null, $target = null)
    {
        if (null === $actor) {
            throw new \LogicException('Actor must be provided');
        }

        if (null === $verb) {
            throw new \LogicException('Verb must be provided');
        }

        $action = new Action();
        $action->setVerb($verb);
        $action->setActor($actor);

        if (null !== $target) {
            $action->setTarget($target);
        }

        if (null !== $actionRef) {
            $action->setAction($actionRef);
        }

        $this->entityManager->persist($action);
        $this->entityManager->flush();
    }


    /**
     * Find stream by reference.
     *
     * @param $reference
     *
     * @return array
     */
    public function findStreamsByReference($reference)
    {
        return $this->repository->createQueryBuilder('a')
            ->where('a.actor = :actor')->setParameter('actor', $reference)
            ->orWhere('a.target = :target')->setParameter('target', $reference)
            ->orWhere('a.action = :action')->setParameter('action', $reference)
            ->getQuery()->getResult();

    }

}