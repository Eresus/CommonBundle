<?php
/**
 * Дата и время
 *
 * @copyright 2011, Михаил Красильников, <mihalych@vsepofigu.ru>
 *
 * @package CommonBundle
 *
 * @author Михаил Красильников <mihalych@vsepofigu.ru>
 */

namespace Eresus\CommonBundle;

use LogicException, DateTime as NativeDateTime, DateTimeZone, ArrayAccess;

/**
 * Дата и время
 *
 * @package CommonBundle
 * @since 1.0
 */
class DateTime extends NativeDateTime implements ArrayAccess
{
	/**
	 * Имена полей эмулируемого массива
	 *
	 * @var array
	 */
	private $validFields = array('date', 'timestamp');

	/**
	 * Создает и возвращает новый экземпляр класса DateTime
	 *
	 * @param string       $time      строка даты/времени. В дополнение к стандартным можно
	 *                                использовать слово «today» — 00:00 сегодняшнего дня
	 * @param DateTimeZone $timezone  временная зона
	 *
	 * @since 1.0
	 */
	public function __construct($time = null, DateTimeZone $timezone = null)
	{
		assert('is_null($time) || is_string($time)');

		if ('today' == $time)
		{
			$today = true;
			$time = 'now';
		}

		parent::__construct($time, $timezone);

		if (isset($today))
		{
			$this->setTime(0, 0);
		}
	}
	//-----------------------------------------------------------------------------

	/**
	 * Копирует дату и время из другого объекта
	 *
	 * @param \DateTime $datetime
	 *
	 * @return void
	 *
	 * @since 1.0
	 */
	public function copyFrom(NativeDateTime $datetime)
	{
		$this->setTimestamp($datetime->getTimestamp());
	}
	//-----------------------------------------------------------------------------

	/**
	 * Проверяет, если ли такой элемент
	 *
	 * @param string $offset  имя элемента
	 *
	 * @see ArrayAccess::offsetExists()
	 *
	 * @since 1.0
	 */
	public function offsetExists($offset)
	{
		assert('is_string($offset)');

		return in_array($offset, $this->validFields);
	}
	//-----------------------------------------------------------------------------

	/**
	 * Возвращает значение элемента
	 *
	 * @param string $offset  имя элемента
	 *
	 * @throws LogicException  если $offset задан неправильно
	 *
	 * @see ArrayAccess::offsetGet()
	 *
	 * @since 1.0
	 */
	public function offsetGet($offset)
	{
		assert('is_string($offset)');

		switch ($offset)
		{
			case 'date':
				return $this->format('d.m.y');

			case 'timestamp':
				return $this->getTimestamp();
		}
		throw new LogicException('Unknown DateTime array index: ' . $offset);
	}
	//-----------------------------------------------------------------------------

	/**
	 * Всегда вбрасывает исключение LogicExcetion
	 *
	 * @param string $offset  имя элемента
	 * @param mixed  $value
	 *
	 * @throws LogicExcetion
	 *
	 * @see ArrayAccess::offsetSet()
	 * @since 1.0
	 *
	 * @SuppressWarnings(PHPMD.UnusedFormalParameter)
	 */
	public function offsetSet($offset, $value)
	{
		throw new LogicException;
	}
	//-----------------------------------------------------------------------------

	/**
	 * Всегда вбрасывает исключение LogicExcetion
	 *
	 * @param string $offset  имя элемента
	 *
	 * @throws LogicExcetion
	 *
	 * @see ArrayAccess::offsetUnset()
	 * @since 1.0
	 *
	 * @SuppressWarnings(PHPMD.UnusedFormalParameter)
	 */
	public function offsetUnset($offset)
	{
		throw new LogicException;
	}
	//-----------------------------------------------------------------------------

}