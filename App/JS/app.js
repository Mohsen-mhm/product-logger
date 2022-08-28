$(document).ready(function () {
    $('#example').DataTable({
        processing: true,
        serverSide: true,
        ajax: './app/dataTableScript.php',
    });
});