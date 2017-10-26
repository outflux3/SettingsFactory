
$(document).ready(function() {
	if($('#ProcessSettingsFactory').length == 0) return;

	$('#ProcessSettingsFactory').WireTabs({
		items: $(".Inputfields li.WireTab")
	});

});
