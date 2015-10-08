<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ExceptionThrower
 *
 * @author Olivier
 */

/**
 * Class qui attrape les erreurs PHP et les convertis en exception
 * 
 * @author Jason Hinkle
 * @copyright  1997-2011 VerySimple, Inc.
 * @license    http://www.gnu.org/licenses/lgpl.html  LGPL
 * @version 1.0
 */
class ExceptionThrower
{
 
	static $IGNORE_DEPRECATED = true;
 
	/**
	 * Commence la redirection des erreurs
	 * @param int $level PHP niveau d'Erreur à attraper (Default = E_ALL & ~E_DEPRECATED)
	 */
	static function Start($level = null)
	{
 
		if ($level == null)
		{
			if (defined("E_DEPRECATED"))
			{
				$level = E_ALL & ~E_DEPRECATED ;
			}
			else
			{
				// php 5.2 et les versions antérieur ne support pas E_DEPRECATED
				$level = E_ALL;
				self::$IGNORE_DEPRECATED = true;
			}
		}//Modification du handler
                // il appelera la class lorqu'il attrapera une erreur
		set_error_handler(array("ExceptionThrower", "HandleError"), $level);
	}
 
	/**
	 * Stop la redirection des erreurs PHP 
	 */
	static function Stop()
	{       //Remet en place le handler utiliser par défaut
		restore_error_handler();
	}
 
	/**
	 * Appeler par le handler d'erreur php.
         * Appeler cette function remontera toujours une exception
         * à moins qu'error_reporting == 0.
         * Si la commande Php est appelé avec un @ la précédant, 
         * alors elle sera ignoré ici aussi.
	 *
	 * @param string $code
	 * @param string $string
	 * @param string $file
	 * @param string $line
	 * @param string $context
	 */
	static function HandleError($code, $string, $file, $line, $context)
	{
		// Ignore les erreurs bannis
		if (error_reporting() == 0) return;
		if (self::$IGNORE_DEPRECATED && strpos($string,"deprecated") === true) return true;
 
		throw new Exception($string,$code);
	}
}