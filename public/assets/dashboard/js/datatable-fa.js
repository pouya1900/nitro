$(document).ready(function() {
    $('#example').DataTable({
        // "pageLength": 50,
        dom: 'Bfrtip',
        buttons: ['csv','excel','print'
        ],
        /*paging:   true,// todo remove thiese lines,*/
        language: {
            searchPlaceholder: 'جستجو ...',
            sSearch: '',
            sLengthMenu: 'نمایش _MENU_',
            sLength: 'dataTables_length',
            Show: "نمایش",
            EmptyTable: "هیچ داده ای در جدول وجود ندارد",
            info: "نمایش _START_ تا _END_ از _TOTAL_ رکورد",
            InfoEmpty: "نمایش 0 تا 0 از 0 رکورد",
            InfoFiltered: "(فیلتر شده از _MAX_ رکورد)",
            InfoPostFix: "",
            InfoThousands: ",",
            LengthMenu: "نمایش _MENU_ رکورد",
            LoadingRecords: "در حال بارگزاری...",
            Processing: "در حال پردازش...",
            Search: "جستجو:",
            buttons: {
                csv: "خروجی csv",
                excel: "خروجی excel",
                pdf: "دریافت pdf",
                print: "پرینت یا دریافت pdf"
            },
            ZeroRecords: "رکوردی با این مشخصات پیدا نشد",
            sZeroRecords: "رکوردی با این مشخصات پیدا نشد",
            sInfoEmpty: "نمایش 0 تا 0 از 0 رکورد",
            sInfoFiltered: "(فیلتر شده از _MAX_ رکورد)",
            Aria: {
                SortAscending: ": فعال سازی نمایش به صورت صعودی",
                SortDescending: ": فعال سازی نمایش به صورت نزولی"
            }
            /*oPaginate: {
                sFirst: '<i class="fa fa-chevron-right"></i>',
                sPrevious: '<i class="fa fa-chevron-right"></i>',
                sNext: '<i class="fa fa-chevron-left"></i>',
                sLast: '<i class="fa fa-chevron-left"></i>'
            }
            oPaginate: false*/

        },
        lengthMenu: [10000000],
        columnDefs: [
            { "width": "15%", "targets": 'my_commands' }
        ],

        select: true
    });

    $('.dataTables_length select').addClass('browser-default');
});