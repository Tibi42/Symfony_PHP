<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ExercicesController extends AbstractController
{
    #[Route('/exercices', name: 'app_exercices')]
    public function index(): Response
    {
        // Données de l'équipe de ventes
        $equipe_ventes = [
            'Guillaume' => [
                'ventes' => [1200.50, 2100.00, 1850.25, 990.00, 2200.75],
                'objectif_mensuel' => 8000.00,
                'commission' => 0.08,
                'anciennete' => 3, // années
                'statut' => 'senior'
            ],
            'Serge' => [
                'ventes' => [800.00, 1100.50, 1450.00, 1200.25, 950.00],
                'objectif_mensuel' => 6000.00,
                'commission' => 0.06,
                'anciennete' => 1,
                'statut' => 'junior'
            ],
            'Jayanthi' => [
                'ventes' => [2200.00, 1800.75, 2400.50, 1950.00, 1750.25],
                'objectif_mensuel' => 9000.00,
                'commission' => 0.10,
                'anciennete' => 5,
                'statut' => 'expert'
            ]
        ];

        // Variables de configuration
        $nom_entreprise = "KoodelKa SA";
        $taux_tva = 0.20;
        $prime_objectif = 500.00; // Prime si objectif atteint
        $seuil_performance = 0.90; // 90% de l'objectif minimum
        $periode = "septembre 2025";

        // Variables d'analyse globale
        $total_ventes_equipe = 0.0;
        $total_objectifs = 0.0;
        $vendeurs_performants = [];
        $vendeurs_difficulte = [];
        $statistiques_vendeurs = [];
        $analyses_vendeurs = [];

        // Analyse individuelle de chaque vendeur
        foreach ($equipe_ventes as $nom => $data) {
            $ventes = $data['ventes'];
            $objectif = $data['objectif_mensuel'];
            $taux_commission = $data['commission'];
            $anciennete = $data['anciennete'];
            $statut = $data['statut'];

            // Calculs statistiques avec opérateurs arithmétiques
            $total_ventes = array_sum($ventes);
            $moyenne_vente = $total_ventes / count($ventes);
            $vente_max = max($ventes);
            $vente_min = min($ventes);
            $nb_ventes = count($ventes);

            // Performance et calculs financiers
            $taux_realisation = ($total_ventes / $objectif) * 100;
            $commission_brute = $total_ventes * $taux_commission;
            $ventes_ttc = $total_ventes * (1 + $taux_tva);

            // Bonus et primes avec opérateurs logiques et de comparaison
            $objectif_atteint = $total_ventes >= $objectif;
            $performance_excellente = $taux_realisation >= 120.0;
            $performance_correcte = $taux_realisation >= $seuil_performance * 100;

            $prime = 0.0;
            $bonus_anciennete = 0.0;
            $malus = 0.0;

            if ($objectif_atteint) {
                $prime = $prime_objectif;
                if ($performance_excellente && $statut === 'expert') {
                    $prime *= 1.5; // Bonus expert
                }
            }

            // Bonus ancienneté avec opérateurs de comparaison
            if ($anciennete >= 5) {
                $bonus_anciennete = $commission_brute * 0.15;
            } elseif ($anciennete >= 3) {
                $bonus_anciennete = $commission_brute * 0.10;
            } elseif ($anciennete >= 1) {
                $bonus_anciennete = $commission_brute * 0.05;
            }

            // Malus si performance très faible
            if (!$performance_correcte && $anciennete > 0) {
                $malus = $commission_brute * 0.20;
            }

            $remuneration_totale = $commission_brute + $prime + $bonus_anciennete - $malus;

            // Opérateur spaceship pour comparaisons
            $vs_objectif = $total_ventes <=> $objectif;
            $vs_moyenne_marche = $moyenne_vente <=> 1500.00; // Référence marché

            // Classification avec match et opérateurs
            $evaluation = match (true) {
                $performance_excellente => "🏆 Excellent",
                $objectif_atteint => "✅ Objectif atteint",
                $performance_correcte => "⚠️ Correct",
                default => "❌ Insuffisant"
            };

            // Conseils personnalisés avec opérateurs logiques
            $conseil = '';
            if ($performance_excellente && $statut !== 'expert') {
                $conseil = "🚀 Promotion méritée !";
            } elseif ($objectif_atteint && $anciennete >= 2) {
                $conseil = "📈 Excellente régularité !";
            } elseif (!$performance_correcte && $vente_max > $moyenne_vente * 1.5) {
                $conseil = "💡 Potentiel détecté, travaillez la régularité";
            } elseif (!$performance_correcte) {
                $conseil = "📚 Formation commerciale recommandée";
            } else {
                $conseil = "👍 Continuez sur cette voie !";
            }

            // Stockage pour analyse globale
            $total_ventes_equipe += $total_ventes;
            $total_objectifs += $objectif;

            if ($objectif_atteint) {
                $vendeurs_performants[] = $nom;
            } elseif (!$performance_correcte) {
                $vendeurs_difficulte[] = $nom;
            }

            $statistiques_vendeurs[$nom] = [
                'total' => $total_ventes,
                'taux' => $taux_realisation,
                'remuneration' => $remuneration_totale
            ];

            // Stockage des données pour le template
            $analyses_vendeurs[$nom] = [
                'data' => $data,
                'total_ventes' => $total_ventes,
                'moyenne_vente' => $moyenne_vente,
                'vente_max' => $vente_max,
                'vente_min' => $vente_min,
                'nb_ventes' => $nb_ventes,
                'taux_realisation' => $taux_realisation,
                'commission_brute' => $commission_brute,
                'ventes_ttc' => $ventes_ttc,
                'objectif_atteint' => $objectif_atteint,
                'performance_excellente' => $performance_excellente,
                'performance_correcte' => $performance_correcte,
                'prime' => $prime,
                'bonus_anciennete' => $bonus_anciennete,
                'malus' => $malus,
                'remuneration_totale' => $remuneration_totale,
                'vs_objectif' => $vs_objectif,
                'vs_moyenne_marche' => $vs_moyenne_marche,
                'evaluation' => $evaluation,
                'conseil' => $conseil
            ];
        }

        // Analyse globale de l'équipe
        $taux_realisation_equipe = ($total_ventes_equipe / $total_objectifs) * 100;
        $nb_performants = count($vendeurs_performants);
        $nb_difficulte = count($vendeurs_difficulte);
        $nb_total_vendeurs = count($equipe_ventes);

        // Comparaisons avec spaceship et opérateurs logiques
        $equipe_performante = $taux_realisation_equipe >= 100.0;
        $besoin_formation = $nb_difficulte >= ($nb_total_vendeurs / 2);
        $equipe_exceptionnelle = ($nb_performants === $nb_total_vendeurs) && ($taux_realisation_equipe >= 110.0);

        $status_equipe = $equipe_exceptionnelle ? "🌟 ÉQUIPE EXCEPTIONNELLE" : ($equipe_performante ? "💪 ÉQUIPE PERFORMANTE" : ($besoin_formation ? "📈 ÉQUIPE EN DÉVELOPPEMENT" : "⚠️ ÉQUIPE À ACCOMPAGNER"));

        // Recommandations avec coalescence nulle et opérateurs
        $budget_formation = $besoin_formation ? 5000.0 : 2000.0;
        $action_prioritaire = $nb_difficulte > 0 ? "Formation commerciale" : ($nb_performants < $nb_total_vendeurs ? "Motivation et coaching" : "Maintien de l'excellence");

        return $this->render('exercices/index.html.twig', [
            'nom_entreprise' => $nom_entreprise,
            'periode' => $periode,
            'taux_tva' => $taux_tva,
            'prime_objectif' => $prime_objectif,
            'analyses_vendeurs' => $analyses_vendeurs,
            'total_ventes_equipe' => $total_ventes_equipe,
            'total_objectifs' => $total_objectifs,
            'taux_realisation_equipe' => $taux_realisation_equipe,
            'nb_performants' => $nb_performants,
            'nb_difficulte' => $nb_difficulte,
            'nb_total_vendeurs' => $nb_total_vendeurs,
            'status_equipe' => $status_equipe,
            'action_prioritaire' => $action_prioritaire,
            'budget_formation' => $budget_formation,
            // Ajout de la barre de navigation latérale
            'sidebar' => [
                'logo' => [
                    'icon' => 'elephant',
                    'title' => 'PHP Learning',
                    'subtitle' => 'Maîtrisez les bases de PHP'
                ],
                'navigationItems' => [
                    ['icon' => 'home', 'text' => 'Accueil', 'href' => $this->generateUrl('app_home'), 'active' => false],
                    ['icon' => 'list', 'text' => 'Programme', 'href' => '#', 'hasDropdown' => true],
                    [
                        'icon' => 'document',
                        'text' => 'Exercices',
                        'href' => '#',
                        'hasDropdown' => true,
                        'active' => true,
                        'dropdownItems' => [
                            [
                                'icon' => 'Exercices 5',
                                'text' => 'Analyseur de Performance Commerciale',
                                'href' => $this->generateUrl('app_exercices')
                            ],
                        ]
                    ],
                    ['icon' => 'box', 'text' => 'Ressources', 'href' => '#']
                ]
            ]
        ]);
    }
}
