<?php
/*
Plugin Name: Mi primer prlugin
Description: Este es mi primer plurgin. yeih
Version :1.0
Author: Pedro Alvarez
Author URI: https://github.com/Pelusa93/
License: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: miprimerplugin
Domain Path: /lenguages
*/

if(!function_exists('pp_install')){
        function pp_install(){
            //acciones
        }
}
if(!function_exists('pp_deactivation')){
        function pp_deactivation(){
        //acciones
        flush_rewrite_rules();
        }

}
/*if(!function_exists('pp_eliminar')){
    function pp_desinstall(){
        //acciones
    }
}*/

if (!class_exists('pp_mi_class')){

        class pp_mi_class{
        }
}



if(! isset($mivariable)){

    $mivariable='nuevo valor';
}

    register_activation_hook( __FILE__ ,'pp_install' );
    register_deactivation_hook( __FILE__ ,'pp_deactivation' );
  //  register_uninstall_hook( __FILE__ ,'pp_eliminar' );

    if (!function_exists('pp_plugins_cargados')){
        add_action('plugins_loaded','pp_plugins_cargados');
        function pp_plugins_cargados(){
            if (current_user_can('edit_pages')){

                        if(! function_exists('pp_add_meta_description')){
                            add_action('wp_head','pp_add_meta_description');
                            
                            function pp_add_meta_description(){
                             
                             //   echo "<meta name='description' content='creacion de plugins en wordpress' > ";
                                echo "<meta name='description' content='creacion de plugins en wordpress'>";
                
                            }
                
                        }
                }

        };
    }
/*if (is_admin()){

    //mostramos informacion a la administracion

   // require_once 'admin/display-admin.php';
}
else{
    //require_once 'public/display-admin.php';

}*/

$_POST['email']='test@email.com';
$email=$_POST['email'];
if (is_email($email)){
//echo "el email existe";
}else{
//echo "esto no es correcto";

}

$_POST['frutas']=['manzana', 'pera', 'durazno','melocoton'];
$frutas=$_POST['frutas'];
if (in_array('durazno',$frutas)){
//echo "durazno fue encontrado";
}else{
//echo "durazno no se encontro";

}

/*EVITA EL SQL INJECTION*/ 
$input="este valor ha sido guardado en la <?php echo 'DELETE' ?>";
//echo sanitize_text_field($input); 
/*
ESCAPE CORRECTO DE LA SALIDA DE DATOS
*/
$output="<a href='". esc_url('file://google.co',['file','otro']). "' title='Google now>Google</a>'";
$html_permitidos=[
    'a'=>[
        'href'=> [],
        'title'=>[],
    ],
    'p'=>[ ],
    'h3'=>[ ],
    'strong'=>[ ],
];
$protocolos=[file];
//echo wp_kses ($output, $html_permitidos,$protocolos);
//wp_kses_post($output);

/*
tokens de autenticacion
*/
add_action('admin_menu','pp_options_page');
if (! function_exists ('pp_options_page')){
    function pp_options_page(){
        add_menu_page(
            'PP prueba',
            'PP prueba',
            'manage_options',
            'pp_prueba',
            'pp_prueba_page_display',
            '',
            15);

            
                    add_menu_page(
                        'Materias',
                        'Materias',
                        'manage_options',
                        plugin_dir_path(__FILE__).'admin/vista.php',
                        '',
                        '',
                        16);
                
            

                        /*
                        
                    add_menu_page(
                        'Materias',
                        'Materias',
                        'manage_options',
                        plugin_dir_path(__FILE__).'admin/vista.php',
                        'pp_materias_page_display',
                        '',
                        16);
                        */

                        add_submenu_page(
                            'pp_prueba',
                            'titulo submenu1',
                            'titulo submenu1',
                            'manage_options',
                            'submenu1_pp_pruebas',
                            'submenu1_pp_pruebas_page_display'


                        );
                    }
}

if (! function_exists(submenu1_pp_pruebas_page_display)){
    function submenu1_pp_pruebas_page_display(){
    ?>
    
    <?php if(current_user_can('manage_options')):?>
    <!--HTML-->
    <div class="wrap">
    <h1>esta es la pagina del submenu 1 </h1>
    <form action="" method"post">
    
    <input type="text" placeholder="Texto" >
    </form>
    <?php submit_button('Enviar'); ?>
    
    </div>
    <?php else: ?>
    
    <p>
    No tienes acceso a esta seccion
    </p>
    
    <?php endif; ?>
    
    <?php
    
    }
    
    
    }


if(! function_exists(pp_prueba_page_display)){
    function pp_prueba_page_display(){
        if(current_user_can('edit_others_posts')){

            $nonce= wp_create_nonce('nonce_personalizado');
            echo "<br>$nonce</br>";

            if (isset($_POST['nonce'] ) && ! empty ($_POST['nonce'])){
                    if (wp_verify_nonce($_POST['nonce'],'nonce_personalizado')){
                    echo "hemos verificado el nonce recibido<br>
                    Nonce: {$_POST['nonce']}<br>"; 
                    


                    };

            }
            ?>
            <br>
            
            <form action="" method="post">
            <input name="nonce" type="hidden" value="<?php echo $nonce;?>">
            <input name="eliminar" type="hidden" value="Eliminar">
            <button type="submit">Eliminar</button>
            </form>
            
             <?php
            
        }
    };


}

if (! function_exists(pp_materias_page_display)){
function pp_materias_page_display(){
?>

<?php if(current_user_can('manage_options')):?>
<!--HTML-->
<div class="wrap">

<form action="" method"post">

<input type="text" placeholder="Texto" >
</form>
<?php submit_button('Enviar'); ?>

</div>
<?php else: ?>

<p>
No tienes acceso a esta seccion
</p>

<?php endif; ?>

<?php

}


}
?>
