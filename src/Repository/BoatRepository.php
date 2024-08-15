<?php

namespace App\Repository;

use App\Data\SearchData;
use App\Entity\Boat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @extends ServiceEntityRepository<Boat>
 */
class BoatRepository extends ServiceEntityRepository
{

    private PaginatorInterface $paginator;

    public function __construct(ManagerRegistry $registry, PaginatorInterface $paginator)
    {
        parent::__construct($registry, Boat::class);
        $this->paginator = $paginator;
    }

    /**Get boats linked to a search
     * @return PaginationInterface
     */
    public function findSearch(SearchData $search): PaginationInterface {

        $query = $this
            ->createQueryBuilder('b');

        if (!empty($search->boat)) {
            $query = $query
                ->andWhere('b.boatType IN (:boat)')
                ->setParameter('boat', $search->boat)
            ;
        }
        if (!empty($search->places)) {
            $query = $query
                ->andWhere('b.numberOfPlaces = :places')
                ->setParameter('places', $search->places)
            ;
        }
        if (!empty($search->min)) {
            $query = $query
                ->andWhere('b.price >= :min')
                ->setParameter('min', $search->min)
            ;
        }
        if (!empty($search->max)) {
            $query = $query
                ->andWhere('b.price <= :max')
                ->setParameter('max', $search->max)
            ;
        }

        $query = $query->getQuery();
        return $this->paginator->paginate(
            $query,
            $search->page,
            3
        );
    }

}
