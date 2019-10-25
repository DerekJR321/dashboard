<div id="wrapper">
    <div id="page-wrapper">
        <div class="container-fluid">
            <!--heading-->
            <div class="row">
                <div class="col-lg-12">
                    <ol class="breadcrumb">
                        <li class="active">
                            <i class="fa fa-desktop"></i> Modules
                        </li>
                    </ol>
                </div>
                <div class="col-lg-6">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Show</th>
                                    <th>Read</th>
                                    <th>Update</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                if($checking_status == 1) {
                                    foreach($result as $r) {
                                        ?>
                                        <tr>
                                            <td><?php echo $r->id; ?></td>
                                            <td><?php echo $r->name; ?></td>
                                            <td><?php echo $r->show == 1 ? 'yes' : 'no'; ?></td>
                                            <td><?php echo $r->read == 1 ? 'yes' : 'no'; ?></td>
                                            <td><?php echo $r->update == 1 ? 'yes' : 'no'; ?></td>
                                            <td><?php echo $r->delete == 1 ? 'yes' : 'no'; ?></td>
                                        </tr>
                            <?php
                                    }
                                } else {
                                    echo '<td colspan="6" style="text-align:center;">No results found</td>';
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

