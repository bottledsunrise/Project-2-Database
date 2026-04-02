<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Enrollment List</title> 
    </head>
    <?php include('topNavigation.php'); ?>
    </br>
    <body>
        <table>
            <tr>
                <th>ID</th>
                <th>Student ID</th>
                <th>Section ID</th>
                <th>Grade</th>
            </tr>
            <?php foreach ($enrollments as $enrollment) : ?>
            <tr>
                <td><?php echo $enrollment->get_id(); ?></td>
                <td><?php echo $enrollment->get_student_id(); ?></td>
                <td><?php echo $enrollment->get_section_id(); ?></td>
                <td><?php echo $enrollment->get_grade(); ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        </br>
        
        <h2>Add Enrollment</h2>
        <form action="enrollment.php" method="post">
            <label>Student ID:</label>
            <input type="text" name="student_id" /><br>
            <label>Section ID:</label>
            <input type="text" name="section_id"/><br>
            <label>Grade:</label>
            <input type="text" name="grade"/><br>
            <input type="hidden" name='action' value='insert'/>
            <label>&nbsp;</label>
            <input type="submit" value="Add Enrollment"/>
        </form>
        </br>
        
        <h2>Update Enrollment</h2>
        <form action="enrollment.php" method="post">
            <label>ID:</label>
            <input type="text" name="id"/><br>
            <label>Student ID:</label>
            <input type="text" name="student_id" /><br>
            <label>Section ID:</label>
            <input type="text" name="section_id"/><br>
            <label>Grade:</label>
            <input type="text" name="grade"/><br>
            <input type="hidden" name='action' value='update'/>
            <label>&nbsp;</label>
            <input type="submit" value="Update Enrollment"/>
        </form>
        </br>
        
        <h2>Delete Enrollment</h2>
        <form action="enrollment.php" method="post">
            <label>ID:</label>
            <input type="text" name="id"/><br>
            <input type="hidden" name='action' value='delete'/>
            <label>&nbsp;</label>
            <input type="submit" value="Delete Enrollment"/>
        </form>
    </body>
    </br>
    <?php include('footer.php'); ?>
</html>

