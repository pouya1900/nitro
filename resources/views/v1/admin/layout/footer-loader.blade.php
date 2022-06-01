<!-- Footer and copyright -->
	<footer style="text-align: center" class="pade-footer row b#444=000 t#bbb=fff">
		طراحی شده توسط تیم برنامه نویسی اهورا  ahoora <a  href="http://ahorateam.ir"><i class="fa fa-instagram t#0085ff"></i> </a>
		<a href="javascript:;" id="ToTop" class="fa fa-arrow-up pull-right"></a>
	</footer>
	<!-- /End Footer -->


	<!-- best Modal place -->
	<div class="modal fade" id="PatternsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">الگوها</h4>
				</div>
				<div class="modal-body">
					<ol id="pattern_thumb"><!-- Ajax loading --></ol>					
				</div>
				<div class="modal-footer">
		 			<input id="PattInput" type="hidden" />
					<div class="btn-group pull-left">
					 	<button id="BodyBtn" class="btn btn-info">تنظیم روی بدنه</button>
						<button id="ContentBtn" class="btn btn-info">تنظیم روی محتوا</button>
					</div>
					<button class="btn btn-primary pull-right">ذخیره ی تغییرات</button>
				</div>
			</div>
		</div>
	</div>
	<!-- /End Modals -->

	<!-- loaders and alerts -->
	<div class="page-loading t#0f0 b#000"><i class="fa fa-spinner fa-5x fa-spin"></i></div>
	<div id="wait" class="alert" style="display:none"><i class="fa fa-spinner fa-spin"></i>در حال بارگذاری...</div>
	<div id="lockscreen" style="display:none"><i class="fa fa-lock"></i>برند
		<p>اگر این برگه را رفرش کنید به برگه ورود منتقل خواهید شد.</p>
	</div>



	<!-- downloaded scripts (for all pages) -->
	<script type="text/javascript" src="{{ asset('assets/dashboard/js/colorclass.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/dashboard/js/pack-1.js') }}"></script> 
		<!-- jquery, uery-ui, bootstrap -->
	<script type="text/javascript" src="{{ asset('assets/dashboard/js/pack-2.js') }}"></script>
	 <!-- sticky, mousetrap, lity, toastr -->

	<!-- custom script (for all pages) -->
	<script type="text/javascript" src="{{asset('assets/dashboard/js/custom-scripts.js')}}"></script>
	<script type="text/javascript" src="{{ asset('assets/dashboard/js/custom-functions.js') }}"></script>

	{{--custom ajax scripts--}}
	<script src="{{asset('assets/dashboard/js/ajax/table_options.js')}}"></script>

	{{-- for clicable table tr --}}
	<script type="text/javascript">
        jQuery(document).ready(function($) {
            $(".clickable-row td:not(:last-child)").click(function() {
                window.location = $(this).closest("tr").data("url");
            });
        });
	</script>

