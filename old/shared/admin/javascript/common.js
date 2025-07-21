/**
 * (C)Copyright WebOD.co.uk
 * @author Bradley Weston (WebOD Developer) <bradwestonwigston@gmail.com>
 */


$(document).ready(function(){ 

	$(function() {
		$("ul.pricing_sort").sortable({ opacity: 0.6, cursor: 'move', update: function() {
			var order = $(this).sortable("serialize") + '&cmd=Order';
			$.post("?", order);}});});
	
	$(function() {
		$("ul.quote_sort").sortable({ opacity: 0.6, cursor: 'move', update: function() {
			var order = $(this).sortable("serialize") + '&cmd=Order';
			$.post("?", order);}});});
	
});
