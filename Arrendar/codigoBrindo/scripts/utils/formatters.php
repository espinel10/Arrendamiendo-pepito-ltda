<?php

//VALORES 0 < x 999.999 
function toPesos($intValue) {
    $result = '$';
    $toStringValue = strval($intValue);
    if ($intValue <= 999){
      return $result . $toStringValue;
    }
    //1.000 Y 9.999
    if (($intValue > 999) && ($intValue < 10000)) {
      return $result .
      substr($toStringValue, 0, 1) . '.' . substr($toStringValue, 1, $toStringValue.length);
    }
    //10.000 Y 99.999
    if (($intValue > 9999) && ($intValue < 100000)) {
      return $result .
          substr($toStringValue, 0, 2) . '.' .
          substr($toStringValue, 2, $toStringValue.length);
    }
    // 100.000
    else {
      return $result +
      substr($toStringValue, 0, 3) . '.' .
      substr($toStringValue, 4, $toStringValue.length);
    }
  }

//IMPRIME LOS PRODUCTOS [cantidad]x [nombre] > 1 ó [nombre]
//CONDICIONAL TERNARIO PARA IMPRIMIR VARIOS PRODUCTOS O UNO SÓLO            
function printProductsQuantity($productName, $quantity){
  return $quantity == 1 ? "$productName " : "".$quantity."x $productName  ";
}

?>