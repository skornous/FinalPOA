$(document).ready(function(){
	$('#nb_BT').highcharts({
		legend: {
			enabled: false
		},
		title: {
			text: 'nb_BT'
		},
		xAxis: {
			categories: tab_date_nb_BT
		},
		series: [{
			data: tab_values_nb_BT,
			name: '',
			allowPointSelect: true
		}]

	});

	$('#nbi_SAP').highcharts({
		legend: {
			enabled: false
		},
		title: {
			text: 'nbi_SAP'
		},
		xAxis: {
			categories: tab_date_nbi_SAP
		},
		series: [{
			data: tab_values_nbi_SAP,
			name: '',
			allowPointSelect: true
		}]

	});

	$('#nb_NETBACKUP').highcharts({
		legend: {
			enabled: false
		},
		title: {
			text: 'nb_NETBACKUP'
		},
		xAxis: {
			categories: tab_date_nb_NETBACKUP
		},
		series: [{
			data: tab_values_nb_NETBACKUP,
			name: '',
			allowPointSelect: true
		}]

	});


	$('#nbi_ORACLE').highcharts({
		legend: {
			enabled: false
		},
		title: {
			text: 'nbi_ORACLE'
		},
		xAxis: {
			categories: tab_date_nbi_ORACLE
		},
		series: [{
			data: tab_values_nbi_ORACLE,
			name: '',
			allowPointSelect: true
		}]

	});

	$('#nbi_SQL').highcharts({
		legend: {
			enabled: false
		},
		title: {
			text: 'nbi_SQL'
		},
		xAxis: {
			categories: tab_date_nbi_SQL
		},
		series: [{
			data: tab_values_nbi_SQL,
			name: '',
			allowPointSelect: true
		}]

	});


	$('#nb_ESX').highcharts({
		legend: {
			enabled: false
		},
		title: {
			text: 'nb_ESX'
		},
		xAxis: {
			categories: tab_date_nb_ESX
		},
		series: [{
			data: tab_values_nb_ESX,
			name: '',
			allowPointSelect: true
		}]

	});


	$('#nb_CITRIX').highcharts({
		legend: {
			enabled: false
		},
		title: {
			text: 'nb_CITRIX'
		},
		xAxis: {
			categories: tab_date_nb_CITRIX
		},
		series: [{
			data: tab_values_nb_CITRIX,
			name: '',
			allowPointSelect: true
		}]

	});
});