Création du composant
=====================

### Créer le composant dans GitHub

* Déclarer le nom
* Remplir la description du type *"XXXXXX assets for OlixBundles"*
* Cocher README
* Cocher LICENSE

### Cloner le dépôt GitHub

A cloner sur le serveur de developpement

``` bash
git clone git@github.com:sabinus52/xxxxxx.git
```

### Créer le fichier Composer

Créer le fichier *composer.json* de la manière suivante :

``` json
{
	"name" : "sabinus52/bootstrap",
	"type" : "olix-asset",
	"description" : "Bootstrap assets for OlixBundles",
	"keywords" : [
		"assets",
		"bootstrap"
	],
	"homepage" : "https://github.com/sabinus52/bootstrap",
	"license" : "MIT",
	"authors" : [{
			"name" : "Olivier",
			"email" : "sabinus52@gmail.com",
			"role" : "Maintainer"
		}
	],
	"support" : {
		"source" : "https://github.com/twbs/bootstrap"
	},
	"require" : {
		"sabinus52/jquery" : "1.*"
	}
        "extra" : {
		"olix" : {
			"files" : [
				"js/*",
				"css/test.css",
				"images/*.png"
			],
			"name" : "jquery"
		}
	}
}
```

### Faire un commit

Faire le commit de création du fichier

``` bash
git add .
git commit -m "Ajout de composer.json"
```

### Faire une première version

Suivre la procédure comme une [mise à jour](update-component.md)

### Déclarer le paquet sur le site Packagist

https://packagist.org

Plus d'infos ici : http://www.idci-consulting.fr/creer-un-bundle-symfony2-reutilisable-et-le-diffuser-via-composer

