$(document).ready(function() {

    // if(JSON.parse(localStorage.getItem('latest'))==null){

        $.ajax({
          // url: "https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest",
          url: "src/data2.php",
          // url: "data_20181016.json",
          method: "GET",
          data: { start: 1, limit: 100, convert: 'USD' },
          // headers: { 'X-CMC_PRO_API_KEY': '90058ea6-90d3-400c-a31e-821ea817f70e' },
          // json: true,
          // gzip: true,
          success: function(data) {
            // console.log(data);
            // localStorage.setItem('latest', JSON.stringify(data));
            var data = JSON.parse(data);
            var newRows;
            for (var i in data.data) {
              newRows += "<tr><td>" + data.data[i].symbol + "</td>"
              newRows += "<td>" + data.data[i].name + "</td>"
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
    /*} else {

      var data = JSON.parse(localStorage.getItem('latest'));
      // console.log( data );

      var newRows;
      for (var i in data.data) {
        newRows += "<tr><td>" + data.data[i].symbol + "</td>"
        newRows += "<td>" + data.data[i].name + "</td>"
        newRows += "<td>$" + parseFloat(JSON.parse(data.data[i].quote.USD.market_cap)).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + "</td>"
        newRows += "<td>$" + parseFloat(JSON.parse(data.data[i].quote.USD.price)).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + "</td>"
        newRows += "<td>$" + parseFloat(JSON.parse(data.data[i].quote.USD.volume_24h)).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + "</td>"
        newRows += "<td>" + parseFloat(JSON.parse(data.data[i].circulating_supply)).toFixed().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + " " + data.data[i].symbol + "</td>"
        newRows += "<td>" + parseFloat(JSON.parse(data.data[i].quote.USD.percent_change_24h)).toFixed(2) + "% </td></tr>"
      }
      $("table>tbody").html(newRows); 
    }*/

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