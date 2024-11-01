jQuery(document).ready(function() {     
  jQuery("#wpas_blog_name").change(function() {
    var id = jQuery('#wpas_blog_name').val();
    jQuery("#wpas_category_div").load("?page=wp-article-spinner-blogs&blog_id=" + id + " #categories_list");
  });

   var wpas_output = jQuery("#wpas_output").offset();
   jQuery(window).scrollTop(wpas_output.top);
});

