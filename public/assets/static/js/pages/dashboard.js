var optionsResponsesTime = {
  annotations: {
    position: "back",
  },
  dataLabels: {
    enabled: false,
  },
  chart: {
    type: "bar",
    height: 300,
  },
  fill: {
    opacity: 1,
  },
  plotOptions: {},
  series: [
    {
      name: "Chat",
      data: [9, 10, 30, 20, 10, 20, 30, 20, 10, 20, 30, 20],
    },
  ],
  colors: "#435ebe",
  xaxis: {
    categories: [
      "Jan",
      "Feb",
      "Mar",
      "Apr",
      "May",
      "Jun",
      "Jul",
      "Aug",
      "Sep",
      "Oct",
      "Nov",
      "Dec",
    ],
  },
var optionsProfileVisit = {
	annotations: {
		position: 'back'
	},
	dataLabels: {
		enabled:false
	},
	chart: {
		type: 'bar',
		height: 300
	},
	fill: {
		opacity:1
	},
	plotOptions: {
	},
	series: [{
		name: 'sales',
		data: [15,6,25]
	}],
	colors: '#435ebe',
	xaxis: {
		categories: ["2021","2022","2023"],
	},
}

var optionsMemberBulan = {
	annotations: {
		position: 'back'
	},
	dataLabels: {
		enabled:false
	},
	chart: {
		type: 'bar',
		height: 300
	},
	fill: {
		opacity:1
	},
	plotOptions: {
	},
	series: [{
		name: 'sales',
		data: [9,15,25]
	}],
	colors: '#435ebe',
	xaxis: {
		categories: ["Januari","Februari","Maret"],
	},
}

var optionsMemberTahun = {
	annotations: {
		position: 'back'
	},
	dataLabels: {
		enabled:false
	},
	chart: {
		type: 'bar',
		height: 300
	},
	fill: {
		opacity:1
	},
	plotOptions: {
	},
	series: [{
		name: 'sales',
		data: [15,6,25]
	}],
	colors: '#435ebe',
	xaxis: {
		categories: ["2021","2022","2023"],
	},
}

var optionsAktifBulan= {
	annotations: {
		position: 'back'
	},
	dataLabels: {
		enabled:false
	},
	chart: {
		type: 'bar',
		height: 300
	},
	fill: {
		opacity:1
	},
	plotOptions: {
	},
	series: [{
		name: 'sales',
		data: [15,6, 10]
	}],
	colors: '#435ebe',
	xaxis: {
		categories: ["Januari","Februari","Maret"],
	},
}

var optionsAktifTahun= {
	annotations: {
		position: 'back'
	},
	dataLabels: {
		enabled:false
	},
	chart: {
		type: 'bar',
		height: 300
	},
	fill: {
		opacity:1
	},
	plotOptions: {
	},
	series: [{
		name: 'sales',
		data: [10,10,20]
	}],
	colors: '#435ebe',
	xaxis: {
		categories: ["2021","2022","2023"],
	},
}


let optionsVisitorsProfile  = {
	series: [70, 30],
	labels: ['Male', 'Female'],
	colors: ['#435ebe','#55c6e8'],
	chart: {
		type: 'donut',
		width: '100%',
		height:'350px'
	},
	legend: {
		position: 'bottom'
	},
	plotOptions: {
		pie: {
			donut: {
				size: '30%'
			}
		}
	}
}

var optionsEurope = {
	series: [{
		name: 'series1',
		data: [310, 800, 600, 430, 540, 340, 605, 805,430, 540, 340, 605]
	}],
	chart: {
		height: 80,
		type: 'area',
		toolbar: {
			show:false,
		},
	},
	colors: ['#5350e9'],
	stroke: {
		width: 2,
	},
	grid: {
		show:false,
	},
	dataLabels: {
		enabled: false
	},
	xaxis: {
		type: 'datetime',
		categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z", "2018-09-19T06:30:00.000Z","2018-09-19T07:30:00.000Z","2018-09-19T08:30:00.000Z","2018-09-19T09:30:00.000Z","2018-09-19T10:30:00.000Z","2018-09-19T11:30:00.000Z"],
		axisBorder: {
			show:false
		},
		axisTicks: {
			show:false
		},
		labels: {
			show:false,
		}
	},
	show:false,
	yaxis: {
		labels: {
			show:false,
		},
	},
	tooltip: {
		x: {
			format: 'dd/MM/yy HH:mm'
		},
	},
};

let optionsAmerica = {
	...optionsEurope,
	colors: ['#008b75'],
}
let optionsIndonesia = {
	...optionsEurope,
	colors: ['#dc3545'],
}

var optionsResponsesTime = new ApexCharts(
  document.querySelector("#chart-responses-time"),
  optionsResponsesTime
)
var chartVisitorsProfile = new ApexCharts(
  document.getElementById("chart-visitors-profile"),
  optionsVisitorsProfile
)
var chartEurope = new ApexCharts(
  document.querySelector("#chart-europe"),
  optionsEurope
)
var chartAmerica = new ApexCharts(
  document.querySelector("#chart-america"),
  optionsAmerica
)
var chartIndonesia = new ApexCharts(
  document.querySelector("#chart-indonesia"),
  optionsIndonesia
)

chartIndonesia.render()
chartAmerica.render()
chartEurope.render()
// chartProfileVisit.render()
chartVisitorsProfile.render()
optionsResponsesTime.render()


var chartProfileVisit = new ApexCharts(
	document.querySelector("#chart-profile-visit"),
	optionsProfileVisit
  )
var chartMemberBulan = new ApexCharts(
	document.querySelector("#chart-member-bulan"), 
	optionsMemberBulan
	)
var chartMemberTahun = new ApexCharts(
	document.querySelector("#chart-member-tahun"), 
	optionsMemberTahun
	)
var chartAktifBulan = new ApexCharts(
	document.querySelector("#chart-aktif-bulan"), 
	optionsAktifBulan
	)
var chartAktifTahun = new ApexCharts(
	document.querySelector("#chart-aktif-tahun"), 
	optionsAktifTahun
	)
var chartVisitorsProfile = new ApexCharts(
	document.getElementById('#chart-visitors-profile'), 
	optionsVisitorsProfile
	)
var chartEurope = new ApexCharts(
	document.querySelector("#chart-europe"), 
	optionsEurope
	)
var chartAmerica = new ApexCharts(
	document.querySelector("#chart-america"), 
	optionsAmerica
	)
var chartIndonesia = new ApexCharts(
	document.querySelector("#chart-indonesia"), 
	optionsIndonesia
	)
	

chartIndonesia.render();
chartAmerica.render();
chartEurope.render();
chartProfileVisit.render();
chartMemberBulan.render();
chartMemberTahun.render();
chartAktifBulan.render();
chartAktifTahun.render();
chartVisitorsProfile.render()
