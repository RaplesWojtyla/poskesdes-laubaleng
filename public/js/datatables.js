// import DataTable from 'datatables.net-dt';
// import 'datatables.net-responsive-dt';

// let table = new DataTable('#myTable', {
//     responsive: true
// });

window.addEventListener('DOMContentLoaded', event => {
    // Simple-DataTables
    // https://github.com/fiduswriter/Simple-DataTables/wiki

    const myTable = document.getElementById('myTable');
    if (myTable) {
        scrollX: false;
        compact: true;
        new simpleDatatables.DataTable(myTable);
    }

});