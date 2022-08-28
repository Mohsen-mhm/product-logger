<div class="container mt-5">
    <div class="row d-flex justify-content-between">
        <div class="col">
            <h4>Resource Name: {$resource_name}</h4>
        </div>
        <div class="col d-flex justify-content-end">
            <a href="./../../index.php" class="btn btn-secondary w-25 ms-2 me-2">Home page</a>
            <a href="./createResourceInfo.php?id={$id}" class="btn btn-success w-25 ms-2 me-2">Create</a>
        </div>
    </div>
    <div class="row w-100 mt-5">
        <table id="example2" class="display mt-5">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Version</th>
                    <th>DB</th>
                    <th>Congif</th>
                    <th>Necessary</th>
                    <th>Release URL</th>
                    <th>SR</th>
                    <th>CR</th>
                    <th>Edit</th>
                </tr>
            </thead>

            <tfoot>
                <tr>
                    <th>id</th>
                    <th>Version</th>
                    <th>DB Update</th>
                    <th>Congif Update</th>
                    <th>Necessary Update</th>
                    <th>Release URL</th>
                    <th>Server Response</th>
                    <th>Client Response</th>
                    <th>Edit</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<script>
$(document).ready(function () {
    $('#example2').DataTable({
        processing: false,
        serverSide: true,
        ajax: './../dataTableResourceInfo.php',
    }).column(1).search({$id}).draw();
});
</script>
