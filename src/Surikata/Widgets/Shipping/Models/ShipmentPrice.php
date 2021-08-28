<?php

namespace ADIOS\Widgets\Shipping\Models;

class ShipmentPrice extends \ADIOS\Core\Model {
  var $sqlName = "shipping_shipment_prices";
  var $lookupSqlValue = "concat({%TABLE%}.name)";
  var $urlBase = "Shipping/ShipmentPrices";
  var $tableTitle = "Shipment prices";
  var $formTitleForInserting = "New shipment price";
  var $formTitleForEditing = "Shipment price";

  var $shipmentPriceCalculationMethodEnumValues = [
    1 => "Calculate by offer value",
    2 => "Calculate by offer height"
  ];

  public function columns(array $columns = []) {
    return parent::columns([
      "id_shipment" => [
        "type" => "lookup",
        "title" => $this->translate("Shipment"),
        "model" => "Widgets/Shipping/Models/Shipment",
        "required" => TRUE,
        "show_column" => TRUE,
      ],

      "name" => [
        'type' => 'varchar',
        'title' => $this->translate("Unique name"),
        "required" => TRUE,
        'show_column' => TRUE,
      ],

      "weight_from" => [
        "type" => "float",
        "title" => $this->translate("Offer weight from"),
        "show_column" => TRUE
      ],

      "weight_to" => [
        "type" => "float",
        "title" => $this->translate("Offer weight to"),
        "show_column" => TRUE
      ],

      "price_from" => [
        "type" => "float",
        "title" => $this->translate("Offer price start"),
        "show_column" => TRUE
      ],

      "price_to" => [
        "type" => "float",
        "title" => $this->translate("Offer price to"),
        "show_column" => TRUE
      ],

      "shipment_price_calculation_method" => [
        'type' => 'varchar',
        'title' => $this->translate("Shipment price calculation method"),
        "enum_values" => $this->shipmentPriceCalculationMethodEnumValues,
        'show_column' => TRUE,
      ],

      "shipment_price" => [
        "type" => "float",
        "title" => $this->translate("Shipment price"),
        "show_column" => TRUE
      ],

    ]);
  }

  public function indexes($columns = []) {
    return parent::indexes([
      "unique_name" => [
        "type" => "unique",
        "columns" => ["name"],
      ],
    ]);
  }

}