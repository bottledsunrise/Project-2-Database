<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Sections List</title>
    </head>
    <?php include('topNavigation.php'); ?>
    </br>
    <body>
        <table>
            <tr>
                <th>ID</th>
                <th>Course Code</th>
                <th>Faculty ID</th>
                <th>Semester</th>
            </tr>
           <?php foreach ($sections as $section) : ?>
                <tr>
                    <td><?php echo $section->get_id(); ?></td>
                    <td><?php echo $section->get_course_code(); ?></td>
                    <td><?php echo $section->get_faculty_id(); ?></td>
                    <td><?php echo $section->get_semester(); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
        </br>
        
        <h2>Add/Update Section</h2>
        <form action ="section.php" method="post">
            <label>Course Code:</label>
            <input type ="text" name="course_code"/><br>
            
            <label>Faculty ID:</label>
            <input type ="text" name="faculty_id"/><br>
            
            <label>Semester:</label>
            <input type ="text" name="semester"/><br>
            
            <label>ID:</label>
            <input type ="text" name="id"/><br>
            
            <input type="hidden" name="action" value="insert_or_update"/>
            <input type="radio" name="insert_or_update" value="insert" checked>Add</br>
            <input type="radio" name="insert_or_update" value="update">Update</br>
            <label>&nbsp;</label>
            <input type="submit" value="Submit"/>
        </form>
        </br>
        
        <h2>Delete Section</h2>
        <form action="section.php" method="post">
            <label>ID:</label>
            <input type="text" name="id"/><br>
            <input type="hidden" name='action' value='delete'/>
            <label>&nbsp;</label>
            <input type="submit" value="Delete Section"/>
        </form>
        </br>
    </body>
    <?php include('footer.php'); ?>
</html>

