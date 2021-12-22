<?php
/**
 */
class _str
{
    # ID no único
	static public function id($s='')
	{
        return substr(md5($s), 0, 11);
    }

    # ID único
	static public function uid($s='')
	{
        return substr(md5(microtime().$s), 0, 11);
    }
}
