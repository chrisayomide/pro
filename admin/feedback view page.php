<?php include 'db_connect.php'; ?>

<div class="col-lg-12">
    <div class="card card-outline card-info">
        <div class="card-header">
            <h3 class="card-title">Feedback from Students</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped" id="feedback-list">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Faculty</th>
                        <th>Student</th>
                        <th>Feedback</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $qry = $conn->query("SELECT f.firstname AS faculty_firstname, f.lastname AS faculty_lastname, s.firstname AS student_firstname, s.lastname AS student_lastname, fb.feedback, fb.date_submitted 
                                         FROM feedback_list fb 
                                         JOIN faculty_list f ON f.id = fb.faculty_id 
                                         JOIN student_list s ON s.id = fb.student_id 
                                         ORDER BY fb.date_submitted DESC");
                    $i = 1;
                    while($row = $qry->fetch_assoc()):
                    ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo ucwords($row['faculty_firstname'] . ' ' . $row['faculty_lastname']); ?></td>
                        <td><?php echo ucwords($row['student_firstname'] . ' ' . $row['student_lastname']); ?></td>
                        <td><?php echo $row['feedback']; ?></td>
                        <td><?php echo date('Y-m-d H:i:s', strtotime($row['date_submitted'])); ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    $('#feedback-list').DataTable();
});
</script>
