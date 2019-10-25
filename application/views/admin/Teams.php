<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb">
                    <div class="text-muted bcrumb float-right">
						<i class="fas fa-home"></i> <a href="<?php echo base_url();?>admin/home">Home</a> / <i class="fas fa-boxes"></i> Teams
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <a href="javascript:void(0)" class="btn btn-info ml-3" id="create-new-team">Add New Team</a>
                        <br /><br />
                        <table class="table table-hover cell-border" id="teams_list">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Team Name</th>
                                    <th>Team Logo</th>
                                    <th>Team Manager</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($teams): ?>
                                <?php foreach($teams as $team) : ?>
                                <tr id="team_id_<?php echo $team->id;?>">
                                    <td><?php echo $team->id; ?></td>
                                    <td><?php echo $team->teamName; ?></td>
                                    <td align="center"><a class="image-link" href="<?php echo $team->teamLogo;?>" target="_blank" alt="Team Logo"><img border="0" src="<?php echo $team->teamLogo; ?>" alt="<?php echo $team->teamName; ?>" width="75" height="75" /></a></td>
                                    <td><?php echo $team->teamManager;?></td>
                                    <td align="center">
                                        <a href="javascript:void(0)" role="button" id="edit-team" data-id="<?php echo $team->id;?>" class="btn btn-sm btn-info">Edit</a>
                                        <a href="javascript:void(0)" id="delete-team" data-id="<?php echo $team->id;?>" class="btn btn-sm btn-danger">Delete</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- modal for add / edit team -->
<div class="modal fade" tabindex="-1" id="ajax-team-modal" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="teamCrudModal"></h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="teamForm" name="teamForm">
					<input type="hidden" name="team_id" id="team_id">
					<div class="form-group row">
						<label for="teamName" class="col-sm-4 form-control-label">Team Name</label>
						<div class="col-sm-12">
							<input type="text" class="form-control" id="teamName" name="teamName" placeholder="Enter Team Name" value="" required="required">
						</div>
					</div>
					<div class="form-group row">
						<label for="teamLogo" class="col-sm-4 form-control-label">Team Logo</label>
						<div class="col-sm-12">
							<input type="text" class="form-control" id="teamLogo" name="teamLogo" value="Enter Team Logo URL" value="">
						</div>
					</div>
					<div class="form-group row">
						<label for="teamManager" class="col-sm-4 form-control-label">Manager</label>
						<div class="col-sm-12">
							<input type="text" class="form-control" id="teamManager" name="teamManager" placeholder="Enter Team Manager" value="">
						</div>
					</div>

			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary" id="btn-save" value="create">Save Changes</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
            </form>
		</div>
	</div>
</div>

<!--crud operations-->
<script>
    $(document).ready(function () {
        $("#teams_list").DataTable({
			responsive: true
		});

        /* when user clicks add team button */
        $('#create-new-team').click(function () {
            $('#btn-save').val("create-team");
            $('#team_id').val('');
            $('#teamForm').trigger("reset");
            $('#teamCrudModal').html("Add New Team");
            $('#ajax-team-modal').modal('show');
        });

        /* when user clicks edit team */
        $('body').on('click', "#edit-team", function () {
            let team_id = $(this).data("id");
            $.ajax({
                type: "POST",
                url: SITEURL + "admin/Team/get_team_by_id",
                data: {
                    id: team_id
                },
                dataType: "json",
                success: function (res) {
                    if(res.success == true) {
                        $('#title-error').hide();
                        $('#team_code-error').hide();
                        $('#description-error').hide();
                        $('#teamCrudModal').html("Edit Team");
                        $('#btn-save').val("edit-team");
                        $('#ajax-team-modal').modal('show');
                        $('#team_id').val(res.data.id);
                        $('#teamName').val(res.data.teamName);
                        $('#teamLogo').val(res.data.teamLogo);
                        $('#teamManager').val(res.data.teamManager);
                    }
                },
                error: function (data) {
					console.log('ERROR:' , data);
                }
            });
        });

        /* user clicks delete team */
        $('body').on('click', '#delete-team', function () {
            let team_id = $(this).data("id");

            if(confirm("Are you sure you want to delete this team?")) {
                $.ajax({
                    type: "POST",
                    url: SITEURL + "admin/Team/delete",
                    data: {
                        team_id: team_id
                    },
                    dataType: "json",
                    success: function (data) {
						$("#team_id" + team_id).remove();
						location.reload();
                    },
                    error: function (data) {
                        console.log('ERROR:', data);
                    }
                });
            }
        });
    });

    if($("#teamForm").length > 0) {
        $("#teamForm").validate({

            submitHandler: function (form) {
                let actionType = $('#btn-save').val();
                $('#btn-save').html('Sending...');

                $.ajax({
                    data: $('#teamForm').serialize(),
                    url: SITEURL + "admin/Team/store",
                    type: "POST",
                    dataType: "json",
                    success: function (res) {
                        let team = '<tr id="team_id_' + res.data.id + '"><td>' + res.data.id + '</td><td>' + res.data.teamName + '</td><td>' + res.data.teamLogo + '</td><td>' + res.data.teamManager + '</td>';
						team += '<td><a href="javascript:void(0)" id="edit-team" res.data-id ="' + res.data.id + '" class="btn btn-info">Edit</a><a href="javascript:void(0)" id="delete-team" res.data-id="' + res.data.id + '" class="btn btn-danger delete-team">Delete</a></td></tr>';
						location.reload();

                        if(actionType == "create-team") {
                            $('#team_list').prepend(team);
                        } else {
                            $("#team_id_" + res.data.id).replaceWith(team);
                        }

                        $('#teamForm').trigger("reset");
                        $('#ajax-team-modal').modal('hide');
                        $('#btn-save').html('Save Changes');
                    },

                    error: function (data) {
                        console.log('ERROR:', data);
                        $('#btn-save').html('Save Changes');
                    }
                });
            }
        });
    }
</script>
