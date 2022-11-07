<?php
namespace Drupal\sm_dashboard\Service;

class DashboardService
{
  function getClientOperationAmount($op_type){
    $query = \Drupal::database()->select('node_field_data', 'fd');
    $query->fields('fd', ['title']);
    $query->innerJoin('node__field_client', 'client', "client.entity_id = fd.nid");
    $query->innerJoin('node__field_operation_type', 'operation_type', "operation_type.entity_id = fd.nid");
    $query->condition('operation_type.field_operation_type_value', $op_type);
    $query->condition('fd.type', 'client_operation');
    $query->condition('fd.status', 1);
    $data = $query->execute()->fetchAll();
    $result = 0;
    foreach ($data as $item){
      $result += $item->title;
    }
    return $result;
  }


  function getCountOf($type){
    $query = \Drupal::database()->select('node_field_data', 'fd');
    $query->fields('fd', ['title']);
    $query->condition('fd.type', $type);
    $data = $query->execute()->fetchAll();
    return count($data);
  }


}
