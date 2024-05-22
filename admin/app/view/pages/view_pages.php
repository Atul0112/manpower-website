<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
 
    function Delete(id) {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                //ajax
                var url = "&id=" + id;
                $.ajax({
                    url: "",
                    type: 'GET',
                    success: function(res) {
                        if(res.status == "success")
                        Swal.fire({
                            title: "Deleted!",
                            text: "This page has been deleted.",
                            icon: "success"
                        });
                    }
                });

            }
        });
    }
</script>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>All Pages</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">View_Pages</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Pages List</h3>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>S No</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($data['list'] as $list) { ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $list['title']; ?></td>
                                    <td><?php echo $list['description']; ?></td>
                                    <td><?php echo $list['created_at']; ?></td>

                                    <td>
                                        <a href="/admin/index.php?path=edit_page&method=edit&id=<?php echo $list['id']; ?>" class="btn btn-outline-primary">Edit Page</a>&nbsp
                                        <!-- <a href="#" onclick="Delete()">Delete</a> -->
                                        <a href="#" onclick="Delete(<?php echo $list['id']; ?>)" class="btn btn-outline-danger">Delete Page</a>
                                    </td>

                                </tr>
                            <?php $i++;
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>