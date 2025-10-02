# Architecture Atomic Design - PHP Learning

Cette application utilise la méthodologie **Atomic Design** pour organiser les composants Twig de manière modulaire et réutilisable.

## 📁 Structure des dossiers

```
templates/
├── atoms/          # Composants de base (Button, Typography, Icon, Card)
├── molecules/      # Combinaisons d'atoms (NavigationItem, ModuleCard, Logo)
├── organisms/      # Sections complexes (Sidebar, ModuleGrid, MainContent)
├── templates/      # Layouts de page (HomeTemplate, PageTemplate)
├── home/          # Pages spécifiques (index.html.twig)
├── base.html.twig # Template de base
└── README.md      # Cette documentation
```

## 🧩 Niveaux d'abstraction

### 1. **Atoms** (Composants de base)

Les plus petits composants réutilisables :

-   **`button.html.twig`** - Bouton avec variantes (primary, secondary, link)
-   **`typography.html.twig`** - Texte avec variantes (h1, h2, body, caption)
-   **`icon.html.twig`** - Icônes avec tailles et couleurs
-   **`card.html.twig`** - Conteneur de base avec header/body/footer

### 2. **Molecules** (Combinaisons d'atoms)

Composants qui combinent plusieurs atoms :

-   **`navigation-item.html.twig`** - Élément de navigation (Icon + Typography + Link)
-   **`module-card.html.twig`** - Carte de module (Card + Typography + Button)
-   **`logo.html.twig`** - Logo de l'application (Icon + Typography)

### 3. **Organisms** (Sections complexes)

Sections importantes de l'interface :

-   **`sidebar.html.twig`** - Barre latérale complète (Logo + Navigation)
-   **`module-grid.html.twig`** - Grille de modules d'apprentissage
-   **`main-content.html.twig`** - Zone de contenu principal

### 4. **Templates** (Layouts de page)

Structures de page complètes :

-   **`home-template.html.twig`** - Layout pour la page d'accueil
-   **`page-template.html.twig`** - Layout générique pour autres pages

## 🎯 Avantages de cette architecture

### ✅ **Réutilisabilité**

-   Chaque composant peut être utilisé dans différents contextes
-   Modifications centralisées dans un seul fichier

### ✅ **Maintenabilité**

-   Structure claire et prévisible
-   Facile de localiser et modifier un composant

### ✅ **Scalabilité**

-   Ajout facile de nouveaux composants
-   Évolution progressive de l'interface

### ✅ **Collaboration**

-   Équipes peuvent travailler sur différents niveaux
-   Standards clairs pour tous les développeurs

## 🔧 Utilisation des composants

### Exemple d'utilisation d'un Atom :

```twig
{% include 'atoms/button.html.twig' with {
    'variant': 'primary',
    'size': 'large',
    'icon': '→',
    'text': 'Commencer'
} %}
```

### Exemple d'utilisation d'une Molecule :

```twig
{% include 'molecules/module-card.html.twig' with {
    'number': '1',
    'title': 'Variables PHP',
    'description': 'Apprenez les bases des variables',
    'linkHref': '/module/1'
} %}
```

### Exemple d'utilisation d'un Organism :

```twig
{% include 'organisms/sidebar.html.twig' with {
    'logo': {
        'icon': 'elephant',
        'title': 'PHP Learning'
    },
    'navigationItems': [
        {'icon': 'home', 'text': 'Accueil', 'active': true}
    ]
} %}
```

## 🎨 Personnalisation

### Variables disponibles pour chaque composant :

#### Button

-   `variant`: primary, secondary, link
-   `size`: small, medium, large
-   `icon`: icône à afficher
-   `text`: texte du bouton
-   `classes`: classes CSS supplémentaires

#### Typography

-   `tag`: h1, h2, h3, h4, p, span, div
-   `variant`: h1, h2, h3, h4, body, caption, small
-   `color`: primary, secondary, dark, muted, accent
-   `classes`: classes CSS supplémentaires

#### ModuleCard

-   `number`: numéro du module
-   `title`: titre du module
-   `description`: description du module
-   `linkHref`: URL du lien
-   `linkText`: texte du lien

## 🚀 Évolutions futures

Cette architecture permet d'ajouter facilement :

-   **Nouveaux atoms** : Input, Select, Modal, etc.
-   **Nouvelles molecules** : SearchBar, UserMenu, etc.
-   **Nouveaux organisms** : Header, Footer, etc.
-   **Nouveaux templates** : DashboardTemplate, CourseTemplate, etc.

## 📝 Bonnes pratiques

1. **Nommage cohérent** : Utiliser des noms descriptifs et en anglais
2. **Props optionnelles** : Toujours fournir des valeurs par défaut
3. **Documentation** : Commenter les props disponibles
4. **Tests** : Tester chaque composant individuellement
5. **Performance** : Éviter les includes imbriqués trop profonds

