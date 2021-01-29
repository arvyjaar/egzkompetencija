<script>
    $(function() {
			  let copyButtonTrans = '<?php echo e(trans('global.datatables.copy')); ?>'
			  let csvButtonTrans = '<?php echo e(trans('global.datatables.csv')); ?>'
			  let excelButtonTrans = '<?php echo e(trans('global.datatables.excel')); ?>'
			  let pdfButtonTrans = '<?php echo e(trans('global.datatables.pdf')); ?>'
			  let printButtonTrans = '<?php echo e(trans('global.datatables.print')); ?>'
			  let colvisButtonTrans = '<?php echo e(trans('global.datatables.colvis')); ?>'

			  let languages = {
			    'en': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/English.json',
			  };

			  $.extend(true, $.fn.dataTable.Buttons.defaults.dom.button, { className: 'btn' })
			  $.extend(true, $.fn.dataTable.defaults, {
			    language: {
			      url: languages.<?php echo e(app()->getLocale()); ?>

			    },
			    columnDefs: [{
			        orderable: false,
			        className: 'select-checkbox',
			        targets: 0
			    }, {
			        orderable: false,
			        searchable: false,
			        targets: -1
			    }],
			    select: {
			      style:    'multi+shift',
			      selector: 'td:first-child'
			    },
			    order: [],
			    scrollX: true,
			    pageLength: 50,
			    dom: 'lBfrtip<"actions">',
				
			    buttons: [
			      {
			        extend: 'csv',
			        className: 'btn-default',
			        text: csvButtonTrans,
			        exportOptions: {
			          columns: ':visible'
			        }
			      },
			      {
			        extend: 'excel',
			        className: 'btn-default',
			        text: excelButtonTrans,
			        exportOptions: {
			          columns: ':visible'
			        }
			      },
			      {
			        extend: 'pdf',
			        className: 'btn-default',
			        text: pdfButtonTrans,
			        exportOptions: {
			          columns: ':visible'
			        }
			      },
			      {
			        extend: 'print',
			        className: 'btn-default',
			        text: printButtonTrans,
			        exportOptions: {
			          columns: ':visible'
			        }
			      },
			      {
			        extend: 'colvis',
			        className: 'btn-default',
			        text: colvisButtonTrans,
			        exportOptions: {
			          columns: ':visible'
			        }
			      }
			    ]
			  });

			  $.fn.dataTable.ext.classes.sPageButton = '';
			});
</script><?php /**PATH /home/vagrant/egzkomp.test/resources/views/partials/quickadmin-datatables.blade.php ENDPATH**/ ?>