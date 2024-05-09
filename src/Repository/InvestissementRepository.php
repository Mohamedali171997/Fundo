<?php

namespace App\Repository;

use App\Entity\Investissement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Investissement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Investissement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Investissement[]    findAll()
 * @method Investissement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InvestissementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Investissement::class);
    }

    /**
     * Recherche et filtre les investissements en fonction des critères spécifiés.
     *
     * @param array $searchCriteria Les critères de recherche
     * 
     * @return Investissement[] Les investissements filtrés
     */
    public function findByCriteria(array $searchCriteria): array
    {
        $queryBuilder = $this->createQueryBuilder('i');

        // Appliquer les filtres si des critères de recherche sont spécifiés
        if (!empty($searchCriteria)) {
            // Exemple de filtre pour le nom
            if (!empty($searchCriteria['Nom'])) {
                $queryBuilder->andWhere('i.nom LIKE :nom')
                    ->setParameter('Nom', '%' . $searchCriteria['Nom'] . '%');
            }

        
        }
        if (!empty($searchCriteria['MontantInitial'])) {
            $queryBuilder->andWhere('i.montantInitial = :montantInitial')
                ->setParameter('montantInitial', $searchCriteria['MontantInitial']);
        }
        

        return $queryBuilder->getQuery()->getResult();
    }
}
