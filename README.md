# FRAMEWILL #
Este es el modelo base de aplicación que uso en mis proyectos tratando de emular una estructura MVC y eventualmetne generando un miniframework donde todo tengo ordenado en carpetas model-view-controller (las páginas base están en raíz pero todo se modela según esas tres carpetas, en el model la lógica de negocio, en el view los HTML que luego llamo y proceso mediante comodines y funciones especiales, y en el controller todos los archivos que procesan información entre los PHP, a veces también con salidas JSON o asíncronas).

## USO ##

Simplemente estructura tu aplicación con la carpeta **Model** como contenedora de las clases y en tu aplicación llama a estas clases (puedes fabricar las tuyas con la plantilla de `example_object.php` ) de la siguiente forma:

    //include 'model/objeto_ejemplo.php'; 
    //siempre incluir al archivo de objeto en tu script
    $objeto_de_ejemplo = objeto_ejemplo(1);

De esta forma crearás un objeto con toda la data traída desde la DB (una práctica que yo tengo es equivaler las tablas relevantes a un objeto en mi aplicación, así puedo usar de forma versátil la información de ésta. Ojo, el objeto representa a un registro de la tabla, así que suelo usar bastante mis PK's como parametros, en el ejemplo de arriba, el 1 pasado al constructor le dice al objeto con qué registro llenarse).

##  Funciones ##
    
    //me devolvera el campo ejemplo_id de la tabla en mencion
    $objeto_de_ejemplo->get_data("ejemplo_id");
    
    //me devolvera el campo ejemplo_nombre 
    $objeto_de_ejemplo->get_data("ejemplo_nombre");

## Conexion ##

La conexión a la base de datos se realiza mediante el objeto `conexion`, éste puede traer al puntero que realiza la conexión en caso queramos realizar nuestras propias consultas:

    $c = new conexion();
    $puntero_mysql = $c->get_mysql();
    
    //esto devolera un resultset con la data
    $query = $puntero_mysql->query('SELECT employee_id FROM employee');
    $c->cerrar();

## Llamando datos relacionados ##

Como en el ejemplo que empaqueto, si necesitamos llamar datos que consideramos anexos a nuestro objeto, es decir, que deberían ser parte de nuestro objeto pero que están en otras tablas, simplemente tendríamos que realizar una funcion privada dentro de nuestra clase personalizada llamándolos y metiéndolos en la variable data, que es de tipo array:

    //clase objeto_personalizado
    class objecto_personalizado extends objeto{
    	public function __construct(int $id){
    		$campos = ["id"];
    		parent::_construct($id, "nombre_tabla", $campos,"id");
			if($this->existe()){
    			$this->get_otro_dato_en_otra_tabla();
			}
    }
    
    private function get_otro_dato_en_otra_tabla(){
    	$mysql = $this->get_mysql();
    	$sql = "SELECT otro_dato FROM otra_tabla WHERE idtablabase ='".$this->get_data("id")."'"
    	$q = $mysql->query($sql);
    	$r = $q->fetch_assoc();
    	$this->data["otro_dato"] = $r["otro_dato"];
    }
    
    //llamada en otro archivo:
    //include 'model/objeto_personalizado.php
    $c = new objeto_personalizado(1);
    $c->get_data("otro_dato"); //esto me devuelve el dato en otra tabla relacionado con el registro de la primera sin alterar la nomenclatura

## ¿Qué pasa si mi objeto llama a un registro inexistente? ##

Si por ejemplo tratamos de crear un objeto que hace referencia a un registro que aún no se ha creado en nuestra tabla, por ejemplo:

    $obj = new objeto_prueba(300033); //no existe el registro con id 300033

El objeto se seguirá creando, pero sin ninguna función existente (a pesar que la tabla sí tiene los campos que especificamos en nuestra clase), y además al llamar la función existe() ésta nos devolverá un falso:

    $obj->existe(); //falso

Por lo que es bueno probar nuestros objetos antes de usarlos:

    $obj = new objeto_prueba(300033);
    if($obj->existe()){
    	//operar el objeto
    }else{
    	echo "Objeto inexistente!";
    }

## Futuro del paquete ##

Tengo pensado ampliar el paquete con otras funcionalidades básicas que los programadores en web solemos usar, desde logins hasta manejo de sesiones (sin cookies y con cookies) todo siempre teniendo este formato de tres capas entre modelos , controladores y archivos HTML que se formatean para mostrar al usuario; sin revolver todos los archivos, manteniendo un orden fácil y entendible (a diferencia de los frameworks que agregan indiscriminadamente carpetas). Pero aún ando haciendo pruebas con esto. De momento voy soltando versiones estables del paquete, pero en interno tengo el paquete en un modo más avanzado hasta estar seguro de que se puede considerar estable para publicarlo aquí.
