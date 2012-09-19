<?php
/**
 * Классы общего назначения
 *
 * @copyright 2011, Михаил Красильников, <mihalych@vsepofigu.ru>
 *
 * @package CommonBundle
 *
 * @author Михаил Красильников <mihalych@vsepofigu.ru>
 */

namespace Eresus\CommonBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Классы общего назначения
 *
 * @package CommonBundle
 * @since 1.0
 */
class CommonBundle extends Bundle
{
	/**
	 * Конструктор
	 *
	 * @since 1.0
	 */
	public function __construct()
	{
		// Задаём уникальное имя, чтобы избежать конфликта с другими пакетами
		$this->name = 'EresusCommonBundle';
	}
}
