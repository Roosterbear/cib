<?php

/**
 *
 * @author jguerrero
 *
 */
class Prestamo extends \CI_Model {
  private $id, $idEjemplar, $idSolicitante, $idPolitica, $estado, $fechaSalida, $fechaEntrega, $renovaciones, $idUsuario,$fechaEntrada;
  public $ejemplar;
  public $politica;
  /**
   *
   * @return void
   *
   */
  public function __construct($id=NULL) {
    parent::__construct ();

    if($id!==null){$this->setId($id);}

    $this->ejemplar=new Ejemplar();
    $this->politica= new Politica();
  }
  /**
   * @return the $id
   */
  public function getId() {
    return $this->id;
  }

  /**
   * @return the $idEjemplar
   */
  public function getIdEjemplar() {
    return $this->idEjemplar;
  }

  /**
   * @return the $idSolicitante
   */
  public function getIdSolicitante() {
    return $this->idSolicitante;
  }

  /**
   * @return the $idPolitica
   */
  public function getIdPolitica() {
    return $this->idPolitica;
  }

  /**
   * @return the $estado
   */
  public function getEstado() {
    return $this->estado;
  }

  /**
   * @return the $fechaSalida
   */
  public function getFechaSalida() {
    return $this->fechaSalida;
  }

  /**
   * @return the $fechaEntrega
   */
  public function getFechaEntrega() {
    return str_replace(" 00:00:00", "", $this->fechaEntrega);
  }
  /**
   * @return the $renovaciones
   */
  public function getRenovaciones() {
    return $this->renovaciones;
  }

  /**
   * @return the $idUsuario
   */
  public function getIdUsuario() {
    return $this->idUsuario;
  }

  /**
   * @param field_type $id
   */
  public function setId($id) {
    $this->id = $id;
  }

  /**
   * @param field_type $idEjemplar
   */
  public function setIdEjemplar($idEjemplar) {
    $this->idEjemplar = $idEjemplar;
  }

  /**
   * @param field_type $idSolicitante
   */
  public function setIdSolicitante($idSolicitante) {
    $this->idSolicitante = $idSolicitante;
  }

  /**
   * @param field_type $idPolitica
   */
  public function setIdPolitica($idPolitica) {
    //echo "<script>alert(".$idPolitica.")</script>";
    $this->idPolitica = $idPolitica == ""?"1":$idPolitica;

  }

  /**
   * @param field_type $estado
   */
  public function setEstado($estado) {
    $this->estado = $estado;
  }

  /**
   * @param field_type $fechaSalida
   */
  public function setFechaSalida($fechaSalida) {
    $this->fechaSalida = $fechaSalida;
  }

  /**
   * @param field_type $fechaEntrega
   */
  public function setFechaEntrega($fechaEntrega) {
    $this->fechaEntrega = $fechaEntrega;
  }

  /**
   * @param field_type $renovaciones
   */
  public function setRenovaciones($renovaciones) {
    $this->renovaciones = $renovaciones;
  }

  /**
   * @param field_type $idUsuario
   */
  public function setIdUsuario($idUsuario) {
    $this->idUsuario = $idUsuario;
  }
  /**
   * @return the $fechaEntrada
   */
  public function getFechaEntrada() {
    return $this->fechaEntrada;
  }

  /**
   * @param field_type $fechaEntrada
   */
  public function setFechaEntrada($fechaEntrada) {
    $this->fechaEntrada = $fechaEntrada;
  }


}

?>