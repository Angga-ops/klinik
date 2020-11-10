  <script src="../tinymcpuk/jscripts/tiny_mce/tiny_mce.js" type="text/javascript"></script>
  <script src="../tinymcpuk/jscripts/tiny_mce/tiny_lokomedia.js" type="text/javascript"></script>
    <script type="text/javascript" src="../bootstrap/js/jquery.js" ></script>
  <script type="text/javascript" src="../bootstrap/js/bootstrap.min.js" ></script>
  <script type="text/javascript" src="../bootstrap/js/bootstrap-tooltip.js"></script>
  <script type="text/javascript" src="../bootstrap/js/bootstrap-modal.js"></script>
  <script type="text/javascript" src="../bootstrap/js/bootstrap-timepicker.min.js"></script>
  <script type="text/javascript" src="../bootstrap/js/bootstrap-dropdown.js"></script>
  <script type="text/javascript" src="../bootstrap/js/bootstrap-datepicker.js"></script>
  <script type="text/javascript" src="../bootstrap/js/prettify.js"></script>
  <script type="text/javascript">
  $(function() {
window.prettyPrint && prettyPrint();
			$('#mulai').datepicker({
				format: 'yyyy-mm-dd',
                todayBtn: 'linked'
			});
			$('#akhir').datepicker({
				format: 'yyyy-mm-dd',
                todayBtn: 'linked'
			});
			$('#waktumulai').timepicker({
			    minuteStep: 1,
                showMeridian: false
			});
			$('#waktuakhir').timepicker({
			    minuteStep: 1,
                showMeridian: false
			});
			$('#jadwal').timepicker({
			    minuteStep: 1,
                showMeridian: false
			});
  });
  
  function ubah(by)
  {
		if(by.value=='0')
			document.booking.harga.disabled=true;
		else
			document.booking.harga.disabled=false;
  }
  
  function filetypechanged(rdo)
{
	if(rdo.value=='0')
		document.booking.harga.disabled=true;
	else
		document.booking.harga.disabled=true;
}
  </script>
  <script>
	function auto(t){
		setTimeout("location.reload(true);",t);
	}
  </script>
  <link rel="stylesheet" href="assets/js/jvectormap/jquery-jvectormap-1.2.2.css"  id="style-resource-1">
	<link rel="stylesheet" href="assets/js/rickshaw/rickshaw.min.css"  id="style-resource-2">
	<link rel="stylesheet" href="assets/js/dropzone/dropzone.css"  id="style-resource-1">
	<link rel="stylesheet" href="assets/js/select2/select2-bootstrap.css"  id="style-resource-1">
	<link rel="stylesheet" href="assets/js/select2/select2.css"  id="style-resource-2">
	<link rel="stylesheet" href="assets/js/selectboxit/jquery.selectBoxIt.css"  id="style-resource-3">
	<link rel="stylesheet" href="assets/js/daterangepicker/daterangepicker-bs3.css"  id="style-resource-4">
<link rel="stylesheet" href="assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css"  id="style-resource-1">
	<link rel="stylesheet" href="assets/css/font-icons/entypo/css/entypo.css"  id="style-resource-2">
	<link rel="stylesheet" href="assets/css/font-icons/entypo/css/animation.css"  id="style-resource-3">
	<link rel="stylesheet" href="assets/css/neon.css"  id="style-resource-5">
	<link rel="stylesheet" href="assets/css/custom.css"  id="style-resource-6">
	<link rel="stylesheet" href="assets/js/select2/select2-bootstrap.css"  id="style-resource-1">
	<link rel="stylesheet" href="assets/js/select2/select2.css"  id="style-resource-2">
	
	
	
  <script src="assets/js/gsap/main-gsap.js" id="script-resource-1"></script>
	<script src="assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js" id="script-resource-2"></script>
	<script src="assets/js/bootstrap.min.js" id="script-resource-3"></script>
	<script src="assets/js/joinable.js" id="script-resource-4"></script>
	<script src="assets/js/resizeable.js" id="script-resource-5"></script>
	<script src="assets/js/neon-api.js" id="script-resource-6"></script>
	<script src="assets/js/jvectormap/jquery-jvectormap-1.2.2.min.js" id="script-resource-7"></script>
	<script src="assets/js/jvectormap/jquery-jvectormap-europe-merc-en.js" id="script-resource-8"></script>
	<script src="assets/js/bootstrap-switch.min.js" id="script-resource-7"></script>
	<script src="assets/js/jquery.validate.min.js" id="script-resource-7"></script>
	<script src="assets/js/jquery.sparkline.min.js" id="script-resource-9"></script>
	<script src="assets/js/rickshaw/vendor/d3.v3.js" id="script-resource-10"></script>
	<script src="assets/js/rickshaw/rickshaw.min.js" id="script-resource-11"></script>
	<script src="assets/js/jquery.dataTables.min.js" id="script-resource-7"></script>
	<script src="assets/js/dataTables.bootstrap.js" id="script-resource-8"></script>
	<script src="assets/js/select2/select2.min.js" id="script-resource-9"></script>
	<script src="assets/js/bootstrap-tagsinput.min.js" id="script-resource-8"></script>
	<script src="assets/js/typeahead.min.js" id="script-resource-9"></script>
	<script src="assets/js/selectboxit/jquery.selectBoxIt.min.js" id="script-resource-10"></script>
	<script src="assets/js/jquery.mousewheel-3.0.4.pack.js" id="script-resource-10"></script>
	<script src="assets/js/bootstrap-datepicker.js" id="script-resource-11"></script>
	<script src="assets/js/bootstrap-timepicker.min.js" id="script-resource-12"></script>
	
	<script src="assets/js/raphael-min.js" id="script-resource-12"></script>
	<script src="assets/js/bootstrap-colorpicker.min.js" id="script-resource-13"></script>
	<script src="assets/js/daterangepicker/moment.min.js" id="script-resource-14"></script>
	<script src="assets/js/daterangepicker/daterangepicker.js" id="script-resource-15"></script>
	<script src="assets/js/fileinput.js" id="script-resource-7"></script>
	<script src="assets/js/jquery.multi-select.js" id="script-resource-16"></script>
	<script src="assets/js/morris.min.js" id="script-resource-13"></script>
	<script src="assets/js/toastr.js" id="script-resource-14"></script>
	<script src="assets/js/neon-chat.js" id="script-resource-15"></script>
	<script src="assets/js/neon-custom.js" id="script-resource-16"></script>
	<script src="assets/js/neon-demo.js" id="script-resource-17"></script>
	<script type="text/javascript">
	jQuery(document).ready(function($)
	{
		$("#mytable").dataTable({
			"sPaginationType": "bootstrap",
			"aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
			"bStateSave": true
		});
		
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
	});
	
</script>
	<script type="text/javascript">
		
		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-28991003-3']);
		_gaq.push(['_setDomainName', 'laborator.co']);
		_gaq.push(['_setAllowLinker', true]);
		_gaq.push(['_trackPageview']);
		
		(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();
		
	</script>
  <textarea id=loko> wrwqarwetrfwszetg</textarea>