<?php
    $diccionario = array(
        'subtitle'=>array(
            //VIEW_SET_USER=>'Crear un nuevo usuario',
            VIEW_GET_USER=>'Buscar usuario',
            /*VIEW_DELETE_USER=>'Eliminar un usuario',
            VIEW_EDIT_USER=>'Modificar usuario',*/
            VIEW_REPORT_USER=>'Reportar usuario'
        ),

        'links_menu'=>array(
            //'VIEW_SET_USER'=>MODULO.VIEW_SET_USER.'/',
            'VIEW_GET_USER'=>MODULO.VIEW_GET_USER.'/',
            /*'VIEW_EDIT_USER'=>MODULO.VIEW_EDIT_USER.'/',
            'VIEW_DELETE_USER'=>MODULO.VIEW_DELETE_USER.'/',*/
            'VIEW_REPORT_USER'=>MODULO.VIEW_REPORT_USER.'/'
        ),
        //mvc
        'form_actions'=>array(
            //'SET'=>'/MVC/'.MODULO.SET_USER.'/',
            'GET'=>'/MVC/'.MODULO.GET_USER.'/',
            /*'DELETE'=>'/MVC/'.MODULO.DELETE_USER.'/',
            'EDIT'=>'/MVC/'.MODULO.EDIT_USER.'/',*/
            'REPORT'=>'/MVC/'.MODULO.REPORT_USER.'/'
        )
    );

    //function get_template($form='get') {
        function get_template($form='get') {
        $file = '../site_media/html/usuario_'.$form.'.html';
        $template = file_get_contents($file);
        return $template;
    }

    function render_dinamic_data($html, $data) {
        foreach ($data as $clave=>$valor) {
            $html = str_replace('{'.$clave.'}', $valor, $html);
        }
        return $html;
    }

    function retornar_vista($vista, $data=array()) {
        global $diccionario;
        $html = get_template('template');
        $html = str_replace('{subtitulo}', $diccionario['subtitle'][$vista], $html);
        $html = str_replace('{formulario}', get_template($vista), $html);
        $html = render_dinamic_data($html, $diccionario['form_actions']);
        $html = render_dinamic_data($html, $diccionario['links_menu']);
        $html = render_dinamic_data($html, $data);

        // render {mensaje}
        if(array_key_exists('nombre', $data) && array_key_exists('apellido', $data) && $vista==VIEW_EDIT_USER) 
        {
                $mensaje = 'Editar usuario '.$data['nombre'].' '.$data['apellido'];
        } else {
            if(array_key_exists('mensaje', $data)) {
                $mensaje = $data['mensaje'];
            } else {
                $mensaje = 'Datos del usuario:';
            }
        }
        $html = str_replace('{mensaje}', $mensaje, $html);
        print $html;
    }
?>