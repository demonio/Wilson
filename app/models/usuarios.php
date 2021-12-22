<?php
/**
 */
class Usuarios extends LiteRecord
{
    #
    public function actualizar($post)
    { 
        $values[] = $post['correo'];
        $values[] = $post['clave'];
        $values[] = $post['idu'];

        $sql = 'UPDATE usuarios SET correo=?, clave=? WHERE idu=?';
        self::query($sql, $values);
    }

    #
    public function crear($post)
    { 
        if ( ! filter_var($post['correo'], FILTER_VALIDATE_EMAIL)) {
            return Session::setArray('mensajes', _('Esto no es un correo.'));
        }

        $values[] = _str::uid();
        $values[] = $post['correo'];
        $values[] = $post['clave'];

        $sql = 'INSERT INTO usuarios SET idu=?, correo=?, clave=?';
        self::query($sql, $values);
    }

    #
    public function eliminar($post)
    { 
        $values[] = $post['idu'];

        $sql = 'DELETE FROM usuarios WHERE idu=?';
        self::query($sql, $values);
    }

    #
    public function todos()
    { 
        $sql = 'SELECT * FROM usuarios';
        return self::all($sql);
    }

    #
    public function uno($idu)
    { 
        $values[] = $idu;

        $sql = 'SELECT * FROM usuarios WHERE idu=?';
        $usuario = self::first($sql, $values);

        if ( ! $usuario) {
            return self::cols();
        }
        return $usuario;
    }





    #
    /*public function entrar($datos)
    {  
        $sql = 'SELECT idu, clave FROM usuarios WHERE correo=? AND validado=1';
        $usuario = self::first($sql, [$datos['correo']]);
        if ( ! $usuario) {
            Session::setArray('mensajes', _('Credenciales no aceptados.'));
            return false;
        }

        if ( ! password_verify($datos['clave'], $usuario->clave)) {
            Session::setArray('mensajes', _('Credenciales no aceptados.'));
            return false;
        }

        Session::set('idu', $usuario->idu);

        Session::setArray('mensajes', _('Bienvenido.'));
    }

    #
    public function borrarse($datos)
    {  
        $sql = 'SELECT idu, clave FROM usuarios WHERE correo=? OR correo=""';
        $usuario = self::first($sql, [$datos['correo']]);
        if ( ! $usuario) {
            Session::setArray('mensajes', _('Credenciales no aceptados.'));
            return false;
        }

        if ($usuario->correo && ! password_verify($datos['clave'], $usuario->clave)) {
            Session::setArray('mensajes', _('Credenciales no aceptados.'));
            return false;
        }

        $sql = 'DELETE FROM usuarios WHERE correo=?';

        self::query($sql, [$datos['correo']]);

        Session::delete('idu');

        Session::setArray('mensajes', _('Se ha eliminado el usuario.'));
    }

    #
    public function comprobarSiExisteCorreo($datos)
    {
        $sql = 'SELECT id FROM usuarios WHERE correo=?';
        return self::first($sql, [$datos['correo']]);
    }

    #
    public function registrar($datos)
    {  
        if ( ! $datos['politicas']) {
            Session::setArray('mensajes', _('Por favor, acepte las políticas.'));
            return false;
        }

        if ($this->comprobarSiExisteCorreo($datos)) {
            Session::setArray('mensajes', _('Credenciales no aceptados.'));
            return false;
        }

        if (strlen($datos['clave'] < 12)) {
            Session::setArray('mensajes', _('Se requiere una clave de al menos 12 caracteres.'));
            return false;
        }

        if (strlen($datos['apodo'] < 3)) {
            Session::setArray('mensajes', _('Se requiere un apodo de al menos 3 caracteres.'));
            return false;
        }

        if ( ! filter_var($datos['correo'], FILTER_VALIDATE_EMAIL)) {
            Session::setArray('mensajes', _('Se requiere un correo valido.'));
            return false;
        }

        $datos['idu'] = _str::uid();

        $datos['clave'] = password_hash($datos['clave'], PASSWORD_DEFAULT);

        $datos['rol'] = 1;

        $datos['validado'] = 0;

        $this->create($datos);

        $mensaje = _('Pulse en el siguiente enlace para deja en blanco su clave: ');

        $mensaje .= $_SERVER['HTTP_HOST'] . '/usuarios/validar/' . base64_encode($datos['clave']);

        exit($mensaje);

        _mail::send($datos['correo'], _('Confirme su correo en AppLES'), $mensaje);

        Session::setArray('mensajes', _('Acuda a su cliente de correo.'));
    }

    #
    public function resetear($clave)
    {
        $clave = base64_decode($clave);
        $sql = 'SELECT id FROM usuarios WHERE clave=?';
        $usuario = self::first($sql, [$clave]);
        if ( ! $usuario) {
            Session::setArray('mensajes', _('Credenciales no aceptados.'));
            return false;
        }

        $sql = 'UPDATE usuarios SET validado=1 WHERE clave=?';
        self::query($sql, [$clave]);

        Session::setArray('mensajes', _('Ahora pruebe a entrar con otra clave.'));
    }

    #
    public function uno($idu=0)
    {
        $idu = empty($idu) ? Session::get('idu') : $idu;
        $sql = 'SELECT * FROM usuarios WHERE idu=?';
        return self::first($sql, [$idu]);
    }

    #
    public function validar($clave)
    {
        $clave = base64_decode($clave);
        $sql = 'SELECT id FROM usuarios WHERE clave=?';
        $usuario = self::first($sql, [$clave]);
        if ( ! $usuario) {
            Session::setArray('mensajes', _('Credenciales no aceptados.'));
            return false;
        }

        $sql = 'UPDATE usuarios SET validado=1 WHERE clave=?';
        self::query($sql, [$clave]);

        Session::setArray('mensajes', _('Correo validado. Ahora puede entrar.'));
    }*/
}
