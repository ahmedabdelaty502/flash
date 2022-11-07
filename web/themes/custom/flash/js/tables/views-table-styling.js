(function ($, Drupal, drupalSettings) {
  /*-------------------------------------------*\
  note: this styling is related to table views
  \*---------------------------------------------------------------------------------------------------*/
  // check if the page is the display of the view or edit of the view so we can toggle page background color
  $(document).ready(function () {

    // make array of the table headers text
    let titles = [];
    $(".views-view-table thead th").each(function () {
      if ($(this).children('a').length > 0) {
        titles.push($(this).children('a').text());
      } else {
        titles.push($(this).text());
      }
    });
    //add header text as an attribute for each tale cell
    $(".views-view-table tbody tr").each(function () {
      for (let i = 0; i < titles.length; i++) {
        $(this).children(`td:eq(${i})`).attr('header-text', titles[i]);
      }
    });
    //remove (margin bottom:-14px) css property from tables inside views-form if there is no result
    if ($(".views-view-table").children('tbody').children('tr').length == 1 ){
      $(".contextual-region > .view-content .views-form form > .views-view-table").css('margin-bottom',0)
    }
  });
  //*--------------------------------------------------------------------------------------------------------*
})(jQuery, Drupal, drupalSettings);
