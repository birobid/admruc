<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $ITEM
 * @property string $NOMBRE
 * @property string $NOMBRECORTO
 * @property string $CATEGORIA
 * @property string $FAMILIA
 * @property string $LINEA
 * @property string $MARCA
 * @property string $PRESENTA
 * @property string $ESTADO
 * @property string $DISPOVEN
 * @property string $IVA
 * @property string $BIEN
 * @property string $PROVEEDOR
 * @property float $FACTOR
 * @property float $STOCK
 * @property float $STOCKMI
 * @property float $STOCKMA
 * @property float $PESO
 * @property float $VOLUMEN
 * @property float $PRECIO0
 * @property float $PRECIO1
 * @property float $PRECIO2
 * @property float $PRECIO3
 * @property float $PRECIO4
 * @property float $PRECIO5
 * @property float $PVP
 * @property string $ITEMR
 * @property string $ULTVEN
 * @property string $ULTCOM
 * @property float $COSTOP
 * @property float $COSTOU
 * @property string $OBSERVA
 * @property string $GRUPO
 * @property string $COMBO
 * @property string $REGALO
 * @property string $CODPROV
 * @property float $PORUTI
 * @property float $PORUTIVENTA
 * @property string $CODBARRA
 * @property string $CANFRA
 * @property int $STOCKMAY
 * @property float $PORUTIPRE0
 * @property float $PORUTIPRE1
 * @property float $PORUTIPRE2
 * @property float $PORUTIPRE3
 * @property float $PORUTIPRE4
 * @property float $PORUTIPRE5
 * @property float $LITROS
 * @property string $WEB
 * @property string $OFERTA
 * @property float $POFERTA
 * @property string $NOVEDAD
 * @property string $IMAGEN
 * @property float $CANTCOMPRA
 * @property string $SOLOPOS
 * @property string $CUENTAVENTA
 * @property string $ESPT
 * @property string $IMAGENADICIONAL
 * @property string $TIENECTAVENTA
 * @property string $tipoprofal
 * @property float $PORDESSUGERIDO
 * @property int $NUMCOTIZACION
 * @property string $SOLORECETA
 * @property string $PSICOTROPICO
 * @property string $TRATAMIENTOCONTINUO
 * @property string $CONTROLLOTE
 * @property string $seccion
 * @property string $percha
 * @property string $REGSANITARIO
 * @property string $EWEB
 * @property string $TIPOPRODUCTO
 * @property float $cantidadxcaja
 * @property string $CodShip
 * @property string $descripcion
 * @property string $subcategoria
 * @property string $CARRO
 * @property string $ESTAENCARRO
 * @property string $CONCENTRACION
 * @property string $FORMAF
 * @property string $PRESENTACION
 * @property string $pespecial
 * @property string $MANEJAARROBA
 */
class ADMITEM extends Model
{
    public $connection = 'sqlsrv';
   
    public  $timestamps = false;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'ADMITEM';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'ITEM';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     * 
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = ['NOMBRE', 'NOMBRECORTO', 'CATEGORIA', 'FAMILIA', 'LINEA', 'MARCA', 'PRESENTA', 'ESTADO', 'DISPOVEN', 'IVA', 'BIEN', 'PROVEEDOR', 'FACTOR', 'STOCK', 'STOCKMI', 'STOCKMA', 'PESO', 'VOLUMEN', 'PRECIO0', 'PRECIO1', 'PRECIO2', 'PRECIO3', 'PRECIO4', 'PRECIO5', 'PVP', 'ITEMR', 'ULTVEN', 'ULTCOM', 'COSTOP', 'COSTOU', 'OBSERVA', 'GRUPO', 'COMBO', 'REGALO', 'CODPROV', 'PORUTI', 'PORUTIVENTA', 'CODBARRA', 'CANFRA', 'STOCKMAY', 'PORUTIPRE0', 'PORUTIPRE1', 'PORUTIPRE2', 'PORUTIPRE3', 'PORUTIPRE4', 'PORUTIPRE5', 'LITROS', 'WEB', 'OFERTA', 'POFERTA', 'NOVEDAD', 'IMAGEN', 'CANTCOMPRA', 'SOLOPOS', 'CUENTAVENTA', 'ESPT', 'IMAGENADICIONAL', 'TIENECTAVENTA', 'tipoprofal', 'PORDESSUGERIDO', 'NUMCOTIZACION', 'SOLORECETA', 'PSICOTROPICO', 'TRATAMIENTOCONTINUO', 'CONTROLLOTE', 'seccion', 'percha', 'REGSANITARIO', 'EWEB', 'TIPOPRODUCTO', 'cantidadxcaja', 'CodShip', 'descripcion', 'subcategoria', 'CARRO', 'ESTAENCARRO', 'CONCENTRACION', 'FORMAF', 'PRESENTACION', 'pespecial', 'MANEJAARROBA'];

}
