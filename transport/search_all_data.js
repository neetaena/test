
							$(function() {
								$(".search_driver" ).autocomplete({
									source: 'search_driver.php',//เรียกข้อมูลจากไฟล์ search.php โดยจะส่งparams ชื่อ term ไปด้วย
									minLength: 2,
								});
							});

							$(function() {
								$(".search_licen" ).autocomplete({
									source: 'search_licen.php',//เรียกข้อมูลจากไฟล์ search.php โดยจะส่งparams ชื่อ term ไปด้วย
									minLength: 2,
								});
							});

							
							

							/* $(document).ready(function() {
					                $('.categories').change(function() {
					                    $.ajax({
					                        type: 'GET',
					                        data: {categories: $(this).val()},
					                        url: 'search/search_report_movement.php',
					                        success: function(data) {
					                            $('.report_movement').html(data);
					                        }
					                    });
					                    return false;
					                });
					            });*/

	