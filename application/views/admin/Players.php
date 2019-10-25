<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb">
					<div class="text-muted bcrumb float-left">
						<a href="javascript:void(0)" class="btn btn-sm btn-info ml-3" id="create-new-player">Add New Player</a>
					</div>
                    <div class="text-muted bcrumb float-right">
                        <i class="fas fa-home"></i><a href="<?php echo base_url();?>admin/home"> Home</a> / <i class="fas fa-users"></i> Players</div>
					</div>
					<div style="clear:both;"></div>
                    <div class="row">
                        <div class="col-md-12">
                            
							<br /><br />
							<table class="table table-hover cell-border" id="players_list">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Number</th>
                                        <th>Team</th>
										<th>Position</th>
										<th>Shoots</th>
										<th>Height</th>
										<th>Weight</th>
										<th>DOB</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($players): ?>
                                    <?php foreach($players as $player) : ?>
                                    <tr id="player_id_<?php echo $player->id;?>">
                                        <td><a class="image-link" href="<?php echo $player->player_img;?>" target="_blank"><img border="0" src="<?php echo $player->player_img; ?>" alt="<?php echo $player->player_name;?>" width="50" height="50" /></a></td>
										<td><?php echo $player->player_name; ?></td>
										<td><?php echo $player->player_number; ?></td>
                                        <td><?php echo $player->teamName; ?></td>
										<td><?php echo $player->player_position; ?></td>
										<td><?php echo $player->player_shoots; ?></td>
										<td><?php echo $player->player_height; ?></td>
										<td><?php echo $player->player_weight; ?></td>
										<td><?php echo $player->player_dob; ?></td>
                                        <td align="center">
                                            <a href="javascript:void(0)" id="edit-player" data-id="<?php echo $player->id;?>" class="btn btn-sm btn-info">Edit</a>
                                            <a href="javascript:void(0)" id="delete-player" data-id="<?php echo $player->id;?>" class="btn btn-sm btn-danger">Delete</a>
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
</div>

<!-- modal for add / edit player -->
<div class="modal fade" tabindex="-1" id="ajax-player-modal" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="playerCrudModal"></h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="playerForm" name="playerForm" class="form-horizontal">
					<input type="hidden" name="player_id" id="player_id">
					<div class="form-group row">
						<label for="player_name" class="col-sm-2 col-form-label">Name</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="player_name" name="player_name" placeholder="Enter Player Name" value="" required="required">
						</div>
					</div>

					<div class="form-group row">
						<label for="player_number" class="col-sm-2 col-form-label">Player Num</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="player_number" name="player_number" placeholder="Enter Player Number" value="">
						</div>
					</div>

                    <div class="form-group row">
                        <label for="team_id" class="col-sm-2 col-form-label">Team</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="team_id" name="team_id">
                                <option selected="selected" value="">Select Team...</option>
                                <?php
                                foreach($teams as $team) {
                                    echo '<option value="'.$team->id.'">'.$team->teamName.'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>

					<div class="form-group row">
						<label for="player_position" class="col-sm-2 col-form-label">Position</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="player_position" name="player_position" placeholder="Enter Position" value="">
						</div>
					</div>

					<div class="form-group row">
						<label for="player_shoots" class="col-sm-2 col-form-label">Player Shoots</label>
						<div class="col-sm-10">
							<select class="form-control" id="player_shoots" name="player_shoots">
								<option selected="selected" value="">Select...</option>
								<option value="Left">Left</option>
								<option value="Right">Right</option>
							</select>
						</div>
					</div>

					<div class="form-group row">
						<label for="player_height" class="col-sm-2 col-form-label">Height</label>
						<div class="col-sm-10">
							<select class="form-control" id="player_height" name="player_height">
								<option selected="selected" value="">Select...</option>
								<?php
									$player_height = array("4'1","4'2","4'3","4'4","4'5","4'6","4'7","4'8","4'9","4'10","4'11","5'0","5'1","5'2","5'3","5'4","5'5","5'6","5'7","5'8","5'9","5'10","5'11","6'0", "6'1","6'2","6'3","6'4","6'5","6'6","6'7","6'8","6'9","6'10","6'11");

									foreach($player_height as $height) {
								?>
								<option value="<?php echo $height;?>"><?php echo $height; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>

					<div class="form-group row">
						<label for="player_weight" class="col-sm-2 col-form-label">Weight</label>
						<div class="col-sm-10">
							<input type="number" class="form-control" id="player_weight" name="player_weight" placeholder="100">
						</div>
					</div>

					<div class="form-group row">
						<label for="player_dob" class="col-sm-2 col-form-label">Birthday</label>
						<div class="col-sm-10">
							<input type="date" class="form-control" id="player_dob" name="player_dob">
						</div>
					</div>

					<div class="form-group row">
						<label for="player_img" class="col-sm-2 col-form-label">Player Photo</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="player_img" name="player_img" placeholder="Enter Photo URL">
						</div>
					</div>

			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary" id="btn-save" value="create">Save Changes</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
        </form>
	</div>
</div>

<!--crud operations-->

<script>
    $(document).ready(function () {
        $("#players_list").DataTable({
			responsive: true
		});

        /* when user clicks add player button */
        $('#create-new-player').click(function () {
            $('#btn-save').val("create-player");
            $('#player_id').val('');
            $('#playerForm').trigger("reset");
            $('#playerCrudModal').html("Add New Player");
            $('#ajax-player-modal').modal('show');
        });

        /* when user clicks edit player */
        $('body').on('click', "#edit-player", function () {
            let player_id = $(this).data("id");
            $.ajax({
                type: "POST",
                url: SITEURL + "admin/Player/get_player_by_id",
                data: {
                    id: player_id
                },
                dataType: "json",
                success: function (res) {
                    if(res.success == true) {
                        $('#title-error').hide();
                        $('#player_code-error').hide();
                        $('#description-error').hide();
                        $('#playerCrudModal').html("Edit Player");
                        $('#btn-save').val("edit-player");
                        $('#ajax-player-modal').modal('show');
						$('#player_id').val(res.data.id);
						$('#team_id').val(res.data.team_id);
						$('#player_name').val(res.data.player_name);
						$('#player_number').val(res.data.player_number);
						$('#player_position').val(res.data.player_position);
						$('#player_shoots').val(res.data.player_shoots);
						$('#player_height').val(res.data.player_height);
						$('#player_weight').val(res.data.player_weight);
						$('#player_dob').val(res.data.player_dob);
						$('#player_img').val(res.data.player_img);
                    }
                },
                error: function (data) {
					console.log('ERROR:' , data);
                }
            });
        });

        /* user clicks delete player */
        $('body').on('click', '#delete-player', function () {
            let player_id = $(this).data("id");

            if(confirm("Are you sure you want to delete this player?")) {
                $.ajax({
                    type: "POST",
                    url: SITEURL + "admin/Player/delete",
                    data: {
                        player_id: player_id
                    },
                    dataType: "json",
                    success: function (data) {
						$("#player_id" + player_id).remove();
						location.reload();
                    },
                    error: function (data) {
                        console.log('ERROR:', data);
                    }
                });
            }
        });
    });

    if($("#playerForm").length > 0) {
        $("#playerForm").validate({

            submitHandler: function (form) {
                let actionType = $('#btn-save').val();
                $('#btn-save').html('Sending...');

                $.ajax({
                    data: $('#playerForm').serialize(),
                    url: SITEURL + "admin/Player/store",
                    type: "POST",
                    dataType: "json",
                    success: function (res) {
                        let player = '<tr id="player_id_' + res.data.id + '"><td><td>' + res.data.player_img + '</td><td>' + res.data.player_name + '</td><td>' + res.data.player_number + '</td><td>' + res.data.team_id + '</td><td>' + res.data.player_position + '</td><td>' + res.data.player_shoots + '</td><td>' + res.data.player_height + '</td><td>' + res.data.player_weight + '</td><td>' + res.data.player_dob + '</td>';
						player += '<td><a href="javascript:void(0)" id="edit-player" res.data-id ="' + res.data.id + '" class="btn btn-info">Edit</a><a href="javascript:void(0)" id="delete-player" res.data-id="' + res.data.id + '" class="btn btn-danger delete-player">Delete</a></td></tr>';
						location.reload();

                        if(actionType == "create-player") {
                            $('#player_list').prepend(player);
                        } else {
                            $("#player_id_" + res.data.id).replaceWith(player);
                        }

                        $('#playerForm').trigger("reset");
                        $('#ajax-player-modal').modal('hide');
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

/* End of file Players.php */
/* Location: ./application/views/admin/Players.php */
