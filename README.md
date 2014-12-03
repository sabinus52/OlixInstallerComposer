OlixInstallerComposer
=====================

Installe / Met à jour les packages Olix depuis Composer

Usage
-----

### Pré-requis

Pour pouvoir installer un composant via Composer, ajouter d'abord le package 
**sabinus52/olix-installer-composer** dans votre *composer.json*
de la clé `require` key.
Puis ajouter les composants désirés comme [bootstrap](https://github.com/sabinus52/bootstrap)
dans votre *composer.json* de la clé `require` key.

``` json
{
    "require": {
        "sabinus52/olix-installer-script-composer": "dev-master",
        "sabinus52/bootstrap": "*"
    },
}
```

### Configuration

Pour choisir l'emplacement des assets, ajouter la clé `olix-assets-dir` dans la clé `extra`.

``` json
{
    "extra": {
        "olix-assets-dir" : "public"
    }
}
```

Par défaut `public`

### Utilisation dans son code

Pour utiliser les composants intallés, il suffit de faire référence à ceux-ci dans son code
avec les balises `script` et `link` :

``` html
<script src="public/jquery/jquery.js"></script>
<script src="public/bootstrap/js/bootstrap.js"></script>
<link href="public/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
```

Comment créer un composant "asset"
----------------------------------

Créer le *composer.json* pour le composant de la facon suivante 
avec comme `type` la valeur *olix-asset* :

``` json
{
    "name": "vendor/bootstrap",
    "type": "olix-asset",
    "extra": {
        "olix": {
            "files": [
                "js/bootstrap.js",
                "css/bootstrap.css"
                "fonts/*"
            ]
        }
    }
}
```

* `files` - Liste des fichiers qui seront copiés.

### Nom du composant

OlixInstallerComposer peut installer le composant sous un nom autre que celui de du nom du composant.
Pour cela, il faut ajouter la configuration `name` comme cela :

``` json
{
    "name": "vendor/bootstrap",
    "type": "olix-asset",
    "extra": {
        "component": {
            "name": "mybootstrap"
        }
    }
}
```

