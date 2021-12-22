<?php
//app/libs/lite_record.php

/**
 * Record 
 * Para los que prefieren SQL con las ventajas de ORM
 *
 * Clase padre para añadir tus métodos
 *
 * @category Kumbia
 * @package ActiveRecord
 * @subpackage LiteRecord
 */

use Kumbia\ActiveRecord\LiteRecord as ORM;

class LiteRecord extends ORM
{
    #
	public static function cols()
	{
		$source = static::getSource();
		$rows = self::all("DESCRIBE $source");
		$a = [];
		foreach ($rows as $row) {
			$a[$row->Field] = '';
		}
		return (object)$a;
	}
}
