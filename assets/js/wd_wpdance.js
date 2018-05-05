// Menu Mobile
jQuery(function () {
  jQuery(".menu-bars").click(function(){
    jQuery(".menu-bars, .pushmenu-left, .body-wrapper, body").toggleClass('pushmenu');      
  });
	jQuery(".pushmenu-left .nav ul li.page_item_has_children, .pushmenu-left .mobile-main-menu ul li.menu-item-has-children").prepend("<i class='fa fa-caret-down'></i>");
	
  jQuery(".pushmenu-left .nav ul li.page_item_has_children i, .pushmenu-left .mobile-main-menu ul li.menu-item-has-children i").click(function(){
    jQuery(this).toggleClass('openmenu');      
  });

});
