<?php

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\ReplaceCommand;

function flash_form_system_theme_settings_alter(&$form, FormStateInterface &$form_state, $form_id = null)
{
    // vertical tabs
    $form['layout'] = [
    '#type'  => 'vertical_tabs',
  ];
    // theme color mode settings
    $form['layout']['theme_color'] = [
      '#type'        => 'details',
      '#title'       => t('theme color'),
      '#description'   => t('choose theme color mode'),
      '#group' => 'layout',
    ];

    $form['layout']['theme_color']['theme_color_mode']= [
      '#type'          => 'radios',
      '#options' => ['dark' => t('dark'), 'light'=> t('light')],
      '#default_value' => theme_get_setting('theme_color_mode')
    ];

    // side bar settings
    $form['layout']['sidebar'] = [
        '#type'        => 'details',
        '#title'       => t('sidebar'),
        '#group' => 'layout',
      ];

    $form['layout']['sidebar']['show_sidebar']= [
      '#type'          => 'checkbox',
      '#default_value' => theme_get_setting('show_sidebar'),
      '#description'   => t("Check this option to show the side bar. Uncheck to hide. "),
        ];

    $form['layout']['sidebar']['sidebar_position']= [
    '#type'          => 'radios',
    '#options' => ['left' => t('left'), 'right' => t('right')],
    '#default_value' => theme_get_setting('sidebar_position'),
    '#description' => t('choose sidebar position'),
  ];
    //  main navigation/header settings
    $form['layout']['navigation'] = [
      '#type'        => 'details',
      '#title'       => t('main navigation'),
      '#group' => 'layout',
    ];

    $form['layout']['navigation']['navigation_position']= [
    '#type'          => 'radios',
    '#options' => ['top' => t('top'), 'sides' => t('sides') ],
    '#default_value' => theme_get_setting('navigation_position'),
    '#description'   => t("choose the position of the main navigation"),
    ];

    $form['layout']['navigation']['navigation_sticky']= [
      '#type'          => 'checkbox',
      '#default_value' => theme_get_setting('navigation_sticky'),
      '#description'   => t("Check this option to stick main navigation to the top of the page."),
        ];
    // google fonts

    $form['layout']['fonts'] = [
      '#type'        => 'details',
      '#title'       => t('fonts'),
      '#description' => t(''),
      '#group' => 'layout',
    ];
    $form['layout']['fonts']['google_font'] = [
      '#type'          => 'select',
      '#title'         => t('Select Google Fonts Location'),
      '#options' => array(
        'local' => t('Local Self Hosted'),
        'google_cdn' => t('Google CDN Server')
      ),
      '#default_value' => theme_get_setting('google_font'),
      '#description'   => t('sales management theme uses fthe ollowing Google font: "ElMessiri". You can serve this font locally or from Google server.'),
    ];
    // ---------------------------------------------------------
    //banner
    $form['layout']['banner'] = [
      '#type'        => 'details',
      '#title'       => t('banner types'),
      '#description' => t(''),
      '#group' => 'layout',
    ];
    $form['layout']['banner']['show_banner'] = [
      '#type'          => 'checkbox',
      '#title'         => t('Show banner on Homepage'),
      '#default_value' => theme_get_setting('show_banner'),
      '#description'   => t("Check this option to show banner on homepage. Uncheck to hide."),
      '#attributes' => [
        'name' => 'show_banner',
      ],
    ];
    $form['layout']['banner']['banner_fieldset'] = [
      '#type'        => 'fieldset',
      '#states' => [
      'visible' => [
        '[name="show_banner"]' => ['checked'   => true],
      ],
      ]
    ];

    $form['layout']['banner']['banner_fieldset']['banner_type'] = [
      '#type' => 'select',
      '#options' => array(
        'static' => t('static image'),
        'static_multiple' => t('static multiple images'),
        'slider' => t('slider'),
      ),
      '#title'       => t('choose banner type'),
      '#description' => t('choose banner type'),
      '#selected' => theme_get_setting('banner_type'),
      '#default_value' => theme_get_setting('banner_type'),
      '#attributes' => [
        'name' => 'banner_type',
      ],
      ];
    /* Slider -> Image upload */
    $form['layout']['banner']['banner_fieldset']['static_image_fieldset'] = [
      '#type'          => 'fieldset',
      '#title'         => t('Slider Background Images'),
      '#states' => [
        'visible' => [
          '[name="banner_type"]' => ['value' => 'static'],
        ],
        ]
    ];
    $form['layout']['banner']['banner_fieldset']['static_image_fieldset']['static_image'] = [
      '#type'=> 'managed_file',
      '#upload_location' => 'public://banner_images/static',
      '#progress_message'   => t('Please wait...'),
      '#progress_indicator' => 'bar',
      '#upload_validators' =>[
        'file_validate_extensions' => ['gif png jpg jpeg'],
      ],
      '#default_value' => theme_get_setting('static_image', 'sales_management'),
      '#description'   => t('upload image'),

    ];
    $form['layout']['banner']['banner_fieldset']['multiple_images_fieldset'] = [
      '#type'          => 'fieldset',
      '#title'         => t('Slider Background Images'),
      '#states' => [
        'visible' => [
          '[name="banner_type"]' => ['!value' => 'static'],
        ],
        ]
    ];
    for ($i = 0; $i < 5; $i++) {
        $form['layout']['banner']['banner_fieldset']['multiple_images_fieldset']['banner_image'.$i] = [
          '#type'=> 'managed_file',
          '#title' => t('Image').' #'.($i+1),
          '#upload_location' => 'public://banner_images/multiple',
          '#progress_message'   => t('Please wait...'),
          '#progress_indicator' => 'bar',
          '#upload_validators' =>[
            'file_validate_extensions' => ['gif png jpg jpeg'],
          ],
          '#default_value' => theme_get_setting('banner_image'.$i, 'sales_management'),
          '#description'   => t('upload').'image'.($i+1),
        ];
    }



    // ------------------------------------------------------------------
    $form['layout']['footer'] = [
      '#type'        => 'details',
      '#title'       => t('footer layout'),
      '#description' => t(''),
      '#group' => 'layout',
    ];
    $form['layout']['footer']['show_footer']= [
      '#type'          => 'checkbox',
      '#title'         => t('Show footer'),
      '#default_value' => theme_get_setting('show_footer'),
      '#description'   => t("Check this option to show footer. Uncheck to hide."),

    ];
    $form['layout']['footer']['footer_layout']= [
      '#type'          => 'radios',
      '#title'         => t('choose starting number of columns for footer'),
      '#default_value' => theme_get_setting('footer_layout'),
      '#options' => [0 => t('one'), 1=> t('two'), 2=> t('three'), 3=> t('four')],
      '#description'   => t(""),
    ];
}
