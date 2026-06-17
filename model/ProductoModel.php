<?php
// model/ProductoModel.php

// Retrocedemos un nivel para salir de 'model' y entramos a 'config'
require_once __DIR__ . "/../config/conexion.php";

class ProductoModel {
    
    public static function listarTodos() {
        $db = Conexion::conectar();
        $stmt = $db->query("SELECT * FROM productos_ropa ORDER BY pro_id DESC");
        return $stmt->fetchAll();
    }

    public static function obtenerPorId($id) {
        $db = Conexion::conectar();
        $stmt = $db->prepare("SELECT * FROM productos_ropa WHERE pro_id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public static function guardar($descripcion, $categoria, $talla, $color, $precio, $stock, $imagen) {
        $db = Conexion::conectar();
        $stmt = $db->prepare("INSERT INTO productos_ropa (pro_descripcion, pro_categoria, pro_talla, pro_color, pro_precio_v, pro_stock, pro_imagen) VALUES (?, ?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$descripcion, $categoria, $talla, $color, $precio, $stock, $imagen]);
    }

    public static function actualizar($id, $descripcion, $categoria, $talla, $color, $precio, $stock, $imagen) {
        $db = Conexion::conectar();
        $stmt = $db->prepare("UPDATE productos_ropa SET pro_descripcion = ?, pro_categoria = ?, pro_talla = ?, pro_color = ?, pro_precio_v = ?, pro_stock = ?, pro_imagen = ? WHERE pro_id = ?");
        return $stmt->execute([$descripcion, $categoria, $talla, $color, $precio, $stock, $imagen, $id]);
    }

    public static function eliminar($id) {
        $db = Conexion::conectar();
        $stmt = $db->prepare("DELETE FROM productos_ropa WHERE pro_id = ?");
        return $stmt->execute([$id]);
    }
}
?>