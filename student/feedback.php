<?php include 'db_connect.php'; ?>

<div class="col-lg-12">
    <div class="card card-outline card-info">
        <div class="card-header">
            <h3 class="card-title">Submit Feedback</h3>
        </div>
        <div class="card-body">
            <form id="feedback-form">
                <div class="form-group">
                    <label for="faculty_id">Select Faculty:</label>
                    <select name="faculty_id" id="faculty_id" class="form-control" required>
                        <option value="">Choose Faculty</option>
                        <?php
                        $faculties = $conn->query("SELECT * FROM faculty_list");
                        while ($row = $faculties->fetch_assoc()) {
                            echo "<option value='{$row['id']}'>{$row['firstname']} {$row['lastname']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="feedback">Your Feedback:</label>
                    <textarea name="feedback" id="feedback" class="form-control" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit Feedback</button>
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    $('#feedback-form').submit(function(e){
        e.preventDefault();
        $.ajax({
            url: 'ajax.php?action=save_feedback',
            method: 'POST',
            data: $(this).serialize(),
            success: function(resp){
                if(resp == 1){
                    alert_toast("Feedback successfully submitted.", 'success');
                    $('#feedback-form')[0].reset(); // Clear form
                } else {
                    alert_toast("Error submitting feedback. Please try again.", 'error');
                }
            }
        });
    });
});
</script>
