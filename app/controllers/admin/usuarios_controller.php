<?php
/**
 */
class UsuariosController extends AdminController
{
    #
	protected function before_filter()
	{
        if ($accion = Input::post('accion')) {
            unset($_POST['accion']);
            if (method_exists($this, $accion)) {
                $this->$accion();
            }
        }
    }
    
    public function index()
    {
        Redirect::to('/admin/usuarios/listar');
    }
    
    public function listar($idu='')
    {
        $this->usuarios = (new Usuarios)->todos();

        $this->usuario = (new Usuarios)->uno($idu);
    }

    public function actualizar()
    {
        (new Usuarios)->actualizar(Input::post());
        Redirect::to('/admin/usuarios');
    }

    public function crear()
    {
        (new Usuarios)->crear(Input::post());
        Redirect::to('/admin/usuarios');
    }

    public function eliminar()
    {
        (new Usuarios)->eliminar(Input::post());
        Redirect::to('/admin/usuarios');
    }
}
