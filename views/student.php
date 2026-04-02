<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Student List</title> 
    </head>
    <?php include('topNavigation.php'); ?>
    </br>
    <body>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Major</th>
            </tr>
            <?php foreach ($students as $student) : ?>
            <tr>
                <td><?php echo $student->get_id(); ?></td>
                <td><?php echo $student->get_name(); ?></td>
                <td><?php echo $student->get_major(); ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        </br>
        
        <h2>Add/Update Student</h2>
        <form action="student.php" method="post">
            <label>Name:</label>
            <input type="text" name="name" /><br>
            <label>Major:</label>
            <input type="text" name="major"/><br>
            <label>ID:</label>
            <input type="text" name="id"/><br>
            <input type="hidden" name='action' value='insert_or_update'/>
            <input type="radio" name="insert_or_update" value="insert" checked>Add</br>
            <input type="radio" name="insert_or_update" value="update">Update</br>
            <label>&nbsp;</label>
            <input type="submit" value="Submit"/>
        </form>
        </br>
        
        <h2>Delete Student</h2>
        <form action="student.php" method="post">
            <label>ID:</label>
            <input type="text" name="id"/><br>
            <input type="hidden" name='action' value='delete'/>
            <label>&nbsp;</label>
            <input type="submit" value="Delete Student"/>
        </form>
    </body>
    </br>
    <?php include('footer.php'); ?>
</html>


