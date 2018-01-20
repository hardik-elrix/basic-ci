<!-- Mainly scripts -->

<script src="<?= CDN_PATH ?>js/plugins/bootstrap-toggle/bootstrap-toggle.min.js"></script>
<script src="<?= CDN_PATH ?>js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="<?= CDN_PATH ?>js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<script src="<?= CDN_PATH ?>js/plugins/dataTables/datatables.min.js"></script>
<!-- Custom and plugin javascript -->
<script src="<?= CDN_PATH ?>js/inspinia.js"></script>
<script src="<?= CDN_PATH ?>js/plugins/pace/pace.min.js"></script>
<?php
	if (isset($current['action']) && $current['action'] == 'view')
	{
		?>
        <script>
            $(document).ready(function () {
                $('input[type=checkbox].input[data-toggle=toggle]').bootstrapToggle();
                var table = $('.dataTables-example').DataTable({
					pageLength: 25,
					pagingType: "simple_numbers",
					responsive: true
				});
				$(".filterhead").each( function ( i ) {
					if(i<<?=$current['filter_limit']?>)
					{
						var select = $('<select><option value="">Filter</option></select>')
							.appendTo( $(this).empty() )
							.on( 'change', function () {
								var term = $(this).val();
								table.column( i ).search(term, false, false ).draw();
							} );
						table.column( i ).data().unique().sort().each( function ( d, j ) {
							select.append( '<option value="'+d+'">'+d+'</option>' )
						} );
					}
				} );
                // $('.dataTables-example').DataTable({
                //     pageLength: 25,
					// pagingType: "simple_numbers",
                //     responsive: true,
                //     dom: '<"html5buttons"B>lTfgitp',
                //     buttons: [
                        //{extend: 'copy'},
                        //{extend: 'csv'},
                        //{extend: 'excel', title: 'Data'},
                        //{extend: 'pdf', title: 'Data'},

                        /*{extend: 'print',
                            customize: function (win){
                                $(win.document.body).addClass('white-bg');
                                $(win.document.body).css('font-size', '10px');

                                $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                            }
                        }*/
                    //]
            });
			//$('input[type=checkbox].input[data-toggle=toggle]').bootstrapToggle();
        </script>
		<?php
	}
?>

</body>

</html>