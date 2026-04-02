<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Faculty List</title> 
    </head>
    <?php include('topNavigation.php'); ?>
    </br>
    <body>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
            </tr>
            <?php foreach ($faculty as $faculty_member) : ?>
            <tr>
                <td><?php echo $faculty_member->get_id(); ?></td>
                <td><?php echo $faculty_member->get_name(); ?></td>
                <td><?php echo $faculty_member->get_email(); ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        </br>
        
        <h2>Add/Update Faculty</h2>
        <form action="faculty.php" method="post">
            <label>Name:</label>
            <input type="text" name="name" /><br>
            <label>Email:</label>
            <input type="text" name="email"/><br>
            <label>ID:</label>
            <input type="text" name="id"/><br>
            <input type="hidden" name='action' value='insert_or_update'/>
            <input type="radio" name="insert_or_update" value="insert" checked>Add</br>
            <input type="radio" name="insert_or_update" value="update">Update</br>
            <label>&nbsp;</label>
            <input type="submit" value="Submit"/>
        </form>
        </br>
        
        <h2>Delete Faculty</h2>
        <form action="faculty.php" method="post">
            <label>ID:</label>
            <input type="text" name="id"/><br>
            <input type="hidden" name='action' value='delete'/>
            <label>&nbsp;</label>
            <input type="submit" value="Delete Faculty"/>
        </form>
    </body>
    </br>
    <?php include('footer.php'); ?>
</html>
