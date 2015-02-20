<?php

use mvc\model\table\tableBaseClass;

class animalBaseTableClass extends tableBaseClass {

    private $id,
            $peso_animal,
            $edad_animal,
            $fecha_ingreso,
            $precio_animal,
            $genero_id,
            $lote_id,
            $raza;

    const ID = 'id';
    const PESO = 'peso_animal';
    const EDAD = 'edad_animal';
    const FECHA_INGRESO = 'fecha_ingreso';
    const PRECIO = 'precio_animal';
    const GENERO_ID = 'genero_id';
    const LOTE_ID = 'lote_id';
    const RAZA = 'raza';

    function getId() {
        return $this->id;
    }

    function getPeso_animal() {
        return $this->peso_animal;
    }

    function getEdad_animal() {
        return $this->edad_animal;
    }

    function getFecha_ingreso() {
        return $this->fecha_ingreso;
    }

    function getPrecio_animal() {
        return $this->precio_animal;
    }

    function getGenero_id() {
        return $this->genero_id;
    }

    function getLote_id() {
        return $this->lote_id;
    }

    function getRaza() {
        return $this->raza;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setPeso_animal($peso_animal) {
        $this->peso_animal = $peso_animal;
    }

    function setEdad_animal($edad_animal) {
        $this->edad_animal = $edad_animal;
    }

    function setFecha_ingreso($fecha_ingreso) {
        $this->fecha_ingreso = $fecha_ingreso;
    }

    function setPrecio_animal($precio_animal) {
        $this->precio_animal = $precio_animal;
    }

    function setGenero_id($genero_id) {
        $this->genero_id = $genero_id;
    }

    function setLote_id($lote_id) {
        $this->lote_id = $lote_id;
    }

    function setRaza($raza) {
        $this->raza = $raza;
    }

    /**
     * Método para obtener el nombre del campo más la tabla ya sea en formato
     * DB (.) o en formato HTML (_)
     *
     * @param string $field Nombre del campo
     * @param string $html [optional] Por defecto traerá el nombre del campo en
     * versión DB
     * @return string
     */
    public static function getNameField($field, $html = false, $table = null) {
        return parent::getNameField($field, self::getNameTable(), $html);
    }

    /**
     * Obtiene el nombre de la tabla
     * @return string
     */
    public static function getNameTable() {
        return 'animal';
    }

    /**
     * Método para borrar un registro de una tabla X en la base de datos
     *
     * @param array $ids Array con los campos por posiciones
     * asociativas y los valores por valores a tener en cuenta para el borrado.
     * Ejemplo $fieldsAndValues['id'] = 1
     * @param boolean $deletedLogical [optional] Borrado lógico [por defecto] o
     * borrado físico de un registro en una tabla de la base de datos
     * @return PDOException|boolean
     */
    public static function delete($ids, $deletedLogical = true, $table = null) {
        return parent::delete($ids, $deletedLogical, self::getNameTable());
    }

    /**
     * Método para insertar en una tabla usuario
     *
     * @param array $data Array asociativo donde las claves son los nombres de
     * los campos y su valor sería el valor a insertar. Ejemplo:
     * $data['nombre'] = 'Erika'; $data['apellido'] = 'Galindo';
     * @return PDOException|boolean
     */
    public static function insert($data, $table = null) {
        return parent::insert(self::getNameTable(), $data);
    }

    /**
     * Método para leer todos los registros de una tabla
     *
     * @param array $fields Array con los nombres de los campos a solicitar
     * @param boolean $deletedLogical [optional] Indicación de borrado lógico
     * o borrado físico
     * @param array $orderBy [optional] Array con el o los nombres de los campos
     * por los cuales se ordenará la consulta
     * @param string $order [optional] Forma de ordenar la consulta
     * (por defecto NULL), pude ser ASC o DESC
     * @param integer $limit [optional] Cantidad de resultados a mostrar
     * @param integer $offset [optional] Página solicitadad sobre la cantidad
     * de datos a mostrar
     * @return mixed una instancia de una clase estandar, la cual tendrá como
     * variables publica los nombres de las columnas de la consulta o una
     * instancia de \PDOException en caso de fracaso.
     */
    public static function getAll($fields, $deletedLogical = true, $orderBy = null, $order = null, $limit = null, $offset = null, $where = null, $table = null) {
        return parent::getAll(self::getNameTable(), $fields, $deletedLogical, $orderBy, $order, $limit, $offset, $where);
    }

    /**
     * Método para actualizar un registro en una tabla de una base de datos
     *
     * @param array $ids Array asociativo con las posiciones por nombres de los
     * campos y los valores son quienes serían las llaves a buscar.
     * @param array $data Array asociativo con los datos a modificar,
     * las posiciones por nombres de las columnas con los valores por los nuevos
     * datos a escribir
     * @return PDOException|boolean
     */
    public static function update($ids, $data, $table = null) {
        return parent::update($ids, $data, self::getNameTable());
    }

}
