<?php
/**
 *
 * Plugin Composer pour l'activation du l'installeur des Assets
 *
 *
 * @package Olix
 * @subpackage InstallerComposer
 * @author Olivier
 *
 */

namespace OlixInstaller;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Package\PackageInterface;
use Composer\Installer\LibraryInstaller;
use Composer\Repository\InstalledRepositoryInterface;


class AssetInstaller extends LibraryInstaller
{


	/**
	 * Retourne le chemin de base où sera installé le package
	 * 
	 * (non-PHPdoc)
	 * @see \Composer\Installer\LibraryInstaller::getPackageBasePath()
	 */
	public function getPackageBasePath (PackageInterface $package)
	{
		// Prend que le nom du package sans le vendor
		$prettyName = $package->getPrettyName();
		if (strpos($prettyName, '/') !== false) {
			list(, $name) = explode('/', $prettyName);
		} else {
			$name = $prettyName;
		}
		
		// Vérifie si on force le changement du nom depuis la configuration "extra"
		$extra = $package->getExtra();
		if (isset($extra['olix']['name']))
			$name = $extra['olix']['name'];
		
		// Récupère dans le composer du projet l'emplacement choisi pour l'installation du package
		if ($this->composer->getPackage()) {
			$extraRoot = $this->composer->getPackage()->getExtra();
			$webDir = isset($extraRoot['symfony-web-dir']) ? $extraRoot['symfony-web-dir'] : 'public';
			$installDir = isset($extraRoot['olix-assets-dir']) ? $extraRoot['olix-assets-dir'] : 'public';
		} else {
			$webDir = 'web';
			$installDir = 'public';
		}
		
		return $webDir.DIRECTORY_SEPARATOR.$installDir.DIRECTORY_SEPARATOR.$name;
	}


	/**
	 * Test si le type du package correspond à un "olix-asset"
	 * 
	 * (non-PHPdoc)
	 * @see \Composer\Installer\LibraryInstaller::supports()
	 */
	public function supports ($packageType)
	{
		return $packageType === 'olix-asset';
	}

}