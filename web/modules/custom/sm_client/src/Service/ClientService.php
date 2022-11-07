<?php
namespace Drupal\sm_client\Service;

class ClientService
{

  function getProductPrice($product_id){
    $product = \Drupal\node\Entity\Node::load($product_id);
    if($product){
      return $product->get('field_meter_price')->value;
    }
  }

  function getUserOperationAmount($op_type, $user_id){
    $query = \Drupal::database()->select('node_field_data', 'fd');
    $query->fields('fd', ['title']);
    $query->innerJoin('node__field_client', 'client', "client.entity_id = fd.nid");
    $query->innerJoin('node__field_operation_type', 'operation_type', "operation_type.entity_id = fd.nid");
    $query->condition('client.field_client_target_id', $user_id);
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

  function updateClientAmount($id) {
    $client = \Drupal\node\Entity\Node::load($id);
    $total_supply_amount = $this->getUserOperationAmount('product',$id);
    $total_received_amount = $this->getUserOperationAmount('payment',$id);
    if($client){
      $client->set('field_total_supply_amount', $total_supply_amount);
      $client->set('field_total_received_amount', $total_received_amount);
      $client->set('field_amount_difference', $total_supply_amount - $total_received_amount);
      $client->save();
    }
  }
}
