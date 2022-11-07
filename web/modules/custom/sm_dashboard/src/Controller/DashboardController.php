<?php

namespace Drupal\sm_dashboard\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\sm_dashboard\Service\DashboardService;
/**
 * Controller for the Landing Page.
 */
class DashboardController extends ControllerBase
{

  public function landingPage()
  {
    $DashboardService = new DashboardService();
    $clients['payment'] = $DashboardService->getClientOperationAmount('payment');
    $clients['product'] = $DashboardService->getClientOperationAmount('product');
    $clients['count_products'] = $DashboardService->getCountOf('product');
    $clients['count_clients'] = $DashboardService->getCountOf('clients');
    return [
      '#theme' => 'landing_page',
      '#clients' => $clients
      ];
  }
}
