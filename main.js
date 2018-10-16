$(document).ready(function() {

    $.ajax({
		// url: "https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest",
        url: "src/data2.php",
        method: "GET",
        data: { start: 1, limit: 100, convert: 'USD' },
        success: function(data) {
            var data = JSON.parse(data);
            var newRows;
            for (var i in data.data) {
              newRows += "<tr><td>" + data.data[i].symbol + "</td>"
              newRows += "<td><a href=\"historical.php?id=" + data.data[i].id + "&slug=" + data.data[i].slug + "\">" + data.data[i].name + "</a></td>"
              newRows += "<td>$" + parseFloat(JSON.parse(data.data[i].quote.USD.market_cap)).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + "</td>"
              newRows += "<td>$" + parseFloat(JSON.parse(data.data[i].quote.USD.price)).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + "</td>"
              newRows += "<td>$" + parseFloat(JSON.parse(data.data[i].quote.USD.volume_24h)).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + "</td>"
              newRows += "<td>" + parseFloat(JSON.parse(data.data[i].circulating_supply)).toFixed().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + " " + data.data[i].symbol + "</td>"
              newRows += "<td>" + parseFloat(JSON.parse(data.data[i].quote.USD.percent_change_24h)).toFixed(2) + "% </td></tr>"
            }
            $("table>tbody").html(newRows); 
        },
        error: function(xhr) {
            console.log('error', xhr);
        }
	});

    /*$('#example').DataTable({
      bSort: false,
      searching: false,
      bInfo: false,
      bLengthChange: false,
      // dom: 'Bfrtip',
      buttons: [
        'csv', 'excel', 'pdf'
      ]
    });*/
});